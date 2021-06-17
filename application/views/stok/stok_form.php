
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Produk <?php echo form_error('id_produk') ?></label>
            <select name="id_produk" class="form-control">
                <option value="<?php echo $id_produk ?>"><?php echo get_data('produk','id_produk',$id_produk,'nama_produk') ?></option>
                <?php foreach ($this->db->get('produk')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_produk ?>"><?php echo $rw->nama_produk ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Qty <?php echo form_error('qty') ?></label>
            <input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" />
        </div>
	    <input type="hidden" name="id_stok" value="<?php echo $id_stok; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('stok') ?>" class="btn btn-default">Cancel</a>
	</form>
   