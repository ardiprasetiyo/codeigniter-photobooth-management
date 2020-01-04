<div>
    <input type="text" name="new-username" value="<?= $userdata['username'] ?>" disabled>
    <input type="text" name="new-fullname" placeholder="Masukan nama baru" value="<?= $userdata['full_name'] ?>">
    <input type="text" name="new-email" placeholder="Masukan email baru" value="<?= $userdata['email'] ?>">
    <input type="password" name='new-password' placeholder="Masukan password baru" style="display: none">
    <input type="password" name='new-ver-password' placeholder="Ketik ulang password" style="display: none">
    <select name="role">
        <?php foreach($roles as $role) :  ?>
            <option value="<?= $role['id_role'] ?>"><?= $role['role_name'] ?></option>
        <?php endforeach;?>
    </select>
    <select name="is_active">
        <option value="1">Aktif</option>
        <?php if( $userdata['is_active'] == 0 ) : ?>
            <option value="0" selected>Non Aktif</option>
        <?php else :  ?>
            <option value="0">Non Aktif</option>
        <?php endif;?>
    </select>
    <button name="reset-password">Reset Password</button>
    <button name="submit" user-target=<?= $userdata['id'] ?>>Submit</button>
</div>

<script>
        var base_url = '<?= site_url()?>';
</script>
<script src="<?= base_url('plugins/js/') . 'jquery.js'?>"></script>
<script src="<?= base_url('plugins/js/') . 'superadmin-edit-user-logic.js' ?>"></script>