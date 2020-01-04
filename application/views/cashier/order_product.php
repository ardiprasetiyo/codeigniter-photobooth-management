<?php $product_detail = $product_detail[0]; ?>

<div class="columns">
    <div class="column is-6">
        <div class="columns">
                <div class="column is-12">
                    <h1 class="title" style="margin-bottom: 30px;"><?= $product_detail['product_name'] ?></h1>
                    <h1 class="subtitle"><span class="has-text-mygreen">IDR <b><?= $product_detail['product_cost'] ?></b></span> /cetak</h1>
                    <div class="desc" style="min-height: 150px;max-height: 150px;overflow: auto;">
                        <h1 class="subtitle is-6"><?= $product_detail['product_description'] ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="column is-6">
            <div class="columns">
                <div class="column is-12">
                    <h1 class="subtitle is-6 has-text-centered" style="margin-top: 20px; margin-bottom: 15px;"><b>Cetak Sebanyak</b></h1>
                    <input type="number" name="set-order-cetak" class="input is-box has-text-centered" value="1" min="1" style="min-height: 50px;">
                    <button name="add-order-detail" product-target="<?= $product_detail['id_product'] ?>" class="input button button-green" style="margin-top: 20px;"><b>ORDER NOW</b></button>
                    <button class="input is-box button button-red" name="tutup-popup" style="margin-top: 20px; font-size: 15px;"><b>BATAL ORDER</b></button>
                </div>
            </div>
        </div>
    </div> 