
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <form action="<?php echo site_url('pengeluaran/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pengeluaran'); ?>" class="btn btn-default">Reset</a>
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
                <?php echo anchor(site_url('pengeluaran/create'),'Create', 'class="btn btn-primary"'); ?>
                
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tanggal</th>
		<th>Keterangan</th>
		<th>Biaya</th>
		<th>Action</th>
            </tr><?php
            foreach ($pengeluaran_data as $pengeluaran)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pengeluaran->tanggal ?></td>
			<td><?php echo $pengeluaran->keterangan ?></td>
			<td><?php echo number_format($pengeluaran->biaya) ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pengeluaran/update/'.$pengeluaran->id_pengeluaran),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('pengeluaran/delete/'.$pengeluaran->id_pengeluaran),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    