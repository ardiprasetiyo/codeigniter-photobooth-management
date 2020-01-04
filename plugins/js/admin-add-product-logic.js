$(document).ready(function(){
    $('button[name=submit-add-product]').on('click', function(){
        let product_name = $('input[name=add-product-name]').val();
        let product_desc = $('textarea[name=add-product-description]').val();
        let product_cost = $('input[name=add-product-cost]').val();
        let product_basepoint = $('input[name=add-product-basepoint]').val();
        let product_duration = $('input[name=add-product-duration]').val();
        
        $.post({
            type: "POST",
            url : base_url + "/Admin_Controller/do_add_product/",
            data : {
                'add-product-name' : product_name,
                'add-product-description' : product_desc,
                'add-product-cost' : product_cost,
                'add-product-basepoint' : product_basepoint,
                'add-product-duration' : product_duration
            },
            success : function(callback){
                let result = JSON.parse(callback);
                if( result.status == 'true' ){
                    $('input[name=text]').val('');
                    $('input[name=password]').val('');
                    $('textarea').val('');
                }
            }
        })
    });
});