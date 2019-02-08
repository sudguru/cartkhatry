@extends('layouts.admin')
@section('pagetitle')
Add Images of Product
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/colorpicker/css/bootstrap-colorpicker.css') }}">
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

.deletePrice {
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
                <a class="btn btn-sm btn-success" style="height:36px; padding: .6rem 1.5rem" href="{{ route('product.create') }}">Add New</a>
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
                    <img src="/storage/images/{{auth()->user()->id}}/thumb_240/{{$pic->pic_path}}" style="width: 100%; cursor: move" />
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%">Size</th>
                            <th style="text-align: right">Regular</th>
                            <th style="text-align: right">Discounted</th>
                            <th>Valid Until</th>
                            <th>Del</th>
                        </tr>
                    </thead>
                    <tbody id="productPrices">
                        @foreach($product->prices as $price)
                        <tr id="row-{{$price->id}}">
                            <td>{{$price->size->size}}</td>
                            <td style="text-align: right">{{$price->regular}}</td>
                            <td style="text-align: right">{{$price->discounted}}</td>
                            <td>{{$price->discount_valid_until}}</td>
                            <td><i class="fas fa-trash deletePrice" id="{{$price->id}}"></i></td>
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <select name="size_id" class="form-control selectsizeclass">
                                    @foreach($sizes as $size)
                                    <option value="{{$size->id}}" data-size="{{$size->size}}">{{$size->size}}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="sizename" value="{{$sizes[0]->size}}" />
                            </td>
                            <td>
                                <input id="regular" type="number" name="regular" required class="form-control">
                            </td>
                            <td>
                                <input id="discounted" type="number" name="discounted" class="form-control">
                            </td>
                            <td>
                                <input id="discount_valid_until" type="text" name="discount_valid_until" data-toggle="datepicker"
                                    class="form-control" autocomplete="off">
                            </td>
                            <td>
                                <input type="hidden" name="product_id" value={{$product->id}} />
                                <button type="submit" class="btn btn-primary btn-sm float-right">Save Price</button>
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
                    <option value="KhatryOnline.com" {{ $product->paymentmanagedby == 'KhatryOnline.com' ? 'selected' : '' }}>KhatryOnline.com</option>
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
                        <option value="{{$parent->id}}" {{$parent->id == $product->category_id ? 'selected': ''}}>{{$parent->category}}</option>
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
                    <option value="{{$country->name}}" {{ $product->manufactured_in == $country->name ? 'selected' : ''}}>{{$country->name}}</option>
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
                <select name="primarycurrency">
                    <option value="AUD">AUD - Australian Dollar</option>
                    <option value="CAD">CAD - Canadian Dollar</option>
                    <option value="CNY">CNY - Chinese Yuan</option>
                    <option value="DKK">DKK - Danish Kroner</option>
                    <option value="EUR">EUR - European Euro</option>
                    <option value="HKD">HKD - Hongkong Dollar</option>
                    <option value="IND">IND - Indian Rupee</option>
                    <option value="JPY">JPY - Japanese Yen</option>
                    <option value="NPR">NPR - Nepalese Rupee</option>
                    <option value="SGD">SGD - Singapore Dollar</option>
                    <option value="KRW">KRW - South Korean Won</option>
                    <option value="SEK">SEK - Swedish Kroner</option>
                    <option value="CHF">CHF - Swiss Franc</option>
                    <option value="USD">USD - US Dollar</option>
                    <option value="GBP">GBP - UK Pound Sterling</option>
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
