<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link
      href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo/favicon.png" type="image/x-icon">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/select2-4.0.6-rc.1/dist/css/select2.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>

    <link
      rel="shortcut icon"
      href="<?= base_url();  ?>assets/images/logo/<?= $this->Settings_model->getSetting()['favicon']; ?>"
      type="image/x-icon"
    />

    <link rel="stylesheet" media="screen" type="text/css" href="<?= base_url(); ?>assets/css/colorpicker.css" />

    <style>

      /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      /* Firefox */
      input[type=number] {
        -moz-appearance: textfield;
      }

      .ck-editor__editable_inline {
          min-height: 300px;
      }

      .description-product-detail {
        color: #666;
      }

      .description-product-detail h2 {
        font-size: 22px;
      }

      .description-product-detail h3 {
        font-size: 19px;
      }

      .description-product-detail h4 {
        font-size: 17px;
      }

      .description-product-detail p {
        font-size: 14.5px;
      }

      .description-product-detail img {
        width: 50%;
      }

    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body id="page-top">
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
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul
        class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="<?= base_url(); ?>administrator"
        >
          <div class="sidebar-brand-icon rotate">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <div class="sidebar-brand-text mx-3">History Pemesanan</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <?php 
        $email = $this->session->userdata('email');
        $conditions = array(
          'process' => 0,
          'email' => $email
        );

        $orders = $this->db->get_where('invoice', $conditions);
        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>historypemesanan">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pesanan</span> <small class="badge badge-warning"><?= $orders->num_rows() ?> new</small></a
          >
        </li>

       

        <br />

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav
            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
          >
            <!-- Sidebar Toggle (Topbar) -->
            <button
              id="sidebarToggleTop"
              class="btn rounded-pill btn-link d-md-none rounded-circle mr-3"
            >
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form
              class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
            >
              <div class="input-group">
                <input
                  type="text"
                  class="form-control bg-light border-0 small"
                  placeholder="Search for..."
                  name="search"
                />
                <div class="input-group-append">
                  <button class="btn rounded-pill btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form> -->

          </nav>
          <!-- End of Topbar -->
