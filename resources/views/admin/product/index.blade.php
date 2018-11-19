@extends('layouts.admin')

@section('pagetitle')
Products - Admin
@endsection
@section('extracss')
<link rel="stylesheet" href="{{ asset('/assets/css/bs4datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/button.datatables.min.css') }}">
@endsection

@section('content')

<h3>Products</h3>
<br/>
<table class="table table-striped my-2" id="myproducts">
    <thead>
        <th>SN</th>
        <th>User</th>
        <th>Category</th>
        <th>SKU</th>
        <th>Name</th>
        <th>Stock</th>
        <th>Min. Stock</th>
        <th>Min. Order</th>
        {{-- <th>Order</th> --}}
        <th>Rank</th>
        <th>Approved</th>

    </thead>
    <tbody>
        @foreach($products as $key=>$product)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$product->user->name}}</td>
            <td>{{$product->category->category}}</td>
            <td>{{$product->SKU}}</td>
            <td><a href="#">{{$product->name}}</a></td>
            <td class="{{ $product->stock <= $product->min_stock_level ? 'required' : '' }}">{{$product->stock}}</td>
            <td>{{$product->min_stock_level}}</td>
            <td>{{$product->min_order_unit}}</td>
            <td>{{$product->viewed_rank}}</td>
            <td><a href="javascript:void(0)" class="approve" id="{{$product->id}}">{{$product->approved ? 'Yes' : 'No'}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<br/>
<br/>
@endsection

@section('extrajs')
<style>
    .myclass {
        display: flex;
        justify-content: space-between;
    }
</style>
<script src="{{ asset('/assets/js/bs4datatables.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatablebutton.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatablecolvis.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatableprint.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('#myproducts').DataTable({
            dom: '<"myclass"Bf>rt<"myclass"lip>',
            buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed three-column',
                    postfixButtons: ['colvisRestore']
                }
            ]
            // ,
            // columnDefs: [{
            //     targets: [-1, -2, -3, -4, -5, -6, -7, -8, -9, -10, -11, -12],
            //     visible: false
            // }]
        });
        
        $('.approve').on('click', function() {

          var id = $(this).attr('id');
          var val = $(this).html();

          if(val == "Yes") {
            val_i = 0;
          } else {
            val_i = 1;
          }

          var data = {
            approved: val_i,
            _token: '<?= csrf_token(); ?>'
          }
          var that = this;
          $.ajax({
            type: 'PUT',
            url: '/adm/product/' + id,
            data: data,
            success: function(data) {
              if(data == 1) {
                $(that).html('Yes');
              } else {
                $(that).html('No');
              }
            }
          });
        });
    });

</script>
@endsection
