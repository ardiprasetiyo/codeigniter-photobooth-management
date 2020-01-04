<div class="section find-order">
	<div class="find-wrapper columns">
		<div class="column">
			<div class="card is-box">
				<div class="card-content">
					<h1 class="title is-6"><b>Unduh Foto</b></h1>
					<h1 class="subtitle is-7">Klik link dibawah untuk mengunduh foto</h1>
					<div class="columns is-multiline">

						<?php foreach( $file_name as $file ) : ?>
						<div class="column is-12" style="margin: 0px 0px 5px 0px; padding: 5px;">
							<div class="card">
								<a href="<?= site_url() ?>/customer/download/photo/<?= $file ?>" target="_blank">
								<div class="card-content" style="padding: 10px; margin: 0">
									<h1 class="subtitle is-7" style="color: blue"><?= basename($file) ?></h1>
								</div>
								</a>
							</div>
						</div>
						<?php endforeach; ?>

					</div>
					<a href="<?= site_url() ?>/customer/order_lookup" class="button button-blue input is-box" style="font-size: 12px; margin-top: 20px;"><b>KEMBALI</b></a>
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