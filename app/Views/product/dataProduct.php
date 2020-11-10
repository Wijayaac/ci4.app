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
<script>
    $(document).ready(function() {
        $('#dataproduct').DataTable();
    })
</script>