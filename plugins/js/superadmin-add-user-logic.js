$(document).ready(function(){
    $('.reg-submit').on('click', function(){
        $(this).attr('disabled', 'true');
        var reg_username = $('.reg-username').val();
        var reg_password = $('.reg-password').val();
        var reg_password_confirm = $('.reg-ver-password').val();
        var reg_fullname = $('.reg-fullname').val();
        var reg_email = $('.reg-email').val();
        var reg_role = $('select[name=reg-role]').val();
        $.ajax({
           type: "POST",
           url: base_url + "/Su_Controller/do_add_account/",
           data: {"reg-username" : reg_username, 
                  "reg-password" : reg_password, 
                  "reg-ver-password" : reg_password_confirm, 
                  "reg-fullname" : reg_fullname, 
                  "reg-email" : reg_email, 
                  "reg-role" : reg_role
                },
            success: function(callback){
                console.log(callback);
                result = JSON.parse(callback);
                $('.reg-submit').removeAttr('disabled');
                $('.status-message').html('<p>' +  result.message + '</p>').fadeIn(300);
                if( result.status == 'true' ){
                    $('.reg-username').val("");
                    $('.reg-password').val("");
                    $('.reg-ver-password').val("");
                    $('.reg-fullname').val("");
                    $('.reg-email').val("");
                }
            }
       });
       
    }); 
});