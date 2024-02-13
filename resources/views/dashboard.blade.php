@extends('adminlte::page')

@section('content')
    <style>
        .reviw_progress {
            background: #EEEEEE;
            justify-content: flex-start;
            border-radius: 100px;
            align-items: center;
            position: relative;
            display: flex;
            height: 10px;
            width: 100%;

        }

        .progress-value {
            border-radius: 100px;
            height: 10px;
        }



        .progress-item {
            display: flex;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 0;
            animation: .4s ease-out reverse;
        }

        .progress-item::after {
            content: attr(data-value);
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 50px;
            margin: 5px;
            border-radius: 50%;
            background: white;
            color: #8900ff;
            font-size: 12px;
            text-align: center;
        }

        .progress-item2 {
            display: flex;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            font-size: 0;
            animation: .4s ease-out reverse;
        }

        .progress-item2::after {
            content: attr(data-value);
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 100px;
            margin: 8px;
            border-radius: 50%;
            background: white;
            color: #2d0153;
            font-size: 12px;
            text-align: center;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="position-relative">
                <img src="{{ asset('images/dashbanner.png') }}" alt="" style="width: 100%; height:100px;">
                <div class=" position-absolute w-100 " style="top:25%; left:0px; z-index: 999;">
                    <h4 class="px-2 text-white">Welcome to My Jewelry Dashboard</h4>

                    <div class="row p-2">

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <a href="">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <div class="d-flex justify-content-between  align-items-center  mb-4">
                                            <div>
                                                <div class="mb-1"> 25140</div>
                                                <div>Total Sales</div>
                                            </div>
                                            <div>
                                                <div
                                                    style="background-color:blue; padding:12px; color:#fff; border-radius:50%;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>Total income: $22506</div>
                                            <div>20%</div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <a href="">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <div class="d-flex justify-content-between  align-items-center  mb-4">
                                            <div>
                                                <div class="mb-1"> 25140</div>
                                                <div>Total Orders</div>
                                            </div>
                                            <div>
                                                <div
                                                    style="background-color:blue; padding:12px; color:#fff; border-radius:50%;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                        <path
                                                            d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z" />
                                                        <path
                                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>Total income: $22506</div>
                                            <div>20%</div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <a href="">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <div class="d-flex justify-content-between  align-items-center  mb-4">
                                            <div>
                                                <div class="mb-1"> 25140</div>
                                                <div>Total Users</div>
                                            </div>
                                            <div>
                                                <div
                                                    style="background-color:blue; padding:12px; color:#fff; border-radius:50%;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>Total income: $22506</div>
                                            <div>20%</div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <a href="">
                                <div class="small-box bg-white">
                                    <div class="inner">
                                        <div class="d-flex justify-content-between  align-items-center  mb-4">
                                            <div>
                                                <div class="mb-1"> 25140</div>
                                                <div>Total Revenue</div>
                                            </div>
                                            <div>
                                                <div
                                                    style="background-color:blue; padding:12px; color:#fff; border-radius:50%;">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        fill="currentColor" class="bi bi-graph-up-arrow"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>Total income: $22506</div>
                                            <div>20%</div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
            <!-- Main row -->
            <div class="d-block d-lg-none" style="margin-bottom: 245px;"></div>
            <div class="row "style="margin-top:110px;">
                <!-- Left col -->
                <div class="col-lg-8">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Today's trends <br><span style="font-size: 12px">as of 26th Jan 2023,
                                        08:52 AM</span> </h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">70</span>
                                    <span>Call Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span class="text-muted">Since last week</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="myChart" style="width:100%; height: 250px;"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> This Week
                                </span>

                                <span>
                                    <i class="fas fa-square text-gray"></i> Last Week
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- DIRECT CHAT -->

                    <!-- /.card -->
                </div>
                <div class="col-lg-4">
                    <div class="card py-2 px-3" style="height: 470px;">

                        <div class="row">
                            <div class="col-12">
                                <div class="bg-white">
                                    <h5>Top product sales</h5>
                                </div>

                                <div class="d-flex justify-content-between  align-items-center border-bottom py-2 mb-3">
                                    <div class="col-6">Rings</div>
                                    <div class="col-6 d-flex justify-content-between  align-items-center">
                                        <div data-num="90" class="progress-item" style="color:#15b300;">sd
                                        </div>
                                        <div>
                                            <div>70%</div>
                                            <div>Sale</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between  align-items-center border-bottom py-2 mb-3">
                                    <div class="col-6">Earrings</div>
                                    <div class="col-6 d-flex justify-content-between  align-items-center">
                                        <div data-num="80" class="progress-item">sd</div>
                                        <div>
                                            <div>70%</div>
                                            <div>Sale</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between  align-items-center border-bottom py-2 mb-3">
                                    <div class="col-6">Pendants</div>
                                    <div class="col-6 d-flex justify-content-between  align-items-center">
                                        <div data-num="70" class="progress-item">sd</div>
                                        <div>
                                            <div>70%</div>
                                            <div>Sale</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between  align-items-center border-bottom py-2 mb-3">
                                    <div class="col-6">Necklaces</div>
                                    <div class="col-6 d-flex justify-content-between  align-items-center">
                                        <div data-num="60" class="progress-item">sd</div>
                                        <div>
                                            <div>70%</div>
                                            <div>Sale</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between  align-items-center border-bottom py-2 ">
                                    <div class="col-6">Bracelets</div>
                                    <div class="col-6 d-flex justify-content-between  align-items-center">
                                        <div data-num="40" class="progress-item">sd</div>
                                        <div>
                                            <div>70%</div>
                                            <div>Sale</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class=" text-center bg-white py-4 shadow">
                        <h4>Recent Stock</h4>
                        <div class="d-flex mt-3 justify-content-center">
                            <div data-num="90" class="progress-item progress-item2">sd</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class=" text-center bg-white py-4 shadow">
                        <h4>Purchase Order</h4>
                        <div class="mt-3 d-flex justify-content-center">
                            <div data-num="80" class="progress-item progress-item2">sd</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class=" text-center bg-white py-4 shadow">
                        <h4>Shipped Orders</h4>
                        <div class="mt-3 d-flex justify-content-center">
                            <div data-num="60" class="progress-item progress-item2">sd</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class=" text-center bg-white py-4 shadow">
                        <h4>canceled Orders</h4>
                        <div class="mt-3 d-flex justify-content-center">
                            <div data-num="30" class="progress-item progress-item2">sd</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="row  py-5 ">

                {{-- <div class="col-lg-4 ">
                        <div class="">
                            <div class=" bg-white rounded-2xl p-5">
                                <div class="">
                                    <div class="">
                                        <h5 >Appointments </h5>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between  align-items-center my-2">
                                    <div>
                                        <label for="Review">From:</label>
                                        <input wire:model="afrom" type="date" style="   border:1px solid gray;">
                                    </div>
                                    <div>
                                        <label for="Review">To:</label>
                                        <input wire:model="ato" type="date" style="   border:1px solid gray;">
                                    </div>
                                </div>

                                <div class="row mt-5 pb-3">
                                    <div class="col-6">
                                        <div class=" border-b border-r  border-gray-200 p-3 h-100">
                                            <p class=" mb-2">Today appointment </p>
                                            <h5 class="font-medium text-xl">2</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class=" border-b  border-gray-200 p-3 h-100">
                                            <p class=" mb-2">Total appointment </p>
                                            <h5 class="font-medium text-xl">3</h5>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="rounded bg-white p-5">
                            <div class="  ">

                                <div class="">
                                    <h5 >Subscribers</h5>
                                </div>

                                <div class="d-flex justify-content-between  align-items-center my-2">

                                    <div>
                                        <label for="Subscriber">From:</label>
                                        <input wire:model="sfrom" type="date" style="   border:1px solid gray;">
                                    </div>
                                    <div>
                                        <label for="Subscriber">To:</label>
                                        <input wire:model="sto" type="date" style="   border:1px solid gray;">
                                    </div>
                                </div>

                                <div class="row mt-5 pb-3">
                                    <div class="col-6">
                                        <div class=" border-b border-r border-gray-200 p-3 h-100">
                                            <p class=" mb-2">Today Subscribers</p>
                                            <h5 class="font-medium text-xl">2</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">


                                        <div class="border-b  border-gray-200 p-3 h-100">
                                            <p class=" mb-2">Total Subscribers</p>
                                            <h5 class="font-medium text-xl">23</h5>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div> --}}
                <div class="col-12">
                    <div class=" bg-white p-2 shadow">
                        <div class="mb-1">
                            <h4>Ratings & Reviews </h4>
                        </div>

                        <div class="row ">
                            <div class="col-lg-6 mb-3">
                                <div class="border-bottom">
                                    <h5>Ratings : (&#9733; &#9733;
                                        &#9733; &#9733; &#9733;)</h5>
                                </div>

                                <div class="d-flex justify-content-between  align-items-center border-0 pt-3">
                                    <div>
                                        <span style="color:#15b300; font-size:18px;">5 &#9733;</span>
                                    </div>
                                    {{-- @php
                                            $total = App\Models\Review::all();
                                            $reviewtotal = count($total);
                                            
                                            $fivescores = App\Models\Review::where('score', 5)->get();
                                            $perfive = (count($fivescores) / $reviewtotal) * 100;
                                            
                                            $fourscores = App\Models\Review::where('score', 4)->get();
                                            $perfour = (count($fourscores) / $reviewtotal) * 100;
                                            
                                            $threescores = App\Models\Review::where('score', 3)->get();
                                            $perthree = (count($threescores) / $reviewtotal) * 100;
                                            
                                            $twocores = App\Models\Review::where('score', 2)->get();
                                            $pertwo = (count($twocores) / $reviewtotal) * 100;
                                            
                                            $onecores = App\Models\Review::where('score', 1)->get();
                                            $perone = (count($onecores) / $reviewtotal) * 100;
                                            
                                        @endphp --}}
                                    <div style="color:#15b300;">
                                        {{-- {{ $perfive }}% --}}
                                        30%
                                    </div>
                                </div>


                                <div class="reviw_progress mb-4">
                                    <div class="progress-value" style="width:30%; background:#15b300;"></div>
                                </div>


                                <div class="d-flex justify-content-between  align-items-center border-0">
                                    <div>
                                        <span style="color:#8900ff; font-size:18px;">4 &#9733;</span>
                                    </div>
                                    <div style="color:#8900ff;">
                                        {{-- {{ $perfour }}% --}}40%
                                    </div>
                                </div>
                                <div class="reviw_progress mb-4">
                                    <div class="progress-value" style="width:40%; background:#8900ff;"></div>
                                </div>


                                <div class="d-flex justify-content-between  align-items-center border-0">
                                    <div>
                                        <span style="color:#ffaa00; font-size:18px;">3 &#9733;</span>
                                    </div>
                                    <div style="color:#ffaa00;">
                                        {{-- {{ $perthree }}% --}}10%
                                    </div>
                                </div>
                                <div class="reviw_progress mb-4">
                                    <div class="progress-value" style="width:10%; background:#ffaa00;"></div>
                                </div>


                                <div class="d-flex justify-content-between  align-items-center border-0">
                                    <div>
                                        <span style="color:#ff6600; font-size:18px;">2 &#9733;</span>
                                    </div>
                                    <div style="color:#ff6600;">
                                        {{-- {{ $pertwo }}% --}}20%
                                    </div>
                                </div>
                                <div class="reviw_progress mb-4">
                                    <div class="progress-value" style="width:20%; background:#ff6600;"></div>
                                </div>


                                <div class="d-flex justify-content-between  align-items-center border-0">
                                    <div>
                                        <span style="color:#b30000; font-size:18px;">1 &#9733;</span>
                                    </div>
                                    <div style="color:#b30000;">
                                        {{-- {{ $perone }}% --}}0%
                                    </div>
                                </div>
                                <div class="reviw_progress">
                                    <div class="progress-value" style="width:0%; background:#b30000;"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="d-flex justify-content-between  align-items-center border-bottom">
                                    <div class="">
                                        <h5>Reviews : </h5>
                                    </div>
                                    <div class="d-flex justify-content-between  align-items-center">
                                        <div>
                                            <span for="Review">From:</span>
                                            <input wire:model="refrom" type="date" style="   border:1px solid gray;">
                                        </div>
                                        <div>
                                            <span for="Review">To:</span>
                                            <input wire:model="reto" type="date" style="   border:1px solid gray;">
                                        </div>
                                    </div>
                                </div>


                                <div class=" p-2 " style="overflow:auto; height:320px;">

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div class="capitalize">
                                                name
                                            </div>
                                            <div>
                                                12/2/2023
                                            </div>
                                        </div>
                                        <div class="py-2 text-sm text-justify font-medium ">
                                            review
                                        </div>
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div>sku</div>
                                            <div class="flex  border-0" style="color:#00263a;">
                                                <span style="font-size:15px;">&#9733;
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div class="capitalize">
                                                name
                                            </div>
                                            <div>
                                                12/2/2023
                                            </div>
                                        </div>
                                        <div class="py-2 text-sm text-justify font-medium ">
                                            review
                                        </div>
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div>sku</div>
                                            <div class="flex  border-0" style="color:#00263a;">
                                                <span style="font-size:15px;">&#9733;
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div class="capitalize">
                                                name
                                            </div>
                                            <div>
                                                12/2/2023
                                            </div>
                                        </div>
                                        <div class="py-2 text-sm text-justify font-medium ">
                                            review
                                        </div>
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div>sku</div>
                                            <div class="flex  border-0" style="color:#00263a;">
                                                <span style="font-size:15px;">&#9733;
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div class="capitalize">
                                                name
                                            </div>
                                            <div>
                                                12/2/2023
                                            </div>
                                        </div>
                                        <div class="py-2 text-sm text-justify font-medium ">
                                            review
                                        </div>
                                        <div class="d-flex justify-content-between  align-items-center border-0">
                                            <div>sku</div>
                                            <div class="flex  border-0" style="color:#00263a;">
                                                <span style="font-size:15px;">&#9733;
                                            </div>
                                        </div>
                                        <hr>
                                    </div>



                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        </div>


    </section>
    <script>
        var xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
        var yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 6,
                            max: 16
                        }
                    }],
                }
            }
        });




        let items = document.querySelectorAll('.progress-item');
        const counters = Array(items.length);
        const intervals = Array(items.length);
        counters.fill(0);
        items.forEach((number, index) => {
            intervals[index] = setInterval(() => {
                if (counters[index] == parseInt(number.dataset.num)) {
                    clearInterval(intervals[index]);
                } else {
                    counters[index] += 1;
                    number.style.background = "conic-gradient(green calc(" + counters[index] +
                        "%), lightgray 0deg)";
                    number.setAttribute('data-value', counters[index] + "%");
                    number.innerHTML = counters[index] + "%";
                }
            }, 15);
        });
    </script>
@stop
