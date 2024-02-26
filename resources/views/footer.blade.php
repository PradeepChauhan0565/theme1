<!-------subscribe modal start----------------------->
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body position-relative text-center">
                <h3 class=" py-2">Thank You!</h3>
                <div id="newsletter"></div>
                <div class="close position-absolute " data-bs-dismiss="modal"
                    style="top:0px; right:0; cursor: pointer; font-size:24px; padding:0px 13px; background-color:var(--default-color);"
                    aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------subscribe end----------------------->

<div class="mb-5" style="background-color: var(--default-color);">
    <div class="container-1">
        <div class="row  justify-content-center align-items-center  ">
            <div class="col-lg-6">
                <div class=" py-3 text-center">
                    <h3 style="color: #fff;">Join the Jewelry Revolution!</h3>
                </div>
                <form id="subscribForm" class="newsletter-inner" action="{{ route('newsletter') }}" method="POST">
                    @csrf
                    <div class="pb-4  position-relative">
                        <input type="text" placeholder="Enter Your Email Address" name="email"
                            value="{{ old('email') }}" class=" py-2 w-100 rounded-pill "
                            style="border: 1px solid #fff; outline:0;padding-left:20px; padding-right:160px;" required>

                        @error('email')
                            <div class="px-3"><span style="color:red">{{ $message }}</span></div>
                        @enderror
                        <button id="subscribbtn" class="  position-absolute px-4 px-lg-5 py-2 rounded-pill border:0;"
                            type="submit"
                            style="color:#fff; right:1px; border:0; top:1px; z-index:1; background-color:var(--default-color);">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                                style="color:#fff;"></span>
                            <span class="btn-txt" style="color:#fff;">JOIN US</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div style="background-color: #fff;">
    <div class="container-1">
        <div class="pb-4 row g-4">
            <div class=" col-lg-3">
                <h5 style="border-bottom: 1px solid; var(--default-color);padding:8px 0;">CUSTOMER SERVICE</h5>
                <ul class=" mt-3 line-footer ">
                    <li class="mb-2"><a href="">FAQs</a></li>
                    <li class="mb-2"><a href="">Track Your Order</a></li>
                    <li class="mb-2"><a href="">Returns & Exchange</a></li>
                    <li class="mb-2"><a href="">Resize & Repair</a></li>
                </ul>
            </div>

            <div class=" col-lg-3">
                <h5 style="border-bottom: 1px solid; var(--default-color);padding:8px 0;"> ABOUT US</h5>
                <ul class=" mt-3 line-footer ">
                    <li class="mb-2"><a href="">About Jewelry</a></li>
                    <li class="mb-2"><a href="">Customer Reviews</a></li>
                    <li class="mb-2"><a href="">Jewelry Blog</a></li>
                    <li class="mb-2"><a href="">Jewelry in the Press</a></li>
                    <li><a href="">US Service Discount</a></li>
                </ul>
            </div>

            <div class=" col-lg-3">
                <h5 style="border-bottom: 1px solid; var(--default-color);padding:8px 0;">WHY JEWELRY?</h5>
                <ul class=" mt-3 line-footer ">
                    <li class="mb-2"><a href="">24/7 Customer Support</a></li>
                    <li class="mb-2"><a href="">Free Returns</a></li>
                    <li class="mb-2"><a href="">Free Shipping</a></li>
                    <li class="mb-2"><a href="">Payment Options</a></li>
                    <li class="mb-2"><a href="">Lifetime Warranty</a></li>
                    <li class="mb-2"><a href="">Privacy Policy</a></li>

                </ul>
            </div>

            <div class=" col-lg-3">
                <h5 style="border-bottom: 1px solid; var(--default-color);padding:8px 0;"> 24/7 CUSTOMER SUPPORT</h5>
                <ul class=" mt-3 line-footer ">
                    <li class="mb-2"><a href="tel:{{ $contacts->mobile_number }}"><i
                                class="fa-solid fa-phone-flip"></i>&nbsp;
                            {{ $contacts->mobile_number }}</a></li>
                    <li class="mb-2"><a href="mailto:{{ $contacts->email }}"><i
                                class="fa-solid fa-envelope"></i>&nbsp;
                            {{ $contacts->email }}</a></li>
                    <li class="mb-2">FOLLOW US ON</li>
                    <div class="d-flex ">
                        @foreach ($socials as $item)
                            <a style="color:var(--default-color);" href="{{ $item->link }}"
                                title="{{ $item->name }}" target="_blank">
                                <div class="  p-2 border mx-1 "><i class="{{ $item->icon }}"></i></div>
                            </a>
                        @endforeach

                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>


<script>
    $("#subscribForm").submit(function(e) {
        $(".spinner-border").removeClass("d-none");
        $(".submit").attr("disabled", true);
        $(".btn-txt").text("Please wait ...");

        e.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(data) {
                $('#exampleModalCenter').modal('toggle');
                $("#subscribForm")[0].reset();
                $(".spinner-border").addClass("d-none");
                $(".submit").attr("disabled", false);
                $(".btn-txt").text("JOIN US");
                $('#newsletter').text(data);
            }
        });

    });
    $('#closesubscribe').click(function() {
        $('#exampleModalCenter').modal('hide');

    });
</script>
