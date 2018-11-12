<div class="row">
    <div class="col-md-4">
        <form action="/image/upload" method="post" enctype="multipart/form-data" id="upload_form">
            {{ csrf_field() }}
            <div id="imageHolder"><img src="/assets/images/product-placeholder.png" class="img-responsive"></div>
            <div id="upload_error"></div>

            <input id="image" type="file" name="photo" class="mb-1" />

            <input name="__submit__" type="submit" value="Upload" class="btn btn-success btn-sm" />
        </form>
    </div>
    <div class="col-md-8">
        <form action="/image/savecaption" method="post" id="caption_form">
            {{ csrf_field() }}
            <div class="form-group" style="margin-top: 10px">
                <strong>Alignment:</strong> <br />
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="alignment" id="inlineRadio1" value="left"
                        checked>
                    <label class="form-check-label" for="inlineRadio1">Left</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="alignment" id="inlineRadio2" value="right">
                    <label class="form-check-label" for="inlineRadio2">Right</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="alignment" id="inlineRadio3" value="none">
                    <label class="form-check-label" for="inlineRadio3">None</label>
                </div>
            </div>

            <div class="form-group" style="margin-top: 10px">
                <strong>Featured Image ?</strong> <br />
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="featured" id="inlineRadio4" value="1" checked>
                    <label class="form-check-label" for="inlineRadio4">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="featured" id="inlineRadio5" value="0">
                    <label class="form-check-label" for="inlineRadio5">No</label>
                </div>
            </div>

            <div class="form-group">
                <strong>Image Caption:</strong> <br />
                <input type="text" id="caption" name="caption" class="form-control" />
            </div>

            <div class="form-group" style="margin-top: 10px">
                <strong>Select Size:</strong> <br />
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="insert_size" id="ori" value="original" checked>
                    <label class="form-check-label" for="ori" data-toggle="tooltip" data-placement="top" title="Original">Original</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="insert_size" id="lg" value="thumb_1200" checked>
                    <label class="form-check-label" for="lg" data-toggle="tooltip" data-placement="top" title="1200px">Large</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="insert_size" id="md" value="thumb_800" checked>
                    <label class="form-check-label" for="md" data-toggle="tooltip" data-placement="top" title="800px">Medium</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="insert_size" id="sm" value="thumb_400">
                    <label class="form-check-label" for="sm" data-toggle="tooltip" data-placement="top" title="400px">Small</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="insert_size" id="xs" value="thumb_240" checked>
                    <label class="form-check-label" for="xs" data-toggle="tooltip" data-placement="top" title="240px">Thumbnail</label>
                </div>

            </div>
            <input type="hidden" name="pic_id" id="pic_id" value="0" />
            <input type="hidden" name="pic_name" id="pic_name" value="" />
            <input type="button" id="btnCancel" value="Cancel" data-dismiss="modal" class="btn btn-sm btn-default pull-right mt-3" />
            <input type="submit" id="btnInsert" value="Insert" class="btn btn-sm btn-primary pull-right mt-3" />

        </form>
    </div>
</div>