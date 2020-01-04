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



    <div class="content-wrap section">
        <div class="columns">
            <div class="column is-7">
                <div class="columns">
                    <div class="column is-12 is-flex is-horizontal-center">
                        <div class="title-box-rounded is-box-green">
                            <h1 class="subtitle has-text-white is-6"><b> AVAILABLE PRODUCT </b></h1>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-10 is-offset-1 card product-list-wrapper">
                        <div class="card-content">
                            <div class="columns">
                                
                                <?php if(!$product_list) : ?> 

                                <div class="column is-12" style="margin-top: 20%;">
                                    <div class="card is-box">
                                        <div class="card-content has-text-centered">
                                            <h1 class="title is-4">Belum Ada Foto</h1>
                                            <h1 class="subtitle is-6 has-text-grey" style="padding-top:10px;">Belum ada produk tersedia.</h1>
                                        </div>
                                    </div>
                                </div>

                                <?php else : ?>

                                <?php foreach( $product_list as $product ) :  ?>
                                
                                <div class="column is-6">
                                    <div class="card is-box">
                                        <div class="card-content">
                                            <h1 class="title is-4"><?= $product['product_name'] ?></h1>
                                            <h1 class="subtitle is-6 has-text-grey" style="padding-top:10px;"><span class="has-text-mygreen">IDR <b><?= $product['product_cost'] ?></b></span> /cetak</h1>
                                            <div class="desc">
                                                <p class="subtitle is-6"><?= $product['product_description'] ?></p>
                                            </div>
                                            <button name="add-to-cart" product-target="<?= $product['id_product'] ?>" class="button button-green"><b>ORDER PRODUCT</b></button>
                                        </div>
                                    </div>
                                </div>

                                <?php endforeach; ?>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="column is-4">
                <div class="card is-box calc">
                    <div class="card-content">
                        
                        <div class="columns">
                            <div class="column is-12">
                                <h1 class="title is-5 has-text-centered">TOTAL PAYMENT</h1>
                                <input type="text" name="total-payment" class="input title-box-rounded has-text-centered" style="height: 60px; border: solid 0.5px rgba(0,0,0,0.1); font-size: 25px; background-color: white;" disabled value="IDR. 0">
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-12">
                                <div class="card cart-wrapper">

                                    <!-- <div class="columns">
                                        <div class="column is-12" style="padding-bottom:0;">
                                            <div class="card-content" style="padding-bottom: 0;">
                                                <div class="columns">
                                                    <div class="column is-12 card" style="padding: 0;">
                                                        <div class="card-content">
                                                            <div class="columns">
                                                                <div class="column is-10">
                                                                    <h1 class="subtitle is-5" style="line-height: 20px;margin-bottom: 10px;">2x <b>Photo Group Express Golden Ratio (4R)</b></h1>
                                                                    <h1 class="subtitle is-7" >IDR. <b>20000</b></h1>
                                                                </div>
                                                                <div class="column is-2">
                                                                    <h1 class="subtitle is-6 has-text-centered" style="margin-top:50%;"2><a href="#">X</a></h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                </div>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-12">
                                <button name="checkout" class="button input button-blue is-box" style="font-size: 15px; height: 40px;"><b>PROCESS</b></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>


        </div>
    </div>