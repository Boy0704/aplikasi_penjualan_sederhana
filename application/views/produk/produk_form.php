
        <form action="<?php echo $action.'?'.param_get(); ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Nama Produk <?php echo form_error('nama_produk') ?></label>
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kategori <?php echo form_error('kategori') ?></label>
            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Harga Beli <?php echo form_error('harga_beli') ?></label>
            <input type="text" class="form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Harga Jual <?php echo form_error('harga_jual') ?></label>
            <input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga Jual" value="<?php echo $harga_jual; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Supplier <?php echo form_error('id_supplier') ?></label>
            <select name="id_supplier" class="form-control">
                <option value="<?php echo $id_supplier ?>"><?php echo get_data('supplier','id_supplier',$id_supplier,'nama') ?></option>
                <?php foreach ($this->db->get('supplier')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_supplier ?>"><?php echo $rw->nama ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Foto</label>
            <input type="file" class="form-control" name="foto" />
            <input type="hidden" name="foto_old" value="<?php echo $foto ?>">
            <div>
                <?php if ($foto != ''): ?>
                    <b>*) Foto Sebelumnya : </b><br>
                    <img src="image/produk/<?php echo $foto ?>" style="width: 100px;">
                <?php endif ?>
            </div>
        </div>
	    <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('produk').'?'.param_get() ?>" class="btn btn-default">Cancel</a>
	</form>
   