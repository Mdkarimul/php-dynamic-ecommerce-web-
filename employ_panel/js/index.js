$(document).ready(function(){
    $(".stock-update-btn").click(function(){
        $(".stock-update-btn-menu").collapse('toggle');
    })

    $(".homepage-design-btn").click(function(){
        $(".homepage-design-collapse").collapse('toggle');
    })


});


//dynamic request
$(document).ready(function(){
    var active = $(".active").attr("access-link");
        dynamic_request(active);
    $(".collapse-item").each(function(){
        $(this).click(function(){
            var link = $(this).attr("access-link");
           dynamic_request(link);
        });
    });
});

//active tab
$(document).ready(function(){
    var i;
    $(".collapse-item").each(function(){
        $(this).click(function(){
            for(i=0;i<$(".collapse-item").length;i++)
            {
                $(".collapse-item").removeClass("active");
            }
            $(this).addClass("active");
        });
    });
});

function dynamic_request(link)
{
 $.ajax({
     type : "POST",
     url :"dynamic_pages/"+link,
     xhr : function(){
       var r = new XMLHttpRequest();
       r.onprogress = function(e)
       {
        var per =  Math.floor((e.loaded*100)/e.total);
        var loader = '<center><button class="btn btn-danger" style="font-size:30px;"><i class="fa fa-circle-o-notch fa-spin"></i>Loading '+per+' </button></center>';
        $(".page").html(loader);
    }
       return r;
       
     },
     beforeSend : function(){
        var loader = '  <center><button class="btn btn-danger" style="font-size:30px;"><i class="fa fa-circle-o-notch fa-spin"></i>Loading </button></center>';
     $(".page").html(loader);
     },
     success : function(response){
    $(".page").html(response); 
    if(link =="branding_design.php")
    {
        brand_information();
    }
    alert(link);

    if(link  =="header_showcase_design.php")
    {
        header_showcase();
    }
    if(link =="delivary_area_design.php")
    {
      delivary_area();
    }
    if(link == "category_showcase.php")
    {
      category_showcase();
    }

   
         
    //create products

    $(".create-products-form").submit(function(e){
  var option =  $(".selected-products option");
  var i;
  var c_name ="";
  for(i=0;i<option.length;i++)
  {
    if(option[i].innerHTML == $(".selected-products").val())
    {
      c_name = $(option[i]).attr("c-name");
    }  
  }
  
  
      
    e.preventDefault();
   
   if($(".selected-products").val() !="Choose Brands")
   {
     $.ajax({
         type : "POST",
         url :"php/create_products.php?c_name="+c_name,
         data : new FormData(this),
         processData :false,
         contentType : false,
         cache : false,
         xhr : function(){
      var request = new XMLHttpRequest();
      request.upload.onprogress = function(e){
       var per =  Math.floor((e.loaded*100)/e.total);
      
       $(".progress-bar").css({
           width : per+"%"
       });
       $(".progress-bar").html(per+"%");
      }
         return request;
         },
         beforeSend : function(){
        $(".create-products-progress").removeClass("d-none");
         },
         success : function(response){
           
           if(response.trim() =="success")
           {
            $(".create-products-progress").addClass("d-none");
            $(".progress-bar").css({
                width : "0%"
            });
           // $(".create-products-form").trigger('reset');
            }
            else
            {
                alert(response);

                $(".create-products-progress").addClass("d-none");
            $(".progress-bar").css({
                width : "0%"
            });
           // $(".create-products-form").trigger('reset');
            }
                }

     });
   }
   else
   {
       alert("Please choose a brand");
   }
   

    });


    if(link =="create_category.php")
    {
        display_category_list();
    }


    //category add fields 
    $(".category-add-field-btn").click(function(){
        var input = document.createElement("INPUT");
        input.type="text";
        input.className = "form-control mb-3 input";
        var place_value = $(".input:first").attr("placeholder");
        input.placeholder = place_value;
        input.require = "required";
        input.style.background="#f9f9f9";
        $(".category-add-field-area").append(input);
    });

 

    //create category list
    $(".create-field-btn").click(function(e){
        alert("llll");
        e.preventDefault();
        if($(".input").val() != '')
        {
            var input = [];
            var input_length = $(".input").length;
            var i;
            for(i=0;i<input_length;i++)
            {
                input[i] = document.getElementsByClassName("input")[i].value;
            }
            var object = JSON.stringify(input);
            $.ajax({
                type :"POST",
                url : "php/create_category_db.php",
                data : {
                    json_data : object
                },
                beforeSend : function(){
                $(".create-category-loader").removeClass("d-none");
                },
                success : function(response){
                    alert(response);
                $(".create-category-loader").addClass("d-none");
                if(response.trim()=="done")
                {
    
                    $(".input").val("");
                    var notice = document.createElement("DIV");
                    notice.className="alert alert-success";
                    notice.innerHTML="<b>Success !</b>";
                    $(".create-category-notice").html(notice);
                    setTimeout(function(){
                    $(".create-category-notice").html("");
                    },3000);
                    display_category_list();
                }
                }
            });
        }
       
    });

      // add brand fields
      $(".brand-add-field-btn").click(function(){
        var input = document.createElement("INPUT");
        input.type="text";
        input.className = "form-control mb-3 input";
        var place_value = $(".input:first").attr("placeholder");
        input.placeholder = place_value;
        input.require = "required";
        input.style.background="#f9f9f9";
        $(".brand-add-field-area").append(input);
    });


     //create new brands
     $(".create-brands-btn").click(function(e){
        e.preventDefault();
        var select_category = $(".brands-category").val();
        if(select_category=="Choose category")
        {
            var notice = document.createElement("DIV");
             notice.className="alert alert-warning";
             notice.innerHTML="<b>Please choose a brand</b>";
             $(".create-brands-notice").html(notice);
             setTimeout(function(){
                $(".create-brands-notice").html("");
                $(".brands-form").trigger('reset');
             },3000);
            

        }
        else
        {
        if($(".input").val() != '')
        {
            var input = [];
            var input_length = $(".input").length;
            var i;
            for(i=0;i<input_length;i++)
            {
                input[i] = document.getElementsByClassName("input")[i].value;
            }
            var object = JSON.stringify(input);
            $.ajax({
                type :"POST",
                url : "php/create_brands_db.php",
                data : {
                    json_data : object,
                    category : select_category
                },
                beforeSend : function(){
                $(".create-brands-loader").removeClass("d-none");
                },
                success : function(response){
                    alert(response);
                $(".create-brands-loader").addClass("d-none");
                if(response.trim()=="done")
                {
    
                    $(".input").val("");
                    var notice = document.createElement("DIV");
                    notice.className="alert alert-success";
                    notice.innerHTML="<b>Success !</b>";
                    $(".create-brands-notice").html(notice);
                    setTimeout(function(){
                    $(".create-brands-notice").html("");
                    },3000);
                    
                }
                }
            });
        }
    }
       
    });


    $(".display-brands").on("change",function(){


        var selected_category_name = $(this).val();
        var all_option = $(this).html().replace("<option>Choose category</option>").replace("<option>"+selected_category_name+"</option>");
        
        $.ajax({
            type :"POST",
            url : "php/display_brands.php",
            data : {
                category_name : selected_category_name
            },
            beforeSend : function(){
                $(".brand-loader").removeClass("d-none");
            },
            success : function(response){
             $(".brand-loader").addClass("d-none");
             alert(response);
             if(response.trim() != "No brand has been created yet")
             {

             
             var table = document.createElement("TABLE");
             table.width="100%";
             table.border="1px ";
             table.className = "text-center";
             var top_tr = document.createElement("TR");

             var th_category = document.createElement("TH");
             th_category.height="40";
             th_category.innerHTML ="CATEGORY";
             th_category.className ="bg-danger text-light";

             var th_brands = document.createElement("TH");
             th_brands.height="40";
             th_brands.innerHTML ="BRNADS NAME";
             th_brands.className ="bg-danger text-light";
             
             var th_edit = document.createElement("TH");
             th_edit.height="40";
             th_edit.innerHTML ="EDIT";
             th_edit.className ="bg-danger text-light";
             
             var th_delete = document.createElement("TH");
             th_delete.height="40";
             th_delete.innerHTML ="DELETE";
             th_delete.className ="bg-danger text-light";

             top_tr.append(th_category);
             top_tr.append(th_brands);
             top_tr.append(th_edit);
             top_tr.append(th_delete);
             table.append(top_tr);
             

             var data = JSON.parse(response);
             var i;
             for(i=0;i<data.length;i++)
             {
                 var tr = document.createElement("TR");
                 var td_category = document.createElement("TD");
                 var td_brands = document.createElement("TD");
                 var td_edit = document.createElement("TD");
                 var td_delete = document.createElement("TD");
                 td_category.innerHTML="<select disabled='disabled' class=' selected-categoryname-name border p-2'><option>"+data[i].category_name+"</option>"+all_option+"</select>";
                 td_brands.innerHTML=data[i].brands_name;
                 td_edit.innerHTML="<i class='fa fa-edit brand-edit' b-name="+data[i].brands_name+" c-name="+data[i].category_name+"></i><i class='fa fa-save brand-save d-none' b-name="+data[i].brands_name+" c-name="+data[i].category_name+"></i>";
                 td_delete.innerHTML="<i class='fa fa-trash brand-delete' b-name="+data[i].brands_name+" c-name="+data[i].category_name+"></i>";
                 tr.append(td_category);
                 tr.append(td_brands);
                 tr.append(td_edit);
                 tr.append(td_delete);
                 table.append(tr);
                 $(".brands-list-show-area").html(table);
                    console.log(data[i]);

                    //delete brand 

                    $(".brand-delete").each(function(){
                        $(this).click(function(){
                            var delete_icon = this;
                           var c_name = $(this).attr("c-name");
                           var b_name = $(this).attr("b-name");
                           $.ajax({
                               type : "POST",
                               url : "php/delete_brands.php",
                               data : {
                                   category_name : c_name,
                                   brands_name : b_name

                               },
                               success : function(response){
                                   alert(response);
                                   if(response.trim()=="Delete success")
                                   {
                                      var tr =  delete_icon.parentElement.parentElement;
                                      tr.remove();
                                   }
                                   else
                                   {
                                       alert(response);
                                   }
                               }
                           });
                           
                        });
                    });

        //brand edit
         $(".brand-edit").each(function(){
             $(this).click(function(){
                 $(this).addClass("d-none");
                 var edit_icon = this;
                 var parent = this.parentElement;
                 var c_name = $(this).attr("c-name");
                 var b_name = $(this).attr("b-name");
                 var tr = this.parentElement.parentElement;
                 var td = tr.getElementsByTagName("TD");
                var select_tag =  td[0].getElementsByClassName("selected-categoryname-name")[0];
                select_tag.disabled =false;
                td[1].contentEditable=true;
                td[1].focus();
               var save_icon =  td[2].getElementsByClassName("brand-save")[0];
               var delete_icon =  td[3].getElementsByClassName("brand-delete")[0];
               $(save_icon).removeClass("d-none");
                 $(save_icon).click(function(){
                   $.ajax({
                       type : "POST",
                       url : "php/edit_brands.php",
                       data : {
                           previous_category_name : c_name,
                           previous_brand_name : b_name,
                           current_category_name : select_tag.value,
                           current_brand_name : td[1].innerHTML
                       },
                       beforeSend : function(){

                       },
                       success : function(response){
                    alert(response);
                    if(response.trim()=="edit success")
                    {
                        select_tag.disabled =true;
                        td[1].contentEditable=false;
                        $(save_icon).addClass("d-none");
                        $(edit_icon).removeClass("d-none");

                        $(edit_icon).attr("c-name",select_tag.value);
                        $(edit_icon).attr("b-name",td[1].innerHTML);
                        
                        $(save_icon).attr("c-name",select_tag.value);
                        $(save_icon).attr("b-name",td[1].innerHTML);
                        
                        $(delete_icon).attr("c-name",select_tag.value);
                        $(delete_icon).attr("b-name",td[1].innerHTML);

                    }
                       }

                   });
                 });

                 
             });
         });
             }
            }
            else
            {
                $(".brands-list-show-area").html(response);   
            }
            }
        });

    });
     }
 });
}

//display category list 
$(document).ready(function(){
    display_category_list();
});


function display_category_list()
{
        $.ajax({
            type : "POST",
            url : "php/category_list.php",
            success : function(response){
                var list = JSON.parse(response);
                var i;
                for(i=0;i<list.length;i++)
                {
                   var id =  list[i].id;
                   var name =  list[i].category_name;
                   var ul = document.createElement("UL");
                   ul.className="list-group";
                   var li = document.createElement("LI");
                   li.className="list-group-item mb-3 border-0";
                   ul.append(li);
    
                   var div = document.createElement("DIV");
                   div.className="btn-group ";
                   div.style.backgroundColor="#ddd";
                   li.append(div);
    
                   var id_btn = document.createElement("BUTTON");
                   id_btn.innerHTML=id;
                   id_btn.className= "btn id";
                   div.append(id_btn);
    
                   var name_btn = document.createElement("BUTTON");
                   name_btn.innerHTML=name;
                   name_btn.className= "btn name";
                   div.append(name_btn);
    
                   var edit_btn = document.createElement("BUTTON");
                   edit_btn.innerHTML="<i class='fa fa-edit edit-icon'></i><i class='fa fa-save d-none save-icon'></i>";
                   edit_btn.className= "btn ";
                   div.append(edit_btn);
    
                   var delete_btn = document.createElement("BUTTON");
                   delete_btn.innerHTML="<i class='fa fa-trash delete-icon'></i>";
                   delete_btn.className= "btn ";
                   div.append(delete_btn);
    
                 $(".category-area").append(ul);
    
                }
            }
        });
    }





 //edit category name
 edit_btn.onclick = function()
 {
    var parent =  this.parentElement;
   var cate_name =  parent.getElementsByClassName("name")[0];
   var id =  parent.getElementsByClassName("id")[0];
   var save_icon =  parent.getElementsByClassName("save-icon")[0];
   var edit_icon =  parent.getElementsByClassName("edit-icon")[0];
    cate_name.contentEditable=  true;
    cate_name.focus();
    $(save_icon).removeClass("d-none");
    $(edit_icon).addClass("d-none");

    $(save_icon).click(function(){
       var changed_name = cate_name.innerHTML.trim();
       $.ajax({
           type :"POST",
           url :"php/edit_category_name.php",
           data : {
               id : id.innerHTML.trim(),
               changed_name : changed_name
           },
           success : function(response)
           {
               alert(response);
               if(response.trim()=="update success")
               {
                cate_name.contentEditable= false;
                $(save_icon).addClass("d-none");
                $(edit_icon).removeClass("d-none");
               }
               else
               {
                   alert(response);
               }
           }
          
       });
    });

 }




//delete category list
delete_btn.onclick = function()
{
    var parent = this.parentElement;
    var id = parent.getElementsByClassName("id")[0].innerHTML.trim();
    $.ajax({
        type : "POST",
        url : "php/delete_category_name.php",
        data : {
            id : id
        },
        success : function(response)
        {
       alert(response);
       if(response.trim()=="delete success")
       {
           parent.parentElement.parentElement.remove();
       }
       else
       {
           alert(response);
       }
        }
    });
}








//start branding details coding


function brand_information()
{
    $(document).ready(function(){
        $("#about-us").on("input",function(){
          var length = $(this).val().length;
          $(".about-us-count").html(length);
    
        });
      });
    
      $(document).ready(function(){
        $("#p_policy").on("input",function(){
          var length = $(this).val().length;
          $(".privacy-count").html(length);
        });
      });
    
      $(document).ready(function(){
        $("#c_policy").on("input",function(){
          var length = $(this).val().length;
          $(".cookies-count").html(length);
        });
      });
    
      $(document).ready(function(){
        $("#t_condition").on("input",function(){
          var length = $(this).val().length;
          $(".terms-count").html(length);
        });
      });
    
      //branding details
      $(document).ready(function(){
        $(".branding-form").submit(function(e){
      e.preventDefault();
      var file = document.querySelector("#brand_logo");
      var file_size;
      if(file.value =="")
      {
        file_size = 0;
      }
      else
      {
        file_size = file.files[0].size;
      }
     if(500000>file_size)
     {
       $.ajax({
        type : "POST",
        url : "php/branding_details.php",
        data : new FormData(this),
        processData :false,
        contentType : false,
        cache : false,
        beforeSend  : function(){
    
        },
        success : function(response)
        {
       alert(response);
        }
      });
     }
     else
     {
       alert("Please upload leas then 200 kb of file");
     }
      
        });
      });
    
    
      $(document).ready(function(){
        $.ajax({
          type : "POST",
          url : "php/check_branding_table.php",
          success : function(response){
        var all_data = JSON.parse(response.trim());
        console.log(all_data);
        $("#brand_name").val(all_data[0].brand_name);
        $("#domain_name").val(all_data[0].domain_name);
        $("#email").val(all_data[0].email);
        $("#phone").val(all_data[0].phone);
        $("#facebook_url").val(all_data[0].facebook_url);
        $("#twitter_url").val(all_data[0].twitter_url);
        $("#address").val(all_data[0].adr);
        $("#about_us").val(all_data[0].about_us);
        $("#p_policy").val(all_data[0].privacy_policy);
        $("#c_policy").val(all_data[0].cookies_policy);
        $("#t_condition").val(all_data[0].terms_policy);
        $(".branding-form input, .branding-form textarea, .branding-form button ").prop("disabled",true);
         
        $(".branding-edit").click(function(){
         $(".branding-form input, .branding-form textarea, .branding-form button ").prop("disabled",false);
        });
       }
        });
      });
}






//header showcase


function header_showcase()
{
    $(document).ready(function(){
     $(".target").each(function(){
      $(this).click(function(event){
       var element = event.target;
       var index_number =  $(element).index();
       sessionStorage.setItem("color_index",index_number);
       var i;
       for(i=0;i<$(".target").length;i++)
       {
        $(".target").css({
          border : "",
          boxShadow  : "",
          padding : "",
          width : ""

        });
       }
       $(this).css({
          border : "5px solid red",
          boxShadow  : "0px 0px 3px grey",
          padding : "5px",
          width : "fit-content"

        });
       $(".color_selector").on("change",function(){
       var index =  Number(sessionStorage.getItem("color_index"));
        var color = $(this).val();
        var ele =   document.getElementsByClassName("target")[index];
        ele.style.color=color;
       });

       $(".font-size").on("input",function(){
       var index =  Number(sessionStorage.getItem("color_index"));
        var size = $(this).val();
        var ele =   document.getElementsByClassName("target")[index];
        ele.style.fontSize=size+"%";
       });


     });
      $(this).on("dblclick",function(){
        $(".target").css({
          border : "",
          boxShadow  : "",
          padding : "",
          width : ""

        });
      });
     });
   });

   //title image upload 
$(document).ready(function(){
 $("#title_image").on("change",function(){
   var file = this.files[0];
   if(file.size<200000)
   {
  var url = URL.createObjectURL(file);
  var image = new Image();
   image.src = url;
   image.onload = function (){
    var o_width = image.width;
   var o_height = image.height;
   if(o_width ==1920 && o_height ==978)
   {
     image.style.width="60%";
     image.style.position="absolute";
     image.style.top="0px";
     image.style.left="0px";
     $(".showcase_preview").css({
       position : "relative"
     });
    $(".showcase_preview").append(image);
   }
   else
   {
     alert("Please upload 1920*978");
   }
   }
   }
   else
   {
     alert("upload less then 200 kb");
   }
 });
});

//text area max length
$(document).ready(function(){
 $("#title_text").on("input",function(){
   var length = this.value.length;
   $(".showcase-title").html(this.value);
   $(".title_limit").html(length);
 });
});

$(document).ready(function(){
 $("#subtitle_text").on("input",function(){
   var length = this.value.length;
   $(".showcase-subtitle").html(this.value);
   $(".subtitle_count").html(length);
 });
});

//add showcase 

$(document).ready(function(){
$(".header-showcase-form").submit(function(e){
  e.preventDefault();
  var title = document.querySelector(".showcase-title");
  var subtitle = document.querySelector(".showcase-subtitle");
  var file = document.querySelector("#title_image").files[0];

//title here
  var title_size = "";
  var title_color = "";
  if(title.style.fontSize=="")
  {
 title_size = "300%";
  }
  else
  {
    title_size = title.style.fontSize;
  }

  if(title.style.color=="")
  {
 title_color = "black";
  }
  else
  {
    title_color = title.style.color;
  }

//subtitle
  var subtitle_size = "";
  var subtitle_color = "";
  if(subtitle.style.fontSize=="")
  {
 subtitle_size = "200%";
  }
  else
  {
    subtitle_size = subtitle.style.fontSize;
  }

  if(subtitle.style.color=="")
  {
 subtitle_color = "black";
  }
  else
  {
    subtitle_color = subtitle.style.color;
  }


//alignment
 var flex_box = document.querySelector(".showcase_preview");
  var h_align = "";
  var v_align = "";
  if(flex_box.style.justifyContent=="")
  {
    h_align = "flex-start";
  }
  else
  {
    h_align = flex_box.style.justifyContent;
  }

  if(flex_box.style.alignItems =="")
  {
    v_align = "flex-start";
  }
  else
  {
    v_align = flex_box.style.alignItems;
  }

  var css_data = {
   title_size : title_size,
   title_color : title_color,
   subtitle_size : subtitle_size,
   subtitle_color : subtitle_color,
   h_align : h_align,
   v_align : v_align,
   title_text : title.innerHTML,
   subtitle_text : subtitle.innerHTML,
   buttons : $(".title-buttons").html().trim(),
   options : $("#edit-title").val().trim()
  };

 var formdata = new FormData();
 formdata.append("file_data",file);
 formdata.append("css_data",JSON.stringify(css_data));


  $prev_data = $(".showcase_preview").html();

  
  $.ajax({
    type : "POST",
    url : "php/header_showcase.php",
    data : formdata,
    processData : false,
    contentType : false,
    cache : false,
    success : function(response)
    {
      alert(response);
      if(response.trim() =="store")
      {
          $(".header-showcase-form").trigger('reset');
          $(".showcase_preview").html($prev_data);
      }
    }
  });
});
});

//alignment

$(document).ready(function(){
$(".alignment").each(function(){
  $(this).click(function(){
    var position_align = $(this).attr("align-position");
    var position_value = $(this).attr("position-value");
    if(position_align =="h")
    {
      $(".showcase_preview").css({
        justifyContent : position_value

      });
    }
    else if(position_align=="v")
    {
      $(".showcase_preview").css({
        alignItems : position_value

      });
    }
  });
});
});

//add btn

$(document).ready(function(){
$(".add-btn").click(function(){
  var button = document.createElement("BUTTON");
  button.className="btn mr-2 title-btn";
  var a = document.createElement("A");
  a.href= $(".btn-url").val();
  a.innerHTML= $(".btn-name").val();
  a.style.color= $(".btn-textcolor").val();
  a.style.fontSize= $(".btn-size").val();
  button.style.backgroundColor= $(".btn-bgcolor").val();
  button.append(a);
  var title_buttons = document.querySelector(".title-buttons");
 var c_elements =  title_buttons.getElementsByTagName("BUTTON");
 var btn_length = c_elements.length;
 if(btn_length ==0 || btn_length==1)
 {
  $(".title-buttons").append(button);
 }
 else
 {
alert("Only two buttons are allowed");
 }
  
});
});

//real preview

$(document).ready(function(){
$(".real-preview-btn").click(function(){
var file = document.querySelector("#title_image").files[0];
var formdata = new FormData();
formdata.append("pic",file);
//alignment
var flex_box = document.querySelector(".showcase_preview");
  var h_align = "";
  var v_align = "";
  if(flex_box.style.justifyContent=="")
  {
    h_align = "flex-start";
  }
  else
  {
    h_align = flex_box.style.justifyContent;
  }

  if(flex_box.style.alignItems =="")
  {
    v_align = "flex-start";
  }
  else
  {
    v_align = flex_box.style.alignItems;
  }
var array =   [$(".title-box").html().trim(),h_align,v_align];
formdata.append("data",JSON.stringify(array));
$.ajax({
  type : "POST",
  url : "php/real_preview.php",
  data : formdata,
  contentType : false,
  processData  :false,
  cache : false,
  success : function(response){
  // alert(response);
   var page =  window.open("about:blank");
   page.document.open();
   page.document.write(response);
   page.document.close();
   
  }
});
});
});


//edit title

$(document).ready(function(){
var showcase_preview = $(".showcase_preview").html();
$("#edit-title").on("change",function(){
if($(this).val() != "Choose title")
{
  $(".add-showcase-btn").html("Save edit");
  $(".add-showcase-btn").removeClass("bg-primary");
  $(".add-showcase-btn").addClass("bg-danger");
  $.ajax({
    type : "POST",
    url : "php/edit_title.php",
    data : {
      id : $(this).val()
    },
    success  :function(response){
  $("#title_image").removeAttr("required","required");
  var selected_value = $("#edit-title").val();
  $(".add-showcase-btn").html("Save edit");
  $(".add-showcase-btn").removeClass("bg-primary");
  $(".add-showcase-btn").addClass("bg-danger");
  $(".delete-title").removeClass("d-none");
  $(".delete-title").click(function(){
    $.ajax({
      type : "POST",
      url : "php/delete_title.php",
      data : {
        id : $("#edit-title").val()
      },
      success : function(response)
      {
        alert(response);
        if(response.trim() =="Delete success")
        {
  $(".add-showcase-btn").html("Add showcase");
  $(".add-showcase-btn").removeClass("bg-danger");
  $(".add-showcase-btn").addClass("bg-primary");
  $(".header-showcase-form").trigger('reset');
  $(".showcase_preview").html(showcase_preview);
  $(".delete-title").addClass("d-none");
  var op =  $("#edit-title option");
  op[0].selected = "selected";
  var i;
  for(i=0;i<op.length;i++)
  {
    if(op[i].value ==selected_value)
    {
      op[i].remove();
    }
  }
        }
      }
    });
  });


   var all_data = JSON.parse(response.trim());
    var image = document.createElement("IMG");
     image.src=all_data[0];
     image.style.width="100%";
     image.style.position = "absolute";
     image.style.top = "0px";
     image.style.left = "0px";
     $(".showcase_preview").append(image);
     $(".showcase-title").html(all_data[1]);
     $(".showcase-title").css({
       color : all_data[3],
       fontSize : all_data[2]
     });

     $(".showcase-subtitle").html(all_data[4]);
     $(".showcase-subtitle").css({
       color : all_data[5],
       fontSize : all_data[6]
     });
     $(".title-buttons").html(all_data[9]);

     $("#title_text").val(all_data[1]);
     $("#subtitle_text").val(all_data[4]);



     //edit btn 
     $(".title-btn").each(function(){
       $(this).click(function(){
         sessionStorage.setItem("btn_key",$(this).index());
         $(".delete-btn").removeClass("d-none");
       var url =   $(this).children().attr("href");
       $(".btn-url").val(url);
       var btn_text = $(this).children().html();
       $(".btn-name").val(btn_text);



       //bg color
       var bgcolor = $(this).css('backgroundColor').replace("rgb(","").replace(")","");
       var bg = bgcolor.split(",");
       var i;
       var color_code = "";
       for(i=0;i<bg.length;i++)
       {
       var hex_code =   Number(bg[i]).toString(16);
      color_code += hex_code.length ==1 ? "0"+hex_code : hex_code;
       }
       $(".btn-bgcolor").val("#"+color_code);


      //text color
       var text_color = $(this).children().css('color').replace("rgb(","").replace(")","");
       var color  = text_color.split(",");
       var text_color_code = "";
       for(i=0;i<color.length;i++)
       {
       var text_hex_code =   Number(color[i]).toString(16);
      text_color_code += text_hex_code.length == 1 ? "0"+text_hex_code : text_hex_code;
       }
       $(".btn-textcolor").val("#"+text_color_code);

       //font size
       var btn_size = $(this).children().css('fontSize');
       for(i=0;i<$(".btn-size").children().length;i++)
       {
         var option  = $(".btn-size").children();
         if(option[i].value == btn_size)
         {
           alert(btn_size);
           option[i].selected = "selected";
         }
       }

       });
     });

     $(".btn-name").on("input",function(){
       var index_no = Number(sessionStorage.getItem("btn_key"));
       var selected_btn = document.getElementsByClassName("title-btn")[index_no];
       selected_btn.getElementsByTagName("A")[0].innerHTML= this.value;
     });


     $(".btn-bgcolor").on("change",function(){
       var index_no = Number(sessionStorage.getItem("btn_key"));
       var selected_btn = document.getElementsByClassName("title-btn")[index_no];
       selected_btn.style.backgroundColor  =this.value;
     });

     $(".btn-textcolor").on("change",function(){
       var index_no = Number(sessionStorage.getItem("btn_key"));
       var selected_btn = document.getElementsByClassName("title-btn")[index_no];
       selected_btn.getElementsByTagName("A")[0].style.color=this.value;
     });

     $(".btn-size").on("change",function(){
       var index_no = Number(sessionStorage.getItem("btn_key"));
       var selected_btn = document.getElementsByClassName("title-btn")[index_no];
       selected_btn.getElementsByTagName("A")[0].style.fontSize=this.value;
     });


     $(".delete-btn").on("click",function(){
       var index_no = Number(sessionStorage.getItem("btn_key"));
       var selected_btn = document.getElementsByClassName("title-btn")[index_no];
       selected_btn.remove();
       $(".btn-url,.btn-name").val("");
       $(".btn-bgcolor,.btn-textcolor").val("");
     var op =   $(".btn-size option");
     op[0].selected =  "selected";
       $(".delete-btn").addClass("d-none");
     });


    


    }

  });
}
else
{
  $("#title_image").attr("required","required");
  $(".add-showcase-btn").html("Add showcase");
  $(".add-showcase-btn").removeClass("bg-danger");
  $(".add-showcase-btn").addClass("bg-primary");
  $(".header-showcase-form").trigger('reset');
  $(".showcase_preview").html(showcase_preview);
  $(".delete-title").addClass("d-none");
}
});
});
   }




   //category showcase 



   function category_showcase()
{
  $(document).ready(function(){
  $(".upload-icon").each(function(){
    $(this).on("change",function(){
    var upload_icon = this;
   var dummy_pic =  upload_icon.parentElement.parentElement.parentElement.getElementsByTagName("IMG")[0];
   
  var set_btn =  upload_icon.parentElement.parentElement.getElementsByClassName("set-btn")[0];
  var input =  upload_icon.parentElement.parentElement.getElementsByTagName("INPUT")[1];

   var d_width = dummy_pic.naturalWidth;
   var d_height = dummy_pic.naturalHeight;
   
     var file  = upload_icon.files[0];
     var url = URL.createObjectURL(file);
     var image = new Image();
     image.src= url;
     var uploaded_width = "";
     var uploaded_height = "";
     image.onload = function(){
     uploaded_width =   image.width;
      uploaded_height =  image.height;
     if(d_width == uploaded_width && d_height == uploaded_height)
     {
      input.oninput = function(){
        if(this.value.length >= 1)
        {
        set_btn.disabled = false;
        set_btn.onclick = function(){
          var formdata = new FormData();
          formdata.append("photo",file);
          formdata.append("text",input.value);
          formdata.append("direction",$(set_btn).attr("img-dir"));
          $.ajax({
            type : "POST",
            url : "php/category_showcase.php",
            data : formdata,
            processData : false,
            contentType : false,
            cache : false,
            beforeSend : function(){
              set_btn.innerHTML= "Please wait...";
            },
            success  :function(response){
              set_btn.innerHTML= "SET";
            alert(response);
            if(response.trim()=="success")
            {
              dummy_pic.src = url;
              $(upload_icon.parentElement.parentElement).addClass("d-none");
              dummy_pic.ondblclick = function(){
                $(upload_icon.parentElement.parentElement).removeClass("d-none");
              }
            }
            }
          });

        }
        }
        else
        {
          set_btn.disabled = true;
        }
      }
     }
     else
     {
       alert("Please upload"+ d_width+"/"+d_height);
     }
     }
    });
  });
});



$(document).ready(function(){
  var img = $("img");
  var i;
  for(i=0;i<img.length;i++)
  {
    if(img[i].src.indexOf("base64") != -1)
    {
     var set_btn =  img[i].parentElement.getElementsByClassName("set-btn")[0];
     set_btn.disabled=false;

     $(".set-btn").each(function(){
      $(this).click(function(){
        set_btn = this;
        var input = this.parentElement.getElementsByTagName("INPUT");
      var file =  input[0].files[0];
      var text = input[1].value;
     var d_pic =  this.parentElement.parentElement.getElementsByTagName("IMG")[0];
     var url = d_pic.src;
     if(input[0].value !="")
     {
       url = URL.createObjectURL(input[0].files[0]);
     }

     var formdata = new FormData();
          formdata.append("photo",file);
          formdata.append("text",text);
          formdata.append("direction",$(set_btn).attr("img-dir"));
          $.ajax({
            type : "POST",
            url : "php/category_showcase.php",
            data : formdata,
            processData : false,
            contentType : false,
            cache : false,
            beforeSend : function(){
              set_btn.innerHTML= "Please wait...";
            },
            success  :function(response){
              set_btn.innerHTML= "SET";
            alert(response);
            if(response.trim()=="success")
            {
              dummy_pic.src = url;
              $(set_btn.parentElement).addClass("d-none");
              dummy_pic.ondblclick = function(){
                $(set_btn.parentElement).removeClass("d-none");
              }
            }
            }
          });
      }); 
     });
    }
  } 
});
}





//start delivary area coding 
function delivary_area()
{
//get state here 
     $(document).ready(function(){
   $(".countries").on("change",function(){
     $(".states").html("");
    var option = $(".countries option");
    var i;
    for(i=0;i<option.length;i++)
    {
     if(option[i].innerHTML == $(".countries").val())
     {
       var id = $(option[i]).attr("c_id");
      $.ajax({
        type  :"POST",
        url : "php/get_states.php",
        data : {
          c_id : id
        },
        success  : function(response) 
        {
         var state =  JSON.parse(response.trim());
         for(var j=0;j<state.length;j++)
         {
         var options =  "<option  s_id='"+state[j].id+"'>"+state[j].name+"</option>";
          $(".states").append(options);
         }
        }
      });
     }
    }
   });
     });


     //get city
     $(document).ready(function(){
   $(".states").on("change",function(){
     $(".cities").html("");
    var option = $(".states option");
    var i;
    for(i=0;i<option.length;i++)
    {
     if(option[i].innerHTML == $(".states").val())
     {
       var id = $(option[i]).attr("s_id");
      $.ajax({
        type  :"POST",
        url : "php/get_cities.php",
        data : {
          s_id : id
        },
        success  : function(response) 
        {
         var city =  JSON.parse(response.trim());
         for(var j=0;j<city.length;j++)
         {
         var options =  "<option>"+city[j].name+"</option>";
          $(".cities").append(options);
         }
        }
      });
     }
    }
   });
     });


     //get pin code
     $(document).ready(function(){
       $(".cities").on("change",function(){
         var city = $(this).val();
         $.ajax({
           type : "GET",
           url : "https://api.postalpincode.in/postoffice/"+city,
           success : function(response){
             var index = response[0].PostOffice.length-1;
               $(".pincode").val(response[0].PostOffice[index].Pincode);   
           }
         });
       });
     });


     //set area 
     $(document).ready(function(){
       $(".set-area-form").submit(function(e){
         e.preventDefault();
         $.ajax({
           type  :"POST",
           url  :"php/set_area.php",
           data : new FormData(this),
           processData : false,
           contentType : false,
           cache : false,
           success  :function(response){
            alert(response);
           }
         });
       });
     });
    }