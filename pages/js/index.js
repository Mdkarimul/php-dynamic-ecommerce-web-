
function add_to_cart(){
    $(document).ready(function(){
        $(".cart-btn").each(function(){
            $(this).click(function(){
               var product_id =  $(this).attr("product_id");
               var all_cookie = document.cookie.split(";");
             var temp_cookie = [];
               var i;
               for(i=0;i<all_cookie.length;i++)
               {
                   var cookie = all_cookie[i].split("=");
                   if(cookie[0].trim() !="authentication")
                   {
                       //window.location = "signin.php";
                       temp_cookie[i] = cookie[0].trim();
                   }
                   else
                   {
                       temp_cookie = "matched";
                   }
               }
    
               if(temp_cookie =="matched")
               {
                   var product_id = $(this).attr("product_id");
                   var product_title = $(this).attr("product_title");
                   var product_price = $(this).attr("product_price");
                   var product_brand = $(this).attr("product_brand");
                   var product_pic = $(this).attr("product_pic");
    
                  $.ajax({
                      type  :"POST",
                      url  :"http://localhost/ecommerce/pages/php/cart.php",
                      data : {
                          product_id : product_id,
                          product_title : product_title,
                          product_price : product_price,
                          product_brand : product_brand,
                          product_pic : product_pic
                      },
                      success : function(response){
                      //alert(response);
                      if(response.trim() =="success")
                      {
                     if($(".cart-notification").prop("nodeName") != undefined)
                     {
                      var number =    $(".cart-notification span").html().trim();
                      number++;
                      $(".cart-notification span").html(number);
                     }
                     else
                     {
                         var div = document.createElement("DIV");
                         div.style.color="white";
                         div.style.backgroundColor="red";
                         div.style.width="25px";
                         div.style.height="25px";
                         div.style.borderRadius = "50%";
                         div.style.position = "absolute";
                         div.style.fontWeight = "bold";
                         div.style.zIndex = "1000";
                         div.className = "cart-notification";
                         var span = document.createElement("SPAN");
                        span.innerHTML = 1;
                        $(div).append(span);
                        $(".cart-link").append(div);
                                 }
                    
                      }
                      else
                      {
                          alert(response);
                      }
                      }
                  });
    
               }
               else
               {
                   window.location = "signin.php";
               }
            });
        });
    });
}

add_to_cart();



//remove item from cart
$(document).ready(function(){
    $(".delete-cart-btn").each(function(){
        $(this).click(function(){
            var btn = this;
            var id = $(this).attr("product_id");
            $.ajax({
                type : "POST",
                url : "../php/remove_cart.php",
                data : {
                    id : id
                },
                success  :function(response){
                alert(response);

                if(response.trim() =="success")
                {
                btn.parentElement.parentElement.parentElement.remove(); 
                }
                else
                {
                    alert(response);
                }
                }
            });
        });
    });
});



//buy now here
function buy_now(){
$(document).ready(function(){
    $(".buy-cart-btn").each(function(){
        $(this).click(function(){
            var p_id = $(this).attr("product_id");
            alert(p_id);
            window.location="http://localhost/ecommerce/pages/php/buy_products.php?id="+p_id;
        });
    });
});}


//purchase btn 
$(document).ready(function(){
    $(".purchase-btn").click(function(){
       var pay_mode = $("input[name='pay-mode']:checked").val();
       alert(pay_mode);
       if(pay_mode)
       {
           $id = $(this).attr("product_id");
           $title = $(this).attr("product_title");
           $brand = $(this).attr("product_brand");
           $price = $(this).attr("product_price");
            $quantity = $(".quantity").val();
       if(pay_mode =="online")
       {
        window.location ="../../pay/pay.php?id="+$id+"&brand="+$brand+"&title="+$title+"&price="+$price+"&quantity="+$quantity;
       }
       else
       {
        window.location ="../../pay/purchase_entry.php?id="+$id+"&brand="+$brand+"&title="+$title+"&price="+$price+"&quantity="+$quantity+"&pay_mode=cod";
       }
       }
       else
       {
           alert("Please choose a payment mode !");
       }
    });
});



//check pin code 

$(document).ready(function(){
    $(".pincode-api-btn").click(function(){
        
        var pincode = Number($(".pincode-field").val());
        $.ajax({
            type : "POST",
            url : "../php/check_pincode.php",
            data : {
                pin : pincode
            },
            success: function(response){
               
           $(".pincode-message").html(response);
           setTimeout(function(){
               $(".pincode-message").html("");
           },4000);
            }
        });
    });
});



//stocks control

$(document).ready(function(){
    $(".quantity").on("input",function(){
        var stocks = $(".stock_number").html();
        if($(this).val()>stocks)
        {
            alert("negative stocks");
            $(this).val('1');
        }
    });
});


//image preview 

$(document).ready(function(){
    $(".thumb-pic").each(function(){
        $(this).click(function(){
            var src = $(this).attr("src");
            $(".preview").attr("src",src);
        });
    });
});



//filter products

$(document).ready(function(){
    $(".filter-btn").each(function(){
        $(this).click(function(){
            $(".filter-btn").each(function(){
                $(this).removeClass("btn-primary px-2 rounded-sm w-100");
            });
            $(this).addClass("btn-primary px-2 rounded-sm");
            $()
            var brands = $(this).attr("brand-name");
            var cat_name = $(this).attr("cat-name");
          
            $.ajax({
                type : "POST",
                url : "../php/filter_product.php",
                data : {
                    cat_name : cat_name,
                    brand_name : brands
                },
                beforeSend : function(){
                  $(".product-result").html("Loading...")
                },
                success : function(response){
                    $(".product-result").html("")
                var all_data =  JSON.parse(response.trim());
                var i;
                if(all_data.length ==0)
                {
                    $(".product-result").html("<h2><i class='fa fa-shopping-cart'></i>  Empty stocks</h2>");
                }
                else
                {
                    for(i=0;i<all_data.length;i++)
                    {
                     var div = document.createElement("DIV");
                     div.className= "text-center border shadow-sm p-2 mb-4  ml-3";
                     var img = document.createElement("IMG");
                     img.src="../../"+all_data[i].thumb;
                     img.width = "250";
                     img.height = "316";

                       //brand name
                       var brand_span = document.createElement("SPAN");
                       brand_span.className = "text-uppercase font-weight-bold";
                       brand_span.innerHTML = "<br>"+all_data[i].brands+"<br>";

                      //title
                       var title_span = document.createElement("SPAN");
                       title_span.className = "text-uppercase";
                       title_span.innerHTML = all_data[i].title+"<br>";

                       //price
                       var price_span = document.createElement("SPAN");
                       price_span.className = "text-uppercase font-weight-bold";
                       price_span.innerHTML = "<i class='fa fa-rupee'></i> "+all_data[i].price+"<br>";

                       //cart btn
                       var cart_btn = document.createElement("BUTTON");
                       cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
                       cart_btn.className = "btn btn-danger mt-3 mr-3 cart-btn";
                       $(cart_btn).attr("product_id",all_data[i].id);
                       $(cart_btn).attr("product_title",all_data[i].title);
                       $(cart_btn).attr("product_price",all_data[i].price);
                       $(cart_btn).attr("product_pic",all_data[i].thumb);
                       $(cart_btn).attr("product_brand",all_data[i].thumb);

                       //buy btn
                       var buy_btn = document.createElement("BUTTON");
                       buy_btn.innerHTML = " BUY NOW";
                       buy_btn.className = "btn btn-primary mt-3 mr-3 buy-cart-btn";
                       $(buy_btn).attr("product_id",all_data[i].id);
                       $(buy_btn).attr("product_title",all_data[i].title);
                       $(buy_btn).attr("product_price",all_data[i].price);
                       $(buy_btn).attr("product_pic",all_data[i].brands);


                       ;

                     $(div).append(img);
                     $(div).append(brand_span);
                     $(div).append(title_span);
                     $(div).append(price_span);
                     $(div).append(cart_btn);
                     $(div).append(buy_btn);
                     $(".product-result").append(div);

                    }
                    add_to_cart();
                    buy_now();
                }
                }

            });
        });
    });
});


//default filter button

$(document).ready(function(){
    var f_btn = $(".filter-btn");
    f_btn[0].click();
});

//filter by price

$(document).ready(function(){
    $(".price-filter-btn").click(function(){
      
        var cat_name = $(this).attr("cat-name");
        var min = $(".min-price").val();
        var max = $(".max-price").val();
        
        $.ajax({
            type : "POST",
            url : "filter_by_price.php",
            data : {
                min : min,
                maxx : max,
                cat_name : cat_name
            },
            beforeSend : function(){
                $(".product-result").html("Loading");
            },
            success  :function(response){
             

            $(".product-result").html("");
            var all_data =  JSON.parse(response.trim());
            var i;
            if(all_data.length ==0)
            {
                $(".product-result").html("<h2><i class='fa fa-shopping-cart'></i>  Empty stocks</h2>");
            }
            else
            {
                for(i=0;i<all_data.length;i++)
                {
                 var div = document.createElement("DIV");
                 div.className= "text-center border shadow-sm p-2 mb-4  ml-3";
                 var img = document.createElement("IMG");
                 img.src="../../"+all_data[i].thumb;
                 img.width = "250";
                 img.height = "316";

                   //brand name
                   var brand_span = document.createElement("SPAN");
                   brand_span.className = "text-uppercase font-weight-bold";
                   brand_span.innerHTML = "<br>"+all_data[i].brands+"<br>";

                  //title
                   var title_span = document.createElement("SPAN");
                   title_span.className = "text-uppercase";
                   title_span.innerHTML = all_data[i].title+"<br>";

                   //price
                   var price_span = document.createElement("SPAN");
                   price_span.className = "text-uppercase font-weight-bold";
                   price_span.innerHTML = "<i class='fa fa-rupee'></i> "+all_data[i].price+"<br>";

                   //cart btn
                   var cart_btn = document.createElement("BUTTON");
                   cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
                   cart_btn.className = "btn btn-danger mt-3 mr-3 cart-btn";
                   $(cart_btn).attr("product_id",all_data[i].id);
                   $(cart_btn).attr("product_title",all_data[i].title);
                   $(cart_btn).attr("product_price",all_data[i].price);
                   $(cart_btn).attr("product_pic",all_data[i].thumb);
                   $(cart_btn).attr("product_brand",all_data[i].thumb);

                   //buy btn
                   var buy_btn = document.createElement("BUTTON");
                   buy_btn.innerHTML = " BUY NOW";
                   buy_btn.className = "btn btn-primary mt-3 mr-3 buy-cart-btn";
                   $(buy_btn).attr("product_id",all_data[i].id);
                   $(buy_btn).attr("product_title",all_data[i].title);
                   $(buy_btn).attr("product_price",all_data[i].price);
                   $(buy_btn).attr("product_pic",all_data[i].brands);


                   ;

                 $(div).append(img);
                 $(div).append(brand_span);
                 $(div).append(title_span);
                 $(div).append(price_span);
                 $(div).append(cart_btn);
                 $(div).append(buy_btn);
                 $(".product-result").append(div);

                }
                add_to_cart();
                buy_now();
            }


            }

        });
    });
});


//personal information edit

$(document).ready(function(){
    $(".personal-form").submit(function(e){
     e.preventDefault();
     $.ajax({
         type :"POST",
         url : "personal_information.php",
         data : new FormData(this),
         processData  :false,
         contentType : false,
         cache : false,
         beforeSend : function(){
          $(".personal-form-btn").html("PLEASE WAIT...");
         },
         success : function(response){
            $(".personal-form-btn").html("UPDATE");
          alert(response);
         }
     });
    });
});

//privacy and password changes
$(document).ready(function(){
    $(".privacy-form").submit(function(e){
    e.preventDefault();
    var new_pass = $("#newpassword").val();
    var r_password = $("#re_enter_newpassword").val();
    if(new_pass == r_password)
    {
        $.ajax({
            type :"POST",
            url : "privacy_information.php",
            data : new FormData(this),
            processData  :false,
            contentType : false,
            cache : false,
            beforeSend : function(){
             $(".privacy-form-btn").html("PLEASE WAIT...");
            },
            success : function(response){
               $(".privacy-form-btn").html("UPDATE");
             alert(response);
             if(response.trim() =="Password changed")
             {
                 $(".privacy-form").trigger('reset');
             }
            }
        });
    }
    else
    {
        alert("New password and re-new password must be same");
    }
    });
});


//star rating here

$(document).ready(function(){
    $(".star").each(function(){
        $(this).click(function(){
            $(".star-btn").removeClass("d-none");
            $(this).removeClass("fa fa-star-o");
            $(this).addClass("fa fa-star");
            var star = $(".star");
             var index = $(this).attr("index");
             index++;
    
            for(i=0;i<5;i++)
            {
                $(star[i]).removeClass("fa fa-star text-warning");
                $(star[i]).addClass("fa fa-star-o text-warning ");
                

                if(i<index)
                {
                $(star[i]).removeClass("fa fa-star-o");
                $(star[i]).addClass("fa fa-star text-warning");
                }
            }

            $(".star-btn").click(function(){
                
                var id = $(this).attr("p_id");
                if($("#comment").val() !="")
                {
                  if($("#picture").val() != "")
                  {

                    var picture = document.querySelector("#picture").files[0];
                    var formdata = new FormData();
                    formdata.append("picture",picture);
                    formdata.append("comment",$("#comment").val());
                    formdata.append("rating",index);
                    formdata.append("p_id",id);

                    $.ajax({
                        type : "POST",
                        url : "rating.php",
                        data  : formdata,
                        processData : false,
                        contentType : false,
                        success : function(response){
                        alert(response);
                         if(response.trim() =="success")
                         {
                             $(".star-btn").addClass("d-none");
                             $(".comment-info").html("Comment posted");
                             $(".comment-info").addClass("text-success");
                             $(".comment-box").addClass("d-none");
                             $(".picture-box").addClass("d-none");
                             $(".comment-header").html("YOUR RATING");
                             setTimeout(function(){
                                 $(".comment-info").html($("#comment").val());
                                 $(".comment-info").removeClass("text-success");

                             },4000);
                         }
                         else
                         {
                             alert(response);
                         }
                        }
                    });

                  }
                  else
                  {
                      alert("please choose a profile picture");
                  }
                }
                else
                {
                    alert("Please write something in comment box");
                }
            
            });
        });
    });
});







//sort by

$(document).ready(function(){
    $(".sort-by").on("change",function(){
        var c_name = '';
        var b_name = '';
        $(".filter-btn").each(function(){
            if($(this).attr("class").indexOf('btn-primary') != -1)
            {
                 c_name = $(this).attr('cat-name');
                 b_name = $(this).attr('brand-name');
                alert(c_name);
            }
        });

       var sort_by =  $(this).val();
       $.ajax({
           type : "POST",
           url : "sort_product.php",
           data : {
               c_name : c_name,
               b_name : b_name,
               sort_by : sort_by
           },
           beforeSend : function() {
           $(".product-result").html("Loading...");
           },
           success : function(response){
               alert(response);
            $(".product-result").html("")
            var all_data =  JSON.parse(response.trim());
            var i;
            if(all_data.length ==0)
            {
                $(".product-result").html("<h2><i class='fa fa-shopping-cart'></i>  Empty stocks</h2>");
            }
            else
            {
                for(i=0;i<all_data.length;i++)
                {
                 var div = document.createElement("DIV");
                 div.className= "text-center border shadow-sm p-2 mb-4  ml-3";
                 var img = document.createElement("IMG");
                 img.src="../../"+all_data[i].thumb;
                 img.width = "250";
                 img.height = "316";

                   //brand name
                   var brand_span = document.createElement("SPAN");
                   brand_span.className = "text-uppercase font-weight-bold";
                   brand_span.innerHTML = "<br>"+all_data[i].brands+"<br>";

                  //title
                   var title_span = document.createElement("SPAN");
                   title_span.className = "text-uppercase";
                   title_span.innerHTML = all_data[i].title+"<br>";

                   //price
                   var price_span = document.createElement("SPAN");
                   price_span.className = "text-uppercase font-weight-bold";
                   price_span.innerHTML = "<i class='fa fa-rupee'></i> "+all_data[i].price+"<br>";

                   //cart btn
                   var cart_btn = document.createElement("BUTTON");
                   cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
                   cart_btn.className = "btn btn-danger mt-3 mr-3 cart-btn";
                   $(cart_btn).attr("product_id",all_data[i].id);
                   $(cart_btn).attr("product_title",all_data[i].title);
                   $(cart_btn).attr("product_price",all_data[i].price);
                   $(cart_btn).attr("product_pic",all_data[i].thumb);
                   $(cart_btn).attr("product_brand",all_data[i].thumb);

                   //buy btn
                   var buy_btn = document.createElement("BUTTON");
                   buy_btn.innerHTML = " BUY NOW";
                   buy_btn.className = "btn btn-primary mt-3 mr-3 buy-cart-btn";
                   $(buy_btn).attr("product_id",all_data[i].id);
                   $(buy_btn).attr("product_title",all_data[i].title);
                   $(buy_btn).attr("product_price",all_data[i].price);
                   $(buy_btn).attr("product_pic",all_data[i].brands);


                   ;

                 $(div).append(img);
                 $(div).append(brand_span);
                 $(div).append(title_span);
                 $(div).append(price_span);
                 $(div).append(cart_btn);
                 $(div).append(buy_btn);
                 $(".product-result").append(div);

                }
                add_to_cart();
                buy_now();
            }
           }
       });
    });
});


//subscribe coding here 

$(document).ready(function(){
    $(".subscribe-btn").click(function(e){
        e.preventDefault();
        var s_email = $(".subscribe-email").val();
        $.ajax({
            type :"POST",
            url : "http://localhost/ecommerce/pages/php/subscribe_verify.php",
            data : {
                email : s_email
            },
            success : function(response){
                
                var data = JSON.parse(response.trim());
                   var code =  data[1];
                   var success = data[0];
                   
                   if(success == "success")
                   {
                    var count = 3; 
                       function verify(){
                    
                    var prompt =    window.prompt("Please visit on your email to get verification code");
                    if(prompt ==code)
                    {
                    alert("right");
                    $.ajax({
                        type : "POST",
                        url : "http://localhost/ecommerce/pages/php/subscribe.php",
                        data : {
                            email : s_email
                        },
                        success : function(response){
                         alert(response);
                        }
                    });
                    }
                    else if(prompt ==null || prompt =="")
                    {
                        verify();
                    }
                    else
                    {
                        alert("your verification code is wrong");
                        if(--count>0)
                        {
                            verify();
                        }
                       
                    }}
                    verify();
                   }
                
            }
        });
    });
});


//ajax live search

$(document).ready(function(){
    $(".search-input").on("input",function(){
        var key = $(this).val().trim();
        $.ajax({
            type : "POST",
            url : "http://localhost/ecommerce/pages/php/live_search.php",
            data : {
                key : key
            },
            success : function(response){
            $(".search-hint").html("");
           $(".search-hint").html(response);
           $(".search-hint").css({
               backgroundColor :  'white'
           });
           $(".p_tag").on("mouseover",function(){
               $(this).css({
                   backgroundColor : 'black',
                   color : 'white',
                   padding :'10px',
                   margin: '0px',
                   height : '40px',
                   cursor : 'pointer'
               });

               $(this).on("mouseout",function(){
                $(this).css({
                    backgroundColor : '',
                    color : ''
                   
                });
               });
           });

         
           $(".p_tag").each(function(){
               $(this).click(function(){
                   var id = $(this).attr("p_id");
                   $(".search-input").val($(this).html().trim());
                   $(".search-hint").html("");
                   $(".search-hint").css({
                    backgroundColor :  ''
                });
                window.location = "http://localhost/ecommerce/pages/php/buy_products.php?id="+id;

               });
           });



            }
        });
    });
});


//default search by enter 

$(document).ready(function(){
    $(".search-input").on("keypress",function(event){
        if(event.keyCode == 13 && $(this).val() != "")
        {
            var key = $(this).val().trim();
            window.location ="http://localhost/ecommerce/pages/php/default_search.php?search="+key;
        }
    });
});


//default search by click on icon
$(document).ready(function(){
    $(".search-icon").on("click",function(event){
        if( $(".search-input").val() != "")
        {
            var key = $('.search-input').val().trim();
            window.location ="http://localhost/ecommerce/pages/php/default_search.php?search="+key;
        }
        else
        {
            alert("please write something in search box");
        }
    });
});