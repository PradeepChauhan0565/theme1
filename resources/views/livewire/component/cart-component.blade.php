<div>
    <style>
    .wishline{
        position: relative;
    }
    .wishline::before{
         content: '';
    background-color:  #071d49;
    width: 100%;
    height: 1px;
    position: absolute;
    right: 0;
    top: 0;
    }
    .wishtag{
        position: absolute;
        top: -18px;
        left: 50%;
        border: 1px solid  #071d49;
        padding: 4px 10px;      
        transform: translateX(-50%);
        background-color: #071d49;
    }
</style>


<div class="container">
            <div class="wishline mt-5">
                <span class="wishtag" style="color: #fff;">Your Shopping Cart</span>
            </div> 
        <br>
        <br>
        <br>
        <div class="row g-4 mb-5">
            <div class="col-lg-8 ">
                <div class="d-flex  gap-4 mb-4">                                                
                        <div class="d-flex gap-4 border p-3">                       
                            <div class="mr-3 w-25">
                                <div class=" border ">
                                    <img src="images/product1.jpg" alt="" style="width: 100%; height:100%; ">
                                </div>
                                <div class=" d-lg-flex justify-content-around my-4" style="font-size: 10px;">
                                    <a href=""><div>Edit</div></a>
                                    <a href="" wire:click="removetoCart()"><div>Remove</div></a>
                                    <a href="" wire:click="movetoWish()"><div>Move To Wishlist</div></a>                                  
                                </div>
                            </div>

                            <div class="w-75">
                                <div class="d-flex justify-content-between align-items-center ">                             
                                        <div class=" h5">Product Ring</div>                                                         
                                        <div class="h5 text-red-500">Rs : 300</div>                                    
                                </div>
                                <div class="mt-2">SKU: JR03769-YGP900</div>
                                <div class="mt-2  d-flex">
                                    <div class=" ">
                                        Size: 7
                                    </div>
                                    <div class=" ml-4  ">
                                        Quantity:
                                        <select class="border">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                            <option value="">6</option>
                                            <option value="">7</option>
                                            <option value="">8</option>
                                            <option value="">9</option>
                                            <option value="">10</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-3 ">
                                    <div class=" h5">Product Details</div>
                                    <div class="d-flex justify-content-between my-2">
                                        <div>Gemstone Quality :</div>
                                        <div>Better</div>
                                    </div>
                                    <div class="d-flex justify-content-between my-2">
                                        <div>Total Carat Weight :</div>
                                        <div>1.1</div>
                                    </div>
                                    <div class="d-flex justify-content-between my-2">
                                        <div>Metal Type :</div>
                                        <div>Gold</div>
                                    </div>
                                </div>
                            </div>                        
                    </div>                                
                </div>
                <div class="d-flex  gap-4 mb-4">                                                
                        <div class="d-flex gap-4 border p-3">                       
                            <div class="mr-3 w-25">
                                <div class=" border ">
                                    <img src="images/product1.jpg" alt="" style="width: 100%; height:100%; ">
                                </div>
                                <div class=" d-lg-flex justify-content-around my-4" style="font-size: 10px;">
                                    <a href=""><div>Edit</div></a>
                                    <a href="" wire:click="removetoCart()"><div>Remove</div></a>
                                    <a href="" wire:click="movetoWish()"><div>Move To Wishlist</div></a>                                  
                                </div>
                            </div>

                            <div class="w-75">
                                <div class="d-flex justify-content-between align-items-center ">                             
                                        <div class=" h5">Product Ring</div>                                                         
                                        <div class="h5 text-red-500">Rs : 300</div>                                    
                                </div>
                                <div class="mt-2">SKU: JR03769-YGP900</div>
                                <div class="mt-2  d-flex">
                                    <div class=" ">
                                        Size: 7
                                    </div>
                                    <div class=" ml-4  ">
                                        Quantity:
                                        <select class="border">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                            <option value="">6</option>
                                            <option value="">7</option>
                                            <option value="">8</option>
                                            <option value="">9</option>
                                            <option value="">10</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-3 ">
                                    <div class=" h5">Product Details</div>
                                    <div class="d-flex justify-content-between my-2">
                                        <div>Gemstone Quality :</div>
                                        <div>Better</div>
                                    </div>
                                    <div class="d-flex justify-content-between my-2">
                                        <div>Total Carat Weight :</div>
                                        <div>1.1</div>
                                    </div>
                                    <div class="d-flex justify-content-between my-2">
                                        <div>Metal Type :</div>
                                        <div>Gold</div>
                                    </div>
                                </div>
                            </div>                        
                        </div>                                
                </div>


                
            </div>
            <div class="col-lg-4" >
                    <div class="w-100 border p-3" style=" position: -webkit-sticky; position: sticky; top: 0;">                                              
                                <div class="h4 pb-2 text-center ">Order Summary</div>
                                <div class="d-flex justify-content-between  ">
                                    <div>
                                        <div>Total Items</div>
                                    </div>
                                    <div>

                                        1
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-3  ">
                                    <div>                                       
                                        <div>Subtotal</div>
                                    </div>
                                    <div>

                                        Rs:17000
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3  ">
                                    <div>
                                        <div>You Saved</div>
                                    </div>
                                    <div>
                                        - Rs:1000
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between my-3  ">
                                    <div>                                       
                                        <div>Delivery Charge</div>
                                    </div>
                                    <div>
                                        Free
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between my-3  ">
                                    <div>                                        
                                        <div>Sales Tax</div>
                                    </div>
                                    <div>
                                        Rs: 0
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mt-1 ">
                                    <div>                               
                                        <div class="h5">Order Total</div>
                                    </div>
                                    <div class="h5">
                                        Rs: 16000
                                    </div>
                                </div>


                                <a href="{{ asset('checkout') }}"><button class="mt-4 w-100 rounded-full border-0 py-1" style="background-color: #071d49; color:#fff;">
                                    Secure  Checkout</button></a>
                        </div>                        
                    
            </div>
        </div>
        
    <div class="d-flex justify-content-center pb-3 mb-4">
            <div class="text-center ">
                <div class="">
                    <img  src="images/no-product.png" alt=""  style="width:100%;">
                </div>
                    <h1 class=" mt-2">Oh ho!</h1>
                    <p class="mt-2 ">Your Cart is Empty!</p>
                    <a href="{{asset('/')}}"><button class="py-1 px-4 mt-2 border-0"style="background-color: #071d49; color:#fff;">Start Shopping</button></a>
            </div>
    </div> 
</div>

    
    

</div>
