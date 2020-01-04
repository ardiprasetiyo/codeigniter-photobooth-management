$(document).ready(function(){

    $('button[name=submit]').on('click', function(){
        let user_id = $(this).attr('user-target');
        let full_name = $('input[name=new-fullname]').val();
        let email = $('input[name=new-email').val();
        let role = $('select[name=role]').val();
        let is_active = $('select[name=is_active]').val();
        let password = $('input[name=new-password]').val();
        let ver_password = $('input[name=new-ver-password]').val();
        $.post({
            type : "POST",
            url : base_url + "/Su_Controller/do_edit_account/",
            data : {'user-id' : user_id,
                    'new-fullname' : full_name,
                    'new-email' : email,
                    'new-role' : role,
                    'is-active' : is_active,
                    'new-password' : password,
                    'new-ver-password' : ver_password
                    },
            success : function(callback){
                console.log(callback);
            }
        });
    });

   $('button[name=reset-password]').on('click', function(){
        $(this).fadeOut(300);
        $('input[name=new-password]').fadeIn(300);
        $('input[name=new-ver-password]').fadeIn(300);
   });
});