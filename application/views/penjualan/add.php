<div class="row">
	<div class="col-md-6"></div>
	<div class="col-md-4"></div>
	<div class="col-md-2">
		<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary"><i class="fa fa-plus"></i> Pilih Produk</a>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama Produk</th>
					<th>Kategori Produk</th>
					<th>Qty</th>
					<th>Harga</th>
					<th>Subtotal</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($this->cart->contents() as $items): ?>

				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $items['name']; ?></td>
					<td><?php echo get_data('produk','id_produk',$items['id'],'kategori'); ?></td>
					<td><?php echo $items['qty']; ?></td>
					<td>Rp <?php echo $this->cart->format_number($items['price']); ?></td>
					<td>Rp <?php echo $this->cart->format_number($items['subtotal']); ?></td>
					<td>
						<a href="penjualan/hapus_cart/<?php echo $items['rowid'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>

				<?php $i++; endforeach; ?>

				<tr>
					<td colspan="4"></td>
					<td><b>Total Bayar</b></td>
					<td><b>Rp <?php echo $this->cart->format_number($this->cart->total()); ?></b></td>
				</tr>
			</tbody>
		</table>
	</div>

	<!-- Modal -->
	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Produk</h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	          	<div class="col-md-12">
	          		<input type="text" name="cari" id="search" class="form-control" placeholder="Cari nama produk">
	          	</div>
	          	<hr>
	          	<div style="height: 300px; overflow: scroll;">
	          		<form action="penjualan/simpan_cart/<?php echo kode_urut() ?>" method="POST">
	          		<table id="table">
	          			<?php
	          			$this->db->order_by('id_produk', 'desc');
	          			$produk_data = $this->db->get('produk');
	          			foreach ($produk_data->result() as $produk):
	          				$qty = 0;
	          			 ?>
	          				<?php foreach ($this->cart->contents() as $items):
	          					
	          					if ($produk->id_produk == $items['id']) {
	          						$qty = $items['qty'];
	          					}
	          				 ?>
	          				<?php endforeach; ?>
	          			<tr>
	          				<td>
	          					<img  src="image/produk/<?php echo $produk->foto ?>" width="100px;" style="padding: 10px;">
	          				</td>
	          				<td style="padding: 10px;">
	          					<b><?php echo $produk->nama_produk ?></b> <br>
	          					<?php echo number_format($produk->harga_jual) ?> <br>
	          					Sisa <?php echo $retVal = (get_data('stok','id_produk',$produk->id_produk,'qty') != '') ? get_data('stok','id_produk',$produk->id_produk,'qty') : '0' ; ?>
	          				</td>
	          				<td style="padding: 10px;">
	          					<a onclick="kurang('<?php echo $produk->id_produk ?>')" id="kurang_<?php echo $produk->id_produk ?>" class="btn btn-xs btn-success"><i class="fa fa-minus"></i></a> 

	          					<span style="padding-left: 5px; padding-right: 5px;" id="qty_<?php echo $produk->id_produk ?>"><?php echo $qty ?></span> 
	          					<input type="hidden" id="qty1_<?php echo $produk->id_produk ?>" name="qty[]" value="<?php echo $qty ?>">
	          					<input type="hidden" name="id_produk[]" value="<?php echo $produk->id_produk ?>">

	          					<a onclick="tambah('<?php echo $produk->id_produk ?>')" id="tambah_<?php echo $produk->id_produk ?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></a>
	          				</td>
	          			</tr>
	          			<?php endforeach ?>
	          		</table>
	          		
	          	</div>
	          </div>
	        </div>
	        <div class="modal-footer">
	          <button type="submit" class="btn btn-info">Save</button>
	        </div>
	        </form>
	      </div>
	      
	    </div>
	  </div>
	  

</div>

<div class="row">
	<div class="col-md-6"></div>
	<div class="col-md-4"></div>
	<div class="col-md-2">
		<a href="penjualan/cetak_struk/<?php echo kode_urut() ?>" target="_blank" class="btn btn-info"> Print</a>
		<a href="penjualan/save_penjualan/<?php echo kode_urut() ?>" class="btn btn-success"> Save</a>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var $rows = $('#table tr'); 

	$('#search').keyup(function() {
	    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	    $rows.show().filter(function() {
	        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	        return !~text.indexOf(val);
	    }).hide();
	});
});

function tambah(id_produk) {
	var qty = $("#qty_"+id_produk).text();
	var hasil = parseInt(qty) + 1;
	$("#qty_"+id_produk).text(hasil);
	$("#qty1_"+id_produk).val(hasil);
}

function kurang(id_produk) {
	var qty = $("#qty_"+id_produk).text();
	var hasil = parseInt(qty) - 1;
	$("#qty_"+id_produk).text(hasil);
	$("#qty1_"+id_produk).val(hasil);
}

</script>