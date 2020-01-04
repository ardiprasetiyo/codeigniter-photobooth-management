<div class="section find-order">
	<div class="find-wrapper columns">
		<div class="column">
			<div class="card is-box">
				<div class="card-content">
					<form method="POST" action="<?= site_url() . '/Customer_Controller/find_order/' ?>">
					<h1 class="is-4 title has-text-centered">Orderku</h1>
					<h1 class="is-6 subtitle has-text-centered" style="margin-bottom: 20px;">Lihat order lebih mudah.</h1>
					<?php if( $notif ) :  ?>
					<div class="error-flash has-background-danger" style="padding: 10px; margin-bottom: 20px;">
						<h1 class="has-text-centered has-text-white subtitle is-7"><?= $notif ?></h1>
					</div>
					<?php endif; ?>
					<input type="text" name="order-code" style="padding:20px;" class="input is-box" placeholder="Ketik nomor order">
					<button name="find-order" type="submit" style="margin-top: 20px; margin-bottom: 20px; padding: 0px 20px 0px 20px;" class="button input button-blue is-box"><b>CARI ORDERKU</b></button>
					</form>
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