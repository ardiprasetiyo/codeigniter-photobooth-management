$(document).ready(function(){
    $('button[name=del-product]').on('click', function(){
        $id_product = $(this).attr('product-target');
        console.log($id_product);
        $.post({
            'type' : 'POST',
            'url' : base_url + 'Admin_Controller/do_remove_product/',
            'data' : {'id-product' : $id_product},
            'success' : function(callback){
                $result = JSON.parse(callback);
                console.log($result);
            }
        });
    });
});