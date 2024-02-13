<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Diamond Quality</h3>

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
                                <th wire:click="sort('category_id')" style="cursor: pointer">Code <i
                                        class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('categorytype_id')" style="cursor: pointer">Description <i
                                        class="fas fa-sort"></i>
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
                            @foreach ($diadond_qualities as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $item->code }}</td>
                                    <td class="text-capitalize">{{ $item->description }}</td>

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
            {{ $diadond_qualities->links() }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog @if ($delete != 'delete') modal-xl @endif" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalLabel">Diamond Quality </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body  px-4">
                    @if ($delete != 'delete')
                        <div class="row pb-3 ">
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Code
                                </label>
                                <input type="text" placeholder="code" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="code"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('code')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Description
                                </label>
                                <input type="text" placeholder="Description" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="description"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('description')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2">
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
                    @if ($sz_id && $delete == 'delete')
                        <button type="button" wire:click.prevent="delete()" data-dismiss="modal"
                            class="btn btn-danger close-modal">Delete</button>
                    @elseif($sz_id)
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
