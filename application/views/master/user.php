 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">            
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">DATA USER</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <div class="col-md-2">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Tambah</button>
                </div>
                <div class="col-md-2">
                </div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($user->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NamaUser;?></td>
                      <td><?php echo $ad->Username;?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" style="color:white;" data-toggle="modal" data-target="#ganti-info-<?php echo $ad->ID_User;?>"><li class="fas fa-lock"></li> Ganti Password</button>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#ubah-info-<?php echo $ad->ID_User;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_User;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal ganti password -->
                    <div class="modal fade" id="ganti-info-<?php echo $ad->ID_User;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>User/update_password" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#ffc107;color:#000000;">
                            <h4 class="modal-title">Ganti Password</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_User;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Password <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="password" name="pass" class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Simpan</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- modal ubah -->
                    <div class="modal fade" id="ubah-info-<?php echo $ad->ID_User;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>User/update" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:#FFFFFF;">
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Nama <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="nama" value="<?php echo $ad->NamaUser;?>" class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Username <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="user" value="<?php echo $ad->Username;?>" class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                            <input type="text" name="id" value="<?php echo $ad->ID_User;?>" hidden>

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
                    <div class="modal fade" id="hapus-info-<?php echo $ad->ID_User;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>User/hapus" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Hapus</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_User;?>" hidden>

                            <p>Apakah mau menghapus data user dengan nama <b><?php echo $ad->NamaUser;?></b> ini ?</p>

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
      <form action="<?php echo base_url() ?>User/simpan" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#28a745;color:#FFFFFF;">
          <h4 class="modal-title">Tambah User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nama" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Username <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="user" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Password <span>*</span></label>
            <div class="col-sm-9">
              <input type="password" name="pass" class="form-control" autocomplete="off" required>
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