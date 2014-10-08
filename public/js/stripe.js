$(document).ready(function(){
	Stripe.setPublishableKey('pk_test_SolyzwuW6biBpmOvoqZhRuL6');

	$("#subscription-form button").on('click',function(){
		var form  = $("#subscription-form");
		var submit = form.find('button');
		var submitName = submit.text();

		submit.attr('disabled','disabled').text("Just on moment...");

		Stripe.card.createToken(form,function(status,response){
			if (response.error) 
			{
				$("#stripe-error").text(response.error.message);
				$("#stripe-error").removeClass("hide");
				submit.removeAttr('disabled').text(submitName);
			}
			else
			{
				token = response.id;
				form.append($('<input type="hidden" name="token">').val(token));
				form.submit();
			}
		});
	});
});