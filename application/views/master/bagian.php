   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">DATA DEPARTEMENT</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Tambah</button>
                  </div>
                  <div class="col-2">
                    
                  </div>
                  <div class="col-2"></div>
                  <div class="col-4">
                    <form action="<?php echo base_url()?>Bagian" method="post">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" value="<?php echo $this->session->userdata('ses_cari_bagian');?>">
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
                    <tr>
                      <th>No.</th>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>KABAG</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($bagian->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->KodeBagian;?></td>
                      <td><?php echo $ad->NamaBagian;?></td>
                      <td><?php echo $ad->KepalaBagian;?></td>
                      <td>
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ubah-info-<?php echo $ad->ID_Bagian;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Bagian;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal edit -->
                    <div class="modal fade" id="ubah-info-<?php echo $ad->ID_Bagian;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Bagian/update" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:white;">
                            <h4 class="modal-title">Edit Gaji Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Bagian;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Kode<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="kode" value="<?php echo $ad->KodeBagian;?>" class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Nama<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="nama" value="<?php echo $ad->NamaBagian;?>" class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">KABAG<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="kabag" value="<?php echo $ad->KepalaBagian;?>" class="form-control" autocomplete="off" required>
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

                    <!-- modal resign -->
                    <div class="modal fade" id="hapus-info-<?php echo $ad->ID_Bagian;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Bagian/hapus" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Hapus Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Bagian;?>" hidden>

                            <p>Apakah mau menghapus <b><?php echo $ad->NamaBagian;?></b> ini ?</p>

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
      <form action="<?php echo base_url() ?>Bagian/simpan" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#28a745;color:#FFFFFF;">
          <h4 class="modal-title">Tambah Bagian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <?php
          $rand = rand(100, 999); 
           ?>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Kode <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="kode" value="<?php echo 'DPT-'.$rand;?>" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nama" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">KABAG <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="kabag" class="form-control" autocomplete="off" required>
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