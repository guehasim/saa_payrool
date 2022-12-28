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
                <h5 class="card-title">DATA MESIN ABSEN</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <form action="<?php echo base_url() ?>MesinAbsen" method="post">
                <div class="row">
                  <div class="col-2">
                    <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_awal_absen');?>" class="form-control" name="tgl_awal" placeholder="Tanggal Awal">
                  </div>
                  <p style="padding-top: 5px;">S.D.</p>
                  <div class="col-2">
                    <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_akhir_absen');?>" class="form-control" name="tgl_akhir" placeholder="Tanggal Akhir">
                  </div>
                  <div class="col-3">
                    <select class="form-control select2" name="bagian">
                      <option value="">--Department--</option>
                      <?php foreach ($bagian->result() as $ad): ?>
                        <?php
                          if ($this->session->userdata('ses_bagian_absen') == $ad->ID_Bagian) {
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
                          if ($this->session->userdata('ses_status_absen') == $ae->ID_StatusKaryawan) {
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
                    <input type="text" placeholder="NIK Karyawan" value="<?php echo $this->session->userdata('ses_karyawan_absen');?>" name="karyawan" class="form-control">
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
                        <input type="submit" name="cek" class="btn btn-info" formtarget="_blank" style="border-radius: 0.25rem;" value="Print">
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
                      <th>Jam</th>
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
                    <?php $no = $tampil; foreach ($absen->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ad->NamaStatusKaryawan;?></td>
                      <td><?php echo $ad->NamaBagian;?></td>
                      <td><?php echo $ad->ID_Kary;?></td>
                      <td><?php echo $ad->Nama;?></td>
                      <td><?php echo date('d M y',strtotime($ad->Tanggal));?></td>
                      <td><?php echo substr($ad->Jam,11,8);?></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
                  <br>
                <?php echo $links; ?>
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