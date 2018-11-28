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
    width: 45px;
    height: 45px;
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
    cursor: pointer;
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
        <a class="btn btn-sm btn-info" style="height:36px; padding: .6rem 1.5rem" href="/adm/products">Done</a>
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
            Product Prices
            <a href="#" class="card-edit" data-toggle="modal" data-target="#priceModalAdd"><i class="fas fa-plus"></i>
                &nbsp;Add New Price</a>
        </div>

        <div class="card-body table-responsive" style="padding-bottom: 0; min-height: 50px">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Colors</th>
                        <th>Qty</th>
                        <th style="text-align: right">Regular</th>
                        <th style="text-align: right">Discounted</th>
                        <th>Valid Until</th>
                        <th>Del</th>
                    </tr>
                </thead>
                <tbody id="productPrices">
                    @foreach($product->prices as $price)
                    <tr id="row-{{$price->id}}">
                        <td>{{$price->name}}</td>
                        <td class="d-flex justify-content-start">
                            <div class="d-flex flex-wrap justify-content-start" id="color-{{$price->id}}">
                                @php
                                $colors = explode('~', ltrim($price->colors,'~'));
                                @endphp
                                @if($price->colors)
                                @foreach($colors as $color)

                                <div class="color" style="background-color: {{$color}}; text-align: center">
                                    <i class="colorRemove" style="cursor:pointer" data-color="{{$color}}">✖</i>
                                    <span style="font-size: 9px" class="copycolor" data-color="{{$color}}">Copy</span>
                                </div>

                                @endforeach
                                @endif
                            </div>
                            <div class="color" style="background-color: #ddd; text-align: center">
                                <a href="javascript:void(0)" class="addpriceid" data-toggle="modal" data-target="#colorPickerModal">
                                    <i class="fas fa-plus" style="margin-top: 16px"></i>
                                </a>
                            </div>
                            <input type="text" id="txtcopycolor" />
                        </td>
                        <td>{{$price->fromqty}} - {{$price->toqty}}</td>
                        <td style="text-align: right">{{$price->regular}}</td>
                        <td style="text-align: right">{{$price->discounted}}</td>
                        <td>{{$price->discount_valid_until}}</td>
                        <td><i class="fas fa-trash deletePrice" id="{{$price->id}}"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Color Picker Modal --}}
    <input type="text" id="currentPriceId" />
    <div class="modal fade" id="colorPickerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body d-flex flex-column">
                    <div id="cp7" class="input-group colorpicker-component">
                        <input type="text" id="selectedColor" value="" class="form-control" />
                        <span class="input-group-addon"><i></i></span>
                    </div>
                    <button class="btn btn-primary button-sm mt-4 ml-auto" id="btnColor">Done</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Color Picker Modal End --}}

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
                <div class="form-group">
                    <label for="model">Model <span class="required">*</span></label>
                    <input type="text" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" id="model"
                        name="model" value="{{ old('model') ?? $product->model  }}" autofocus>

                    @if ($errors->has('model'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('model') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
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
            <div class="col-md-6">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->brand}}</option>
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

        <div class="form-footer" style="margin-top: 0; padding-top:0">
            <button type="submit" class="btn btn-primary btn-md">Update Product</button>
        </div><!-- End .form-footer -->

    </form>


    <div class="mb-2"></div><!-- margin -->


</div><!-- End .container -->


<div class="mb-5"></div><!-- margin -->

@include('admin.uploadimagesimple.imagemanager')
@include('admin.product.price')


@endsection

@section('extrajs')
@include('admin.uploadimagesimple.js')
@include('admin.product.js')
@endsection
