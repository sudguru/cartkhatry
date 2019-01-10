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
                    snapshot of your recent account activity and update your account information. 
                    
                </div><!-- End .alert -->
    
                <div class="mb-4"></div><!-- margin -->
    

    

    
                <div class="card">
                    <div class="card-header">
                        Account Infomormation
                        <a href="/account/info" class="card-edit">Edit</a>
                    </div><!-- End .card-header -->
    
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Account Email</th>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <th>Account Name</th>
                                <td>{{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$userdetail->address}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$userdetail->city}}</td>
                            </tr>                       
                            <tr>
                                <th>State</th>
                                <td>{{$userdetail->state}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{$userdetail->country}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$userdetail->phone}}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{$userdetail->mobile}}</td>
                            </tr>
                            <tr>
                                <th>Postal Code</th>
                                <td>{{$userdetail->postalcode}}</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td>{{$userdetail->website}}</td>
                            </tr>
                            <tr>
                                <th>Payment Link</th>
                                <td>{{$userdetail->paymentlink}}</td>
                            </tr>
                        </table>
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