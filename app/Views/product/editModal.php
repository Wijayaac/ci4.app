<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle-1">Make Changes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('product/update', ['class' => 'formEdit']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="idProduct" value="<?= $idProduct; ?>">
                <input type="hidden" name="nameProductOld" value="<?= $nameProduct; ?>">
                <div class="form-group row">
                    <label for="nameProduct " class="col-sm-2">Product Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="nameProduct" id="nameProduct" class="form-control" placeholder="" value="<?= $nameProduct; ?>">
                        <div class="invalid-feedback errorName">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sellerProduct " class="col-sm-2">Seller Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="sellerProduct" id="" class="form-control" placeholder="" value="<?= $sellerProduct; ?>">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary buttonUpdate">Update it</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formEdit').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.buttonUpdate').attr('disable', 'disabled');
                    $('.buttonUpdate').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                },
                complete: function() {
                    $('.buttonUpdate').removeAttr('disable');
                    $('.buttonUpdate').html('Save');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nameProduct) {
                            $('#nameProduct').addClass('is-invalid');
                            $('.errorName').html(response.error.nameProduct);
                        } else {
                            $('#nameProduct').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Horay !',
                            text: response.success
                        })
                        $('#modalEdit').modal('hide');
                        dataproduct();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        })
    });
</script>