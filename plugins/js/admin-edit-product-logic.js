$(document).ready(function(){
    $('button[name=submit-edit-product]').on('click', function(){
        let product_name = $('input[name=edit-product-name]').val();
        let product_desc = $('textarea[name=edit-product-description]').val();
        let product_cost = $('input[name=edit-product-cost]').val();
        let product_basepoint = $('input[name=edit-product-basepoint]').val();
        let product_duration = $('input[name=edit-product-duration]').val();
        let product_target = $(this).attr('product-target');
        
        $.post({
            type: "POST",
            url : base_url + "/Admin_Controller/do_edit_product/",
            data : {
                'edit-product-name' : product_name,
                'edit-product-description' : product_desc,
                'edit-product-cost' : product_cost,
                'edit-product-basepoint' : product_basepoint,
                'edit-product-duration' : product_duration,
                'product-target' : product_target
            },
            success : function(callback){
                let result = JSON.parse(callback);
            }
        })
    }); 
});