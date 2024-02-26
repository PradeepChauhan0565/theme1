<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        #image-upload-button {
            width: 100%;
            height: 70px;
            background: rgb(221, 218, 218);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
    </style>

    @if ($action == 'add_new' || $action == 'edit')

        <div class="border p-2">
            <div class="d-flex justify-content-end mb-2">
                <button class=" btn-secondary border-0" wire:click="back"><i class="fas fa-arrow-left"></i></button>
            </div>
            <div class="row pb-5">
                <div class="d-flex align-items-start ">
                    <div class="nav flex-column nav-pills me-3  px-2" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active " id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">Product</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="false">Category</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-messages" type="button" role="tab"
                            aria-controls="v-pills-messages" aria-selected="false">Details</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-settings" type="button" role="tab"
                            aria-controls="v-pills-settings" aria-selected="false">Image</button>
                    </div>
                    <div class="tab-content bg-white w-100 border shadow" id="v-pills-tabContent">
                        <div class="tab-pane fade show active p-2" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab" wire:ignore.self>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label for="SKU">SKU</label>
                                    <input wire:model="sku" type="text" class="form-control" placeholder="SKU">
                                    @error('sku')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Name">Name</label>
                                    <input wire:model="name" type="text" class="form-control" placeholder="Name">
                                    @error('name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="SKU">Regular Price</label>
                                    <input wire:model="regular_price" type="number" class="form-control"
                                        placeholder="Regular Price">
                                    @error('regular_price')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Name">Sale Price</label>
                                    <input wire:model="sale_price" type="number" class="form-control"
                                        placeholder="Sale Price">
                                </div>


                                <div class="col-lg-6 mb-2">
                                    <label for="Short discretion">Short Discretion</label>
                                    <textarea wire:model="short_desc" class="form-control" rows="4" cols="50" placeholder="Short Discretion..."></textarea>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Long discretion">Long Discretion</label>
                                    <textarea wire:model="long_desc" class="form-control" rows="4" cols="50" placeholder="Long Discretion..."></textarea>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="Material Type">Default Image Color</label>
                                    <select wire:model="image_color_id" id=""
                                        class="w-100 py-1 px-2 border rounded">
                                        <option value="">Select Image Color</option>
                                        <option value="w" class="text-capitalize ">White </option>
                                        <option value="r" class="text-capitalize ">Rose </option>
                                        <option value="y" class="text-capitalize ">Yellow </option>
                                    </select>
                                    @error('metal_color_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Material Type">Product Size</label>
                                    <select wire:model="productSize_id" id=""
                                        class="w-100 py-1 px-2 border rounded">
                                        <option value="">Select Size</option>

                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->code }} </option>
                                        @endforeach
                                    </select>
                                    @error('metal_color_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button wire:click="product()" class="btn btn-success">Save</button>
                            </div>
                        </div>
                        <div class="tab-pane fade p-2" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab" wire:ignore.self>
                            <div class="row">
                                <div class="col-lg-4 mb-2">
                                    <label for="category">Category</label>
                                    <select wire:model="category_id" id=""
                                        class="w-100 py-1 px-2 border rounded">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" class="text-capitalize ">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <label for="categorytype_id">Categorytype</label>
                                    <select wire:model="categorytype_id" id=""
                                        class="w-100 py-1 px-2 border rounded">
                                        <option value="">Select Categorytype</option>
                                        @foreach ($categorytypes as $item)
                                            <option value="{{ $item->id }}" class="text-capitalize ">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categorytype_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <label for="Subcategory">Subcategory</label>
                                    <select wire:model="sub_category_id" id=""
                                        class="w-100 py-1 px-2 border rounded">
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $item)
                                            <option value="{{ $item->id }}" class="text-capitalize ">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_category_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button wire:click="productCategory()" class="btn btn-success">Save</button>
                            </div>
                        </div>
                        <div class="tab-pane fade p-2" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab" wire:ignore.self>
                            <div class="row ">
                                <div class="col-lg-6 mb-2">
                                    <label for="Material Type">Material Type</label>
                                    <select wire:model="material_type_id" id=""
                                        class="w-100 py-1 px-2 border rounded">
                                        <option value="">Select Material</option>
                                        @foreach ($materialType as $item)
                                            <option value="{{ $item->id }}" class="text-capitalize ">
                                                {{ $item->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($material_type_id == 2)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Metal Type">Metal Type</label>
                                        <select wire:model="metal_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Metal Type</option>
                                            @foreach ($metals as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 2)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Metal Type">Metal Purity</label>
                                        <select wire:model="metalQualitiy_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Purity</option>
                                            @foreach ($metalPurity as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Material Type">Diamond Quantity</label>
                                        <select wire:model="diamondQuality_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Metal Type</option>
                                            @foreach ($diadondQuality as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 2)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Metal Type">Metal Color</label>
                                        <select wire:model="metalColor_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Metal Color</option>
                                            @foreach ($metalColors as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Material Type">Diamond Color</label>
                                        <select wire:model="diamondColor_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Diamond Color</option>
                                            @foreach ($diamondColors as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Color Stone color">Color Stone Color</label>
                                        <select wire:model="colorStoneColor_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Color Stone Color</option>
                                            @foreach ($colorStoneColors as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Material Type">Diamond Shape</label>
                                        <select wire:model="diamondShape_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Diamond Shape</option>
                                            @foreach ($diamondShapes as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Material Type">Diamond Size</label>
                                        <select wire:model="diamondSize_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Diamond Size</option>
                                            @foreach ($diamondSizes as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Material Type">Color Stone Shape</label>
                                        <select wire:model="colorStoneShape_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Color Stone Shape</option>
                                            @foreach ($colorStoneShapes as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Material Type">Color Stone Size</label>
                                        <select wire:model="colorStoneSize_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Color Stone Size</option>
                                            @foreach ($colorStoneSizes as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Diamond Type">Diamond Setting</label>
                                        <select wire:model="diamondSetting_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Diamond Setting</option>
                                            @foreach ($settings as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Color Stone Type">Color Stone Setting</label>
                                        <select wire:model="colorStoneSetting_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Setting</option>
                                            @foreach ($settings as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Color Stone name">Color Stone Name</label>
                                        <select wire:model="colorStoneName_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Color Stone Name</option>
                                            @foreach ($colorStoneNames as $item)
                                                <option value="{{ $item->id }}" class="text-capitalize ">
                                                    {{ $item->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 2)
                                    <div class="col-lg-6 mb-2">
                                        <label for="metal weight">Metal Weight</label>
                                        <input wire:model="metalWeight" type="text" class="form-control"
                                            placeholder="Metal Weight">
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Diamond weight">Diamond Weight</label>
                                        <input wire:model="diamondWeight" type="text" class="form-control"
                                            placeholder="Diamond Weight">
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Color Stone weight">Color Stone Weight</label>
                                        <input wire:model="colorStoneWeight" type="text" class="form-control"
                                            placeholder="colorStone Weight">
                                    </div>
                                @endif
                                @if ($material_type_id == 2)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Metal price">Metal Price</label>
                                        <input wire:model="metalPrice" type="text" class="form-control"
                                            placeholder="Metal Price">
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Diamond price">Diamond Price</label>
                                        <input wire:model="diamondPrice" type="text" class="form-control"
                                            placeholder="Diamond Price">
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Color Stone price">Color Stone Price</label>
                                        <input wire:model="colorStonePrice" type="text" class="form-control"
                                            placeholder="Color Stone Price">
                                    </div>
                                @endif
                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Diamond quantity">Diamond Quantity</label>
                                        <input type="text" wire:model="diamondQty" class="form-control"
                                            placeholder="Diamond Quantity">
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Color Stone quantity">Color Stone Quantity</label>
                                        <input type="text" wire:model="colorStoneQty" class="form-control"
                                            placeholder="Color Stone Quantity">
                                    </div>
                                @endif

                                @if ($material_type_id == 3)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Material Type">Center Stone</label>
                                        <select wire:model="diamondCenterStone_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Center Stone</option>
                                            <option value="1" class="text-capitalize "> Yes</option>
                                            <option value="0" class="text-capitalize "> No</option>
                                        </select>
                                    </div>
                                @endif
                                @if ($material_type_id == 4)
                                    <div class="col-lg-6 mb-2">
                                        <label for="Color Stone Type">Center Stone</label>
                                        <select wire:model="colorStoneCenterStone_id" id=""
                                            class="w-100 py-1 px-2 border rounded">
                                            <option value="">Select Center Stone</option>
                                            <option value="1" class="text-capitalize "> Yes</option>
                                            <option value="0" class="text-capitalize "> No</option>
                                        </select>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button wire:click="productDetail()" class="btn btn-success">Save</button>
                            </div>
                        </div>
                        <div class="tab-pane fade p-2" id="v-pills-settings" role="tabpanel"
                            aria-labelledby="v-pills-settings-tab" wire:ignore.self>
                            @php
                                $product = App\Models\Product::find($pt_id);
                            @endphp
                            <div class="row g-3">

                                <div class="col-lg-6 mb-2">
                                    <label for="Image">White Image</label>
                                    <input wire:model="whiteImages" type="file" class="form-control  w-100"
                                        multiple>
                                    <div wire:loading wire:target="whiteImages"><i
                                            class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>
                                    @if ($whiteImages)
                                        Photo Preview:
                                        <div class="row g-2">
                                            @foreach ($whiteImages as $index => $image)
                                                <div class="col-lg-3">
                                                    <div class="position-relative">
                                                        <img style="width:100%;" src="{{ $image->temporaryUrl() }}">
                                                        <button class="border-0 position-absolute top-0 bg-transparent"
                                                            style="right:0;"
                                                            wire:click="removeWhiteImage({{ $index }})"><i
                                                                class="fas fa-times text-danger"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif (count($whiteOldImage) > 0)
                                        Old Image:
                                        <div class="row g-2">
                                            @foreach ($whiteOldImage as $image)
                                                <div class="col-lg-3">
                                                    <div class="position-relative">
                                                        <img style="width: 100px;"
                                                            src="{{ asset('storage/' . $image->url) }}"
                                                            alt="image">
                                                        <button class="border-0 position-absolute top-0 bg-transparent"
                                                            style="right:0;"
                                                            wire:click="removeWhiteOldImage({{ $image->id }})"><i
                                                                class="fas fa-times text-danger"></i></button>
                                                        <div
                                                            class="form-check position-absolute top-0 left-0  bg-transparent">
                                                            <div class="form-check">
                                                                <input wire:ignore
                                                                    wire:change="isMainImageChange({{ $image->id }})"
                                                                    class="form-check-input" type="checkbox"
                                                                    @if ($product->image_url == $image->url) checked @endif>
                                                                {{-- wire:model="is_main_image.{{ $image->id }}" --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    @endif
                                    @error('whiteImages')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Video">White Video</label>
                                    <input wire:model="whiteVideo" type="file" class="form-control  w-100">
                                    <div wire:loading wire:target="whiteVideo"><i
                                            class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>
                                    <div class="row g-2">
                                        @if ($whiteOldVideo)
                                            <div class="col-lg-6">
                                                Old Video:
                                                <div class="position-relative">
                                                    <video loop controls autoplay width="200">
                                                        <source src='{{ asset('storage/' . $whiteOldVideo) }}'
                                                            type='video/mp4'>
                                                    </video>
                                                </div>
                                                <button class="border-0 position-absolute top-0 bg-transparent"
                                                    style="right:0;" wire:click="removeWhiteVideo()"><i
                                                        class="fas fa-times text-danger"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Image">Rose Image</label>
                                    <input wire:model="roseImages" type="file" class="form-control  w-100"
                                        multiple>
                                    <div wire:loading wire:target="roseImages"><i
                                            class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>
                                    @if ($roseImages)
                                        Photo Preview:
                                        <div class="row g-2">
                                            @foreach ($roseImages as $index => $image)
                                                <div class="col-lg-3">
                                                    <div class="position-relative">
                                                        <img style="width:100%;" src="{{ $image->temporaryUrl() }}">
                                                        <button class="border-0 position-absolute top-0 bg-transparent"
                                                            style="right:0;"
                                                            wire:click="removeRoseImage({{ $index }})"><i
                                                                class="fas fa-times text-danger"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif (count($roseOldImage) > 0)
                                        Old Image:
                                        <div class="row g-2">
                                            @foreach ($roseOldImage as $image)
                                                <div class="col-lg-3">
                                                    <div class="position-relative">
                                                        <img style="width: 100px;"
                                                            src="{{ asset('storage/' . $image->url) }}"
                                                            alt="image">
                                                        <button class="border-0 position-absolute top-0 bg-transparent"
                                                            style="right:0;"
                                                            wire:click="removeOldRoseImage({{ $image->id }})"><i
                                                                class="fas fa-times text-danger"></i></button>
                                                        <div
                                                            class="form-check position-absolute top-0 left-0  bg-transparent">
                                                            <input
                                                                wire:change="isMainImageChange({{ $image->id }})"
                                                                class="form-check-input" type="checkbox"
                                                                @if ($product->image_url == $image->url) checked @endif>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @error('roseOldImage')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Video">Rose Video</label>
                                    <input wire:model="roseVideo" type="file" class="form-control  w-100">
                                    <div wire:loading wire:target="roseVideo"><i
                                            class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>
                                    <div class="row g-2">

                                        @if ($roseOldVideo)
                                            <div class="col-lg-6">
                                                Old Video:
                                                <div class="position-relative">
                                                    <video loop controls autoplay width="200">
                                                        <source src='{{ asset('storage/' . $roseOldVideo) }}'
                                                            type='video/mp4'>
                                                    </video>
                                                </div>
                                                <button class="border-0 position-absolute top-0 bg-transparent"
                                                    style="right:0;" wire:click="removeRoseVideo()"><i
                                                        class="fas fa-times text-danger"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Image">Yellow Image</label>
                                    <input wire:model="yelloIimages" type="file" class="form-control  w-100"
                                        multiple>
                                    <div wire:loading wire:target="yelloIimages"><i
                                            class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>
                                    @if ($yelloIimages)
                                        Photo Preview:
                                        <div class="row g-2">
                                            @foreach ($yelloIimages as $index => $image)
                                                <div class="col-lg-3">
                                                    <div class="position-relative">
                                                        <img style="width:100%;" src="{{ $image->temporaryUrl() }}">
                                                        <button class="border-0 position-absolute top-0 bg-transparent"
                                                            style="right:0;"
                                                            wire:click="removeYellowImage({{ $index }})"><i
                                                                class="fas fa-times text-danger"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif (count($yellowOldImage) > 0)
                                        Old Image:
                                        <div class="row g-2">
                                            @foreach ($yellowOldImage as $image)
                                                <div class="col-lg-3">
                                                    <div class="position-relative">
                                                        <img style="width: 100px;"
                                                            src="{{ asset('storage/' . $image->url) }}"
                                                            alt="image">
                                                        <button class="border-0 position-absolute top-0 bg-transparent"
                                                            style="right:0;"
                                                            wire:click="removeOldYellowImage({{ $image->id }})"><i
                                                                class="fas fa-times text-danger"></i></button>
                                                        <div
                                                            class="form-check position-absolute top-0 left-0  bg-transparent">
                                                            <input
                                                                wire:change="isMainImageChange({{ $image->id }})"
                                                                class="form-check-input" type="checkbox"
                                                                @if ($product->image_url == $image->url) checked @endif>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @error('images')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="Video">Yellow Video</label>
                                    <input wire:model="yellowVideo" type="file" class="form-control  w-100">
                                    <div wire:loading wire:target="yellowVideo"><i
                                            class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>
                                    <div class="row g-2">

                                        @if ($yellowOldVideo)
                                            <div class="col-lg-6">
                                                Old Video:
                                                <div class="position-relative">
                                                    <video loop controls autoplay width="200">
                                                        <source src='{{ asset('storage/' . $yellowOldVideo) }}'
                                                            type='video/mp4'>
                                                    </video>
                                                </div>
                                                <button class="border-0 position-absolute top-0 bg-transparent"
                                                    style="right:0;" wire:click="removeYellowVideo()"><i
                                                        class="fas fa-times text-danger"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button wire:click="productImage()" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row ">
            <div class="col-12">
                <div class="card">

                    <div class="card-header " style="overflow: auto;">
                        <h3 class="card-title"> Products( {{ count($products) }} )</h3>
                        <div class="card-tools ">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input wire:model="search" type="text" name="table_search"
                                    class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default border">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center">
                            <div class="d-flex">
                                <button wire:click="importProduct()"
                                    class="py-1 px-2 mx-1 bg-success border-0">Import</button>
                                <button wire:click="deleteAllConfirmation()" class="py-1 px-2 mx-1 bg-danger border-0"
                                    data-toggle="modal" data-target="#exampleModalDelete">Bulk Delete</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class=" table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th> Sr No. </th>
                                    <th> Sku </th>
                                    <th> Name </th>
                                    <th> Category </th>
                                    <th> Category Type </th>
                                    <th> Sub Category </th>
                                    <th> Regular Price </th>
                                    <th wire:click="sort('categorytype_id')" style="cursor: pointer">Sale Price<i
                                            class="fas fa-sort"></i>
                                    </th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action
                                        {{-- <button wire:click="add" type="button" data-toggle="modal"
                                            data-target="#exampleModal" class="btn text-lg p-0 m-0"> <i
                                                class="fas fa-plus-square"></i></button> --}}
                                        <button wire:click="add('add_new')" type="button"
                                            class="btn text-lg p-0 m-0"> <i class="fas fa-plus-square"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td class="text-capitalize">
                                            {{ ($products->currentpage() - 1) * $products->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-capitalize">{{ $item->sku }}</td>
                                        <td class="text-capitalize">{{ $item->name ?? '' }}</td>
                                        <td class="text-capitalize">
                                            @foreach ($item->categories as $category)
                                                {{ $category->name ?? '' }}
                                            @endforeach
                                        </td>
                                        <td class="text-capitalize">
                                            @foreach ($item->categoryTypes as $categoryType)
                                                {{ $categoryType->name ?? '' }}
                                            @endforeach
                                        </td>
                                        <td class="text-capitalize">
                                            @foreach ($item->subSategories as $subCategory)
                                                {{ $subCategory->name ?? '' }}
                                            @endforeach
                                        </td>

                                        <td class="text-capitalize">{{ $item->regular_price }}
                                        </td>
                                        <td class="text-capitalize">{{ $item->sale_price }}</td>
                                        <td class="text-capitalize"><img style="width: 100px;"
                                                src="{{ asset('storage/' . $item->image_url) }}"
                                                alt="{{ $item->sku }}"></td>
                                        <td> <select class="py-1" wire:model="status.{{ $item->id }}"
                                                style="width: 80px" wire:change="statusChange({{ $item->id }})"
                                                class="w-full  text-black border border-gray-500 rounded py-1.5 px-2 mb-3 mr-2"
                                                required>
                                                <option value="1">Enabled</option>
                                                <option value="0">Disabled</option>
                                            </select></td>
                                        <td>
                                            <button class="btn text-success p-0"
                                                wire:click="edit( 'edit', {{ $item->id }})">
                                                <i class="fas fa-user-edit"></i>
                                            </button>
                                            {{-- <button wire:click="view('disabled',{{ $item->id }})"
                                                class="btn text-primary p-1" data-toggle="modal"
                                                data-target="#exampleModal">
                                                <i class="fas fa-eye"></i>
                                            </button> --}}
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
                {{ $products->links() }}
            </div>
        </div>
    @endif



    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button wire:click="closeModel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($delete != 'delete')
                        <div class="text-danger">
                            Are you sure you want to delete All Product?
                        </div>
                    @else
                        <div class="text-danger">
                            Are you sure you want to delete ?
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if ($delete != 'delete')
                        <button wire:click="deleteAllProduct()" type="button" class="btn btn-danger">Delete
                            All</button>
                    @else
                        <button wire:click="deleteProduct()" type="button" class="btn btn-danger">Delete</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- import model --}}
    <div wire:ignore.self class="modal fade" id="exampleModalImoprt" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
                    <button wire:click="closeImportModel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="image-upload-button">Attach File <i class="fas fa-file-upload mx-2"></i>
                        <input id="image-input" wire:model="excelFile" type="file" />
                    </div>
                    <div wire:loading wire:target="excelFile"><i
                            class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>
                    @error('excelFile')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <button wire:click="exportProduct()" type="button" class="btn px-3 py-1">Download
                    Sample File <i class="fas fa-file-download"></i></button>
                <div class="modal-footer">
                    <button wire:click="productImport()" type="button"
                        class="btn bg-success px-3 py-1">Import</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            window.addEventListener('livewireOpenModal', event => {
                $("#exampleModalDelete").modal('show');
            })
            window.addEventListener('livewireCloseModal', event => {
                $("#exampleModalDelete").modal('hide');

            })
            window.addEventListener('livewireImoprtModal', event => {
                $("#exampleModalImoprt").modal('show');
            })
            window.addEventListener('livewireImoprtCloseModal', event => {
                $("#exampleModalImoprt").modal('hide');
            })
        });
    </script>

</div>
