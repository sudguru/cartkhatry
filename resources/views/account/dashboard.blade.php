@extends('layouts.d11')
@section('pagetitle')
    Dashboard
@endsection

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div><!-- End .container -->
    </nav>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <h2>My Dashboard</h2>
    
    
                <div class="alert alert-success" role="alert">
                    Hello, <strong>{{auth()->user()->name}}</strong> From your My Account Dashboard you have the ability to view a
                    snapshot of your recent account activity and update your account information. Select a link below to
                    view or edit information.
                    
                </div><!-- End .alert -->
    
                <div class="mb-4"></div><!-- margin -->
    
                <h3>Account Information</h3>
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Contact Information
                                <a href="#" class="card-edit">Edit</a>
                            </div><!-- End .card-header -->
    
                            <div class="card-body">
                                <p>
                                    John Doe<br>
                                    porto_shop@gmail.com<br>
                                    <a href="#">Change Password</a>
                                </p>
                            </div><!-- End .card-body -->
                        </div><!-- End .card -->
                    </div><!-- End .col-md-6 -->
    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                newsletters
                                <a href="#" class="card-edit">Edit</a>
                            </div><!-- End .card-header -->
    
                            <div class="card-body">
                                <p>
                                    You are currently not subscribed to any newsletter.
                                </p>
                            </div><!-- End .card-body -->
                        </div><!-- End .card -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
    
                <div class="card">
                    <div class="card-header">
                        Address Book
                        <a href="#" class="card-edit">Edit</a>
                    </div><!-- End .card-header -->
    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="">Default Billing Address</h4>
                                <address>
                                    You have not set a default billing address.<br>
                                    <a href="#">Edit Address</a>
                                </address>
                            </div>
                            <div class="col-md-6">
                                <h4 class="">Default Shipping Address</h4>
                                <address>
                                    You have not set a default shipping address.<br>
                                    <a href="#">Edit Address</a>
                                </address>
                            </div>
                        </div>
                    </div><!-- End .card-body -->
                </div><!-- End .card -->
            </div><!-- End .col-lg-9 -->
    
            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard">
                    <h3 class="widget-title">My Account</h3>
    
                    <ul class="list">
                        @include('account.sidebar')
                    </ul>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
    
    <div class="mb-5"></div><!-- margin -->
@endsection