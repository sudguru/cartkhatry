@extends('layouts.admin')
@section('pagetitle')
Images/Size/Price of Product
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}">

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
.color {
    width: 30px;
    height: 30px;
    margin-right: 5px;
    margin-bottom: 5px;
    position: relative;
}

.colorRemove {
    position: absolute;
    right: 5px;
    bottom: 0;
}

.input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 0 4px 4px 0;
    border-left: none;
}

.colorpicker-element .input-group-addon i,
.colorpicker-element .add-on i {
  margin-top: 4px;
  display: inline-block;
  cursor: pointer;
  height: 25px;
  vertical-align: text-center;
  width: 25px;
}

.pointer {
    cursor: pointer;
}

.pointer {
    cursor: pointer;
}

.copycolor {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 2px;
}

#txtcopycolor {
    display: none;
    position: relative;;
    left: -1000px
}

</style>
@endsection

@section('content')

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="container">

    <div class="d-flex justify-content-between">
        <h2><span class="text-muted">Edit</span> {{$product->name}}</h2>
        <div>
            <a class="btn btn-sm btn-success" style="height:36px; padding: .6rem 1.5rem" href="{{ route('product.create') }}">Add
                New</a>
            <a class="btn btn-sm btn-info" style="height:36px; padding: .6rem 1.5rem" href="/adm/products">Done</a>
        </div>


    </div>
    <div class="card">
        <div class="card-header">
            Product Images
            <a href="#" class="card-edit" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i>
                &nbsp;Add New Image</a>
        </div>

        <div class="card-body" style="padding-bottom: 0">
            <ul id="productImages">
                @foreach($product->pics()->orderBy('display_order')->get() as $pic)
                <li data-id="{{ $pic->id }}">
                    <img src="/storage/images/{{$product->user_id}}/thumb_240/{{$pic->pic_path}}" style="width: 100%; cursor: move" />
                    <i class="js-remove" style="cursor: pointer; color: #000000">✖</i>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Size / Price
        </div>

        <div class="card-body table-responsive" style="padding-bottom: 0; min-height: 50px">
            <form action="route('price.store') }}" method="POST" id="form-add-price">
                @csrf
                <div class="text-right"><small>To change Stock Status click Yes or No to toggle.</small></div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%">Size</th>
                            <th style="text-align: right">Regular</th>
                            <th style="text-align: right">Discounted</th>
                            <th>Valid Until</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productPrices">
                        @foreach($product->prices as $price)
                        <tr id="row-{{$price->id}}">
                            <td id="sizename_value-{{$price->id}}">{{$price->size->size}}</td>
                            <td style="text-align: right">{{$product->primarycurrency}} <span id="regular_value-{{$price->id}}">{{$price->regular}}</span></td>
                            <td style="text-align: right">{{$product->primarycurrency}} <span id="discounted_value-{{$price->id}}">{{$price->discounted}}</span></td>
                            <td id="discount_valid_until_value-{{$price->id}}">{{$price->discount_valid_until}}</td>
                            <td id="stock-{{$price->id}}" class="stock pointer" data-stock="{{$price->stock}}">{!! $price->stock == 1 ? '<span style="color:green">Yes</span>' : '<span style="color:red">No</span>' !!}</td>
                            <td>
                                <input type="hidden" id="size_id_hidden-{{$price->id}}" value="{{$price->size->id}}">
                                <i class="fas fa-edit editPrice pointer" id="update-{{$price->id}}"></i>&nbsp;&nbsp;&nbsp;
                                <i class="fas fa-trash deletePrice pointer" id="{{$price->id}}"></i>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <select name="size_id" id="size_id" class="form-control selectsizeclass">
                                    @foreach($sizes as $size)
                                    <option value="{{$size->id}}" data-size="{{$size->size}}">{{$size->size}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="sizename" value="{{$sizes[0]->size}}" />
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">{{$product->primarycurrency}} </span>
                                    </div>
                                    <input  id="regular" type="number" name="regular" required class="form-control"> 
                                </div>
                            </td>
                            <td>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">{{$product->primarycurrency}} </span>
                                            </div>
                                            <input  id="discounted" type="number" name="discounted" required class="form-control" aria-describedby="basic-addon2">
                                        </div>
                            </td>
                            <td>
                                <input id="discount_valid_until" type="text" name="discount_valid_until" data-toggle="datepicker"
                                    class="form-control" autocomplete="off">
                            </td>
                            <td>
                                <input type="hidden" id="mytask" value="add">
                                <input type="hidden" name="product_id" value="{{$product->id}}" />
                                <input type="hidden" name="price_id" id="price_id" value="0" />
                                <button type="submit" id="price_save_btn" class="btn btn-primary btn-sm float-right">Add Price</button>
                            </td>
                        </tr>

                    </tfoot>
                </table>
            </form>
        </div>
    </div>



    <form action="{{ route('product.update', $product->slug) }}" method="POST" autocomplete="off" novalidate class="mb-1">
        @csrf
        {{ method_field('PUT') }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Product Name <span class="required">*</span></label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                        name="name" value="{{ old('name') ?? $product->name  }}" autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <label for="paymentmanagedby">Payment Managed By</label>
                <select name="paymentmanagedby" id="paymentmanagedby" class="form-control">
                    <option value="KhatryOnline.com"
                        {{ $product->paymentmanagedby == 'KhatryOnline.com' ? 'selected' : '' }}>KhatryOnline.com</option>
                    <option value="Self" {{ $product->paymentmanagedby == 'Self' ? 'selected' : '' }}>Self</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_id">Category</label>

                    <select class="custom-select" name="category_id" id="category_id">
                        @foreach($categories as $parent)
                        <option value="{{$parent->id}}" {{$parent->id == $product->category_id ? 'selected': ''}}>{{$parent->category}}
                            {{$parent->id}}</option>
                        @if($parent->children)
                        @foreach($parent->children as $child)
                        <option value="{{$child->id}}" {{$child->id == $product->category_id ? 'selected': ''}}>
                            -- {{$child->category}}</option>
                        @if($child->children)
                        @foreach($child->children as $grandchild)
                        <option value="{{$grandchild->id}}"
                            {{$grandchild->id == $product->category_id ? 'selected': ''}}> ----
                            {{$grandchild->category}}</option>
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->brand}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="manufactured_in">Manufactured In</label>
                <select name="manufactured_in" id="manufactured_in" class="form-control">
                    @foreach($countries as $country)
                    <option value="{{$country->name}}"
                        {{ $product->manufactured_in == $country->name ? 'selected' : ''}}>{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_available">Delivery Available ? <span class="required">*</span></label>
                    <select name="delivery_available" id="delivery_available" class="form-control">
                        <option value="1" {{$product->delivery_available == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{$product->delivery_available == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_day_from">Delivery Day From <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_day_from" name="delivery_day_from" value="{{ old('delivery_day_from') ?? $product->delivery_day_from }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_day_to">Delivery Day To <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_day_to" name="delivery_day_to" value="{{ old('delivery_day_to') ?? $product->delivery_day_to }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_charge_local">Delivery Charge Local <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_charge_local" name="delivery_charge_local"
                        value="{{ old('delivery_charge_local') ?? $product->delivery_charge_local }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_charge_intercity">Delivery Charge Intercity <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_charge_intercity" name="delivery_charge_intercity"
                        value="{{ old('delivery_charge_intercity') ?? $product->delivery_charge_intercity }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="delivery_charge_intl">Delivery Charge Intl <span class="required">*</span></label>
                    <input type="number" class="form-control" id="delivery_charge_intl" name="delivery_charge_intl"
                        value="{{ old('delivery_charge_intl') ?? $product->delivery_charge_intl }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Short Description</label>
            <textarea class="form-control editor" name="description" id="description" style="height: calc(100% - 46px)">{{ old('description') ?? $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="specification">Detailed Specification</label>
            <textarea class="form-control editor" name="specification" id="specification">{{ old('specification') ?? $product->specification }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-4">
                    <select name="primarycurrency" class="form-control">
                            <option value="AUD" {{ $product->primarycurrency == "AUD" ? 'selected' : '' }}>AUD - Australian Dollar</option>
                            <option value="CAD" {{ $product->primarycurrency == "CAD" ? 'selected' : '' }}>CAD - Canadian Dollar</option>
                            <option value="CNY" {{ $product->primarycurrency == "CNY" ? 'selected' : '' }}>CNY - Chinese Yuan</option>
                            <option value="DKK" {{ $product->primarycurrency == "DKK" ? 'selected' : '' }}>DKK - Danish Kroner</option>
                            <option value="EUR" {{ $product->primarycurrency == "EUR" ? 'selected' : '' }}>EUR - European Euro</option>
                            <option value="HKD" {{ $product->primarycurrency == "HKD" ? 'selected' : '' }}>HKD - Hongkong Dollar</option>
                            <option value="INR" {{ $product->primarycurrency == "INR" ? 'selected' : '' }}>INR - Indian Rupee</option>
                            <option value="JPY" {{ $product->primarycurrency == "JPY" ? 'selected' : '' }}>JPY - Japanese Yen</option>
                            <option value="NPR" {{ $product->primarycurrency == "NPR" ? 'selected' : '' }}>NPR - Nepalese Rupee</option>
                            <option value="SGD" {{ $product->primarycurrency == "SGD" ? 'selected' : '' }}>SGD - Singapore Dollar</option>
                            <option value="KRW" {{ $product->primarycurrency == "KRW" ? 'selected' : '' }}>KRW - South Korean Won</option>
                            <option value="SEK" {{ $product->primarycurrency == "SEK" ? 'selected' : '' }}>SEK - Swedish Kroner</option>
                            <option value="CHF" {{ $product->primarycurrency == "CHF" ? 'selected' : '' }}>CHF - Swiss Franc</option>
                            <option value="USD" {{ $product->primarycurrency == "USD" ? 'selected' : '' }}>USD - US Dollar</option>
                            <option value="GBP" {{ $product->primarycurrency == "GBP" ? 'selected' : '' }}>GBP - UK Pound Sterling</option>
                        </select>
            </div>
        </div>

        <div class="form-footer" style="margin-top: 0; padding-top:0">
            <button type="submit" class="btn btn-primary btn-md">Update Product</button>
        </div><!-- End .form-footer -->

    </form>


    <div class="mb-2"></div><!-- margin -->


</div><!-- End .container -->


<div class="mb-5"></div><!-- margin -->

@include('admin.uploadimagesimple.imagemanager')



@endsection

@section('extrajs')
@include('admin.uploadimagesimple.js')
@include('admin.product.js')
@endsection