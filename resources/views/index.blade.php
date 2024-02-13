  @extends('layout')
  @section('content')
      <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">

      <!-- Image container of the image slider -->
      <div class="image-container">
          @foreach ($herobanners as $item)
              <a href="{{ asset($item->url) }}">
                  <div class="slide">
                      <div class="slideNumber">{{ $item->order_by }}</div>
                      <img src="{{ 'storage/herobanner/' . $item->hb_image }}" alt="{{ $item->image_title }}">
                  </div>
              </a>


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
              <h1 class="">{{ $headings->heading_first }}
              </h1>
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

              </div>
          </div>


          <div class="px-1">
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
              let scrollWidth = carousel.scrollWidth - carousel.clientWidth;
              arrowIcons[0].style.display = carousel.scrollLeft == 0 ? "none" : "block";
              arrowIcons[1].style.display = carousel.scrollLeft == scrollWidth ? "none" : "block";
          }

          arrowIcons.forEach(icon => {
              icon.addEventListener("click", () => {
                  let firstImgWidth = firstImg.clientWidth +
                      14;
                  carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
                  setTimeout(() => showHideIcons(), 60);
              });
          });

          const autoSlide = () => {
              if (carousel.scrollLeft - (carousel.scrollWidth - carousel.clientWidth) > -1 || carousel.scrollLeft <= 0)
                  return;
              positionDiff = Math.abs(positionDiff);
              let firstImgWidth = firstImg.clientWidth + 14;
              let valDifference = firstImgWidth - positionDiff;
              if (carousel.scrollLeft > prevScrollLeft) {
                  return carousel.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
              }
              carousel.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
          }

          const dragStart = (e) => {
              isDragStart = true;
              prevPageX = e.pageX || e.touches[0].pageX;
              prevScrollLeft = carousel.scrollLeft;
          }

          const dragging = (e) => {

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
