<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Role Map User</h3>

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
                                <th wire:click="sort('role_id')" style="cursor: pointer">Role <i
                                        class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('user_id')" style="cursor: pointer">USER <i
                                        class="fas fa-sort"></i>
                                </th>
                                <th>Action <button wire:click="add" type="button" data-toggle="modal"
                                        data-target="#exampleModal" class="btn text-lg p-0 m-0"> <i
                                            class="fas fa-plus-square"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role_users as $item)
                                <tr>
                                    <td>{{ $item->role->role_name ?? '' }}</td>
                                    <td>{{ $item->user->name ?? '' }}</td>
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
            {{ $role_users->links() }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog @if ($delete != 'delete') modal-xl @endif" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalLabel">Role Map User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body  px-4">
                    @if ($delete != 'delete')
                        <div class="row pb-3 ">
                            <div class="col-lg-3 ">
                                <label for="floatingInput" class="my-0 "
                                    style="font-weight: 600; color:#000000">Role</label>
                                <select class="col-lg rounded text-md my-0" aria-label="Default select example"
                                    {{ $disabled }} wire:model="role_id"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">User</label>
                                @livewire('component.search-component', [
                                    'table_name' => 'users',
                                    'table_search_column' => 'name',
                                    'name' => 'user_id',
                                    'table_default_value' => $user_id,
                                ])
                                @error('user_id')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-lg-3">
                            <label for="floatingInput" class="my-0" style="font-weight: 600">USER</label>
                            <select class="col-lg rounded text-md my-0" aria-label="Default select example"
                                {{$disabled}} wire:model="user_id"
                                style="outline: 0; padding:4px;border:1px solid black">
                                <option value="">Select User</option>
                                @foreach ($users as $user)                                    
                                <option value="{{$user->id}}">{{$user->user}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                        </div> --}}
                        </div>
                    @else
                        <span class="text-danger"> Are you sure to delete this employee?</span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    @if ($role_user_id && $delete == 'delete')
                        <button type="button" wire:click.prevent="delete()" data-dismiss="modal"
                            class="btn btn-danger close-modal">Delete</button>
                    @elseif($role_user_id)
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
