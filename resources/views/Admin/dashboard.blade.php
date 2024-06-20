<!-- <h1>hii</h1> -->
@extends('admin.layout.layout')
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!-- > -->
<!--  -->
<!-- </div> -->
@section('content')
< <!-- TOTAL USERS -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> User Count</span>
            <div class="count">{{$userCount}}</div>
            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
        <!-- AVERAGE TIME -->
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="#"></i>Product Count </span>
            <div class="count">{{$productCount}}</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
        </div>
        <!-- TOTAL MALES -->
        
        <!-- TOTAL FEMALE -->
        
        <!-- TATAL COLLECTIONS -->
       


        @endsection