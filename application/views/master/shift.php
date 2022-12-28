 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">            
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">DATA SHIFT KERJA</h5>
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
                      <th>Nama Shift</th>
                      <th>Jam Masuk</th>
                      <th>Jam Pulang</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($shift->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NamaShift;?></td>
                      <td><?php echo date('H:i:s',strtotime($ad->JamStart));?></td>
                      <td><?php echo date('H:i:s',strtotime($ad->JamEnd));?></td>
                      <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#ubah-info-<?php echo $ad->ID_Shift;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Shift;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal ubah -->
                    <div class="modal fade" id="ubah-info-<?php echo $ad->ID_Shift;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Shift/update" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:#FFFFFF;">
                            <h4 class="modal-title">Edit Shift Kerja</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Shift <span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" name="nama" value="<?php echo $ad->NamaShift;?>" class="form-control" autocomplete="off" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Masuk<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="time" name="jam" value="<?php echo date('H:s',strtotime($ad->JamStart));?>" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Pulang<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="time" name="jam_pulang" value="<?php echo date('H:s',strtotime($ad->JamEnd));?>" class="form-control" required>
                              </div>
                            </div>

                            <input type="text" name="id" value="<?php echo $ad->ID_Shift;?>" hidden>

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
                    <div class="modal fade" id="hapus-info-<?php echo $ad->ID_Shift;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Shift/hapus" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Hapus</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Shift;?>" hidden>

                            <p>Apakah mau menghapus shift <b><?php echo $ad->NamaShift;?></b> ini ?</p>

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
      <form action="<?php echo base_url() ?>Shift/simpan" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#28a745;color:#FFFFFF;">
          <h4 class="modal-title">Tambah Shift Kerja</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Shift<span>*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nama" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Masuk<span>*</span></label>
            <div class="col-sm-9">
              <input type="time" name="jam" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9 custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="ket" id="customCheckbox1" value="1">
              <label for="customCheckbox1" class="custom-control-label">Besok</label>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Pulang<span>*</span></label>
            <div class="col-sm-9">
              <input type="time" name="jam_pulang" class="form-control" required>
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