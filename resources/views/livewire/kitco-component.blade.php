<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kitcos</h3>

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
                                <th wire:click="sort('category_id')" style="cursor: pointer">Metal Type <i
                                        class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sort('categorytype_id')" style="cursor: pointer">Gram <i
                                        class="fas fa-sort"></i>
                                </th>

                                <th wire:click="sort('order_by')" style="cursor: pointer">Rate <i
                                        class="fas fa-sort"></i></th>
                                <th>10Kt</th>
                                <th>14Kt</th>
                                <th>18Kt</th>
                                <th>22Kt</th>
                                <th>Action <button wire:click="add" type="button" data-toggle="modal"
                                        data-target="#exampleModal" class="btn text-lg p-0 m-0"> <i
                                            class="fas fa-plus-square"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kitcos as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $item->metal->code }}</td>
                                    <td class="text-capitalize">{{ $item->gram }}</td>
                                    <td class="text-capitalize">{{ $item->rate }}</td>
                                    <td class="text-capitalize">{{ $item->kt10 }}</td>
                                    <td class="text-capitalize">{{ $item->kt14 }}</td>

                                    <td>{{ $item->kt18 }}</td>
                                    <td>{{ $item->kt22 }}</td>

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
            {{ $kitcos->links() }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog @if ($delete != 'delete') modal-xl @endif" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalLabel">Kitcos </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body  px-4">
                    @if ($delete != 'delete')
                        <div class="row pb-3 ">
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0 " style="font-weight: 600">Metal Type
                                </label>
                                <select id="" class="col-lg rounded  my-0 text-capitalize" {{ $disabled }}
                                    wire:model="metal_type_id" style="outline: 0; padding:4px;border:1px solid black">
                                    <option value="">Select Metal Type</option>
                                    @foreach ($metal_types as $item)
                                        <option value="{{ $item->id }}">{{ $item->code }}</option>
                                    @endforeach
                                </select>

                                @error('metal_type_id')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Gram
                                </label>
                                <input type="number" placeholder="Gram" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="gram"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('gram')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Rate
                                </label>
                                <input type="number" placeholder="Rate" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="rate"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('rate')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">10Kt</label>
                                <input type="number" placeholder="10Kt" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="kt10"
                                    style="outline: 0; padding:4px;border:1px solid black">

                            </div>
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">14Kt</label>
                                <input type="number" placeholder="14Kt" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="kt14"
                                    style="outline: 0; padding:4px;border:1px solid black">

                            </div>
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">18Kt</label>
                                <input type="number" placeholder="18Kt" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="kt18"
                                    style="outline: 0; padding:4px;border:1px solid black">

                            </div>
                            <div class="col-lg-3 col-md-6 mb-2">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">22Kt</label>
                                <input type="number" placeholder="22Kt" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="kt22"
                                    style="outline: 0; padding:4px;border:1px solid black">

                            </div>

                        </div>
                    @else
                        <span class="text-danger"> Are you sure to delete this?</span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    @if ($mt_id && $delete == 'delete')
                        <button type="button" wire:click.prevent="delete()" data-dismiss="modal"
                            class="btn btn-danger close-modal">Delete</button>
                    @elseif($mt_id)
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
