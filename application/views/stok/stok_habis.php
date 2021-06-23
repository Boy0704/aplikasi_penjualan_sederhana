<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<tr>
				<td>No.</td>
				<td>Nama Produk</td>
				<td>QTY</td>
			</tr>
			<?php
			$no = 1;
			$sql = "SELECT id_produk, qty FROM stok where qty < 5";
			 foreach ($this->db->query($sql)->result() as $rw): ?>
			
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo get_data('produk','id_produk',$rw->id_produk,'nama_produk') ?></td>
				<td><?php echo $rw->qty ?></td>
			</tr>
			<?php $no++; endforeach ?>
		</table>
	</div>
</div>