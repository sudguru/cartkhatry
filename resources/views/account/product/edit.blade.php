@extends('layouts.site')
@section('pagetitle')
Add Images of Product
@endsection

@section('extracss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
<style>
ul#productImages li{
    display: inline-block;
    width: 150px;
    margin-right: 15px;
    margin-bottom: 15px;
}
.thumbnail {
    border: 1px solid #efefef;
}
#productImages {
    margin-bottom: 0px;
}
#productImages li{
    border: 1px solid #efefef;
    position: relative;
    
}
.js-remove {

    position: absolute;
    bottom: 10px;
    right: 15px;
}
</style>
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

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="container">

    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <div class="d-flex justify-content-between">
                <h2>Edit Product</h2>
                <button class="btn btn-sm btn-info">Done</button>
            </div>
            <div class="card">
                <div class="card-header">
                    Product Images
                    <a href="#" class="card-edit" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i>
                        &nbsp;Add New Image</a>
                </div>

                <div class="card-body" style="padding-bottom: 0">
                    <ul id="productImages">
                        @foreach($product->pics as $pic)
                            <li data-id="{{ $pic->id }}">
                                <img src="/storage/images/{{auth()->user()->id}}/thumb_240/{{$pic->pic_path}}" style="width: 100%; cursor: move" />
                                <i class="js-remove" style="cursor: pointer ">✖</i>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Product Prices
                    <a href="#" class="card-edit" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i>
                        &nbsp;Add New Price</a>
                </div>

                <div class="card-body" style="padding-bottom: 0; min-height: 50px">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Attributes</th>
                                <th>Colors</th>
                                <th style="text-align: right">Regular</th>
                                <th style="text-align: right">Discounted</th>
                                <th>Valid Until</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Standard</td>
                                <td>Colrs</td>
                                <td style="text-align: right">Rs. 230</td>
                                <td style="text-align: right">Rs. 200</td>
                                <td>Jan 1, 2019</td>
                                <td><i class="fas fa-trash"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <form action="{{ route('account.product.update', $product->id) }}" method="POST" autocomplete="off"
                novalidate class="mb-1">
                <div class="form-group">
                    <label for="name">Product Name <span class="required">*</span></label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                        name="name" value="{{ old('name') ?? $product->name }}" autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>

                            <select class="custom-select" name="category_id" id="category_id">
                                @foreach($categories as $parent)
                                    <option value="{{$parent->id}}" {{$parent->id == $product->category_id ? 'selected': ''}}>{{$parent->category}}</option>
                                    @if($parent->children)
                                        @foreach($parent->children as $child)
                                            <option value="{{$child->id}}" {{$child->id == $product->category_id ? 'selected': ''}}> -- {{$child->category}}</option>
                                            @if($child->children)
                                                @foreach($child->children as $grandchild)
                                                    <option value="{{$grandchild->id}}"  {{$grandchild->id == $product->category_id ? 'selected': ''}}> ---- {{$grandchild->category}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SKU">SKU <span class="required">*</span></label>
                                    <input type="text" class="form-control{{ $errors->has('SKU') ? ' is-invalid' : '' }}"
                                        id="SKU" name="SKU" value="{{ old('SKU') ?? $product->SKU }}">
                                    @if ($errors->has('SKU'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('SKU') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Available Stock <span class="required">*</span></label>
                                    <input type="number" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}"
                                        id="stock" name="stock" value="{{ old('stock') ?? $product->stock }}">
                                    @if ($errors->has('stock'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_order_unit">Min Order Unit<span class="required">*</span></label>
                                    <input type="number" class="form-control" id="min_order_unit" name="min_order_unit"
                                        value="{{ old('min_order_unit') ?? $product->min_order_unit }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_stock_level">Min Stock Level<span class="required">*</span></label>
                                    <input type="number" class="form-control" id="min_stock_level" name="min_stock_level"
                                        value="{{ old('min_stock_level') ?? $product->min_stock_level }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description">Short Description</label>
                        <textarea class="form-control editor" name="description" id="description" style="height: calc(100% - 46px)">{{ old('description') ?? $product->description }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="specification">Detailed Specification</label>
                    <textarea class="form-control editor" name="specification" id="specification">{{ old('specification') ?? $product->specification }}</textarea>
                </div>

                <div class="form-footer" style="margin-top: 0; padding-top:0">
                    <button type="submit" class="btn btn-primary btn-md">Update Product</button>
                </div><!-- End .form-footer -->
                @csrf
                {{ method_field('PUT') }}
            </form>


            <div class="mb-2"></div><!-- margin -->

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

@include('uploadimagesimple.imagemanager')


@endsection

@section('extrajs')
    @include('uploadimagesimple.js')
@endsection
