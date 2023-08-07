@extends('adminlte::page')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        {{-- <div class="row pt-3">

            <div class="col-lg-2 col-6">
                <!-- small box -->
                <a href="{{asset('complaints/999')}}">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Unreasolved</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <a href="{{asset('complaints/2')}}">
                    <!-- small box -->
                    <div class="small-box bg-white">
                        <div class="inner">
                            <h3>{{$not_assign}}</h3>
                            <p>Unassigned</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <a href="{{asset('complaints/1003')}}">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <h3>{{$overdue}}</h3>
                            <p>Overdue</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <a href="{{asset('complaints/1001')}}">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <h3>{{$today_due}}</h3>
                            <p>Due Today</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <a href="{{asset('complaints/2')}}">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <h3>{{$open}}</h3>
                            <p>New</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <a href="{{asset('complaints/8')}}">
                    <div class="small-box bg-white">
                        <div class="inner">
                            <h3>0</h3>
                            <p>On Hold</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ./col -->
        </div> --}}
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
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
            <div class="col-4">
                <div class="card py-5 px-3" style="height: 470px;">
                    <div class="row">
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3></h3>
                                    <p>Resolved</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>{</h3>
                                    <p>Received</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0m</h3>
                                    <p>Average first response time</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0m</h3>
                                    <p>Average response time</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0%</h3>
                                    <p>Resolution within SLA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-3 py-4" style="min-height: 350px">
                    <div class="row">
                        <div class="col-6">
                            Unresolved tickets
                            <span style="font-size: 12px">Across helpdesk</span>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <a href="#"> View Details</a>
                        </div>
                        <div class="col-12 mt-2">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Group
                                    <span class=" badge-pill">Open</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Escalations
                                    <span class="badge badge-primary badge-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Engineering
                                    <span class="badge badge-primary badge-pill">2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Customer Support
                                    <span class="badge badge-primary badge-pill">1</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Billing
                                    <span class="badge badge-primary badge-pill">1</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-3 py-4" style="min-height: 350px">
                    <div class="row">
                        <div class="col-6">
                            Customer satisfaction
                            <span style="font-size: 12px">Across helpdesk this month</span>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <a href="#"> View Details</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3></h3>
                                    <p>Responses received</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0%</h3>
                                    <p>Positive</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0%</h3>
                                    <p>Neutral</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0%</h3>
                                    <p>Negative</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-3 py-4" style="min-height: 350px">
                    <div class="row">
                        <div class="col-12">
                            Forums
                            <span style="font-size: 12px">Across helpdesk</span>
                        </div>
                        <div class="col-12">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0%</h3>
                                    <p>Waiting for approval</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-white">
                                <div class="inner pl-3" style="border-left: 2px solid rgb(193, 193, 193)">
                                    <h3>0%</h3>
                                    <p>Spam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<script>
    var xValues = [50,60,70,80,90,100,110,120,130,140,150];
    var yValues = [7,8,8,9,9,9,10,11,14,14,15];
    
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
        legend: {display: false},
        scales: {
          yAxes: [{ticks: {min: 6, max:16}}],
        }
      }
    });
</script>
@stop