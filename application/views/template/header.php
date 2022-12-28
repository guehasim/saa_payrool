<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT Sido Agung Alumi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/bs-stepper/css/bs-stepper.min.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/content2/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?php echo base_url() ?>assets/content2/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?php echo base_url() ?>Login/logout" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i> Sign Out
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url() ?>Dashboard" class="brand-link">
      <img src="<?php echo base_url() ?>assets/content2/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> PT.SIDO AGUNG ALUMI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->

      <div class="user-panel  d-flex">
        <div class="info">
          <a href="" class="d-block">Selamat Datang, <br><h4 style="color:#fad570"><?php echo $this->session->userdata('ses_NamaUser');?></h4></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php 

          if ($menu == 'dashboard') {
            $dashboard      = "active";
            $master         = "menu-close";
            $sub_master     = "";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-close";
            $mesinabsen     = "";
            $sub_laporan    = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif ($menu == 'user') {
            $dashboard      = "";
            $master         = "menu-open";
            $sub_master     = "active";
            $user           = "active";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-close";
            $mesinabsen     = "";
            $sub_laporan    = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif ($menu == 'status') {
            $dashboard      = "";
            $master         = "menu-open";
            $sub_master     = "active";
            $user           = "";
            $status         = "active";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-close";
            $mesinabsen     = "";
            $sub_laporan    = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif ($menu == 'bagian') {
            $dashboard      = "";
            $master         = "menu-open";
            $sub_master     = "active";
            $user           = "";
            $status         = "";
            $bagian         = "active";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-close";
            $mesinabsen     = "";
            $sub_laporan    = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif($menu == 'periode'){
            $dashboard      = "";
            $master         = "menu-open";
            $sub_master     = "active";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "active";
            $shift          = "";
            $laporan        = "menu-close";
            $mesinabsen     = "";
            $sub_laporan    = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif($menu == 'shift'){
            $dashboard      = "";
            $master         = "menu-open";
            $sub_master     = "active";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "active";
            $laporan        = "menu-close";
            $mesinabsen     = "";
            $sub_laporan    = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif ($menu == 'karyawan') {
            $dashboard      = "";
            $master         = "menu-open";
            $sub_master     = "active";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "active";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-close";
            $mesinabsen     = "";
            $sub_laporan    = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif ($menu == 'mesinabsen') {
            $dashboard      = "";
            $master         = "menu-close";
            $sub_master     = "";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-open";
            $sub_laporan    = "active";
            $mesinabsen     = "active";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif ($menu == 'absen') {
            $dashboard      = "";
            $master         = "menu-close";
            $sub_master     = "";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-open";
            $sub_laporan    = "active";
            $mesinabsen     = "";
            $absen          = "active";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif($menu == 'lembur'){
            $dashboard      = "";
            $master         = "menu-close";
            $sub_master     = "";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-open";
            $sub_laporan    = "active";
            $mesinabsen     = "";
            $absen          = "";
            $lembur         = "active";
            $tunjangan      = "";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif($menu == 'tunjangan'){
            $dashboard      = "";
            $master         = "menu-close";
            $sub_master     = "";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-open";
            $sub_laporan    = "active";
            $mesinabsen     = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "active";
            $gaji           = "";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tgl_awal_gaji','ses_tgl_akhir_gaji')); //gaji karyawan

            $id = $this->session->userdata('ses_IdUser');
            $this->db->query("DELETE FROM temp_gaji WHERE ID_User = '$id' ");
          }elseif($menu == 'gaji'){
            $dashboard      = "";
            $master         = "menu-close";
            $sub_master     = "";
            $user           = "";
            $status         = "";
            $bagian         = "";
            $karyawan       = "";
            $periode        = "";
            $shift          = "";
            $laporan        = "menu-open";
            $sub_laporan    = "active";
            $mesinabsen     = "";
            $absen          = "";
            $lembur         = "";
            $tunjangan      = "";
            $gaji           = "active";

            $this->session->unset_userdata(array('ses_cari_bagian')); //department
            $this->session->unset_userdata(array('ses_cari')); //karyawan
            $this->session->unset_userdata(array('ses_tgl_awal_absen','ses_tgl_akhir_absen','ses_karyawan_absen','ses_bagian_absen','ses_status_absen')); //Mesin Absen
            $this->session->unset_userdata(array('ses_tgl_awal_absensi','ses_tgl_akhir_absensi','ses_karyawan_absensi','ses_bagian_absensi','ses_status_absensi')); //Rekap Absen
            $this->session->unset_userdata(array('ses_tgl_awal_lembur','ses_tgl_akhir_lembur','ses_karyawan_lembur','ses_bagian_lembur','ses_status_lembur')); //rekap lembur
            $this->session->unset_userdata(array('ses_tunjangan_periode','ses_tunjangan_nm_periode')); //rekap tunjangan
          }?>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>Dashboard" class="nav-link <?php echo $dashboard;?>" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item <?php echo $master;?>">
            <a href="#" class="nav-link <?php echo $sub_master;?>" >
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php echo $user;?>">
                <a href="<?php echo base_url() ?>User" class="nav-link <?php echo $user;?>" >
                  <i class="fa fa-user nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item <?php echo $status;?>">
                <a href="<?php echo base_url() ?>Statuskaryawan" class="nav-link <?php echo $status;?>" >
                  <i class="fa fa-id-card nav-icon"></i>
                  <p>Status Karyawan</p>
                </a>
              </li>
              <li class="nav-item <?php echo $bagian;?>">
                <a href="<?php echo base_url() ?>Bagian" class="nav-link <?php echo $bagian;?>" >
                  <i class="fa fa-columns nav-icon"></i>
                  <p>Departement</p>
                </a>
              </li>
              <li class="nav-item <?php echo $periode;?>">
                <a href="<?php echo base_url() ?>Periode" class="nav-link <?php echo $periode;?>" >
                  <i class="fa fa-calendar nav-icon"></i>
                  <p>Periode</p>
                </a>
              </li>
              <li class="nav-item <?php echo $shift;?>">
                <a href="<?php echo base_url() ?>Shift" class="nav-link <?php echo $shift;?>" >
                  <i class="fa fa-clock nav-icon"></i>
                  <p>Shift Kerja</p>
                </a>
              </li>
              <li class="nav-item <?php echo $karyawan;?>">
                <a href="<?php echo base_url() ?>Karyawan" class="nav-link <?php echo $karyawan;?>" >
                  <i class="fa fa-users nav-icon"></i>
                  <p>Karyawan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php echo $laporan;?>">
            <a href="#" class="nav-link <?php echo $sub_laporan;?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php echo $mesinabsen;?>">
                <a href="<?php echo base_url() ?>MesinAbsen" class="nav-link <?php echo $mesinabsen;?>">
                  <i class="fa fa-fingerprint nav-icon"></i>
                  <p>Mesin Absen</p>
                </a>
              </li>
              <li class="nav-item <?php echo $absen;?>">
                <a href="<?php echo base_url() ?>Absen" class="nav-link <?php echo $absen;?>">
                  <i class="fa fa-clipboard nav-icon"></i>
                  <p>Rekap Absen</p>
                </a>
              </li>
              <li class="nav-item <?php echo $lembur;?>">
                <a href="<?php echo base_url() ?>Lembur" class="nav-link <?php echo $lembur;?>">
                  <i class="fa fa-business-time nav-icon"></i>
                  <p>Rekap Lembur</p>
                </a>
              </li>
              <li class="nav-item <?php echo $tunjangan;?>">
                <a href="<?php echo base_url() ?>Tunjangan" class="nav-link <?php echo $tunjangan;?>">
                  <i class="fa fa-percent nav-icon"></i>
                  <p>Tunjangan & Potongan</p>
                </a>
              </li>
              <li class="nav-item <?php echo $gaji;?>">
                <a href="<?php echo base_url() ?>Gaji" class="nav-link <?php echo $gaji;?>">
                  <i class="fa fa-money-bill nav-icon"></i>
                  <p>Rekap Gaji</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>