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
            <p class="card-text">
                <table class="table table-sm table-striped" id="dataproduct">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Seller Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($showdata as $list) : $i++ ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $list['nameProduct']; ?></td>
                                <td><?= $list['sellerProduct']; ?></td>
                                <td>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#dataproduct').DataTable();
    });
</script>
<?= $this->endSection() ?>