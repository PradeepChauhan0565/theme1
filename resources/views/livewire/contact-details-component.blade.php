<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Details</h3>

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
                                <th wire:click="sort('text')" style="cursor: pointer">Emal <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('text')" style="cursor: pointer">Mobile number <i
                                        class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('url')" style="cursor: pointer">Whatsapp number <i
                                        class="fas fa-sort"></i>
                                </th>

                                <th wire:click="sort('order_by')" style="cursor: pointer">Phone number <i
                                        class="fas fa-sort"></i></th>

                                <th>Action <button wire:click="add" type="button" data-toggle="modal"
                                        data-target="#exampleModal" class="btn text-lg p-0 m-0"> <i
                                            class="fas fa-plus-square"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $item)
                                <tr>

                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile_number }}</td>
                                    <td>{{ $item->whatsapp_number }}</td>
                                    <td>{{ $item->phone_number }}</td>
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
                                        {{-- <button class="btn text-danger p-0" data-toggle="modal"
                                            data-target="#exampleModal"
                                            wire:click="deleteConfirmation({{ $item->id }},'delete')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button> --}}
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
        aria-labelledby="exampleModalLabel" aria-hidden="true" enctype="multipart/form-data">
        <div class="modal-dialog @if ($delete != 'delete') modal-xl @endif" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body  px-4">
                    @if ($delete != 'delete')
                        <div class="row pb-3 ">

                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Email</label>
                                <input type="email" placeholder="Email" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="email"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('email')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Mobile number</label>
                                <input type="number" placeholder="Mobile number" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="mobile_number"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('mobile_number')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Whatsapp
                                    number</label>
                                <input type="number" placeholder="Whatsapp number" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="whatsapp_number"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('whatsapp_number')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Phone
                                    number</label>
                                <input type="number" placeholder="Phone number" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="phone_number"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('phone_number')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    @else
                        <span class="text-danger"> Are you sure to delete this ?</span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    @if ($ct_id && $delete == 'delete')
                        <button type="button" wire:click.prevent="delete()" data-dismiss="modal"
                            class="btn btn-danger close-modal">Delete</button>
                    @elseif($ct_id)
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
