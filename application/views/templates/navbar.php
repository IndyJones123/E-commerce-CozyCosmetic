<?php
$settingss = $this->db->get('settings')->row_array();
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
  <div class="container">
  <a class="navbar-brand mr-5" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/logo/<?= $settingss['logo']; ?>" alt="logo" width="100"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <i class="fa text-light ml-3 icon-search-navbar mobile-search fa-search"></i>

    <div class="collapse navbar-collapse ml-3" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url(); ?>">Beranda</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kategori
          </a>
          <?php $categories = $this->Categories_model->getCategories(); ?>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownCategories">
            <?php foreach($categories->result_array() as $cat): ?>
              <a class="dropdown-item" href="<?= base_url(); ?>c/<?= $cat['slug']; ?>"><?= $cat['name']; ?></a>
            <?php endforeach; ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?= base_url(); ?>products">Semua Produk</a>
        </li>
      </ul>
      <i class="fa text-light icon-search-navbar desktop-search fa-search"></i>
      <br>
      <a href="<?= base_url(); ?>cart" class="text-light navbar-cart-inform">
        <i class="fa fa-shopping-cart"></i>
        <?php if($this->cart->total_items() > 0){ ?>
          Keranjang(<?= count($this->cart->contents()); ?>)
        <?php }else{ ?>
          Keranjang
        <?php } ?>
      </a>
      <br>
      <br>
    </div>
  </div>
</nav>
<div class="top-nav"></div>

<div class="search-form">
  <i class="fa fa-times"></i>
  <form action="<?= base_url(); ?>search" method="get">
    <input type="text" placeholder="Cari produk" autocomplete="off" name="q"><!--
    --><button type="submit">Cari</i></button>
  </form>
</div>
<div class="top-nav"></div>
