<?php
check_admin();

?>
<div class="container">
	<h3>Modulo CRM CLientes </h3>
	<div class="row">
		<div class="col-md-10">
			<div id="container-incremento-clientes"> <!-- venta - categoria -->			
			</div>			
		</div>
	</div>
			<br>
	<div class="row">
		<div class="col-lg-5">
			<div id="container-torta-clientes"></div>
		</div>
		<div class="col-lg-5">
			<div id="container-edad-clientes"></div>
		</div>	
	</div>

	<h2>Aquí estará una lista con los clientes que más han gastado en la empresa.</h2> 
	
	<h2>Cada cliente tendrá su Detalle
	información básica, productos preferidos en torta y últimas compras</h2>

	<br/>
	<div class="col-lg-10">
		<table class="table table-hover table-primary">
		<tr class="thead-dark" >
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Fecha de Nacimiento</th>
			<th>Email</th>
			<th>Sexo</th>
	    <th>Direccion</th>
	    <th>TOTAL compras</th>
	    <th>Detalles</th>
		</tr>

		<?php
			$clie = $mysqli->query("SELECT c.*, ifnull(sum(p.monto),0) as total FROM clientes c
				left JOIN pedidos p ON p.id_cliente=c.id
				GROUP BY c.id;
				");
			while($rp=mysqli_fetch_array($clie)){
				?>
					<tr>
						<td><?=$Nombres=$rp['nombres']?></td>
						<td><?=$Apellidos=$rp['apellidos']?></td>
						<td><?=$Nacimiento=$rp['nacimiento']?></td>
						<td><?=$Nacimiento=$rp['email']?></td>
						<td><?=$Sexo=$rp['sexo']?></td>
						<td><?=$Dirección=$rp['direccion']?></td>
						<td>S/.&nbsp;<?=$Inscripción=round($rp['total'])?></td>	
						<td>
							<a  style="color:#08f" href="?p=crm_cliente_detalle&id=<?=$rp['id']?>">
								<i class="fa fa-eye"></i>
							</a>
						</td>						
					</tr>	
				<?php
			}
		?>

	</table>	
	</div>

</div>

<script>
var categories = [
		'0-18',
    '18-24', '25-29', '30-34', '35-39',
    '40-44', '45-49', '50-54', '55-59',
    '60-64', '65-+', 
];

Highcharts.chart('container-edad-clientes', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Clientes por sexo y edad, 2019'
    },
    subtitle: {
        text: 'Source: ElectroFisi.com'
    },
    xAxis: [{
        categories: categories,
        reversed: false,
        labels: {
            step: 1
        }
    }, { // mirror axis on right side
        opposite: true,
        reversed: false,
        categories: categories,
        linkedTo: 0,
        labels: {
            step: 1
        }
    }],
    yAxis: {
        title: {
            text: null
        },
        labels: {
            formatter: function () {
                return Math.abs(this.value) + '%';
            }
        }
    },

    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },

    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + ', edad ' + this.point.category + '</b><br/>' +
                'Personas: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
        }
    },

    series: [{
        name: 'Hombres',
        data: [ -1.0,
            -2.7, -3.0, -3.3, -3.2,
            -2.9, -3.5, -4.4, -4.1,
            -1.0, -0.0
        ]
    }, {
        name: 'Mujeres',
        data: [ 1.0,
               2.6, 2.0, 0.0, 2.1,
            1.9, 1.4, 1.3, 2.0,
            1.0, 0.0
        ]
    }]
});

	Highcharts.chart('container-incremento-clientes', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Clientes registrados en el sistema'
    },
    subtitle: {
        text: 'Source: ElectroFisi.com'
    },
    xAxis: {
        categories:['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Cantidad clientes'
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
    <?php 
				$cat = $mysqli->query("SELECT ifnull(count(c.id),0) as cantidad
				from meses LEFT JOIN clientes c ON meses.id = month(c.inscripcion)
				group by meses.id ORDER BY meses.id ");	
		?>
    series: [
			{		name: '# Clientes registrados',

					data: [ 
					<?php 						
						while($ct=mysqli_fetch_row($cat)){
						?>	
							<?php echo $ct[0]; ?> ,						
						<?php 
							}
						?>
					]
			}
    ]
});

	Highcharts.chart('container-torta-clientes', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Compras por cliente, 2019'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Compra',
        data: [
         <?php
        	$res=$mysqli->query("SELECT round(sum(monto)) FROM pedidos");
        	  $row = mysqli_fetch_row($res); 
        	  $sum = $row[0];

        		$cat = $mysqli->query("SELECT c.* , round(sum(p.monto)) as monto
					    FROM pedidos p
					    INNER JOIN clientes c ON c.id = p.id_cliente		
					    GROUP BY c.id	");
					while($ct=mysqli_fetch_array($cat)){
						?>
						{ name: '<?php echo $ct['nombres'].' '.$ct['apellidos'];?>' , y: <?php echo round($ct['monto']/$sum,2);?>},	    
	       <?php } ?>
        ]
    }]
	});
</script>