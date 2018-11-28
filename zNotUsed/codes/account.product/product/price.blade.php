<div class="modal fade" id="priceModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Price</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/account/product/price" method="POST" id="form-add-price">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pricename">Price Name (50 Chars Max)</label>
                            <input id="pricename" type="text" name="name" required class="form-control" maxlength="50">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fromqty">From (Qty)</label>
                                    <input type="number" name="fromqty" id="fromqty" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="toqty">To (Qty)</label>
                                    <input type="number" name="toqty" id="toqty" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="regular">Regular Price</label>
                            <input id="regular" type="number" name="regular" required class="form-control">

                        </div>
                        <div class="col-md-4">
                            <label for="discounted">Discount Price</label>
                            <input id="discounted" type="number" name="discounted" class="form-control">

                        </div>
                        <div class="col-md-4">
                            <label for="discount_valid_until">Valid Until</label>
                            <input id="discount_valid_until" type="text" name="discount_valid_until" data-toggle="datepicker" class="form-control">

                        </div>
                    </div>
                    <div>
                        <input type="text" name="product_id" value={{$product->id}} />
                        <button type="submit" class="btn btn-primary btn-sm float-right">Save Price</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
