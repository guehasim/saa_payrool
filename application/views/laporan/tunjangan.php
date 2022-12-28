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
                <h5 class="card-title">DATA TUNJANGAN PERIODE <b><?php echo $this->session->userdata('ses_tunjangan_nm_periode');?></b></h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <div class="col-md-4">
                  <a href="<?php echo base_url() ?>Tunjangan"><button type="button" class="btn btn-primary"><li class="fa fa-reply"></li> Kembali</button></a>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Tambah</button>
                </div>
                <div class="col-md-2">
                </div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Status</th>
                      <th>Department</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Total Tunjangan</th>
                      <th>Keterangan</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($tunjangan->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NamaStatusKaryawan;?></td>
                      <td><?php echo $ad->NamaBagian;?></td>
                      <td><?php echo $ad->ID_Kary;?></td>
                      <td><?php echo $ad->NamaKary;?></td>
                      <td><?php echo number_format($ad->TotalTunjangan,0);?></td>
                      <td><?php echo $ad->KetTunjangan;?></td>
                      <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#ubah-info-<?php echo $ad->ID_Tunjangan;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Tunjangan;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal ubah -->
                    <div class="modal fade" id="ubah-info-<?php echo $ad->ID_Tunjangan;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Tunjangan/update_tunjangan" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:#FFFFFF;">
                            <h4 class="modal-title">Edit Tunjangan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Karyawan <span>*</span></label>
                              <div class="col-sm-9">
                                <select class="form-control select2" name="karyawan">
                                  <option></option>
                                  <?php foreach ($karyawan->result() as $as): ?>
                                    <?php
                                      if ($ad->ID_Kary == $as->ID_Kary) {
                                         $tampil = "selected";
                                       }else{
                                          $tampil = "";
                                       } 
                                     ?>
                                    <option value="<?php echo $as->ID_Kary;?>" <?php echo $tampil;?>><?php echo $as->ID_Kary.' - '.$as->NamaKary;?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Nilai Tunjangan <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="total" value="<?php echo $ad->TotalTunjangan;?>"  class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
                              <div class="col-sm-9">
                                <input type="text" name="keterangan" class="form-control" value="<?php echo $ad->KetTunjangan;?>"  autocomplete="off">
                              </div>
                            </div>

                            <input type="text" name="id" value="<?php echo $ad->ID_Tunjangan;?>" hidden>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Simpan</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- modal hapus -->
                    <div class="modal fade" id="hapus-info-<?php echo $ad->ID_Tunjangan;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Tunjangan/hapus_tunjangan" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Hapus Tunjangan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Tunjangan;?>" hidden>

                            <p>Apakah mau menghapus data user dengan nama <b><?php echo $ad->NamaKary;?></b> ini ?</p>

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
      <form action="<?php echo base_url() ?>Tunjangan/simpan_tunjangan" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#28a745;color:#FFFFFF;">
          <h4 class="modal-title">Tambah Tunjangan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Karyawan <span>*</span></label>
            <div class="col-sm-9">
              <select class="form-control select2" name="karyawan">
                <option></option>
                <?php foreach ($karyawan->result() as $as): ?>
                  <option value="<?php echo $as->ID_Kary ?>"><?php echo $as->ID_Kary.' - '.$as->NamaKary;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <input type="text" name="jenis" value="0" hidden>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nilai Tunjangan <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="total" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-9">
              <input type="text" name="keterangan" class="form-control" autocomplete="off">
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