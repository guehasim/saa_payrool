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
                <h5 class="card-title">DATA VALIDASI LEMBUR</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <form action="<?php echo base_url() ?>Lembur" method="post">
                <div class="row">
                  <div class="col-2">
                    <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_awal_lembur');?>" class="form-control" name="tgl_awal" placeholder="Tanggal Awal">
                  </div>
                  <p style="padding-top: 5px;">S.D.</p>
                  <div class="col-2">
                    <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_akhir_lembur');?>" class="form-control" name="tgl_akhir" placeholder="Tanggal Akhir">
                  </div>
                  <div class="col-3">
                    <select class="form-control select2" name="bagian">
                      <option value="">--Department--</option>
                      <?php foreach ($bagian->result() as $ad): ?>
                        <?php
                          if ($this->session->userdata('ses_bagian_lembur') == $ad->ID_Bagian) {
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
                          if ($this->session->userdata('ses_status_lembur') == $ae->ID_StatusKaryawan) {
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
                    <input type="text" placeholder="NIK Karyawan" value="<?php echo $this->session->userdata('ses_karyawan_lembur');?>" name="karyawan" class="form-control">
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
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Status</th>
                      <th>Department</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>Lembur/Jam</th>
                      <th>Status</th>
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
                    <?php $no=$tampil; foreach ($lembur->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NamaStatusKaryawan;?></td>
                      <td><?php echo $ad->NamaBagian;?></td>
                      <td><?php echo $ad->ID_Kary;?></td>
                      <td><?php echo $ad->NamaKary;?></td>
                      <td><?php echo date('d M y',strtotime($ad->Tanggal));?></td>
                      <td><?php echo $ad->KalkulasiLembur;?> Jam</td>
                      <td>
                        <?php if ($ad->ValidasiLembur == 0): ?>
                          <span class="right badge badge-danger"><li class="fas fa-thumbs-down"></li> Tidak DiSetujui</span>
                        <?php else: ?>
                          <span class="right badge badge-success"><li class="fas fa-thumbs-up"></li> DiSetujui</span>
                        <?php endif ?>
                      </td>
                      <td>
                        <?php if ($ad->ValidasiLembur == 0): ?>
                          <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#setuju-info-<?php echo $ad->ID_Kalkulasi;?>"><li class="fas fa-thumbs-up"></li> Setuju </button>
                        <?php else: ?>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tidak-info-<?php echo $ad->ID_Kalkulasi;?>"><li class="fas fa-thumbs-down"></li> Tidak Setuju </button>
                        <?php endif ?>
                        
                      </td>
                    </tr>

                    <!-- modal setuju -->
                    <div class="modal fade" id="setuju-info-<?php echo $ad->ID_Kalkulasi;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Lembur/update" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#28a745;color:#FFFFFF;">
                            <h4 class="modal-title">Form Validasi Lembur</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Kalkulasi;?>" hidden>
                            <input type="text" name="verifikasi" value="0" hidden>

                            <p>Apakah Lembur <b><?php echo $ad->NamaKary;?></b> ini disetujui ?</p>
                            <br>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Lembur(Jam)<span>*</span></label>
                              <div class="col-sm-3">
                                <input type="text" name="txt_lembur" class="form-control" value="<?php echo $ad->KalkulasiLembur;?>" required>
                              </div>
                            </div>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Setuju</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                    <!-- modal tidak setuju -->
                    <div class="modal fade" id="tidak-info-<?php echo $ad->ID_Kalkulasi;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Lembur/update" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Form Validasi Lembur</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_Kalkulasi;?>" hidden>
                            <input type="text" name="verifikasi" value="1" hidden>

                            <p>Apakah Lembur <b><?php echo $ad->NamaKary;?></b> ini tidak disetujui ?</p>

                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Tidak Setuju</button>
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