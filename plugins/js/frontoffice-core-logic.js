$(document).ready(function(){

    // Searchhing Order ( Return TRUE and REDIRECT ) 
    $('body').on('click', 'button[name=do-search-order]', function(){
        let kode_order = $('input[name=kode-order]').val();
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Front_Office_Controller/do_search_order/',
            'data' : {'order-code' : kode_order},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'false' ){
                    $('.error-content').html(result.message);
                    $('.error-section').fadeIn(300);
                    return 0;
                }
                document.location.href= base_url + "/frontoffice/confirm_order";
            }
        });
    });

    // Back To First Step Button
    $('body').on('click', 'button[name=back-home]', function(){
        document.location.href= base_url + "/frontoffice/";
    });

    // Confirm Order
    $('body').on('click', 'button[name=confirm-order]', function(){
        document.location.href= base_url + "/frontoffice/review_order";
    });

    // Magnifying Image
    $('body').on('click', 'a[name=magnify-image]', function(){
        let imageURL = $(this).attr('image-url');
        let imageName = $(this).attr('image-name');
        $('h1[name=image-name]').html(imageName);
        $('img[name=image-magnify]').attr('src', imageURL);
        $('.magnify-wrapper').fadeIn(300);
    })
    
    // Close Magnify
    $('body').on('click', 'a[name=close-popup]', function(){
        $('.magnify-wrapper').fadeOut(300);
    })

    // Close Popup
    $('body').on('click', 'a[name=close-popup]', function(){
        $('.popup-wrapper').fadeOut(300);
    })


    // Approve Order
    $('body').on('click', 'button[name=approve-order]', function(){
        let order_description = $('textarea[name=order-description]').val();
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Front_Office_Controller/approve_order',
            'data' : {'order-description' : order_description},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    $('.popup-content').html(`
                        <div class="columns">
                            <div class="column is-12">
                                <h1 class="title is-4 has-text-centered" style="padding-bottom: 20px;">TERIMAKASIH</h1>
                                <h1 class="subtitle is-6 has-text-centered" style="padding-bottom: 20px;">Foto sedang diproses. <b>Softfile</b> dapat di unduh melalui link yang sudah terkirim di Email anda.</h1>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-4 is-offset-4 is-horizontal-center">
                                <a href="` + base_url + `frontoffice/home/" class="input button is-box button-green"><b>SELESAI</b></a>
                            </div>
                        </div>`);
                    $('.popup-wrapper').fadeIn(300);
                }
            }
        });
    })

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
                            <a href="#" name="close-popup">
                                <h1 class="title is-6">KEMBALI</h1>
                                <h1 class="subtitle is-6">Kembali ke halaman front office</h1>
                            </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            `);
            $('.popup-wrapper').fadeIn(300)
        });

        
});