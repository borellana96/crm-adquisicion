<?php
check_admin();


//select from facebook if equal nothing else save
?>
<div class="container">
		<h3>Redes Sociales</h3>
		<div class="row">
			<div class="col-md-10">
				<div id="container-redes-sociales"> <!-- venta - categoria -->			
				</div>			
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-4">				
				<a href="https://www.facebook.com/ElectroFisi-111352460315834/" target="_blank">
					<img src="https://logodownload.org/wp-content/uploads/2014/09/facebook-logo-1.png"
					 alt="" height="80">
				</a>
				<p><br></p>
				<div id="container-facebook" style="" > <!-- facebook -->		
					<div class="info-box " style=" width: 300px;">
	            <span class="info-box-icon " style="background-color: #0E94DC;">
	            	<img src="https://image.flaticon.com/icons/png/512/126/126473.png" 
	            	alt="fb" height="60">
	            </span>
	            <div class="info-box-content">
	              <span  class="info-box-text">Likes</span>
	              <span class="info-box-number" id="likes"></span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
				</div>	
				<div id="container-facebook" style="" > <!-- facebook -->		
					<div class="info-box " style=" width: 300px;">
	             <span class="info-box-icon " style="background-color: #0E94DC;">
	            	<img src="https://cdn3.iconfinder.com/data/icons/web-31/24/post-512.png" 
	            	alt="fb" height="70">
	            </span>
	            <div class="info-box-content">
	              <span  class="info-box-text">Posts</span>
	              <span class="info-box-number" id="posts"></span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
				</div>	
				<div id="container-facebook" style="" > <!-- facebook -->		
					<div class="info-box " style=" width: 300px;">
	             <span class="info-box-icon " style="background-color: #0E94DC;">
	            	<img src="https://static.thenounproject.com/png/344403-200.png" 
	            	alt="fb" height="70">
	            </span>
	            <div class="info-box-content">
	              <span  class="info-box-text">Mensajes sin leer</span>
	              <span class="info-box-number" id="sin_leer"></span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
				</div>			
			</div>
			<div class="col-lg-1"> 
				
			</div>
			<div class="col-lg-6"><!--  categorias preferidas -->
				<a href="https://twitter.com/windows?lang=es" target="_blank">
					<img src="https://www.fourjay.org/myphoto/f/110/1100282_twitter-logo-icon-png.png"
					 alt="" height="80">
				</a>
					 <p></br></p>
				<div id="container-twitter" style="" > <!-- facebook -->		
					<div class="info-box " style=" width: 400px;">
	            <span class="info-box-icon bg-info">
	            	<img src="https://www.trzcacak.rs/myfile/full/338-3383200_followers-png-transparent-background-followers-png.png" 
	            	alt="tw" height="50">
	            </span>
	            <div class="info-box-content">
	              <span  class="info-box-text">Seguidores </span>
	              <span class="info-box-number" >4</span>
	            </div>
	            <!-- /.info-box-content -->
	        </div>
	        <div class="info-box " style=" width: 400px;">
	            <span class="info-box-icon bg-info">
	            	<img src="https://icons-for-free.com/iconfiles/png/512/follow+following+twitter+icon-1320196031920300840.png" 
	            	alt="tw" height="100">
	            </span>
	            <div class="info-box-content">
	              <span  class="info-box-text">Seguidos </span>
	              <span class="info-box-number" id="">12</span>
	            </div>
	            <!-- /.info-box-content -->
	        </div>
		      <div class="info-box " style=" width: 400px;">
	            <span class="info-box-icon bg-info">
	            	<img src="https://cdn3.iconfinder.com/data/icons/twitter-ui/48/jee01-39-512.png" 
	            	alt="fb" height="100">
	            </span>
	            <div class="info-box-content">
	              <span  class="info-box-text">Nuevos tweets en la semana </span>
	              <span class="info-box-number" id="">3</span>
	            </div>
	            <!-- /.info-box-content -->
	        </div>
				</div>	
			</div>
		</div>	
</div>
	<h2>Aquí estará los productos con promociones más comprados</h2> 	
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script>

	$( document ).ready(function() {
		var $likes = $('#likes');
		var $sin_leer = $('#sin_leer');
		var $posts = $('#posts');
    $.ajax({
        url: 'https://graph.facebook.com/v5.0/111352460315834?fields=id%2Cname%2Cunseen_message_count%2Cfan_count%2Cposts&access_token=EAAS8F23cRGEBAAcIUYSpF9Gign9ZCINwZAQuH9Ia9hppFmRZAc374olhNurqwWL22ogArQq8RS6XCcuVbx2lVNmzlHmpoDP2XbxTLdT7T0s1xzGHZAzsHTomyVcHwR4iBWX11dMJzDBoy8UH5eUS3OQa0JVJtalDw0ZC0H3KeQgZDZD',
        type: 'GET',
        success: function(respuesta) {
        	console.log(respuesta);
        	$likes.text(respuesta.fan_count);
					$sin_leer.text(respuesta.unseen_message_count);
					let posts = respuesta.posts.data.length;
					$posts.text(posts);
				
        },
        error: function() {
            console.error("No es posible completar la operación");
        }
    });

});

	Highcharts.chart('container-redes-sociales', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Ultima Semana Likes - Followers Redes Sociales'
    },
    subtitle: {
        text: 'Source: https://www.facebook.com/ElectroFisi-111352460315834'
    },
    xAxis: {
        categories: ['Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes' , 'Martes']
    },
    yAxis: {
        title: {
            text: 'Monto Ventas'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
			{		name: 'Facebook',
					data: [ 1,1,1,2,3,4,5,5,5,6]
			},
			{		name: 'Twitter',
					data: [ 5,5,6,8,8,8,8,10,15,16]
			}
    ]
});
</script>