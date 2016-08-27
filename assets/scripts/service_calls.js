$(function(){

    
    $("#brand_select").change(function(){
        
        $("#model_select").empty();
        
        $this = $(this);
        
        brand_id = $this.val();
        
        mForm = $("#open_service");
        
        data = {"brand_id":brand_id,"action":"GetModelForBrand"};
        // form_data = mForm.serializeArray(); 
        console.log(data);
        // console.log(mForm); 
        controller  = mForm.attr('action');
		
        controller = controller.slice(3, controller.length);
		
        url = 'http://localhost/~kfircohen/MyFrame/' + controller;
        // alert(url);
        $.ajax({
			url: url,
			type: 'POST',
			// dataType: 'json',
			data: data
		})
		.done(function(msg) {
			tmp_models = msg.split("?");
        
            models = $.parseJSON(tmp_models[1]);
        
            models.forEach(function(element) {
                $("#model_select").append("<option>"+element+"</option>");
            }, this);
        })
    });

    $("#model_select").change(function (){ 
      url  = "http://localhost/~kfircohen/MyFrame/controllers/service_calls_controller.php";
      model = $(this).val();
      brand = $("#brand_select").text();
      alert(brand+" "+model);
      
    });


    $(".machine_model").hover(function () { 
        $(this).siblings().removeClass("active");
        $(this).addClass("active"); 


    });
    $(".machine_model").popover({ 
        trigger:'hover',
        placement:'auto',
        html:true,
 	 	content:function(){
                base_url = "http://localhost/~kfircohen/MyFrame/";
                brand = $(this).parent().parent().attr("id");  
 	 	    	return '<img src='+ base_url +'assets/machines_IMGs/'+ brand +'/'+ $.trim($(this).text()) + '.png ></img>';
        }
    });




   
});

function blabla () {
    alert("hello");
  }