<input type="text" name="add-product-name" placeholder="Masukan nama produk">
<textarea name="add-product-description" placeholder="Masukan deskripsi produk"></textarea>
<input type="text" name="add-product-cost" placeholder="Masukan harga produk">
<input type="number" min="1" value="2" name="add-product-basepoint" placeholder="Masukan poin produk">
<input type="number" name="add-product-duration" min="1" value="5" placeholder="Masukan durasi pengerjaan produk ( jam )">
<button name="submit-add-product">Tambahkan Produk</button>

<script>
        var base_url = '<?= site_url()?>';
</script>
<script src="<?= base_url('plugins/js/') . 'jquery.js'?>"></script>
<script src="<?= base_url('plugins/js/') . 'admin-add-product-logic.js' ?>"></script>