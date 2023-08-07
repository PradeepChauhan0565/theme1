  @extends('layout')
  @section('content')
      <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
      <style>
          .explore_btn {
              background-color: #071d49;
          }

          .explore_arrow {
              color: #fff;
          }

          .explore_btn:hover .explore_arrow {
              transform: translateX(8px);
              transition: 0.6s;
          }

          .wrapper {
              display: flex;
              max-width: 1200px;
              position: relative;
          }

          .wrapper i {
              top: 50%;
              height: 44px;
              width: 44px;
              color: #343F4F;
              cursor: pointer;
              font-size: 1.28rem;
              position: absolute;
              text-align: center;
              line-height: 44px;
              background: #fff;
              border-radius: 50%;
              transform: translateY(-50%);
              transition: transform 0.1s linear;
          }

          .wrapper i:active {
              transform: translateY(-50%) scale(0.9);
          }

          .wrapper i:hover {
              background: #f2f2f2;
          }

          .wrapper i:first-child {
              left: -22px;
              display: none;
          }

          .wrapper i:last-child {
              right: -22px;
          }

          .wrapper .carousel {
              font-size: 0px;
              cursor: pointer;
              overflow: hidden;
              white-space: nowrap;
              scroll-behavior: smooth;
          }

          .carousel.dragging {
              cursor: grab;
              scroll-behavior: auto;
          }

          .carousel.dragging img {
              pointer-events: none;
          }

          .carousel img {
              height: 380px;
              object-fit: cover;
              user-select: none;
              margin-left: 14px;
              width: calc(100% / 4);
          }

          .carousel img:first-child {
              margin-left: 0px;
          }

          @media screen and (max-width: 900px) {
              .carousel img {
                  width: calc(100% / 2);
              }
          }

          @media screen and (max-width: 550px) {
              .carousel img {
                  width: 100%;
              }
          }

          /* .cat_zoom{
                                                                                                                                                                                                                overflow: hidden;
                                                                                                                                                                                                                border-radius: 10px;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                .cat_zoom img{
                                                                                                                                                                                                                   
                                                                                                                                                                                                                  transition: transform .6s;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                .cat_zoom img:hover {
                                                                                                                                                                                                                 
                                                                                                                                                                                                                  transform: scale(1.2);
                                                                                                                                                                                                                } */


          .jumpbody {
              position: relative;

          }

          .jump button {
              background-color: #071d49;
              border: 0;
          }

          .jump {
              position: absolute;
              bottom: -15px;
              left: 50%;
              transform: translateX(-50%);
              background-color: #071d49;
              transition: 1.5s;

          }

          .jumpbody:hover .jump {
              bottom: 30%;

          }

          img {
              width: 100%;
          }


          /* Image-container design */
          .image-container {
              max-width: 100%;
              position: relative;
              margin: auto;
              z-index: 0;
          }

          .next {
              right: 0;
          }

          /* Next and previous icon design */
          .previous,
          .next {
              cursor: pointer;
              position: absolute;
              top: 50%;
              /* background-color: red; */
              padding: 10px;
              margin-top: -25px;
              z-index: 1;
          }

          /* caption decorate */
          .captionText {
              color: #071d49;
              font-size: 14px;
              position: absolute;
              padding: 12px 12px;
              bottom: 8px;
              width: 100%;
              text-align: center;
          }

          /* Slider image number */
          .slideNumber {
              background-color: #858585;
              color: white;
              border-radius: 25px;
              right: 0;
              opacity: .5;
              margin: 5px;
              width: 30px;
              height: 30px;
              text-align: center;
              font-weight: bold;
              font-size: 20px;
              position: absolute;
          }

          .fa {
              font-size: 36px;
              /* color: #b88c99; */
          }

          .fa:hover {
              transform: rotate(360deg);
              transition: 1s;
              color: rgb(214, 211, 211);
          }

          .footerdot {
              cursor: pointer;
              height: 15px;
              width: 15px;
              margin: 0 2px;
              background-color: #bbbbbb;
              border-radius: 50%;
              display: inline-block;
              transition: background-color 0.5s ease;
          }

          .footerdot.active,
          .footerdot:hover {
              background-color: #071d49;
          }
      </style>

      {{-- <div class="d-none d-lg-block" style="height:10px;"> </div> --}}

      <!-- Image container of the image slider -->
      <div class="image-container">
          @foreach ($herobanners as $item)
              <a href="{{ asset($item->url) }}">
                  <div class="slide">
                      <div class="slideNumber">{{ $item->order_by }}</div>
                      <img src="{{ 'storage/herobanner/' . $item->hb_image }}" alt="{{ $item->image_title }}">
                  </div>
              </a>
              {{-- <a href="{{ asset('/product-front') }}">
              <div class="slide">
                  <div class="slideNumber">2</div>
                  <img src="images/banner2.png">
              </div>
          </a> --}}

              <span><a class="previous" onclick="moveSlides(-1)">
                      <i class="fa fa-chevron-circle-left"></i>
                  </a></span>
              <span><a class="next" onclick="moveSlides(1)">
                      <i class="fa fa-chevron-circle-right"></i>
                  </a></span>
          @endforeach
      </div>

      <br>
      <div style="text-align:center">
          @foreach ($herobanners as $item)
              <span class="footerdot" onclick="activeSlide({{ $item->order_by }})">
              </span>
          @endforeach
      </div>



      <div style="width:90%; margin:auto;">
          <div class="text-center mb-4 mt-5">
              <h1 class="">{{ $headings->heading_first }}</h1>
          </div>
          <div class="row g-3">
              @foreach ($shopbycats as $item)
                  <div class="col-lg-3 col-md-6 mb-5">
                      <div class="jumpbody">
                          <div class="">
                              <img src="{{ asset('storage/sbcimages/' . $item->sbc_image) }}" alt="{{ $item->image_title }}"
                                  style="width: 100%; ">
                          </div>

                          <div class="jump">
                              <div class="">
                                  <a href="{{ asset($item->url) }}">
                                      <div class="text-center"> <button
                                              class="px-3 py-1  text-white">{{ $item->button_name }}</button></div>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
              {{-- <div class="col-lg-3 col-md-6 mb-5">
                  <div class="jumpbody">
                      <div class="">
                          <img src="images/earring.jpg" alt="" style="width: 100%; ">
                      </div>

                      <div class="jump">
                          <div class="">
                              <div class="text-center"> <button class="px-3 py-1  text-white">Earring</button></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 mb-5">
                  <div class="jumpbody">
                      <div class="">
                          <img src="images/Bracelet.jpg" alt="" style="width: 100%; ">
                      </div>

                      <div class="jump">
                          <div class="">
                              <div class="text-center"> <button class="px-3 py-1  text-white">Bracelet</button></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 mb-5">
                  <div class="jumpbody">
                      <div class="">
                          <img src="images/pendant.jpg" alt="" style="width: 100%; ">
                      </div>

                      <div class="jump">
                          <div class="">
                              <div class="text-center"> <button class="px-3 py-1  text-white">Pendant</button></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 mb-5">
                  <div class="jumpbody">
                      <div class="">
                          <img src="images/manglasutra.jpg" alt="" style="width: 100%; ">
                      </div>

                      <div class="jump">
                          <div class="">
                              <div class="text-center"> <button class="px-3 py-1  text-white">Manglasutra</button></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 mb-5">
                  <div class="jumpbody">
                      <div class="">
                          <img src="images/nosepin.jpg" alt="" style="width: 100%; ">
                      </div>

                      <div class="jump">
                          <div class="">
                              <div class="text-center"> <button class="px-3 py-1  text-white">Nosepin</button></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 mb-5">
                  <div class="jumpbody">
                      <div class="">
                          <img src="images/necklace.jpg" alt="" style="width: 100%; ">
                      </div>

                      <div class="jump">
                          <div class="">
                              <div class="text-center"> <button class="px-3 py-1  text-white">Necklace</button></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 mb-5">
                  <div class="jumpbody">
                      <div class="">
                          <img src="images/necklaceset.jpg" alt="" style="width: 100%; ">
                      </div>

                      <div class="jump">
                          <div class="">
                              <div class="text-center"> <button class="px-3 py-1  text-white">Necklace Set</button></div>
                          </div>
                      </div>
                  </div>
              </div> --}}
          </div>

          <div class="mt-5">
              <a href="{{ asset($headings->url) }}"><img
                      src="{{ asset('storage/singlebanner/' . $headings->banner_image) }}"
                      alt="{{ $headings->image_title }}"></a>
          </div>

          <section id="slider" class="pt-5">
              <div class="text-center mb-10">
                  <h1 class="">{{ $headings->heading_second }}</h1>
              </div>
              <div class="slider ">
                  <div class="owl-carousel ">
                      @foreach ($weddings as $item)
                          <div class="slider-card">
                              <a href="{{ $item->url }}">
                                  <div class="d-flex justify-content-center align-items-center mb-4">
                                      <img src="{{ asset('storage/wiimages/' . $item->wi_image) }}"
                                          alt="{{ $item->image_title }}" style="width: 100%">
                                  </div>
                                  <h5 class="mb-0 text-center"><b>{{ $item->heading }}</b></h5>
                                  <p class="text-center  p-4">{{ $item->content }} </p>
                              </a>
                          </div>
                      @endforeach
                      {{-- <div class="slider-card">
                          <div class="d-flex justify-content-center align-items-center mb-4">
                              <img src="images/slidimage1.jpg" alt="" style="width:100%;">
                          </div>
                          <h5 class="mb-0 text-center"><b>Lab-Created Diamonds</b></h5>
                          <p class="text-center p-4">Your source for the latest trends, styling tips and inspiration for
                              all things jewelry. </p>
                      </div>
                      <div class="slider-card">
                          <div class="d-flex justify-content-center align-items-center mb-4">
                              <img src="images/Silver_Jewellery.jpg" alt="" style="width:100%;">
                          </div>
                          <h5 class="mb-0 text-center"><b>Jewelry Essentials</b></h5>
                          <p class="text-center p-4">Your source for the latest trends, styling tips and inspiration for
                              all things jewelry. </p>
                      </div>
                      <div class="slider-card">
                          <div class="d-flex justify-content-center align-items-center mb-4">
                              <img src="images/slidimage2.jpg" alt="" style="width:100%;">
                          </div>
                          <h5 class="mb-0 text-center"><b>Lab-Created Diamonds</b></h5>
                          <p class="text-center p-4">Your source for the latest trends, styling tips and inspiration for
                              all things jewelry. </p>
                      </div>
                      <div class="slider-card">
                          <div class="d-flex justify-content-center align-items-center mb-4">
                              <img src="images/chill4.jpg" alt="" style="width:100%;">
                          </div>
                          <h5 class="mb-0 text-center"><b>Lab-Created Diamonds</b></h5>
                          <p class="text-center p-4">Your source for the latest trends, styling tips and inspiration for
                              all things jewelry. </p>
                      </div> --}}
                  </div>
              </div>
          </section>

          <div>
              <div class="text-center mb-4 mt-5">
                  <h1 class="text-5xl"> {{ $headings->heading_third }}</h1>
              </div>
              <div class="row g-3">
                  @foreach ($getins as $item)
                      <div class="mb-5 col-lg-3 col-md-6">
                          <img src="{{ 'storage/getimages/' . $item->gi_image }}" alt="{{ $item->image_title }}"
                              style="width:100%;">
                          <h5 class="mt-4 ">{{ $item->heading }}</h5>
                          <p class="my-3 " style="text-align: justify;">{{ $item->content }}</p>
                          <a href="{{ $item->url }}"
                              class="explore_btn border border-black rounded-full px-4 py-2  text-white "
                              style="text-decoration: none;">Explore Now <i
                                  class="fas fa-arrow-right explore_arrow"></i></a>
                      </div>
                  @endforeach
                  {{-- <div class="mb-5 col-lg-3 col-md-6">
                      <img src="images/chill2.jpg" alt="" style="width:100%;">
                      <h5 class="mt-4 ">Style Studio</h5>
                      <p class="my-3" style="text-align: justify;">Your source for the latest trends, styling tips and
                          inspiration for all things jewelry.</p>
                      <a href="" class="explore_btn border border-black rounded-full px-4 py-2  text-white "
                          style="text-decoration: none;">Explore Now <i class="fas fa-arrow-right explore_arrow"></i></a>

                  </div>
                  <div class="mb-5 col-lg-3 col-md-6">
                      <img src="images/chill3.jpg" alt="" style="width:100%;">
                      <h5 class="mt-4 ">Lab-Created Diamonds</h5>
                      <p class="my-3" style="text-align: justify;">Your source for the latest trends, styling tips and
                          inspiration for all things jewelry.</p>
                      <a href="" class="explore_btn border border-black rounded-full px-4 py-2  text-white "
                          style="text-decoration: none;">Explore Now <i class="fas fa-arrow-right explore_arrow"></i></a>
                  </div>
                  <div class="mb-5 col-lg-3 col-md-6">
                      <img src="images/chill4.jpg" alt="" style="width:100%;">
                      <h5 class="mt-4 ">Style Studio</h5>
                      <p class="my-3" style="text-align: justify;">Your source for the latest trends, styling tips and
                          inspiration for all things jewelry.</p>
                      <a href="" class="explore_btn border border-black rounded-full px-4 py-2  text-white "
                          style="text-decoration: none;">Explore Now <i class="fas fa-arrow-right explore_arrow"></i></a>
                  </div> --}}
              </div>
          </div>


          <div>
              <div class="text-center mb-4 mt-5">
                  <h1 class="text-5xl">{{ $headings->heading_forth }} </h1>
              </div>
              <div class="mb-5">
                  <div class="wrapper">
                      <i id="left" class="fa-solid fa-angle-left" style="z-index: 99;"></i>
                      <div class="carousel flex">
                          @foreach ($collections as $item)
                              <a href="{{ $item->url }}" class="mx-2"> <img
                                      src="{{ asset('storage/collections/' . $item->fc_image) }}"
                                      alt="{{ $item->image_title }}" draggable="false"></a>
                          @endforeach
                          {{-- <img src="images/7gPcLEWasNqiPLYjlTYb.jpg" alt="img" draggable="false">
                          <img src="images/YHQi3ETloNVC4qQb0fIi.jpg" alt="img" draggable="false">
                          <img src="images/qJvVa1ji9AfYbiueGOYt.jpg" alt="img" draggable="false">
                          <img src="images/ypXjiW6veKg8zhvu87bG.jpg" alt="img" draggable="false"> --}}
                      </div>
                      <i id="right" class="fa-solid fa-angle-right"></i>
                  </div>
              </div>
          </div>




      </div>

      <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/script.js') }}"></script>

      {{-- ----------------herobanner slider js start-------------- --}}
      <script>
          var slideIndex = 1;
          displaySlide(slideIndex);

          function moveSlides(n) {
              displaySlide(slideIndex += n);
          }

          function activeSlide(n) {
              displaySlide(slideIndex = n);
          }

          /* Main function */
          function displaySlide(n) {
              var i;
              var totalslides =
                  document.getElementsByClassName("slide");

              var totaldots =
                  document.getElementsByClassName("footerdot");

              if (n > totalslides.length) {
                  slideIndex = 1;
              }
              if (n < 1) {
                  slideIndex = totalslides.length;
              }
              for (i = 0; i < totalslides.length; i++) {
                  totalslides[i].style.display = "none";
              }
              for (i = 0; i < totaldots.length; i++) {
                  totaldots[i].className =
                      totaldots[i].className.replace(" active", "");
              }
              totalslides[slideIndex - 1].style.display = "block";
              totaldots[slideIndex - 1].className += " active";
          }
      </script>
      {{-- ----------------hero banner slider js start-------------- --}}

      {{-- ----------------collection slider js start-------------- --}}
      <script>
          const carousel = document.querySelector(".carousel"),
              firstImg = carousel.querySelectorAll("img")[0],
              arrowIcons = document.querySelectorAll(".wrapper i");

          let isDragStart = false,
              isDragging = false,
              prevPageX, prevScrollLeft, positionDiff;

          const showHideIcons = () => {
              // showing and hiding prev/next icon according to carousel scroll left value
              let scrollWidth = carousel.scrollWidth - carousel.clientWidth; // getting max scrollable width
              arrowIcons[0].style.display = carousel.scrollLeft == 0 ? "none" : "block";
              arrowIcons[1].style.display = carousel.scrollLeft == scrollWidth ? "none" : "block";
          }

          arrowIcons.forEach(icon => {
              icon.addEventListener("click", () => {
                  let firstImgWidth = firstImg.clientWidth +
                      14; // getting first img width & adding 14 margin value
                  // if clicked icon is left, reduce width value from the carousel scroll left else add to it
                  carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
                  setTimeout(() => showHideIcons(), 60); // calling showHideIcons after 60ms
              });
          });

          const autoSlide = () => {
              // if there is no image left to scroll then return from here
              if (carousel.scrollLeft - (carousel.scrollWidth - carousel.clientWidth) > -1 || carousel.scrollLeft <= 0)
                  return;

              positionDiff = Math.abs(positionDiff); // making positionDiff value to positive
              let firstImgWidth = firstImg.clientWidth + 14;
              // getting difference value that needs to add or reduce from carousel left to take middle img center
              let valDifference = firstImgWidth - positionDiff;

              if (carousel.scrollLeft > prevScrollLeft) { // if user is scrolling to the right
                  return carousel.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
              }
              // if user is scrolling to the left
              carousel.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
          }

          const dragStart = (e) => {
              // updatating global variables value on mouse down event
              isDragStart = true;
              prevPageX = e.pageX || e.touches[0].pageX;
              prevScrollLeft = carousel.scrollLeft;
          }

          const dragging = (e) => {
              // scrolling images/carousel to left according to mouse pointer
              if (!isDragStart) return;
              e.preventDefault();
              isDragging = true;
              carousel.classList.add("dragging");
              positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
              carousel.scrollLeft = prevScrollLeft - positionDiff;
              showHideIcons();
          }

          const dragStop = () => {
              isDragStart = false;
              carousel.classList.remove("dragging");

              if (!isDragging) return;
              isDragging = false;
              autoSlide();
          }

          carousel.addEventListener("mousedown", dragStart);
          carousel.addEventListener("touchstart", dragStart);

          document.addEventListener("mousemove", dragging);
          carousel.addEventListener("touchmove", dragging);

          document.addEventListener("mouseup", dragStop);
          carousel.addEventListener("touchend", dragStop);
      </script>
      {{-- ----------------collection slider js end-------------- --}}
  @endsection
