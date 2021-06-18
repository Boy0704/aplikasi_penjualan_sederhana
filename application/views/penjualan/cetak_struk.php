<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="<?php echo base_url() ?>">
	<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<title>Cetak Struk</title>
</head>
<body onload="print()">

	<center>
		<h3>Daily Pet Care</h3>
	</center>

<table>
	<tr>
		<td><b>No. <?php echo $this->uri->segment(3) ?></b></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td><?php echo date('Y-m-d') ?></td>
	</tr>

	<tr>
		<td>Pegawai</td>
		<td><?php echo $this->session->userdata('nama'); ?></td>
	</tr>
</table>

<hr>
<table class="table">
	<thead>
		<tr>
			<th>Item</th>
			<th>Harga</th>
			<th>Qty</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->cart->contents() as $items): ?>

		<tr>
			<td><?php echo $items['name']; ?></td>
			<td>Rp <?php echo $this->cart->format_number($items['price']); ?></td>
			<td><?php echo $items['qty']; ?></td>
			<td>Rp <?php echo $this->cart->format_number($items['subtotal']); ?></td>
			
		</tr>

		<?php endforeach; ?>

		<tr>
			<td colspan="2"></td>
			<td><b>Total Bayar</b></td>
			<td><b>Rp <?php echo $this->cart->format_number($this->cart->total()); ?></b></td>
		</tr>
	</tbody>
</table>

</body>
</html>