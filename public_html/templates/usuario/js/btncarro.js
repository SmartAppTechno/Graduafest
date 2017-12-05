/*$('.btn_add').click(
function(obj){
	obj.preventDefault(); //STOP default action
	obj.unbind(); //unbind. to stop multiple form submit.
	$("#ajaxform").submit(function(e)
	{	
		var postData = obj.serializeArray();//$(this).serializeArray();
		var formURL = obj.attr("action");//$(this).attr("action");
		alert("Hola");
		alert(JSON.stringify(postData));
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data) 
			{
				alert(data);
			},
			error: function(data) 
			{
				alert("error "+data);    
			}
		});
		obj.preventDefault(); //STOP default action
		obj.unbind(); //unbind. to stop multiple form submit.
	});
	$("#ajaxform").submit(obj);
}/*);

$(function () {
    $('form').on('submit', function (e) {
		var postData =$(this).serializeArray();
		var formURL = $(this).attr("action");
		alert("Hola");
		alert(JSON.stringify(postData));
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data) 
			{
				alert(data);
			},
			error: function(data) 
			{
				alert("error "+data);    
			}
		});
		e.preventDefault(); //STOP default action
		e.unbind(); //unbind. to stop multiple form submit.
    });
});*/
