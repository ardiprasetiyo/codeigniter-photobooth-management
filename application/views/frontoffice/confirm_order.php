<!-- CONFIRM CP -->

<div class="columns" style="margin-top: 130px;">
    <div class="column is-6 is-offset-1">
        <div class="card is-box">
            <div class="card-content">
                <div class="columns" style="padding: 20px;">
                                <div class="column is-6">
                                    <div class="columns">
                                        <div class="column is-12">
                                            <h1 class="title is-3">ORDER FOTO</h1>
                                            <h1 class="subtitle is-5" name="order-code"><?= $order_detail['order_code'] ?></h1>
                                            
                                            <div class="columns">
                                                <div class="column is-12">
                                                    <h1 class="title is-6">Order dibuat pada </h1>
                                                    <h1 class="subtitle is-6" name="order-start"><?= date('d M Y H:i:s', $order_detail['order_date']); ?></h1>
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-12">
                                                    <h1 class="title is-6">Estimasi order selesai pada</h1>
                                                    <h1 class="subtitle is-6" name="order-finish"><?= date('d M Y H:i:s', $order_detail['order_deadline']); ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <div class="columns">
                                        <div class="column is-12">
                                            <h1 class="subtitle is-6 has-text-centered" style="margin-bottom: 10px; margin-top: 10px;">Order dibuat atas nama</h1>
                                            <input type="text" placeholder="Nama anda" name="customer-name" value="<?= strtoupper($order_detail['customer_name']) ?>" class="is-box input has-text-centered" style="min-height: 40px;" disabled>

                                            <h1 class="subtitle is-6 has-text-centered" style="margin-bottom: 10px; margin-top: 10px;">Nomor telepon atau WA aktif</h1>
                                            <input type="text" name="customer-phone" placeholder="Nomor telepon atau WA aktif" value="<?= $order_detail['customer_phone'] ?>" class="is-box input has-text-centered" style="min-height: 40px;" disabled> 

                                            <h1 class="subtitle is-6 has-text-centered" style="margin-bottom: 10px; margin-top: 10px;">Alamat email aktif</h1>
                                            <input type="text" name="customer-email" placeholder="Alamat email aktif" value="<?= $order_detail['customer_email'] ?>" class="is-box input has-text-centered" style="min-height: 40px;" disabled> 

                                        </div>
                                    </div>
                                </div>
                            </div>

                <div class="columns">
                    <div class="column is-12">
                        <div class="columns">
                            <div class="column is-6"><button name="confirm-order" class="button is-box button-green input"><b>KONFIRMASI</b></button></div>
                            <div class="column is-6"><button name="back-home" class="button is-box button-blue input"><b>BATALKAN</b></button></div>
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    </div>

    <div class="column is-4">
        <div class="columns">
            <div class="column is-12">
                <div class="card is-box" style="min-height: 350px; max-height: 350px;">
                    <div class="card-content" style="padding: 30px;">

                        <div class="columns">
                            <div class="column is-12">
                                <h1 class="title is-4">DETAIL ORDER</h1>
                                <h1 class="subtitle is-5">List Order</h1>
                            </div>
                        </div>

                         <div class="columns">
                            <div class="column is-12">
                                <div class="card" style="min-height: 200px; max-height: 200px; overflow: auto; padding-top: 15px;">
                                   
                                    <?php foreach( $order_list as $order) : ?>

                                    <div class="card-content" style="padding-top: 8px; padding-bottom: 8px;">
                                        <div class="card">
                                            <div class="card-content" style="padding: 15px;">
                                                <div class="columns">
                                                    <div class="column is-2"><h1 class="subtitle is-6"><?= $order['order_cetak'] ?>x</h1></div>
                                                    <div class="column is-10"><h1 class="title is-6"><?= $order['product_name'] ?></h1></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
