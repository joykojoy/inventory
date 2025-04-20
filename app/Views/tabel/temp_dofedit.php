<table class="table table-light table-striped">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
            <td class="text-end">Quantity</td>
            <td class="text-end">Harga</td>
            <td class="text-end">Subtotal</td>
            <td class="text-end">Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        $total = 0;
        foreach ($data as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->nama_brg ?></td>
                <td class="text-end"><?= $d->qtt ?></td>
                <td class="text-end"><?= number_format($d->hrg, 0, ',', '.') ?></td>
                <td class="text-end"><?= number_format($d->subtotal, 0, ',', '.') ?></td>
                <td class="text-end">
                    <button type="button" class="btn btn-outline-danger btn-delete-brgtemp-keluar" title="Hapus" data-id="<?= $d->id ?>">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
            <?php $total += $d->subtotal ?>
        <?php endforeach ?>
        <tr class="fw-bold">
            <td class="text-center" colspan="4">Total</td>
            <td class="text-end"><?= number_format($total, 0, ',', '.') ?></td>
        </tr>
    </tbody>
</table>
<script>
    $(".btn-delete-brgtemp-keluar").click(function() {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/barangkeluar/delete_detilbarang",
            data: {
                id: id
            },
            method: "post",
            dataType: "json",
            success: function(responds) {
                if (responds.status) {
                    dtemp_dofedit()
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: responds.psn,
                    })
                }
            }
        });
    })
</script>