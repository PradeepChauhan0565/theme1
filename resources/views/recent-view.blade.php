  @extends('layout')
  @section('content')
      <style>
          .wishline {
              position: relative;
          }

          .wishline::before {
              content: '';
              background-color: #071d49;
              width: 100%;
              height: 1px;
              position: absolute;
              right: 0;
              top: 0;

          }

          .wishtag {
              position: absolute;
              top: -17px;
              left: 50%;
              border: 1px solid #071d49;
              padding: 4px 20px;
              transform: translateX(-50%);
              background-color: #071d49;
          }

          .details {
              display: none;
              transition-delay: 9s;
              box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
              transition: all 0.6s ease-out;
              transition-duration: 2s;
          }

          .product:hover .details {
              display: block;
          }
      </style>
      <div class="container">
          <div class="wishline my-5">
              <span class="wishtag" style="color:#fff;">Recently Viewed</span>
          </div>
          <br>
          <br>
          <br>

          <div class="row mb-5">
              <div class="col-lg-4 ">
                  <div class="position-relative product border">
                      <a href="{{ asset('/single') }}" target="_blank" style="text-decoration: none;"><img
                              src="images/chill1.jpg" alt="" style="width: 100%;">
                          <div class="bg-white  p-2">
                              <p class="mt-2">Jewellery-dropdown-panel </p>
                              <p>Rs.18000</p>
                              <div class="text-center "style="background-color: #071d49;"><button
                                      class="p-1 border-0  text-white" style="background-color: #071d49;">Discover
                                      more</button></div>
                          </div>
                      </a>
                      <div class="position-absolute  text-2xl" style="left:8px; top:2px; font-size:28px;"><i
                              class="far fa-heart"></i></div>
                      <div class="position-absolute   top-0 left-0">
                          <div class=" details ">
                              <div class="position-relative">
                                  <div class="productwrapper  transition delay-700 duration-300 ease-in-out">
                                      <div><img src="images/product1.jpg" alt="" style="width: 100%;"> </div>
                                      <div><img src="images/chill2.jpg" alt="" style="width: 100%;"> </div>
                                      <div><img src="images/chill3.jpg" alt="" style="width: 100%;"> </div>
                                      <div><img src="images/chill4.jpg" alt="" style="width: 100%;"> </div>
                                  </div>
                                  <div class="position-absolute " style="left:-3px; top: 50%;  transform: translate(-50%);">
                                      <a class=" px-2 py-3" id="next"
                                          style="cursor: pointer; background-color:rgb(226, 230, 230);"><i
                                              class="fas fa-angle-left"></i></a>
                                  </div>
                                  <div class="position-absolute "
                                      style="right:-24px; top: 50%;  transform: translate(-50%);"><a class=" px-2 py-3"
                                          id="prev" style="cursor: pointer; background-color:rgb(226, 230, 230);"><i
                                              class="fas fa-angle-right"></i></a> </div>
                                  <div class="position-absolute   text-2xl " title="Add to wishlist"
                                      style="cursor:pointer; left:8px; top:2px; font-size:28px;"><i
                                          class="far fa-heart"></i></div>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>



              <div class="d-flex justify-content-center ">
                  <div class="text-center ">
                      <div class="">
                          <img src="images/recent_view.jpg" alt="" style="width:100%;">
                      </div>
                      <h1 class=" mt-2">Oh ho!</h1>
                      <p class="mt-2 ">Your recently viewed is Empty!</p>
                      <a href="{{ asset('/') }}"><button
                              class="py-1 px-4 mt-2 border-0"style="background-color: #071d49; color:#fff;">Start
                              Shopping</button></a>
                  </div>
              </div>

          </div>
      </div>
      </div>


      {{-- ------------next pre jq-------------------- --}}
      <script>
          $(document).ready(function() {
              $(".productwrapper div").each(function(e) {
                  if (e != 0)
                      $(this).hide();
              });

              $("#next").click(function() {
                  if ($(".productwrapper div:visible").next().length != 0)
                      $(".productwrapper div:visible").next().show().prev().hide();
                  else {
                      $(".productwrapper div:visible").hide();
                      $(".productwrapper div:first").show();
                  }
                  return false;
              });

              $("#prev").click(function() {
                  if ($(".productwrapper div:visible").prev().length != 0)
                      $(".productwrapper div:visible").prev().show().next().hide();
                  else {
                      $(".productwrapper div:visible").hide();
                      $(".productwrapper div:last").show();
                  }
                  return false;
              });
          });
      </script>
  @endsection
