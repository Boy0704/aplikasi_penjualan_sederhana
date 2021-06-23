<div class="row">
	<div class="col-md-2">
		<a href="app/cetak_laporan" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print / Cetak PDF</a>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2" style="text-align: center;">No</th>
					<th rowspan="2" style="text-align: center;">Tanggal</th>
					<th rowspan="2" style="text-align: center;">Keterangan</th>
					<th colspan="2" style="text-align: center;">Jenis</th>
				</tr>
				<tr>
					<th style="text-align: center;">Pemasukan</th>
					<th style="text-align: center;">Pengeluaran</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$total_debit = 0;
				$total_kredit = 0;

				$no = 1;
				$sql = "
					SELECT 
					a.tanggal,
					a.kat,
					a.keterangan,
					a.nilai,
					a.created_at
					FROM 
					(select tanggal, 'pemasukan' as kat , '' as keterangan , subtotal as nilai, created_at FROM penjualan UNION select tanggal, 'pengeluaran' as kat ,keterangan , biaya as nilai, created_at FROM pengeluaran) as a

					order by a.created_at

				";
				foreach ($this->db->query($sql)->result() as $row): 
					$nilai_debit = 0;
					$nilai_kredit = 0;
					if ($row->kat == 'pemasukan') {
						$nilai_debit = $row->nilai;
						$total_debit = $total_debit + $nilai_debit;
					} else {
						$nilai_kredit = $row->nilai;
						$total_kredit = $total_kredit + $nilai_kredit;
					}

					?>
					<tr>
						<td style="text-align: center;"><?php echo $no; ?></td>
						<td><?php echo $row->tanggal ?></td>
						<td><?php echo $retVal = ($row->kat == 'pemasukan') ? 'Pemasukan dari penjualan' : $row->keterangan ; ?></td>
						<td><?php echo number_format($nilai_debit) ?></td>
						<td><?php echo number_format($nilai_kredit) ?></td>
					</tr>
				<?php $no++; endforeach ?>
				<tr>
					<td align="right" colspan="3"><b>Total</b></td>
					<td><b>Rp <?php echo number_format($total_debit) ?></b></td>
					<td><b>Rp <?php echo number_format($total_kredit) ?></b></td>
				</tr>
				<tr>
					<td align="right" colspan="3"><b>Saldo</b></td>
					<td align="center" colspan="2" class="alert alert-info"><b>Rp <?php echo number_format($total_debit-$total_kredit) ?></b></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>