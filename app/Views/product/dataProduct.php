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
                    <button id="buttonEdit" class="btn btn-info mx-2" type="button" onclick="edit('<?= $list['idProduct']; ?>')"><i class="fa fa-magic"></i></button>
                    <button id="buttonDelete" class="btn btn-danger mx-2" type="button" onclick="remove('<?= $list['idProduct']; ?>')"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataproduct').DataTable();
    });

    function edit(idProduct) {
        $.ajax({
            type: "post",
            url: "<?= site_url('product/edit'); ?>",
            data: {
                idProduct: idProduct
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewModal').html(response.success).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    };

    function remove(idProduct) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Confirm for deleting this product ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'I"m not sure',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('product/remove'); ?>",
                    data: {
                        idProduct: idProduct
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your product has been deleted.',
                                'success'
                            );
                            dataproduct();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });

            }
        });
    };
</script>