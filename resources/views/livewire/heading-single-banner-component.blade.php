<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Headings and Single banner</h3>

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
                                <th>Heading first </th>
                                <th>Heading second </th>
                                <th>Heading third </th>

                                <th>Heading forth </th>
                                <th>Banner image </th>
                                <th>Image Title </th>
                                <th>Url </th>

                                <th>Action <button wire:click="add" type="button" data-toggle="modal"
                                        data-target="#exampleModal" class="btn text-lg p-0 m-0"> <i
                                            class="fas fa-plus-square"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($headings as $item)
                                <tr>

                                    <td>{{ $item->heading_first }}</td>
                                    <td>{{ $item->heading_second }}</td>
                                    <td>{{ $item->heading_third }}</td>
                                    <td>{{ $item->heading_forth }}</td>
                                    <td> <img style="width: 100px;"
                                            src="{{ asset('storage/singlebanner/' . $item->banner_image) }}"
                                            alt="{{ $item->image_title }}"></td>
                                    <td>{{ $item->image_title }}</td>
                                    <td>{{ $item->url }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Headings and Single banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body  px-4">
                    @if ($delete != 'delete')
                        <div class="row pb-3 ">

                            <div class="col-lg-3 col-md-6">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Heading first</label>
                                <input type="text" placeholder="Heading first" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="heading_first"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('heading_first')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Heading
                                    second</label>
                                <input type="text" placeholder="Heading second" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="heading_second"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('heading_second')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-lg-3 col-md-6">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Heading
                                    third</label>
                                <input type="text" placeholder="Heading third" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="heading_third"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('heading_third')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Heading
                                    forth</label>
                                <input type="text" placeholder="Heading forth" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="heading_forth"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('heading_forth')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-lg-3 col-md-6 ">
                                <label for="floatingInput" class="my-0 "
                                    style="font-weight: 600; color:#000000">Banner Image</label>
                                <input type="file" placeholder="Text" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="banner_image"
                                    style="outline: 0; padding:4px; border:1px solid black">
                                <div wire:loading wire:target="banner_image"><i
                                        class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>

                                @if ($banner_image)
                                    Photo Preview:
                                    <img style="width:100px" src="{{ $banner_image->temporaryUrl() }}">
                                @elseif($old_banner_image)
                                    Old Image:
                                    <div class="position-relative m-2">
                                        <img style="width: 100px;"
                                            src="{{ asset('storage/singlebanner/' . $old_banner_image) }}"
                                            alt="">
                                        <div class="position-absolute"
                                            style="top:2px; right:5px; cursor:pointer; color:red" title="Remove"
                                            wire:click.prevent="removeoldImage()"><i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                @endif
                                @error('banner_image')
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
                                <label for="floatingInput" class="my-0" style="font-weight: 600">Url</label>
                                <input type="text" placeholder="Url" class="col-lg rounded  my-0"
                                    {{ $disabled }} wire:model="url"
                                    style="outline: 0; padding:4px;border:1px solid black">
                                @error('url')
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
                    @if ($h_id && $delete == 'delete')
                        <button type="button" wire:click.prevent="delete()" data-dismiss="modal"
                            class="btn btn-danger close-modal">Delete</button>
                    @elseif($h_id)
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
