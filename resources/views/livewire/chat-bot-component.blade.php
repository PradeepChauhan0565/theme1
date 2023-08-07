<div>
    <div class="row d-flex justify-content-center" style="width:380px;">
        <div class="col-12">
            <div class="card" id="chat1" style="border-radius: 15px;">
                <div class="card-header d-flex justify-content-between align-items-center px-3 bg-info text-white border-bottom-0"
                    style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <button wire:click="backToContact" class="btn btn-outline-light">
                        <i class="fas fa-angle-left"></i>
                    </button>
                    @if($user)
                    {{$user}}
                    @else
                    Chats
                    @endif
                    <div style="position: absolute; right: 20px;">
                        <i class="fas fa-times" onclick="closeForm()" style="cursor: pointer;"></i>
                    </div>
                </div>

                <div class="card-body" style="min-height: 450px;">
                    @if($room_id)
                    <div style="max-height: 350px; overflow-y: auto; " class="chatContainer my-scroll"
                        id="chatContainer" @if($is_open) wire:poll.1s="getNewChat" @endif>
                        @foreach ($messages as $message)
                        @if($message->sender_id==Auth::user()->id)
                        <div class="d-flex flex-row justify-content-end mb-4">
                            <div class="p-3 me-3 border"
                                style="border-radius: 15px; background-color: rgba(122, 252, 191, 0.2);">
                                <p class="small mb-0">
                                    {{$message->body}}
                                <div style="font-size: 9px; width: 60px; float: right;">
                                    {{Carbon\Carbon::parse($message->created_at)->format('g:i A')}}
                                    @if($message->is_seen && $message->is_delivered)
                                    <i class="fas fa-check-double text-info"></i>
                                    @elseif($message->is_delivered)
                                    <i class="fas fa-check-double"></i>
                                    @else
                                    <i class="fas fa-check"></i>
                                    @endif
                                </div>
                                </p>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                                alt="avatar 1" style="width: 45px; height: 100%;">
                        </div>

                        @else
                        <div class="d-flex flex-row justify-content-start mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                alt="avatar 1" style="width: 45px; height: 100%;">
                            <div class="p-3 ms-3" style="border-radius: 15px; background-color: #ebebeb;">
                                <p class="small mb-0">
                                    {{$message->body}}
                                    <sub style="font-size: 9px;">
                                        {{Carbon\Carbon::parse($message->created_at)->format('g:i A')}}

                                    </sub>
                                </p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        {{-- <div class="d-flex flex-row justify-content-start mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                alt="avatar 1" style="width: 45px; height: 100%;">
                            <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                                <p class="small mb-0">...</p>
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-outline" style="position: absolute; bottom: 0px; width: 91%">
                        <div style="display: flex">
                            <textarea rows="1" wire:model="message_body" wire:keydown.enter='sendMessage'></textarea>
                            @if(strlen(trim($message_body))>0)
                            <button wire:click="sendMessage" class="my-btn"
                                style="background-color: none; border:none;">
                                <i class="far fa-paper-plane"></i>
                            </button>
                            @else
                            <label for="" class="my-btn"></label>
                            @endif
                        </div>
                    </div>
                    @else
                    <div>
                        <div>
                            <div class="relative">
                                <input style="outline: 0; padding:3px;border:1px solid black" type="text"
                                    class="col-lg rounded  " placeholder="Search user..." wire:model="query_chat_user"
                                    wire:click="queryClick" wire:keydown.escape="reset1"
                                    wire:keydown.arrow-up="decrementHighlight"
                                    wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="selectContact" />
                                <br>
                                <div wire:loading
                                    class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group"
                                    style="position: absolute">
                                    <div class="list-item">Searching...</div>
                                </div>

                                {{-- @if(!empty($query))
                                <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="reset"></div> --}}

                                <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group"
                                    style="position: absolute; z-index: 9999;">
                                    @if(!empty($contacts))
                                    @foreach($contacts as $i => $contact)
                                    <button wire:click="setData({{$contact['id'] }})"
                                        class="list-item btn {{ $highlightIndex === $i ? 'highlight' : '' }}">
                                        {{ $contact['name'] }}
                                    </button>
                                    @endforeach
                                    @else
                                    {{-- <div class="list-item">No results!</div> --}}
                                    @endif
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                    <div style="max-height: 350px; overflow-y: auto;" class="my-scroll" @if($is_open)
                        wire:poll.1s="getRooms" @endif>
                        @foreach ($rooms as $room)
                        @if($room->message)
                        <div wire:click="chatClick({{$room->id}})" class="card"
                            style="padding: 10px; margin: 1px 0px; cursor: pointer;">
                            <div class="row">
                                <div class="col-8">
                                    <b> {{$room->users->where('id','!=',Auth::user()->id)->first()->name ?? ""}}</b>
                                </div>
                                <div class="col-4" style="font-size: 10px; text-align: right">
                                    <span class="text-success">
                                        {{$room->message->created_at->diffForHumans() ?? ""}}

                                    </span>
                                </div>
                                <div class="col-10">
                                    {{$room->message->body ?? ""}}
                                </div>
                                <div class="col-2" style="font-size: 16px; text-align: right">
                                    @if(count($room->messages)>0)
                                    <span class="badge badge-pill badge-success">{{count($room->messages)}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>