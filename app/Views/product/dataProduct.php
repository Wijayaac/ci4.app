<?= form_open('product/multipleDelete', ['class' => 'multipleDelete']); ?>

<button type="submit" class="btn btn-danger my-2"> <i class="fa fa-trash" aria-hidden="true"></i> Bulk Delete</button>



<table class="table table-sm table-striped" id="dataproduct">
    <thead>
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
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
                <td><input type="checkbox" name="idProduct[]" class="checkThis" value="<?= $list['idProduct']; ?>"></td>
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
<?= form_close(); ?>
<script>
    $(document).ready(function() {
        $('#dataproduct').DataTable();

        $('#checkAll').click(function(e) {

            if ($(this).is(':checked')) {
                $('.checkThis').prop('checked', true);
            } else {
                $('.checkThis').prop('checked', false);
            }
        });

        $('.multipleDelete').submit(function(e) {
            e.preventDefault();

            let totalData = $('.checkThis:checked');

            if (totalData.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning',
                    text: 'Please check the product you want to delete !',
                });
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `Confirm for deleting ${totalData.length} product ?`,
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
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
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
            }
        });
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
                                response.success,
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