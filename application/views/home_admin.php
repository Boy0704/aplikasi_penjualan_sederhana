<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success">
			<h2>Selamat datang, <?php echo $this->session->userdata('nama'); ?></h2>
		</div>
		
	</div>

</div>

<div class="row">
	<div class="col-lg-4 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
	    <div class="inner">
	      <h3><?php echo number_format(total_pendapatan()) ?></h3>

	      <p>Pendapatan hari ini</p>
	    </div>
	    <div class="icon">
	      <i class="fa fa-cart-arrow-down"></i>
	    </div>
	    <a href="penjualan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
	    <div class="inner">
	      <h3><?php echo number_format(total_pengeluaran()) ?></h3>

	      <p>Pengeluaran hari ini</p>
	    </div>
	    <div class="icon">
	      <i class="fa fa-money"></i>
	    </div>
	    <a href="pengeluaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-4 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
	    <div class="inner">
	      <h3><?php echo total_stok_habis() ?> Item</h3>

	      <p>Stok hampir habis</p>
	    </div>
	    <div class="icon">
	      <i class="ion ion-pie-graph"></i>
	    </div>
	    <a href="stok/stok_habis" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
</div>
<hr>
<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-primary">
		  <div class="panel-heading">Produk Terlaris</div>
		  <div class="panel-body">
		  	<div id="chartContainer" style="height: 300px; width: 100%;"></div>
		  </div>
		</div>
		
	</div>
	<div class="col-sm-6">
		<div class="panel panel-primary">
		  <div class="panel-heading">Pemasukan & Pengeluaran</div>
		  <div class="panel-body">
		  	<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
		  </div>
		</div>
	</div>
</div>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Produk Terlaris"
	},
	axisY: {
		title: "Jumlah"
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "Produk",
		dataPoints: [
		<?php 
		$sql = "
			SELECT id_produk, SUM(qty) qty FROM penjualan
   			GROUP BY id_produk ORDER BY qty DESC LIMIT 5;
		";
		foreach ($this->db->query($sql)->result() as $rw): ?>

			{ y: <?php echo $rw->qty ?>, label: "<?php echo get_data('produk','id_produk',$rw->id_produk,'nama_produk') ?>" },

		<?php endforeach ?>
		]
	}]
});
chart.render();


var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	title: {
		text: "Pemasukan dan Pengeluaran"
	},
	data: [{
		type: "pie",
		startAngle: 240,
		// yValueFormatString: "##0.00\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: <?php echo total_pendapatan() ?>, label: "Pemasukan"},
			{y: <?php echo total_pengeluaran() ?>, label: "Pengeluaran"}
		]
	}]
});
chart1.render();


}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
