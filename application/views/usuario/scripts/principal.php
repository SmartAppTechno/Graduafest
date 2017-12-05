<script>
$(document).ready(function() {
 
  $("#form_r").hide();
});

    var images = [];
    images[0] = "http://graduafestzac.com.mx/imagenes_portada/Portada1.jpg";
    images[1] = "http://graduafestzac.com.mx/imagenes_portada/Portada2.jpg";
    images[2] = "http://graduafestzac.com.mx/imagenes_portada/Portada3.jpg";
	images[3] = "http://graduafestzac.com.mx/imagenes_portada/Portada4.jpg";


    var i = 1;
    setInterval(fadeDivs, 8000);

    function fadeDivs() {
        i = i < images.length ? i : 0;
        /*$('.headerP').fadeOut(100, function(){
            $(this).attr('background-image', images[i]).fadeIn(100);
        })*/
        $("#headerP").css("background-image", "url("+images[i]+")");
        i++;
    }
	
	$( "#registrar" ).click(function() {
		$("#form_r").toggle();
	});
	
	 // Initialize and Configure Scroll Reveal Animation
    window.sr = ScrollReveal();
    sr.reveal('.sr-icons', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 200);
    sr.reveal('.sr-button', {
        duration: 1000,
        delay: 200
    });
    sr.reveal('.sr-contact', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 300);
</script>