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
                <h5 class="card-title" style="padding-top:10px">DATA ABSEN KARYAWAN</h5>
                
                <div class="card-tools">                                  
                  
                    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Absen Manual</button> -->
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <form action="<?php echo base_url() ?>Absen/refresh2" method="post">
                <div class="row">
                  <div class="col-2">
                    
                  </div>
                  <div class="col-2">
                    
                  </div>
                  <div class="col-2">
                    <select class="form-control select2" name="periode" required>
                      <option value="0">--Pilih Periode--</option>
                      <?php foreach ($periode->result() as $ad): ?>
                        <option value="<?php echo $ad->ID_periode;?>"><?php echo date('F Y',strtotime($ad->NamaPeriode));?></option>
                      <?php endforeach ?>
                    </select> 
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-secondary">Refresh Data</button>
                  </div>
                  <div class="col-2">
                    
                  </div>
                  <div class="col-2">
                    
                  </div>
                </div>
                </form>

                <br>

                <form action="<?php echo base_url() ?>Absen" method="post">
                <div class="row">
                  <div class="col-2">
                    <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_awal_absensi');?>" class="form-control" name="tgl_awal" placeholder="Tanggal Awal">
                  </div>
                  <p style="padding-top: 5px;">S.D.</p>
                  <div class="col-2">
                    <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_akhir_absensi');?>" class="form-control" name="tgl_akhir" placeholder="Tanggal Akhir">
                  </div>
                  <div class="col-3">
                    <select class="form-control select2" name="bagian">
                      <option value="">--Department--</option>
                      <?php foreach ($bagian->result() as $ad): ?>
                        <?php
                          if ($this->session->userdata('ses_bagian_absensi') == $ad->ID_Bagian) {
                             $pilih = "selected";
                           }else{
                            $pilih = "";
                           } 
                         ?>
                        <option value="<?php echo $ad->ID_Bagian;?>" <?php echo $pilih;?>><?php echo $ad->NamaBagian;?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-2">
                    <select class="form-control select2" name="status">
                      <option value="">--Status--</option>
                      <?php foreach ($status->result() as $ae): ?>
                        <?php
                          if ($this->session->userdata('ses_status_absensi') == $ae->ID_StatusKaryawan) {
                             $pilihx = "selected";
                           }else{
                            $pilihx = "";
                           } 
                         ?>
                        <option value="<?php echo $ae->ID_StatusKaryawan;?>" <?php echo $pilihx;?>><?php echo $ae->NamaStatusKaryawan;?></option>
                      <?php endforeach ?>
                    </select>
                  </div> 
                  <div class="col-2">
                    <input type="text" placeholder="NIK Karyawan" value="<?php echo $this->session->userdata('ses_karyawan_absensi');?>" name="karyawan" class="form-control">
                  </div>
                                   
                </div>

                <div class="row">
                  <div class="col-2">

                  </div>
                  <div class="col-2">

                  </div>

                  <div class="col-4">
                    <div class="input-group">
                      <span class="input-group-append" style="padding-left: 5px;">
                        <input type="submit" name="cek" class="btn btn-primary" style="border-radius: 0.25rem;" value="Search">
                      </span>

                      <span class="input-group-append" style="padding-left: 5px;">
                        <input type="submit" name="cek" class="btn btn-warning" style="border-radius: 0.25rem;color: white;" value="Reset">
                      </span>

                      <span class="input-group-append" style="padding-left: 5px;">
                        <input type="submit" name="cek" class="btn btn-info" style="border-radius: 0.25rem;" formtarget="_blank" value="Print">
                      </span>

                      <span class="input-group-append" style="padding-left: 5px;">
                        <input type="submit" name="cek" class="btn btn-success" style="border-radius: 0.25rem;" value="Excel">
                      </span>
                    </div>
                  </div> 

                  <div class="col-2">

                  </div>
                  <div class="col-2">

                  </div>                 
                </div>
                </form>
                <br>
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Status</th>
                      <th>Department</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>Jam Masuk</th>
                      <th>Jam Pulang</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if ($nomor == 'index') {
                        $tampil = 1;
                      }else{
                        $tampil = $nomor+1;                       
                      }
                    ?>
                    <?php $no=$tampil; foreach ($gaji->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NamaStatusKaryawan;?></td>
                      <td><?php echo $ad->NamaBagian;?></td>
                      <td><?php echo $ad->ID_Kary;?></td>
                      <td><?php echo $ad->NamaKary;?></td>
                      <td><?php echo date('d M y',strtotime($ad->Tanggal));?></td>
                      <td>                        
                        <?php if ($ad->JamIn == NULL): ?>
                           <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#jamin-info-<?php echo $ad->ID_Kalkulasi;?>"><li class="fas fa-clock"></li> Atur Jam Masuk</button>
                        <?php else: ?> 
                          <?php echo substr($ad->JamIn, 11,8);?>
                        <?php endif ?>  
                      </td>
                      <td>
                        <?php if ($ad->JamOut == NULL): ?>
                          <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#jamout-info-<?php echo $ad->ID_Kalkulasi;?>"><li class="fas fa-clock"></li> Atur Jam Pulang</button>
                        <?php else: ?>
                          <?php echo substr($ad->JamOut, 11,8);?>
                        <?php endif ?>                       
                        </td>
                      <td>
                        <?php if ($ad->JamIn != NULL && $ad->JamOut != NULL): ?>
                          <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-info-<?php echo $ad->ID_Kalkulasi;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <?php else: ?>
                          
                        <?php endif ?>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Kalkulasi;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal edit -->
                    <div class="modal fade" id="edit-info-<?php echo $ad->ID_Kalkulasi;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Absen/update_absensi" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:white;">
                            <h4 class="modal-title">Edit Absensi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Kalkulasi;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Masuk<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="time" name="jam_masuk" class="form-control" value="<?php echo date('H:i:s',strtotime($ad->JamIn));?>" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Keluar<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="time" name="jam_keluar" class="form-control" value="<?php echo date('H:i:s',strtotime($ad->JamOut));?>" required>
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

                    <!-- modal jam in -->
                    <div class="modal fade" id="jamin-info-<?php echo $ad->ID_Kalkulasi;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Absen/update_jammasuk" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#007bff;color:white;">
                            <h4 class="modal-title">Edit Jam Masuk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Kalkulasi;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Masuk<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="time" name="jam_masuk" class="form-control" required>
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- modal jam out -->
                    <div class="modal fade" id="jamout-info-<?php echo $ad->ID_Kalkulasi;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Absen/update_jamkeluar" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#28a745;color:white;">
                            <h4 class="modal-title">Edit Jam Keluar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Kalkulasi;?>" hidden>

                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Keluar<span>*</span></label>
                              <div class="col-sm-9">
                                <input type="time" name="jam_keluar" class="form-control" required>
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">SIMPAN</button>
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
      <form action="<?php echo base_url() ?>Absen/simpan_manual" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#0C77D9;color:#FFFFFF;">
          <h4 class="modal-title">Tambah Absen Manual</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">ID Karyawan <span>*</span></label>
            <div class="col-sm-9">
              <select class="form-control select2" name="karyawan" style="width: 100%;">
                <option value=""></option>
                <?php foreach ($karyawan->result() as $ax): ?>
                  <option value="<?php echo $ax->ID_Kary;?>"><?php echo $ax->ID_Kary;?> - <?php echo $ax->Nama;?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" id="startdate" name="tgl" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#startdate" autocomplete="off" />
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Masuk <span>*</span></label>
            <div class="col-sm-9">
              <input type="password" name="pass" class="form-control" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Jam Keluar <span>*</span></label>
            <div class="col-sm-9">
              <input type="password" name="pass" class="form-control" autocomplete="off" required>
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
  