
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                

                <form action="<?php echo site_url('penjualan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('penjualan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <?php echo anchor(site_url('penjualan/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="20px">No</th>
		<th>Tanggal</th>
		<th>Nama Produk</th>
		<th>Qty</th>
		<th>Harga</th>
        <th>Subtotal</th>
		<th>Total Bayar</th>
		<th width="50px">Action</th>
            </tr><?php
            foreach ($penjualan_data as $penjualan)
            {
                $total_bayar = 0;
                ?>
                <tr>
			<td width="20px"><?php echo ++$start ?></td>
			<td><?php echo $penjualan->tanggal ?></td>
			<td>
                <?php 
                $this->db->where('no_trx', $penjualan->no_trx);
                foreach ($this->db->get('penjualan')->result() as $rw): ?>
                    <p><?php echo get_data('produk','id_produk',$rw->id_produk,'nama_produk') ?></p>
                <?php endforeach ?>


            </td>
			<td>
                <?php 
                $this->db->where('no_trx', $penjualan->no_trx);
                foreach ($this->db->get('penjualan')->result() as $rw): ?>
                    <p><?php echo $rw->qty ?></p>
                <?php endforeach ?>         
            </td>
			<td>
                <?php 
                $this->db->where('no_trx', $penjualan->no_trx);
                foreach ($this->db->get('penjualan')->result() as $rw): ?>
                    <p><?php echo $rw->harga ?></p>
                <?php endforeach ?>         
            </td>
			<td>
                <?php 
                $this->db->where('no_trx', $penjualan->no_trx);
                foreach ($this->db->get('penjualan')->result() as $rw): ?>
                    <p><?php echo number_format($rw->subtotal); $total_bayar = $total_bayar + $rw->subtotal ?></p>
                <?php endforeach ?>         
            </td>
            <td>
                <?php echo number_format($total_bayar) ?>
            </td>
			<td style="text-align:center" width="50px">
				<?php 
				echo anchor(site_url('penjualan/delete/'.$penjualan->no_trx),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    