
    <h1>Add Account</h1>
    <div style="display: none" class="status-message">
    </div>
    <input type="text" name="reg-username" class="reg-username" placeholder="Masukan Username">
    <input type="password" name="reg-password" class="reg-password" placeholder="Masukan Password">
    <input type="text" name="reg-fullname" class="reg-fullname" placeholder="Masukan Nama Lengkap">
    <input type="password" name="reg-ver-password" class="reg-ver-password" placeholder="Ketik Ulang Password">
    <input type="email" name="reg-email" class="reg-email" placeholder="Masukan Email">
    <select name="reg-role" class="reg-role>">
        <?php foreach( $roles as $role ) : ?>
            <option value="<?= $role['id_role'] ?>" name="reg-role"> <?= $role['role_name'] ?> </option>
        <?php endforeach; ?>
    </select>
    <button name="submit" class="reg-submit">Submit</button>
    
    <script>
        var base_url = '<?= site_url()?>';
    </script>
    <script src="<?= base_url('plugins/js/') . 'jquery.js'?>"></script>
    <script src="<?= base_url('plugins/js/') . 'superadmin-add-user-logic.js' ?>"></script>