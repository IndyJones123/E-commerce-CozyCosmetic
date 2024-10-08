<!doctype html>
<html lang="id-ID">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/css/app-responsive.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/css/<?= $css;  ?>.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/css/<?= $responsive;  ?>.css">

    <link
      rel="shortcut icon"
      href="<?= base_url(); ?>assets/images/logo/<?= $this->Settings_model->getSetting()['favicon']; ?>"
      type="image/x-icon"
    />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/2baad1d54e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?= base_url();  ?>assets/icofont/icofont.min.css">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
    <link rel="stylesheet" href="<?= base_url(); ?>assets/select2-4.0.6-rc.1/dist/css/select2.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/lightbox2-2.11.1/dist/css/lightbox.css">

    <title><?= $title ?></title>

    <!--Indicator Scroll-->
    <style type='text/css'>
      /*Indicator*/
      .progress-container{width:100%;position:fixed;top:0;left:0;z-index:9999}.progress-bar{height:5px;background:<?= $this->config->item('default_color'); ?>;width:0%}
      /*Scroll*/
      html{scrollbar-width:thin}
      html::-webkit-scrollbar{width:5px;background-color:#F5F5F5}
      html::-webkit-scrollbar-thumb{background-color:<?= $this->config->item('default_color'); ?>;border-radius:0px}
      .element{scrollbar-width:thin}
      .element::-webkit-scrollbar{width:5px;background-color:#F5F5F5}
      .element::-webkit-scrollbar-thumb{background-color:<?= $this->config->item('default_color'); ?>;border-radius:0px}
    </style>

  </head>
  <body>

  <div class="loading-animation-screen">
    <div class="overlay-screen"></div>
    <img src="<?= base_url(); ?>assets/images/icon/loading.gif" alt="loading.." class="img-loading">
  </div>

  <?php
  $setting = $this->db->get('settings')->row_array();
  $dateNow = date('Y-m-d H:i');
  $dateDB = $setting['promo_time'];
  $dateDBNew = str_replace("T"," ",$dateDB);
  if($dateNow >= $dateDBNew){
    $this->db->set('promo', 0);
    $this->db->update('settings');
  }
  ?>