 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">DATA KARYAWAN RESIGN</h5>

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
                    <a href="<?php echo base_url() ?>Karyawan"><button type="button" class="btn btn-success"><li class="fa fa-reply"></li> Kembali</button></a>
                  </div>
                  <div class="col-2">
                    
                  </div>
                  <div class="col-2"></div>
                  <div class="col-2"></div>
                  <div class="col-2"></div>
                </div>
                <br>
                <table id="example2" class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th style="width:10%">Kode Bag</th>
                      <th>Bagian</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Gaji/Jam</th>
                      <th>Lembur/Jam</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($gaji->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->KodeBagian;?></td>
                      <td><?php echo $ad->NamaBagian;?></td>
                      <td><?php echo $ad->ID_Kary;?></td>
                      <td><?php echo $ad->NamaKary;?></td>
                      <td><?php echo number_format($ad->GajiPokok,0);?></td>
                      <td><?php echo number_format($ad->GajiLembur,0);?></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#aktif-info-<?php echo $ad->ID_Karyawan;?>"><li class="fas fa-reply-all"></li> Aktif Kembali</button>
                      </td>
                    </tr>

                    <!-- modal aktif -->
                    <div class="modal fade" id="aktif-info-<?php echo $ad->ID_Karyawan;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Karyawan/update_aktif" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#007bff;color:#FFFFFF;">
                            <h4 class="modal-title">Konfirm Aktif Kembali</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Karyawan;?>" hidden>

                            <p>Apakah karyawan dengan nama <b><?php echo $ad->NamaKary;?></b> ini sudah Aktif Kembali ?</p>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Aktif</button>
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
  