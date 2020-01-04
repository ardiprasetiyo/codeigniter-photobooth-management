
<h1>Hapus Akun</h1>
<p>Apakah anda yakin akan menghapus <?= $user_data['username']; ?></p>
<button class="del-user" user-target=<?= $user_data['id'] ?>>Ya</button>
<a href="#" class="tutup-popup">Tidak</a>

    <script>
        var base_url = '<?= site_url()?>';
    </script>
    <script src="<?= base_url('plugins/js/') . 'jquery.js'?>"></script>
    <script src="<?= base_url('plugins/js/') . 'superadmin-remove-user-logic.js'?>"></script>