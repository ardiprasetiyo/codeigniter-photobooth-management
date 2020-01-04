<div>
    <?php foreach( $logs as $log ) : ?>
        <h1><?= $log['log_activity']?></h1>
        <p>Pada <?php echo date('d M Y H:i:s', $log['log_date']); ?></p>
        <span> Oleh <b><?= $log['username'] ?></b> <span> Dari Divisi <i><?= $log['role_name'] ?></i></span></span>
        <br>
        <p><?= $log['log_description'] ?></p>
    <?php endforeach; ?>
</div>