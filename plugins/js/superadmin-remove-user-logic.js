$(document).ready(function(){
    $('.del-user').on('click', function(){
       var user_id = $(this).attr('user-target');
       $.ajax({
           'type' : "POST",
           'url' : base_url + '/Su_Controller/do_remove_account',
           'data': {'id-account' : user_id},
           'success' : function(callback){
               console.log(callback)
           }
       });
    }); 
});