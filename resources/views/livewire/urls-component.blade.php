<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">URLs List</h3>

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
                                <th wire:click="sort('text')" style="cursor: pointer">Text <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('url')" style="cursor: pointer">URL <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('icon')" style="cursor: pointer">icon <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('label')" style="cursor: pointer">Label <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('label_color')" style="cursor: pointer">Label Color<i
                                        class="fas fa-sort"></i></th>
                                <th wire:click="sort('order_by')" style="cursor: pointer">Order By <i
                                        class="fas fa-sort"></i></th>

                                <th>Action <button wire:click="add" type="button" data-toggle="modal"
                                        data-target="#exampleModal" class="btn text-lg p-0 m-0"> <i
                                            class="fas fa-plus-square"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($urls as $item)
                                <tr>
                                    <td>{{ $item->text }}</td>
                                    <td>{{ $item->url }}</td>
                                    <td>
                                        <i class="{{ $item->icon }}"></i>
                                        {{ $item->icon }}
                                    </td>
                                    <td>{{ $item->label }}</td>
                                    <td><span
                                            class="badge badge-{{ $item->label_color }} right">{{ $item->label_color }}</span>
                                    </td>
                                    <td>{{ $item->order_by }}</td>
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
                                        {{--   <button class="btn text-danger p-0" data-toggle="modal" data-target="#exampleModal"
                                        wire:click="deleteConfirmation({{$item->id}},'delete')">
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
            {{ $urls->links() }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog @if ($delete != 'delete') modal-xl @endif" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalLabel">URL Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body  px-4">
                    @if ($delete != 'delete')
                        <div class="row pb-3 ">
                            <div class="col-lg-3 ">
                                <label for="floatingInput" class="my-0 "
                                    style="font-weight: 600; color:#000000">Text</label>
                                <input type="text" placeholder="Text" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="url_text"
                                    style="outline: 0; padding:4px; border:1px solid black">
                                @error('url_text')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">URL</label>
                                <input type="text" placeholder="URL" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="url"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('url')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Icon</label>
                                <input type="text" placeholder="Icon" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="icon"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('icon')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Label</label>
                                <input type="text" placeholder="Label" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="label"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('label')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Label
                                    Color</label>
                                <input type="text" placeholder="Label Color" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="label_color"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('label_color')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Order By</label>
                                <input type="text" placeholder="Order By" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="order_by"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('order_by')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Menu</label>
                                @livewire('component.nullable-search-component', [
                                    'table_name' => 'menus',
                                    'table_search_column' => 'text',
                                    'name' => 'menu_id',
                                    'table_default_value' => $menu_id,
                                ])
                                @error('order_by')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @else
                        <span class="text-danger"> Are you sure to delete this employee?</span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    @if ($url_id && $delete == 'delete')
                        <button type="button" wire:click.prevent="delete()" data-dismiss="modal"
                            class="btn btn-danger close-modal">Delete</button>
                    @elseif($url_id)
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
