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
                  <div class="col-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Tambah</button>
                  </div>
                  <div class="col-3"></div>
                  <div class="col-2"></div>
                  <div class="col-4">
                    <form action="<?php echo base_url()?>Karyawan" method="post">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" value="<?php echo $this->session->userdata('ses_cari');?>">
                        <span class="input-group-append" style="padding-left: 5px;">
                          <input type="submit" name="cek" class="btn btn-primary" style="border-radius: 0.25rem;" value="Cari">
                        </span>

                        <span class="input-group-append" style="padding-left: 5px;">
                          <input type="submit" name="cek" class="btn btn-warning" style="border-radius: 0.25rem;" value="Reset">
                        </span>
                      </div>
                    </form>
                  </div>
                </div>
                <br>
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Department</th>
                      <th>Jabatan</th>
                      <th>No.Kartu</th>
                      <th>Photo</th>
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
                    <?php $no=$tampil; foreach ($karyawan->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NikUser;?></td>
                      <td><?php echo $ad->NamaUser;?></td>
                      <td><?php echo $ad->DeptUser;?></td>
                      <td><?php echo $ad->NamaJabatan;?></td>
                      <td><?php echo $ad->NoKartu;?></td>
                      <td>
                        <?php if ($ad->ImageUser != NULL): ?>
                          <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/<?=$ad->ImageUser;?>" style="height: 100px; display: block;">
                        <?php else: ?>
                          <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/no_image.png" style="height: 100px; display: block;">
                        <?php endif ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ganti-info-<?php echo $ad->ID_User;?>"><li class="fas fa-pencil-alt"></li> Ganti Kartu</button>
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ubah-info-<?php echo $ad->ID_User;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_User;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal ganti kartu -->
                    <div class="modal fade" id="ganti-info-<?php echo $ad->ID_User;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Karyawan/ganti_kartu" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#ffc107;color:black;">
                            <h4 class="modal-title">Ganti Kartu</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_User;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Kartu Baru<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="no_kartu" class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">SIMPAN</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>


                    <!-- modal ubah -->
                    <div class="modal fade" id="ubah-info-<?php echo $ad->ID_User;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Karyawan/update" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:#FFFFFF;">
                            <h4 class="modal-title">Edit Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_User;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">NIK <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="nik" class="form-control" value="<?php echo $ad->NikUser;?>" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Nama <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" value="<?php echo $ad->NamaUser;?>" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Department <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="dept" class="form-control" value="<?php echo $ad->DeptUser;?>" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jabatan <span>*</span></label>
                              <div class="col-sm-9">
                                <select class="form-control" name="jabatan" required>
                                  <option value=""></option>
                                  <?php foreach ($jabatan->result() as $as): ?>
                                    <?php
                                    if ($ad->ID_Jabatan == $as->ID_Jabatan) {
                                        $tampil = "selected";
                                     }else{
                                        $tampil = "";
                                     } 
                                     ?>
                                    <option value="<?php echo $as->ID_Jabatan;?>" <?php echo $tampil;?>><?php echo $as->NamaJabatan;?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>                            

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Photo</label>
                              <div class="col-sm-9">
                                <?php if ($ad->ImageUser != NULL): ?>
                                  <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/<?=$ad->ImageUser;?>" style="height: 100px; display: block;">
                                <?php else: ?>
                                  <img class="img-responsive avatar-view" src="<?=base_url()?>assets/upload/images/no_image.png" style="height: 100px; display: block;">
                                <?php endif ?>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
                              <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" autocomplete="off">
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- modal hapus -->
                    <div class="modal fade" id="hapus-info-<?php echo $ad->ID_User;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Karyawan/hapus" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Hapus</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_User;?>" hidden>

                            <p>Apakah mau menghapus data karyawan dengan nama <b><?php echo $ad->NamaUser;?></b> ini ?</p>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
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
        <div class="modal-header" style="background-color:#0C77D9;color:#FFFFFF;">
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
            <label for="inputEmail3" class="col-sm-3 col-form-label">Department <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="dept" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Jabatan <span>*</span></label>
            <div class="col-sm-9">
              <select class="form-control" name="jabatan" required>
                <option value=""></option>
                <?php foreach ($jabatan->result() as $ad): ?>
                  <option value="<?php echo $ad->ID_Jabatan;?>"><?php echo $ad->NamaJabatan;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">No.Kartu <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="no_kartu" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Photo</label>
            <div class="col-sm-9">
              <input type="file" name="image" class="form-control" autocomplete="off">
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- /.modal -->
  