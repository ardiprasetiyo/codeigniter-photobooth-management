<div class="section find-order">
	<div class="find-wrapper columns">
		<div class="column">
			<div class="card is-box">
				<div class="card-content">
					<?php //var_dump($order_data); ?>
					<h1 class="title is-6" style="margin-bottom: 30px;">Data Customer</h1>
					<h1 class="subtitle is-7">Nama Customer : <br> <b><?= $order_data['customer_name'] ?></b></h1>
					<h1 class="subtitle is-7">Nomor Telepon Customer : <br> <b><?= $order_data['customer_phone'] ?></b></h1>
					<h1 class="subtitle is-7">Email Customer : <br> <b><?= $order_data['customer_email'] ?></b></h1>

					<h1 class="title is-6" style="margin-top: 30px; margin-bottom: 30px;">Data Order</h1>
					<h1 class="subtitle is-7">Kode Order : <br> <b><?= $order_data['order_code'] ?></b></h1>
					<h1 class="subtitle is-7">Tanggal Order : <br> <b><?= date("d/m/Y H:i:s", $order_data['order_date']) ?></b></h1>
					<a href="<?= site_url() ?>/customer/photo_download/" class="button button-purple input is-box" style="font-size: 12px;"><b>UNDUH FOTO</b></a>
					<a href="<?= site_url() ?>/customer" class="button button-blue input is-box" style="font-size: 12px; margin-top: 20px;"><b>KEMBALI KE AWAL</b></a>
				</div>
			</div>
		</div>
	</div>

	<div class="columns">
		<div class="column">
			<h1 class="subtitle is-7 has-text-centered"><b>&copy TeFa Multimedia</b> SMKN 3 Bandung</h1>
		</div>
	</div>
</div>