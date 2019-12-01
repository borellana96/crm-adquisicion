<?php
check_admin();
?>
<div class="container">
		<h3>PRODUCTOS ELECTRO FISI</h3>
	<div class="row">
		<div class="col-lg-3">
			<nav class="nav"  style="background-color: #1FB3BF;">
			  <a class="nav-link "  href="./?p=crm_productos">Categorias</a>
			  <a class="nav-link active" href="./?p=crm_productos_cat">Productos</a>
			  <a class="nav-link " href="./?p=crm_productos_top">Top</a>
			</nav>	
		</div>		
	</div>
	<div class="row">
		<div class="col-md-10">
			<div id="container-productos-ventas-linear"> <!-- venta - categoria -->						
			</div>			
		</div>
	</div>	
		<br>
	<div class="row">
		<div class="col-md-5">
			<div id="container-productos-ventas"> <!-- venta - categoria -->					
			</div>			
		</div>
		<div class="col-md-5"><!--  productos preferidas -->
			<div id="container-productos-preferencia"> <!-- venta - categoria -->					
				</div>
		</div>
	</div>
	<br>
</div>
<script>
Highcharts.chart('container-productos-ventas-linear', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Ventas por productos Mensual - 2019'
    },
    subtitle: {
        text: 'Source: ElectroFisi.com'
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dec']
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
    <?php 

    	$res=$mysqli->query("SELECT count(*) FROM productos");
      $row = mysqli_fetch_row($res); 
      $num_productos = $row[0];

			for ($i = 1; $i <= $num_productos; $i++) {
			    $res=$mysqli->query("SELECT name FROM productos where id=$i");
        	$row = mysqli_fetch_row($res); 
        	$producto = $row[0];
					$cat = $mysqli->query("SELECT ifnull(t1.monto,0) as  monto
							from meses 	LEFT JOIN (
						SELECT MONTH(fecha) AS mes , cd.monto as monto 
							FROM pedidos p 
							INNER JOIN compra_detalle cd ON p.id = cd.id_pedido
					    INNER JOIN productos pr ON pr.id =cd.id_producto 
					    WHERE pr.id = $i					    		
					    GROUP BY mes ) as t1 on meses.id = t1.mes ");		
		?>
			{		name: "<?php echo $producto;?>"	,
					data: [			
						<?php 						
						while($ct=mysqli_fetch_row($cat)){
						?>
							<?php echo round($ct[0]); ?> ,						
						<?php 
							}
						?>
					 ]
			},
		<?php
			}
    ?>
    ]
});

	Highcharts.chart('container-productos-ventas', {
		chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Rentabilidad de Productos - 2019'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
	series: [{
		name: 'Ventas',
			data: [
				<?php
				$res=$mysqli->query("SELECT round(sum(monto)) FROM compra_detalle");
				$row = mysqli_fetch_row($res); 
				$sum = $row[0];
        $cat = $mysqli->query("SELECT pr.name , round(sum(cd.monto)) as monto
					    FROM compra_detalle cd
					    INNER JOIN productos pr ON pr.id = cd.id_producto 					   
					    GROUP BY pr.id	");
        	while($ct=mysqli_fetch_array($cat)){
							?>
							{ name: '<?php echo $ct['name'];?>' , y: <?php echo round($ct['monto']/$sum,2);?>},	    
			<?php } ?>
			]
	}]
});


</script>