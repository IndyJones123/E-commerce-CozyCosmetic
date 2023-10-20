<style>
  div.promo div.bottom div.card:hover div.card-body p.card-text {
    color: <?= $this->config->item('default_color'); ?>;
  }
  div.product-wrapper div.main-product div.card:hover div.card-body p.card-text {
    color: <?= $this->config->item('default_color'); ?>;
  }

</style>

<div class="category-menu">
    <div class="main-category">
      <div class="item" data-toggle="modal" data-target="#modalMoreCategory">
          <img src="<?= base_url(); ?>assets/images/icon/category-more.png">
          <p>Lainnya</p>
      </div>
      <?php foreach($categoriesLimit->result_array() as $c): ?>
        <a href="<?= base_url(); ?>c/<?= $c['slug']; ?>">
          <div class="item">
              <img src="<?= base_url(); ?>assets/images/icon/<?= $c['icon']; ?>">
              <p><?= $c['name']; ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
</div>

<!-- Modal More Category -->
<div class="modal fade" id="modalMoreCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">KATEGORI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="main-category">
          <?php foreach($categories->result_array() as $c): ?>
            <a href="<?= base_url(); ?>c/<?= $c['slug']; ?>">
              <div class="item">
                  <img src="<?= base_url(); ?>assets/images/icon/<?= $c['icon']; ?>">
                  <p><?= $c['name']; ?></p>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if($promo->num_rows() > 0){ ?>
<?php if($setting['promo'] == 1){ ?>
<div class="promo">
  <div class="card-header" style="background-color: <?= $this->config->item('default_color'); ?>">
    <p class="lead text-light"><i class="fa fa-fire-alt"></i> Berakhir dalam <span id="countdownPromo"></span></p>
    <a href="<?= base_url(); ?>promo"><button class="float-right"  style="color: <?= $this->config->item('default_color'); ?>">Lihat Semua</button></a>
  </div>
  <div class="bottom">
      <?php foreach($getPromo->result_array() as $data): ?>
        <a href="<?= base_url(); ?>p/<?= $data['slug']; ?>">
          <div class="card">
            <img src="<?= base_url(); ?>assets/images/product/<?= $data['img'] ?>" class="card-img-top" >
            <div class="card-body">
              <p class="card-text mb-0"><?= $data['title'] ?></p>
              <p class="oldPrice mb-0">Rp <?= str_replace(".",",",number_format($data['price'])) ?></p>
              <p class="newPrice" style="color: <?= $this->config->item('default_color'); ?>">Rp <?= str_replace(".",",",number_format($data['promo_price'])) ?></p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
  </div>
</div>
<?php }else{ ?>
  <br><br>
<?php } ?>
<?php }else{ ?>
  <br><br>
<?php } ?>

<?php if($best->num_rows() > 0){ ?>
<div class="product-wrapper best-product">
  <h2 class="title">PRODUK TERLARIS</h2>
  <div class="main-product mt-2">
  <?php foreach($best->result_array() as $p): ?>
    <div>
        <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
          <div class="card">
            <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" class="card-img-top" >
            <div class="card-body">
              <p class="card-text mb-0"><?= $p['title']; ?></p>
              <?php if($setting['promo'] == 1){ ?>
              <?php if($p['promo_price'] == 0){ ?>
                    <p class="newPrice" style="color: <?= $this->config->item('default_color'); ?>">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php }else{ ?>
                    <p class="oldPrice mb-0">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <p class="newPrice" style="color: <?= $this->config->item('default_color'); ?>">Rp <?= str_replace(",",".",number_format($p['promo_price'])); ?></p>
                <?php } ?>
                <?php }else{ ?>
                    <p class="newPrice" style="color: <?= $this->config->item('default_color'); ?>">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php } ?>
            </div>
          </div>
        </a>
    </div>
  <?php endforeach; ?>
  <div class="clearfix"></div>
  </div>
</div>
<?php } ?>

<?php foreach($package->result_array() as $p): ?>
<div class="product-wrapper best-product">
  <h2 class="title float-left" style="text-transform: uppercase;"><?= $p['title']; ?></h2>
  <a href="<?= base_url(); ?>package/<?= $p['slug']; ?>" class="float-right">Lihat semua ></a>
  <img src="<?= base_url(); ?>assets/images/banner/<?= $p['banner'] ?>" class="banner-package" alt="banner <?= $p['title']; ?>" style="width: 100%; object-fit: cover">
  <div class="main-product">
  <?php
  $this->db->limit(6);
  $this->db->join("products", "package_product.product=products.id");
  $this->db->where('package_product.package', $p['id']);
  $packdata = $this->db->get('package_product');
  ?>
  <?php foreach($packdata->result_array() as $p): ?>
    <div>
        <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
          <div class="card">
            <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" class="card-img-top" >
            <div class="card-body">
              <?php if($setting['promo'] == 1){ ?>
              <?php if($p['promo_price'] == 0){ ?>
                    <p class="card-text line-3 mb-0"><?= $p['title']; ?></p>
                    <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php }else{ ?>
                  <p class="card-text mb-0"><?= $p['title']; ?></p>
                    <p class="oldPrice mb-0">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['promo_price'])); ?></p>
                <?php } ?>
                <?php }else{ ?>
                    <p class="card-text line-3 mb-0"><?= $p['title']; ?></p>
                    <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php } ?>
            </div>
          </div>
        </a>
    </div>
  <?php endforeach; ?>
  <div class="clearfix"></div>
  </div>
</div>
<?php endforeach; ?>

<div class="product-wrapper best-product">
  <div class="top d-flex justify-content-between">
    <h2 class="title">PRODUK TERBARU</h2>
    <a href="<?= base_url(); ?>products">Lihat semua ></a>
  </div>
  <div class="main-product mt-2">
  <?php foreach($recent->result_array() as $p): ?>
    <div>
        <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
          <div class="card">
            <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" class="card-img-top" >
            <div class="card-body">
              <?php if($setting['promo'] == 1){ ?>
              <?php if($p['promo_price'] == 0){ ?>
                    <p class="card-text line-3 mb-0"><?= $p['title']; ?></p>
                    <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php }else{ ?>
                  <p class="card-text mb-0"><?= $p['title']; ?></p>
                    <p class="oldPrice mb-0">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['promo_price'])); ?></p>
                <?php } ?>
                <?php }else{ ?>
                    <p class="card-text line-3 mb-0"><?= $p['title']; ?></p>
                    <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                <?php } ?>
            </div>
          </div>
        </a>
    </div>
  <?php endforeach; ?>
  <div class="clearfix"></div>
  </div>
</div>