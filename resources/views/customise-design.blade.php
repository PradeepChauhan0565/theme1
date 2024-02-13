@extends('layout')
@section('content')
    <style>
        .image-upload {
            position: relative;
            max-width: 655px;
            /* margin: 10px auto; */
            /* background-color: #dfdfdf; */
        }

        .image-upload .image-edit {
            position: absolute;
            z-index: 1;
            top: -21px;
            left: 50%;
            transform: translate(-50%);
        }

        .image-edit input {
            display: none;

            +label {
                display: inline-block;
                width: 38px;
                height: 38px;
                margin-bottom: 0;
                border-radius: 50%;
                background: #FFFFFF;
                /* border: 1px solid transparent; */
                border: 1px solid #071d49;

                /* box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12); */
                cursor: pointer;
                font-weight: normal;
                transition: all .2s ease-in-out;

                &:hover {
                    background: #dddcdc;
                    border-color: #eeecec;

                }

                &:after {
                    content: "Upload";
                    /* content: "\f040"; */
                    /* font-family: 'FontAwesome'; */
                    font-size: 9px;
                    color: #071d49;
                    position: absolute;
                    top: 13px;
                    left: 1px;
                    right: 0;
                    text-align: center;
                    margin: auto;
                }
            }
        }

        .image-preview {
            /* width: 400px; */
            height: 212px;
            position: relative;
            /* border-radius: 5%; */
            border: 1px solid #413c3c;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);

            >div {
                width: 100%;
                height: 100%;
                /* border-radius: 5%; */
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
        }
    </style>
    <div class="container my-5 shadow py-2">
        <div class="mb-3">
            <h3>Add Your Design</h3>
        </div>
        <hr>

        <div class="row my-5">
            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-lg-6 col-md-6">
                        <label for="">Diamond Quality</label>
                        <div>
                            <select name="" id="" class="w-100 p-2">
                                <option value="">Select Diamond Quality</option>
                                <option value="">FG-SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="">Metal Type *</label>
                        <div>
                            <select name="" id="" class="w-100 p-2">
                                <option value="">Select Metal Type</option>
                                <option value="">GOLD</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="">Metal Color *</label>
                        <div>
                            <select name="" id="" class="w-100 p-2">
                                <option value="">Select Metal Color</option>
                                <option value="">YELLOW</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="">Metal Purity *</label>
                        <div>
                            <select name="" id="" class="w-100 p-2">
                                <option value="">Select Metal Purity</option>
                                <option value="">GOLD</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="">Estimated Budget</label>
                        <div>
                            <input type="number" class="w-100 " style="padding: 5px 15px;" placeholder="Enter your budget">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="Description">Description *</label>

                    <textarea rows="4" cols="50" class="w-100 p-2" placeholder="Enter Your Description..."></textarea>
                </div>
            </div>

            <div class="col-lg-4">
                <label for="Image">Refernce Images</label>

                <div class="image-upload mt-3">
                    <div class="image-edit">
                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="image-preview">
                        <div id="imagePreview" style="background-image: url();">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <h3>Contact Details</h3>
        </div>
        <hr>
        <div class="row g-4 mt-4">
            <div class="col-lg-4">
                <label for="name">Fulll Name *</label>
                <input type="text" class="w-100 p-2" placeholder="Enter your full name">
            </div>
            <div class="col-lg-4">
                <label for="email">Email *</label>
                <input type="email" class="w-100 p-2" placeholder="Enter your email">
            </div>
            <div class="col-lg-4">
                <label for="mobile">Mobile Number *</label>
                <input type="number" class="w-100 p-2" placeholder="Enter your mobile number">
            </div>

        </div>
        <div class="mt-4">
            <label for="Address">Your Address</label>
            <input type="text" class="w-100 p-2" placeholder="Enter Your Address">
        </div>
        <div class="d-flex justify-content-end my-4 ">
            <button class="px-5 py-2 border-0" style="background-color: #071d49; color:#fff;">Submit</button>
        </div>
    </div>


    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
@endsection
