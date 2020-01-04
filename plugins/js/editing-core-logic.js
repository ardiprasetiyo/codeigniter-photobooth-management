$(document).ready(function(){
    // Get Editing List
    function get_editing_list(){
       $.post({
           'method' : 'GET',
           'url' : base_url + 'Editing_Controller/get_editing_list/',
           'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    $('.editing-list-wrapper').html('');
                    $.each(result.data, function(i, val){
                        let action;
                        if( val.order_status == 1 ){
                            val.order_status = "SELESAI";
                            action = `<div class="column is-4"><h1 class="subtitle is-7 has-text-centered"><a href="#" target-order="${val.order_code}" name="is-not-finished">BATAL</a> &nbsp&nbsp <a href="#" target-order="${val.order_code}" name="detail-order">CATATAN</a></h1></div>`;
                        } else {
                            val.order_status = "TERTUNDA";
                            action = `<div class="column is-4"><h1 class="subtitle is-7 has-text-centered"><a href="#" target-order="${val.order_code}" name="is-canceled">BATAL</a> &nbsp <a href="#" target-order="${val.order_code}" name="is-finished">SELESAI</a> &nbsp&nbsp <a href="#" target-order="${val.order_code}" name="detail-order">CATATAN</a></h1></div>`;
                        }
                        $('.editing-list-wrapper').append(`
                            <div class="column is-12" style="padding: 0px 0px 10px 0px">
                            <div class="card">
                                <div class="card-content">
                                        <div class="columns" style="padding: 0;">
                                        <div class="column is-1"><h1 class="title is-7">${i+1}</h1></div>
                                        <div class="column is-3"><h1 class="title is-7">${val.order_code}</h1></div>
                                        <div class="column is-2"><h1 class="title has-text-centered is-7">${val.order_point}</h1></div>
                                        <div class="column is-2"><h1 class="subtitle is-7 has-text-centered">${val.order_status}</h1></div>
                                        ${action}
                                    </div>
                                </div>
                            </div>
                            </div>
                    `);
                    });
                } else{
                    $('.editing-list-wrapper').html('');
                    $('.editing-list-wrapper').append(`
                            <div class="column is-12" style="padding: 0px 0px 10px 0px">
                            <div class="card">
                                <div class="card-content">
                                        <h1 class="has-text-centered">Belum ada order masuk</h1>
                                    </div>
                                </div>
                            </div>
                            </div>
                    `);
                }
           }
       });
    }

    // Get Editing Point
    function get_editing_point(){
        $.post({
            'method' : 'GET',
            'url' : base_url + 'Editing_Controller/get_editing_point',
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                $('.point-section-wrapper').html('');
                $('.point-section-wrapper').append(`
                    <div class="columns">
                        <div class="column is-12">
                            <h1 class="title is-5 has-text-centered" style="margin:0;">POIN SELESAI</h1>
                            <h1 class="title has-text-centered" style="font-size: 130px;">${result.data['collected_point']}</h1>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column is-5 is-offset-1">
                            <h1 class="title is-6 has-text-centered" style="margin:0;">POIN TERTUNDA</h1>
                            <h1 class="title has-text-centered" style="font-size: 60px; color:grey">${result.data['suspended_point']}</h1>
                        </div>

                    <div class="column is-5">
                        <h1 class="title is-6 has-text-centered" style="margin:0;">TOTAL POIN</h1>
                        <h1 class="title has-text-centered" style="font-size: 60px; color: grey">${result.data['total_point']}</h1>
                    </div>
                    </div>
                `);
            }
        });
    }


    // Do Get Editing List
    get_editing_list();

    // Do Get Editing Point
    get_editing_point();

    // Input Order
    $('body').on('click', 'button[name=submit-add-editing-list]', function(){
        let order_code = $('input[name=add-order-code]').val();
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Editing_Controller/add_editing_list/',
            'data' : {'order-code' : order_code},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    $('input[name=add-order-code]').val('');
                    get_editing_list();
                    get_editing_point();
                } else {
                     $('.popup-content').html(`
                        <div class="columns">
                            <div class="column is-12">
                                <h1 class="title is-4 has-text-centered">TERJADI KESALAHAN</h1>
                            </div>
                        </div>

                        <div class="columns>
                            <div class="column is-4 is-offset-4">
                                <div class="card is-box"> 
                                    <div class="card-content">
                                        <h1 class="subtitle has-text-centered is-6">${result.message}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="columns" style="margin-top:20px;">
                            <div class="column is-4 is-offset-4">
                                <a name="close-popup" class="is-box button button-green input" href="#"><b>TUTUP</b></a>
                            </div>
                        </div>

                     `);
                     $('.popup-wrapper').fadeIn(300);
                }
            }
        });
    });

     // Close Popup
     $('body').on('click', 'a[name=close-popup]', function(){
        $('.popup-wrapper').fadeOut(300);
    })

    // Detail Order
    $('body').on('click', 'a[name=detail-order]', function(){
        let order_code = $(this).attr('target-order');
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Editing_Controller/get_order_detail',
            'data' : {'order-code' : order_code},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    $('.popup-content').html(`
                    <div class="columns">
                        <div class="column is-12">
                            <h1 class="title is-4">DETAIL ORDER</h1>
                            <h1 class="subtitle is-5">Catatan Produksi</h1>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column is-12">
                            <div class="card" style="min-height: 200px; max-height: 200px; overflow: auto; padding-top: 15px;">
                                <div class="card-content" style="padding-top: 8px; padding-bottom: 8px;">
                                    <textarea class="input" style="width: 568px; height: 157px;" disabled>${ result.data[0]['order_description']}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="columns">
                        <div class="column is-10 is-offset-1">
                           <a href="#" name="close-popup" class="input is-box button button-green"><b>TUTUP</b></a>
                        </div>
                    </div>
                    `);
                     $('.popup-wrapper').fadeIn(300);
                }
            } 
        })
    });

    // Cancel Order
    $('body').on('click', 'a[name=is-canceled]', function(){
        let order_code = $(this).attr('target-order');
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Editing_Controller/do_cancel_editing',
            'data' : {'order-code' : order_code},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    get_editing_list();
                    get_editing_point();
                } else{
                    $('.popup-content').html(`
                    <div class="columns">
                        <div class="column is-12">
                            <h1 class="title is-4 has-text-centered">TERJADI KESALAHAN</h1>
                        </div>
                    </div>

                    <div class="columns>
                        <div class="column is-4 is-offset-4">
                            <div class="card is-box"> 
                                <div class="card-content">
                                    <h1 class="subtitle has-text-centered is-6">${result.message}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="columns" style="margin-top:20px;">
                        <div class="column is-4 is-offset-4">
                            <a name="close-popup" class="is-box button button-green input" href="#"><b>TUTUP</b></a>
                        </div>
                    </div>

                 `);
                 $('.popup-wrapper').fadeIn(300);
                }
            }
        })
    });


    // Finish Order
    $('body').on('click', 'a[name=is-finished]', function(){
        let order_code = $(this).attr('target-order');
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Editing_Controller/do_finish_editing',
            'data' : {'order-code' : order_code},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    get_editing_list();
                    get_editing_point();
                } else{
                    $('.popup-content').html(`
                    <div class="columns">
                        <div class="column is-12">
                            <h1 class="title is-4 has-text-centered">TERJADI KESALAHAN</h1>
                        </div>
                    </div>

                    <div class="columns>
                        <div class="column is-4 is-offset-4">
                            <div class="card is-box"> 
                                <div class="card-content">
                                    <h1 class="subtitle has-text-centered is-6">${result.message}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="columns" style="margin-top:20px;">
                        <div class="column is-4 is-offset-4">
                            <a name="close-popup" class="is-box button button-green input" href="#"><b>TUTUP</b></a>
                        </div>
                    </div>

                 `);
                 $('.popup-wrapper').fadeIn(300);
                }
            }
        })
    });


    // Cancel Finished Order
    $('body').on('click', 'a[name=is-not-finished]', function(){
        let order_code = $(this).attr('target-order');
        $.post({
            'method' : 'POST',
            'url' : base_url + 'Editing_Controller/do_cancel_finish_editing',
            'data' : {'order-code' : order_code},
            'success' : function(callbacks){
                let result = JSON.parse(callbacks);
                if( result.status == 'true' ){
                    get_editing_list();
                    get_editing_point();
                }else{
                    $('.popup-content').html(`
                    <div class="columns">
                        <div class="column is-12">
                            <h1 class="title is-4 has-text-centered">TERJADI KESALAHAN</h1>
                        </div>
                    </div>

                    <div class="columns>
                        <div class="column is-4 is-offset-4">
                            <div class="card is-box"> 
                                <div class="card-content">
                                    <h1 class="subtitle has-text-centered is-6">${result.message}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="columns" style="margin-top:20px;">
                        <div class="column is-4 is-offset-4">
                            <a name="close-popup" class="is-box button button-green input" href="#"><b>TUTUP</b></a>
                        </div>
                    </div>

                 `);
                 $('.popup-wrapper').fadeIn(300);
                }
            }
        })
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