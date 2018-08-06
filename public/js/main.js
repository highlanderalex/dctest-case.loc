$(document).ready(function(){
	$("#fill-table").click(function(){
	$("#result").css("display", "none");
     $.ajax({
         url: '/main/filltable',
         type: 'GET',
		 beforeSend: function(){
			showAlert('Идет заполнение таблиц. Ждите...');
		 },
         success: function(res){
			$(".modal-alert").fadeOut();

			var result = '';
			if(res.clients){
                result += '<strong>' + res.clients + '</strong><br>';
			}
			
			if(res.orders){
                result += '<strong>' + res.orders + '</strong><br>';
			}
				
			if(res.error){
				result += '<strong>Error: </strong>' + res.error + '<br>';
			}

            $(".alert-success").html(result);
            $("#result").fadeIn(200);
         },
         error: function(){
			$(".modal-alert").fadeOut();
            alert('Сервер временно недоступен!');
         }
     });
	});
});

function showAlert(msg, type = 'error'){
	var color = '';
	$(".modal-alert p").text(msg);
	if(type == 'success'){
		color = '#2E8B57';
		$(".alert-header").css('background', color);
		$(".modal-alert h3").text('Message!');
		$(".alert-body").css('color', color);
	} else{
		color = '#CD5C5C';
		$(".alert-header").css('background', color);
		$(".modal-alert h3").text('Внимание!');
		$(".alert-body").css('color', color);
	}
	$(".modal-alert").fadeIn();
}
