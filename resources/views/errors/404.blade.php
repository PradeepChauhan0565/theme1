 @extends('layout')
 @section('content')
     <style>
         .css-paqnyd::before {
             bottom: 12px;
             left: 50%;
             border: solid transparent;
             content: '';
             height: 0;
             width: 0;
             position: absolute;
             pointer-events: none;
             border-color: rgba(27, 250, 7, 0);
             border-bottom-color: #071d49;
             border-width: 40px;
             margin-left: -40px;
         }
     </style>

     <div class="container">

         <div class="my-5" style="text-align: center; ">
             <h3>OOPS!</h3>
             <h4 class="mb-4">We could not find what you are looking for.</h4>
             <p class="mb-4">Click below to go back to the homepage.</p>
             <a href="{{ asset('/') }}"
                 style="background-color: #071d49;border:3px solid #e9e7e7; color:#fff; padding:5px 20px;">CONTINUE
                 SHOPPING</a>
         </div>
         <div class="text-center mb-5">
             <h5>Explore our some designs</h5>
         </div>

         <div class="position-relative mb-4">
             <span class="css-paqnyd">
             </span>
         </div>
         <div class="row">
             <div class="col-lg-3 mb-5">
                 <div class="shadow p-2 border">
                     <a href="{{ asset('http://127.0.0.1:8000/shop/ring') }}">
                         <img src="{{ asset('images/ring.jpg') }}" alt="" style="width: 100%;">
                         <div class="py-2 text-center">
                             Ring
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 mb-5">
                 <div class="shadow p-2 border">
                     <a href="{{ asset('/') }}">
                         <img src="{{ asset('images/earring.jpg') }}" alt="" style="width: 100%;">
                         <div class="py-2 text-center">
                             Earring
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 mb-5">
                 <div class="shadow p-2 border">
                     <a href="{{ asset('/') }}">
                         <img src="{{ asset('images/pendant.jpg') }}" alt="" style="width: 100%;">
                         <div class="py-2 text-center">
                             Pendant
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 mb-5">
                 <div class="shadow p-2 border">
                     <a href="{{ asset('/') }}">
                         <img src="{{ asset('images/necklace.jpg') }}" alt="" style="width: 100%;">
                         <div class="py-2 text-center">
                             Necklace
                         </div>
                     </a>
                 </div>
             </div>

         </div>
     </div>
 @endsection
