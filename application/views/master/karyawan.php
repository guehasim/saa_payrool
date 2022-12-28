   <style>
    .select2-container .select2-selection--single {
      box-sizing: border-box;
      cursor: pointer;
      display: block;
      height: 39px;
      user-select: none;
      -webkit-user-select: none;
  </style>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">DATA KARYAWAN</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Tambah</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-import"><li class="fa fa-upload"></li> Import</button>
                    <a href="<?php echo base_url() ?>Karyawan/resign"><button type="button" class="btn btn-warning" style="color:white;"><li class="fa fa-window-close"></li> Riwayat Resign</button></a>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-4">
                    <form action="<?php echo base_url()?>Karyawan" method="post">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" value="<?php echo $this->session->userdata('ses_cari');?>">
                        <span class="input-group-append" style="padding-left: 5px;">
                          <input type="submit" name="cek" class="btn btn-primary" style="border-radius: 0.25rem;" value="Cari">
                        </span>

                        <span class="input-group-append" style="padding-left: 5px;">
                          <input type="submit" name="cek" class="btn btn-warning" style="border-radius: 0.25rem;color: white;" value="Reset">
                        </span>
                      </div>
                    </form>
                  </div>
                </div>
                <br>
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr style="background-color: #007bff;color: white;">
                      <th>No.</th>
                      <th>STATUS</th>
                      <th>DEPARTMENT</th>
                      <th>KABAG</th>
                      <th>NIK</th>
                      <th>NAMA</th>
                      <th>GAJI/JAM</th>
                      <th>LEMBUR/JAM</th>
                      <th>FOTO</th>
                      <th></th>
                    </tr>
                  </thead>
                  <?php 
                    if ($nomor == 'index') {
                      $tampil = 1;
                    }else{
                      $tampil = $nomor+1;                       
                    }
                  ?>
                  <tbody>
                    <?php $no=$tampil; foreach ($gaji->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NamaStatusKaryawan;?></td>
                      <td><?php echo $ad->NamaBagian;?></td>
                      <td><?php echo $ad->KepalaBagian;?></td>
                      <td><?php echo $ad->ID_Kary;?></td>
                      <td><?php echo $ad->NamaKary;?></td>
                      <td><?php echo number_format($ad->GajiPokok,0);?></td>
                      <td><?php echo number_format($ad->GajiLembur,0);?></td>
                      <td>
                        <?php if ($ad->FotoKaryawan != NULL): ?>                          
                          <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/<?php echo $ad->FotoKaryawan;?>" style="height: 100px; display: block;">
                        <?php else: ?>
                           <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/no_image.jpg" style="height: 100px; display: block;">
                        <?php endif ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-warning btn-xs" style="color:white;" data-toggle="modal" data-target="#resign-info-<?php echo $ad->ID_Karyawan;?>"><li class="fas fa-window-close"></li> Resign</button>
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ubah-info-<?php echo $ad->ID_Karyawan;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Karyawan;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal edit -->
                    <div class="modal fade" id="ubah-info-<?php echo $ad->ID_Karyawan;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Karyawan/update" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:white;">
                            <h4 class="modal-title">Edit Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Karyawan;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">NIK <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="nik" class="form-control" value="<?php echo $ad->ID_Kary;?>" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Nama <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" value="<?php echo $ad->NamaKary;?>" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Status <span>*</span></label>
                              <div class="col-sm-9">
                                <select class="form-control select2" name="status">
                                  <option value=""></option>
                                  <?php foreach ($status->result() as $as): ?>
                                    <?php
                                    if ($ad->StatusKaryawan == $as->ID_StatusKaryawan) {
                                        $tampil = "selected";
                                     } else{
                                        $tampil = "";
                                     }
                                     ?>
                                    <option value="<?php echo $as->ID_StatusKaryawan;?>" <?php echo $tampil;?>> <?php echo $as->NamaStatusKaryawan;?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Bagian <span>*</span></label>
                              <div class="col-sm-9">
                                <select class="form-control select2" name="bagian">
                                  <option value=""></option>
                                  <?php foreach ($bagian->result() as $as): ?>
                                    <?php
                                    if ($ad->BagianKary == $as->ID_Bagian) {
                                        $tampil = "selected";
                                     } else{
                                        $tampil = "";
                                     }
                                     ?>
                                    <option value="<?php echo $as->ID_Bagian;?>" <?php echo $tampil;?>><?php echo $as->KodeBagian;?> - <?php echo $as->NamaBagian;?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Gaji Pokok <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="gajipokok" class="form-control" value="<?php echo $ad->GajiPokok;?>" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Gaji Lembur <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="gajilembur" class="form-control" value="<?php echo $ad->GajiLembur;?>" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Foto </label>
                              <div class="col-sm-9">
                                <?php if ($ad->FotoKaryawan != NULL): ?>                          
                                  <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/<?php echo $ad->FotoKaryawan;?>" style="height: 100px; display: block;">
                                <?php else: ?>
                                   <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/no_image.jpg" style="height: 100px; display: block;">
                                <?php endif ?>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label"> </label>
                              <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" autocomplete="off">
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">SIMPAN</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- modal hapus -->
                    <div class="modal fade" id="hapus-info-<?php echo $ad->ID_Karyawan;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Karyawan/hapus" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Hapus Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Karyawan;?>" hidden>

                            <p>Apakah karyawan dengan nama <b><?php echo $ad->NamaKary;?></b> ini mau dihapus ?</p>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- modal resign -->
                    <div class="modal fade" id="resign-info-<?php echo $ad->ID_Karyawan;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Karyawan/update_status" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#ffc107;color:#FFFFFF;">
                            <h4 class="modal-title">Konfirmasi Resign</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Karyawan;?>" hidden>

                            <p>Apakah karyawan dengan nama <b><?php echo $ad->NamaKary;?></b> ini sudah resign ?</p>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning" style="color:white;"> Sudah Resign</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <?php endforeach ?>
                    </tbody>
                  </table>                  
                  <br>
                  <?php echo $links;?>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- modal tambah -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <form action="<?php echo base_url() ?>Karyawan/simpan" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#28a745;color:#FFFFFF;">
          <h4 class="modal-title">Tambah Karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">NIK <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nik" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nama" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Status <span>*</span></label>
            <div class="col-sm-9">
              <select class="form-control select2" name="status">
                <option value=""></option>
                <?php foreach ($status->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_StatusKaryawan;?>"><?php echo $ad->NamaStatusKaryawan;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Bagian <span>*</span></label>
            <div class="col-sm-9">
              <select class="form-control select2" name="bagian">
                <option value=""></option>
                <?php foreach ($bagian->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_Bagian;?>"><?php echo $ad->KodeBagian;?> - <?php echo $ad->NamaBagian;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Gaji Pokok <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="gajipokok" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Gaji Lembur <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="gajilembur" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Foto </label>
            <div class="col-sm-9">
              <input type="file" name="image" class="form-control" autocomplete="off">
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- /.modal -->
  

      <!-- modal import -->
  <div class="modal fade" id="modal-import">
    <div class="modal-dialog">
      <form action="<?php echo base_url() ?>Import/importFile" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#17a2b8;color:#FFFFFF;">
          <h4 class="modal-title">Upload Data Karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">File <span>*</span></label>
            <div class="col-sm-9">
              <input type="file" name="uploadFile" class="form-control" autocomplete="off">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
              <label>Format Excel Klik <a href="<?php echo base_url() ?>assets/upload/file/upload_karyawan.xlsx" style="color:#020af2">Download </a></label>
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Upload</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- /.modal -->