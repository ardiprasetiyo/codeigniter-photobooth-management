$(document).ready(function(){

    // Update Cart Content

    function cart_list(){
        $.post({
            'method' : 'GET',
            'url' : base_url + 'Cashier_Controller/show_cart/',
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    let total_payment = 0;
                    $('.cart-wrapper').html('');
                    $.each(result.data, function(i, val){
                        $('.cart-wrapper').append(
                            `<div class="columns">
                            <div class="column is-12" style="padding-bottom:0;">
                                <div class="card-content" style="padding-bottom: 0;">
                                    <div class="columns">
                                        <div class="column is-12 card" style="padding: 0;">
                                            <div class="card-content">
                                                <div class="columns">
                                                    <div class="column is-10">
                                                        <h1 class="subtitle is-5" style="line-height: 20px;margin-bottom: 10px;">` + val.order_cetak + `x <b>` + val.product_name + `</b></h1>
                                                        <h1 class="subtitle is-7" >IDR. <b>` + (val.order_cetak * val.product_cost)  + `</b></h1>
                                                    </div>
                                                    <div class="column is-2">
                                                        <h1 class="subtitle is-6 has-text-centered" style="margin-top:50%;"2><a href="#" name="batal-order-produk" target-product="` + val.id_product + `">X</a></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                        )
                        total_payment += (val.order_cetak * val.product_cost);
                    });
                    
                    // Set Total Payment
                    $('input[name=total-payment]').val(total_payment);
                } else {
                    $('input[name=total-payment]').val("IDR. 0");
                    $('.cart-wrapper').html(
                        `<div class="columns">
                            <div class="column is-12">
                                <div class="card" style="margin: 120px 10px 10px 10px; padding: 20px;">
                                    <h1 class="has-text-centered">Silahkan pilih produk</h1>
                                </div>
                            </div>
                         </div>`
                    )
                }   
            }
        });
    }




    // Update Cart List
    cart_list();


    // Checkout

    $('body').on('click', 'button[name=checkout]', function(){
        $('.popup-content').html('');
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Cashier_Controller/order_checkout',
            'success' : function(callback){
                $('.popup-content').html(callback);
            }
        });
        $('.popup-wrapper').fadeIn(300);

    });

    // Do Order Checkout

    $('body').on('click', 'button[name=do-order-checkout]', function(){
       let customer_name = $('input[name=customer-name]').val();
       let customer_phone = $('input[name=customer-phone]').val();
       let customer_email = $('input[name=customer-email]').val();
       let order_start = $('h1[name=order-start]').attr('value');
       let order_code = $('h1[name=order-code]').attr('value');
       let estimate_finish = $('h1[name=order-finish]').attr('value');

       $.post({
           'method' : 'POST',
           'url' : base_url + 'Cashier_Controller/do_order_checkout',
           'data' : {'customer-name' : customer_name,
                     'customer-phone' : customer_phone,
                     'customer-email' : customer_email,
                     'order-date' : order_start,
                     'order-deadline' : estimate_finish,
                     'order-code' : order_code},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    $('.popup-wrapper').fadeOut(300);
                    setInterval(function(){

                        $('.popup-content').html(`
                        <div class="columns">
                            <div class="column is-12 has-text-centered">
                                <h1 class="subtitle is-4">Terimakasih.</h1>
                                <div class="columns">
                                    <div class="column is-6 is-offset-3">
                                        <h1 class="subtitle is-6">Softfile akan dikirim secara otomatis melalui email. Segera unduh foto karena foto akan segera dihapus setelah stand tutup.</h1>
                                        <button name="refresh-page" class="button is-box button-green"><b>SELESAI</b></button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    `);
                    }, 400);
                    $('.popup-wrapper').fadeIn(300);
                }
            }
       });
       
    });

    // Order Product

    $('body').on('click', 'button[name=add-to-cart]', function(){
        $('.product-content').html('');
        let product_target = $(this).attr('product-target');
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Cashier_Controller/order_product/',
            'data' : {'id-product' : product_target},
            'success' : function(callback){
                $('.popup-content').html(callback);
            }
        });
        $('.popup-wrapper').fadeIn(300);
    });

    // Cancel Popup

    $('body').on('click','button[name=tutup-popup]', function(){
        $('.popup-wrapper').fadeOut(300);
    });

    $('body').on('click','a[name=tutup-popup]', function(){
        $('.popup-wrapper').fadeOut(300);
    });


    // Add Product To Order List
    $('body').on('click', 'button[name=add-order-detail]', function(){
        let product_id = $(this).attr('product-target');
        let order_cetak = $('input[name=set-order-cetak]').val();
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Cashier_Controller/do_order_product/',
            'data' : {'id-product' : product_id,
                      'order-cetak' : order_cetak},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    cart_list();
                    $('.popup-wrapper').fadeOut(300);
                }
            }
        });
    });


    // Remove Product From Order List
    $('body').on('click', 'a[name=batal-order-produk]', function(){
        let product_id = $(this).attr('target-product');
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Cashier_Controller/remove_order_details',
            'data' : {'id-product' : product_id},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    cart_list();
                }
            }
        });
    });

    // Button Refresh Page
    $('body').on('click', 'button[name=refresh-page]', function(){
        document.location.href=base_url + '/cashier';
    });

    // Profile Button
    $('body').on('click', 'a[name=profile-button]', function(){
        $('.popup-content').html(`
            <div class="columns">
                <div class="column is-12">
                    <h1 class="title is-4 has-text-centered">Account Setting</h1>
                    <h1 class="subtitle is-6 has-text-centered">Pengaturan akun</h1>
                    <div class="columns">
                        <div class="column is-10 is-offset-1 card" style="margin-top: 10px; margin-bottom: 10px; padding: 20px;">
                        <a href=" ` + base_url + '/logout/' + `" name="logout">
                            <h1 class="title is-6">LOGOUT</h1>
                            <h1 class="subtitle is-6">Keluar dari akun</h1>
                        </a>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column is-10 is-offset-1 card" style="margin-top: 10px; margin-bottom: 10px; padding: 20px;">
                        <a href="#" name="tutup-popup">
                            <h1 class="title is-6">KEMBALI</h1>
                            <h1 class="subtitle is-6">Kembali ke order kasir</h1>
                        </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        `);
        $('.popup-wrapper').fadeIn(300)
    });

});