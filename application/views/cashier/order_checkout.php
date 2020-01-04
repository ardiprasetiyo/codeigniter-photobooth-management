<div class="columns">
                                <div class="column is-6">
                                    <div class="columns">
                                        <div class="column is-12">
                                            <h1 class="title is-3">ORDER FOTO</h1>
                                            <h1 class="subtitle is-5" name="order-code" value="<?= $order_detail['order_code'] ?>"><?= $order_detail['order_code']?></h1>
                                            
                                            <div class="columns">
                                                <div class="column is-12">
                                                    <h1 class="title is-6">Order dibuat pada </h1>
                                                    <h1 class="subtitle is-6" name="order-start" value="<?= time(); ?>"><?= date('d M Y H:i:s') ?></h1>
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-12">
                                                    <h1 class="title is-6">Estimasi order selesai pada</h1>
                                                    <h1 class="subtitle is-6" name="order-finish" value="<?= time() + 3600; ?>"><?= date('d M Y H:i:s', time() + 3600 * 4) ?></h1>
                                                </div>
                                            </div>

                                            <div class="columns">
                                                <div class="column is-12">
                                                    <button name="do-order-checkout" class="button is-box button-green input"><b>SELESAI</b></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="column is-6">
                                    <div class="columns">
                                        <div class="column is-12">
                                            <h1 class="subtitle is-6 has-text-centered" style="margin-bottom: 10px; margin-top: 10px;">Order dibuat atas nama</h1>
                                            <input type="text" placeholder="Nama anda" name="customer-name" class="is-box input has-text-centered" style="min-height: 40px;">

                                            <h1 class="subtitle is-6 has-text-centered" style="margin-bottom: 10px; margin-top: 10px;">Nomor telepon atau WA aktif</h1>
                                            <input type="text" name="customer-phone" placeholder="Nomor telepon atau WA aktif"class="is-box input has-text-centered" style="min-height: 40px;"> 

                                            <h1 class="subtitle is-6 has-text-centered" style="margin-bottom: 10px; margin-top: 10px;">Alamat email aktif</h1>
                                            <input type="text" name="customer-email" placeholder="Alamat email aktif"class="is-box input has-text-centered" style="min-height: 40px;"> 

                                        </div>
                                    </div>
                                </div>

                            </div>