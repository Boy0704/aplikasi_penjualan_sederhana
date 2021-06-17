<style type="text/css">
/* E-commerce */
.product-box {
  padding: 0;
  border: 1px solid #e7eaec;
}
.product-box:hover,
.product-box.active {
  border: 1px solid transparent;
  -webkit-box-shadow: 0 3px 7px 0 #a8a8a8;
  -moz-box-shadow: 0 3px 7px 0 #a8a8a8;
  box-shadow: 0 3px 7px 0 #a8a8a8;
}
.product-imitation {
  text-align: center;
  /*padding: 90px 0;*/
  background-color: #f8f8f9;
  border: 1px solid black;
  color: #bebec3;
  font-weight: 600;
}
.cart-product-imitation {
  text-align: center;
  padding-top: 30px;
  height: 80px;
  width: 80px;
  background-color: #f8f8f9;
}
.product-imitation.xl {
  padding: 120px 0;
}
.product-desc {
  padding: 20px;
  position: relative;
}
.ecommerce .tag-list {
  padding: 0;
}
.ecommerce .fa-star {
  color: #d1dade;
}
.ecommerce .fa-star.active {
  color: #f8ac59;
}
.ecommerce .note-editor {
  border: 1px solid #e7eaec;
}
table.shoping-cart-table {
  margin-bottom: 0;
}
table.shoping-cart-table tr td {
  border: none;
  text-align: right;
}
table.shoping-cart-table tr td.desc,
table.shoping-cart-table tr td:first-child {
  text-align: left;
}
table.shoping-cart-table tr td:last-child {
  width: 80px;
}
.product-name {
  font-size: 20px;
  font-weight: 600;
  color: #676a6c;
  display: block;
  margin: 2px 0 5px 0;
}
.product-name:hover,
.product-name:focus {
  color: #1ab394;
}
.product-qty {
  font-size: 14px;
  font-weight: 600;
  color: #ffffff;
  background-color: red;
  padding: 6px 12px;
  position: absolute;
  top: -32px;
  left: 0;
}
.product-price {
  font-size: 14px;
  font-weight: 600;
  color: #ffffff;
  background-color: #1ab394;
  padding: 6px 12px;
  position: absolute;
  top: -32px;
  right: 0;
}
.product-detail .ibox-content {
  padding: 30px 30px 50px 30px;
}
.image-imitation {
  background-color: #f8f8f9;
  text-align: center;
  padding: 200px 0;
}
.product-main-price small {
  font-size: 10px;
}
.product-images {
  margin: 0 20px;
}

.ibox {
  clear: both;
  margin-bottom: 25px;
  margin-top: 0;
  padding: 0;
}
.ibox.collapsed .ibox-content {
  display: none;
}
.ibox.collapsed .fa.fa-chevron-up:before {
  content: "\f078";
}
.ibox.collapsed .fa.fa-chevron-down:before {
  content: "\f077";
}
.ibox:after,
.ibox:before {
  display: table;
}
.ibox-title {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #ffffff;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 3px 0 0;
  color: inherit;
  margin-bottom: 0;
  padding: 14px 15px 7px;
  min-height: 48px;
}
.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}
.ibox-footer {
  color: inherit;
  border-top: 1px solid #e7eaec;
  font-size: 90%;
  background: #ffffff;
  padding: 10px 15px;
}
</style>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <form action="<?php echo site_url('produk/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('produk'); ?>" class="btn btn-default">Reset</a>
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
                <?php echo anchor(site_url('produk/create').'?'.param_get(),'Create', 'class="btn btn-primary"'); ?>
                
            </div>
        </div>
        

        <div class="row">
            <?php foreach ($produk_data as $produk): ?>
                
            
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <a href="#" class="product-name"> <?php echo $produk->nama_produk ?></a>
                        <div class="product-imitation">
                            <img src="image/produk/<?php echo $produk->foto ?>" width="100%">
                        </div>
                        <div class="product-desc">
                            <span class="product-qty">
                                <?php echo $retVal = (get_data('stok','id_produk',$produk->id_produk,'qty') != '') ? get_data('stok','id_produk',$produk->id_produk,'qty') : 'not set' ; ?>
                            </span>
                            <span class="product-price">
                                <?php echo number_format($produk->harga_jual) ?>
                            </span>
                            <small class="text-muted"><?php echo $produk->kategori ?></small>
                           

                            <div class="small m-t-xs">
                                <b>Harga Beli</b> : <?php echo number_format($produk->harga_beli) ?> <br>
                                <b>Supplier</b> : <?php echo get_data('supplier','id_supplier',$produk->id_supplier,'nama') ?> <br><br>

                            </div>
                            <div class="m-t text-right">

                                <a class="btn btn-xs btn-info" href="produk/update/<?php echo $produk->id_produk.'?'.param_get() ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-xs btn-danger" onclick="javasciprt: return confirm('Are You Sure ?')" href="produk/delete/<?php echo $produk->id_produk.'?'.param_get() ?>"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    