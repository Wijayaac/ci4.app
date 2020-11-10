<?= $this->extend('layout/main'); ?>

<?= $this->section('content') ?>
<!-- datatable css -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- datatable -->
<!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- datatable script -->
<div class="col-sm-12">
    <div class="page-title-box">
        <h4 class="page-title">Your Product</h4>
    </div>
</div>

<div class="col-md-12">
    <div class="card m-b-30">
        <h4 class="card-header mt-0">Halo Bro!</h4>
        <div class="card-body">
            <div class="card-title">
                <button type="button" class="btn btn-primary btn-sm addButton"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Product </button>
            </div>
            <p class="card-text viewdata">

            </p>
        </div>
    </div>
</div>
<div style="display: none;" class="viewModal">

</div>
<script>
    function dataproduct() {
        $.ajax({
            url: "<?= site_url('product/getdata'); ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
    $(document).ready(function() {
        dataproduct();

        $('.addButton').click(function(e) {
            //adding animation
            e.preventDefault();

            $.ajax({
                url: "<?= site_url('product/add'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewModal').html(response.data).show();

                    $('#addModal').modal('show');

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>