<input type="text" name="edit-product-name" placeholder="Ubah nama produk" value="<?= $product_data['product_name'] ?>">
<textarea name="edit-product-description" placeholder="Ubah deskripsi produk"><?= $product_data['product_description'] ?></textarea>
<input type="text" name="edit-product-cost" placeholder="Ubah harga produk" value="<?= $product_data['product_cost'] ?>">
<input type="number" min="1" value="<?= $product_data['product_basepoint'] ?>" name="edit-product-basepoint" placeholder="Ubah poin produk">
<input type="number" name="edit-product-duration" min="1" value="<?= $product_data['product_deadline'] ?>" placeholder="Masukan durasi pengerjaan produk ( jam )">
<button name="submit-edit-product" product-target="<?= $product_data['id_product'] ?>">Edit Produk</button>

<script>
        var base_url = '<?= site_url()?>';
</script>
<script src="<?= base_url('plugins/js/') . 'jquery.js'?>"></script>
<script src="<?= base_url('plugins/js/') . 'admin-edit-product-logic.js' ?>"></script>