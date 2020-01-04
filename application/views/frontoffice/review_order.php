    <!-- MAGNIFY -->

        <div class="magnify-wrapper">
            <div class="columns" style="margin-top: 20px;">
                <div class="column is-8 is-offset-2 is-flex is-horizontal-center" style="max-height: 500px">
                    <img name="image-magnify" src="" width="100%" class="has-long-shadow">
                </div>
                <div class="column is-1" style="margin-top: 10px;">
                    <a href="#" name="close-popup" class="button button-red">X</a>
                </div> 
            </div>
            <div class="columns">
               
            </div>
            <div class="columns">
                <div class="column is-4 is-offset-4">
                    <h1 class="subtitle is-6 has-text-centered has-text-white">KODE GAMBAR</h1>
                    <h1 class="title is-4 has-text-centered has-text-white" name="image-name"></h1>
                </div>
            </div>
        </div>

    <!-- END OF MAGNIFY -->


        <!-- POPUP -->

        <div class="popup-wrapper">
            <div class="columns">
                <div class="column is-6 is-offset-3 card is-box" style="margin-top: 130px;">
                    <div class="card-content popup-content">
                        
                    </div>
                </div>
            </div>
        </div>

    <!-- END OF POPUP -->

    


<!-- REVIEW ORDER -->

<div class="columns" style="padding-left: 50px; padding-right: 20px; margin-top: 60px;">
    <div class="column is-6">
        <div class="columns">
            <div class="column is-4 is-offset-4 title-box-rounded bg-mypurple">
                <h1 class="title is-6 has-text-centered has-text-white">PREVIEW FOTO</h1>
            </div>
        </div>

        <div class="columns" style="margin-top: 20px;">
            <div class="column is-12">
                <div class="card is-box" style="min-height: 450px; max-height: 450px; overflow: auto;">
                    <div class="card-content">
                       <div class="columns is-multiline">

                       
                        <?php foreach( $list_photo as $photo_directory ) : ?>

                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-content" style="min-height: 110px; padding: 10px;">
                                    <a href="#" name="magnify-image" image-url="<?= $photo_directory ?>" image-name="<?= basename($photo_directory) ?>">
                                    <img src="<?= $photo_directory ?>" height="100%" style="background-color:red;" alt="">
                                    </a>
                                    </div>
                                    <div class="card-content" style="padding: 0px 10px 10px 10px; word-break: break-all">
                                        <h1 class="subtitle is-6 has-text-centered"><b><?= basename($photo_directory) ?></b></h1>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach;?>


                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="column is-6">
        <div class="columns">
            <div class="column is-4 is-offset-4 title-box-rounded is-box-blue">
                <h1 class="title is-6 has-text-centered has-text-white">CATATAN ORDER</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column is-10 is-offset-1">
                <div class="card is-box" style="margin-top: 25px;">
                    <div class="card-content">
                        <?php $catatan = ''; foreach( $order_details as $order ) : ?>
                            <?php $catatan .= '[' . $order['order_cetak'] . 'x ' . $order['product_name'] . '] &#13&#13&#13' ?>
                        <?php endforeach; ?>
                        <textarea name="order-description" class="input" style="padding: 20px; height: 400px;" placeholder="Masukan catatan produksi"><?= $catatan ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-10 is-offset-1">
                <button class="button button-green input" style="border-radius: 40px; height: 50px" name="approve-order"> <b>SELESAI</b> </button>
            </div>
        </div>

    </div>
    
</div>