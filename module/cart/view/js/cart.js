function load_cart(){
    var token = localStorage.getItem('token');
    
        // console.log(token);

        ajaxPromise(friendlyURL("?module=cart&op=load_cart"), 'POST', 'JSON',  {'token' : token})
        .then(function(data) { 

            $('#cart').empty();
            
            let total_price = 0;
            for (row in data) {
                $("#cart").append(          
            '<div class="basket-product" id="'+ data[row].id_car +'">' +
                            '<div class="item-image">' +
                                '<img src="'+ data[row].img_car +'" alt="Placholder Image 2" class="product-frame" style="height: 200px">' +
                            '</div>' +
                            '<div class="item-details">' +
                                '<div class="item-name">' + data[row].cod_marca + '</div>' +
                                '<div class="item-price">€ - ' + data[row].precio + '</div>' +
                                '<div class="quantity">' +
                                    '<input id="'+ data[row].id_car +'" type="number" value="' + data[row].quanty + '" min="1" max="'+data[row].stock+'" class="quantity-field">' +
                                '</div>' +
                                '<div id="'+ data[row].id_car +'" class="subtotal">' + ((data[row].precio)*(data[row].quanty)) + '</div>' +
                                '<div class="remove">' +
                                    '<button class="button__remove" id="'+ data[row].id_car +'">Remove</button>' +
                                    '</div>' +
                                '</div>' +
                            '</div>'
                        );  
                        total_price += (data[row].precio)*(data[row].quanty);
                    }    
                    $("#subtotal-value").text(total_price);
                    $("#total-value").text(total_price);
        }).catch(function() {
            window.location.href = 'index.php?page=error503'
        });   
        
}

function remove_cart(){
    
    $(document).on('click','.button__remove',function () {
        let token = localStorage.getItem('token');
        let id_car =  this.getAttribute('id');

            ajaxPromise(friendlyURL("?module=cart&op=delete_cart"),'POST','JSON', {'id_car':id_car, 'token':token})
            .then(function(data) { 
                console.log(data);
                window.location.reload();
                $('div.basket-product#'+ id_car).empty();
                
            }).catch(function() {
                window.location.href = 'index.php?page=error503'
            });   
        
    });
}

function change_qty(){
    $(document).on('input','.quantity-field',function () {
        let id_car =  this.getAttribute('id');
        let quanty = $("#"+id_car+".quantity-field").val();
        let token = localStorage.getItem('token');
        console.log(quanty);
            ajaxPromise(friendlyURL("?module=cart&op=update_qty"),'POST', 'JSON',{'token':token,'id_car':id_car,'quanty':quanty})
            .then(function(data) { 
                console.log(data);
                location.reload();
            }).catch(function() {
                window.location.href = 'index.php?page=error503'
            });   
        
    });
}

function checkout(){
    $(document).on('click','.checkout-cta',function () {
        var token =  localStorage.getItem('token');
            ajaxPromise(friendlyURL("?module=cart&op=checkout"),'POST', 'JSON',{'token':token})
            .then(function(data) { 
                console.log(data);
                toastr.success("Compra realizada");

                setTimeout(window.location.href = "?module=home",1000);
            }).catch(function() {
                window.location.href = 'index.php?page=error503'
            });   
            
    });
}

$(function(){
    load_cart();
    remove_cart();
    change_qty();
    checkout();
});