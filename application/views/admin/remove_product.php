<h1>Hapus Produk</h1>
<p>Apakah anda yakin akan menghapus produk <?= $product_data['product_name']; ?></p>
<button name="del-product" product-target=<?= $product_data['id_product'] ?>>Ya</button>
<a href="#" class="tutup-popup">Tidak</a>

    <script>
        var base_url = '<?= site_url()?>';
    </script>
    <script src="<?= base_url('plugins/js/') . 'jquery.js'?>"></script>
    <script src="<?= base_url('plugins/js/') . 'admin-remove-product-logic.js'?>"></script>