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
		.fail(function(msg) {
		
			$("#show_form_errors").text("לא נוצרה תקשורת, נסה שוב...");
		})
		.always(function() {
			console.log("complete");
		});
    });

});