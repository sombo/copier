jQuery(document).ready(function($) {
	$("#btn_save_form").click(function(event) {
		my_form = $('form');
		form_data = my_form.serializeArray();
		console.log(form_data);
		controller  = my_form.attr('action');
		controller = controller.slice(3, controller.length);
		url = 'http://localhost/~kfircohen/MyFrame/' + controller;
		
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'text',
			data: form_data,
		})
		.done(function(msg) {
			if(msg === "success")
				$("#show_form_errors").text("הפרטים נשמרו בהצלחה");
			else
				$("#show_form_errors").text(msg);
		})
		.fail(function(msg) {
		
			$("#show_form_errors").text("לא נוצרה תקשורת, נסה שוב...");
		})
		.always(function() {
			console.log("complete");
		});
		
	});


	$(".indexTable").click(function(){
 	 			//var img= $(this).children().first().next().next().text();
 	 			//alert(img);
 	 			console.log($(this).find('#obj_id'));
 	 			var model = $(this).parent().parent().attr("id");
 	 			var id= $(this).find('#obj_id').text();
 	 			console.log(model + "  " + id);
 	 			window.location.href = "http://localhost/~kfircohen/MyFrame/"+model+"/"+id;

 	 			//alert("ssds");
 	 			//window.location("http://localhost/~kfircohen/copier/");
 	 		});



});