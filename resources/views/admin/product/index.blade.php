@extends('layouts.admin')

@section('pagetitle')
Add New Promo - admin
@endsection
@section('extracss')
<style>
  .layer {
    width: 350px;
    min-height: 250px;
    background-color: #efefef;
    float: left;
    margin-right: 15px;
  }
  .tile__list img {
    float: left;
    margin-right: 10px;
    margin-bottom: 5px;
    border-radius: 100%
  }
</style>
@endsection

@section('content')
<div id="multi" style="margin-left: 30px">


  <div class="layer tile">
    <div class="tile__name">Group A</div>
    <div class="tile__list">
      <img src="https://via.placeholder.com/150"/>
      <img src="https://via.placeholder.com/151"/>
      <img src="https://via.placeholder.com/152"/>
      <img src="https://via.placeholder.com/153"/>
    </div>
  </div>

  <div class="layer tile" >
    <div class="tile__name">Group B</div>
    <div class="tile__list">
      <img src="https://via.placeholder.com/151"/>
      <img src="https://via.placeholder.com/152"/>
      <img src="https://via.placeholder.com/153"/>
    </div>
  </div>

  <div class="layer tile" data-force="20">
    <div class="tile__name">Group C</div>
    <div class="tile__list">
      <img src="https://via.placeholder.com/151"/>
      <img src="https://via.placeholder.com/152"/>
    </div>
  </div>

</div>
<div style="clear: both"></div>
@endsection

@section('extrajs')
<script src="{{ asset('assets/js/sortable.min.js') }}"></script>
<script>
  $(document).ready(function(){
    // Multi groups
    Sortable.create(document.getElementById('multi'), {
      animation: 150,
      draggable: '.tile',
      handle: '.tile__name'
    });

    [].forEach.call(document.getElementById('multi').getElementsByClassName('tile__list'), function (el){
      Sortable.create(el, {
        group: 'photo',
        animation: 150
      });
    });

  })
</script>
@endsection