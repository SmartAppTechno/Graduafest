<script>
$(function () {
    $('form').on('submit', function (e) {
		var postData =$(this).serializeArray();
		var formURL = $(this).attr("action");
		//alert("Hola");
		//alert(JSON.stringify(postData));
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data) 
			{
				//alert(data);
                alert("Agregado exitosamente al carrito.")
			},
			error: function(data) 
			{
				//alert("error "+data);    
			}
		});
		e.preventDefault(); //STOP default action
		e.unbind(); //unbind. to stop multiple form submit.
    });
});

</script>