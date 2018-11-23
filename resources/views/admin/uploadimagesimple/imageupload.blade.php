<div class="row">
    <div class="col-md-4">
        <form action="/image/upload" method="post" enctype="multipart/form-data" id="upload_form" class="pt-3">
            {{ csrf_field() }}
            <div id="imageHolder"><img src="/assets/images/product-placeholder.png" class="img-responsive"></div>
            <div id="upload_error"></div>
            <input id="image" type="file" name="photo" class="mb-1" />
            <input type="hidden" name="product_id" value="{{$product->id}}" />
            <input name="__submit__" type="submit" value="Upload" class="btn btn-success btn-sm" />
        </form>
    </div>
    <div class="col-md-8">
        <form action="/image/savecaption" method="post" id="caption_form" class="pt-3">
            {{ csrf_field() }}

            <div class="form-group">
                <strong>Image Caption:</strong> <br />
                <input type="text" id="caption" name="caption" class="form-control" />
            </div>

            <input type="hidden" name="pic_id" id="pic_id" value="0" />
            <input type="hidden" name="pic_name" id="pic_name" value="" />
            <input type="hidden" name="product_id" value="{{$product->id}}" />
            <input type="button" id="btnCancel" value="Cancel" data-dismiss="modal" class="btn btn-sm btn-default pull-right mt-3" />
            <input type="submit" id="btnInsert" value="Add" class="btn btn-sm btn-primary pull-right mt-3" />

        </form>
    </div>
</div>
