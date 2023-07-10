//wishlist
$(document).ready(function() {
    $(".likes").click(function() {
        $(this).toggleClass("heart");
    });

    $('.decrement-btn').click(function() {
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.increment-btn').click(function() {
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.addtocart').click(function(e) {
        e.preventDefault();
        var qty =  $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.addtocart').val();
        $.ajax({
            method:"POST",
            url:"handlecart.php",
            data:{
                "p_qty":qty,
                "p_id":prod_id,   
                 "scope":"add",
            },
           success:function(response){
               if(response == 401)
              {
                $("#login-modal").modal('show');
              }else if(response == 500)
              {
                alert("try again");
              }
           }
        });
    });

    $(document).on('click', '.updateQty', function() {
        var qty =  $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

       $.ajax({
          method:"POST",
          url:"handlecart.php",
            data:{
                "p_qty":qty,
                "p_id":prod_id,  
                "scope":"update",
            },
            success:function(response){
                setInterval(function(){
                 location.reload();
                },500);
            }
       });
    });
    $(document).on('click', '.optionvalue', function() {
        var prod_id = $(this).closest('.product_data').find('.prodId').val();
        // var p_type = $(this).closest('.product_data').find('.optionvalue').val();
        var p_type = $(this).serialize();

       $.ajax({
          method:"POST",
          url:"handlecart.php",
            data:{
                "p_id":prod_id,
                "p_type":p_type,  
                "scope":"addradio",
            },
            success:function(response){
            }
       });
    });

    $(document).on('click', '.deleteiteam', function() {
        var cart_id =  $(this).closest('.product_data').find('.deleteiteam').val();
        $.ajax({
            method:"POST",
            url:"handlecart.php",
              data:{
                  "cart_id":cart_id,   
                  "scope":"delete",
              },
              success:function(response){
                if(response == 200)
                {
                   $('#mycart').load(location.href+ " #mycart");
                }else if(response == 401)
                {
                    $("#login-modal").modal('show');
                }else if(response == 500)
                {
                  alert("try again");
                }
              }
         });
    });
});






