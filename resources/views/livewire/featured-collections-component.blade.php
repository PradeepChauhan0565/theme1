<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Featured Collections</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input wire:model="search" type="text" name="table_search" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th wire:click="sort('fc_image')" style="cursor: pointer">Collections Image <i
                                        class="fas fa-sort"></i>
                                </th>

                                <th wire:click="sort('image_title')" style="cursor: pointer">Image Title <i
                                        class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('url')" style="cursor: pointer">URL <i class="fas fa-sort"></i>
                                </th>

                                <th wire:click="sort('order_by')" style="cursor: pointer">Order By <i
                                        class="fas fa-sort"></i></th>
                                <th>Status</th>
                                <th>Action <button wire:click="add" type="button" data-toggle="modal"
                                        data-target="#exampleModal" class="btn text-lg p-0 m-0"> <i
                                            class="fas fa-plus-square"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collections as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/collections/' . $item->fc_image) }}"
                                            alt="{{ $item->image_title }}" style="width: 100px">

                                    </td>
                                    <td>{{ $item->image_title }}</td>
                                    <td>{{ $item->url }}</td>

                                    <td>{{ $item->order_by }}</td>
                                    <td> <select class="py-1" wire:model="status.{{ $item->id }}"
                                            style="width: 100px" wire:change="statusChange({{ $item->id }})"
                                            class="w-full  text-black border border-gray-500 rounded py-1.5 px-2 mb-3 mr-2"
                                            required>
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select></td>
                                    <td>
                                        <button class="btn text-success p-0" wire:click="edit({{ $item->id }})"
                                            data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-user-edit"></i>
                                        </button>
                                        <button wire:click="view('disabled',{{ $item->id }})"
                                            class="btn text-primary p-1" data-toggle="modal"
                                            data-target="#exampleModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn text-danger p-0" data-toggle="modal"
                                            data-target="#exampleModal"
                                            wire:click="deleteConfirmation({{ $item->id }},'delete')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
            {{-- {{$urls->links()}} --}}
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog @if ($delete != 'delete') modal-xl @endif" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalLabel">Featured Collections</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body  px-4">
                    @if ($delete != 'delete')
                        <div class="row pb-3 ">
                            <div class="col-lg-3 col-md-6 ">
                                <label for="floatingInput" class="my-0 " style="font-weight: 600; color:#000000">Image
                                    <span style="color:#a19898; font-size:13px;">(250px * 330px)</span></label>
                                <input type="file" placeholder="Text" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="fc_image"
                                    style="outline: 0; padding:4px; border:1px solid black">
                                <div wire:loading wire:target="fc_image"><i
                                        class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>

                                @if ($fc_image)
                                    Photo Preview:
                                    <img style="width:100px" src="{{ $fc_image->temporaryUrl() }}">
                                @elseif($oldfc_image)
                                    <img style="width: 100px;" src="{{ asset('storage/collections/' . $oldfc_image) }}"
                                        alt="">
                                @endif
                                @error('fc_image')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-lg-3 col-md-6">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Image
                                    Title</label>
                                <input type="text" placeholder="Image Title" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="image_title"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('image_title')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">URL</label>
                                <input type="text" placeholder="Url" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="url"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('url')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Order By</label>
                                <input type="number" placeholder="Order By" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="order_by"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('order_by')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    @else
                        <span class="text-danger"> Are you sure to delete this?</span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    @if ($fc_id && $delete == 'delete')
                        <button type="button" wire:click.prevent="delete()" data-dismiss="modal"
                            class="btn btn-danger close-modal">Delete</button>
                    @elseif($fc_id)
                        <button type="button" wire:click.prevent="update()"
                            class="btn btn-primary close-modal">Update</button>
                    @else
                        <button type="button" wire:click.prevent="store()"
                            class="btn btn-primary close-modal">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
