<script src="{{ asset('https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('../src/jquery.exzoom.js') }}"></script>
<link href="{{ asset('../src/jquery.exzoom.css') }}" rel="stylesheet" type="text/css" />
<style>
    /* -----------exzoom css---------- */
    #exzoom {
        width: auto;
    }

    .product_list_ul {
        position: relative;
    }

    .bvideo-wrap {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        transform: translate3d(0px, 0px, 0px);
        width: 100%;
        height: 100%;

    }

    .product_list_ul:hover .bvideo-wrap {
        display: block;
    }
</style>
<div class="exzoom " id="exzoom">
    <div class="exzoom_img_box " wire:ignore>
        <ul class='exzoom_img_ul d-flex' style="padding-left: 0rem;">
            @if (count($productImage) > 0)
                @foreach ($productImage as $image1)
                    <li wire:ignore.self class="btnfornext"><img src="{{ asset('storage/' . $image1->url) }}"
                            style="width: 100%; height:100%;" /></li>

                    @if ($image1->is_video != null)
                        <li class=" product_list_ul"><img src="{{ asset('images/play.png') }}"
                                style="width: 100%; height:100%;" />
                            <div class="bvideo-wrap ">
                                <video width="100%" height="100%" poster="" loop controls muted autoplay>
                                    <source src='{{ asset('storage/' . $image1->is_video) }}' type='video/mp4'>
                                </video>
                            </div>
                        </li>
                        @php
                            break;
                        @endphp
                    @endif
                @endforeach
            @endif

        </ul>
        <div class=" exzoom_prev_btn"
            style="position:absolute; top:45%; left:-1px; z-index:9; font-size:20px;  cursor:pointer; ">
            <div class="zoom_btn">
                <i class="fa-solid fa-angle-left"></i>
            </div>
        </div>
        <div class=" exzoom_next_btn"
            style="position:absolute; top:45%; right:-1px;z-index:9; font-size:20px;  cursor:pointer; ">
            <div class="zoom_btn">
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
    </div>
    <div class="exzoom_nav"></div>
</div>

<script type="text/javascript">
    $('.container').imagesLoaded(function() {
        $("#exzoom").exzoom({
            autoPlay: false,
        });
        $("#exzoom").removeClass('hidden')
    });
</script>
