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
                <h5 class="card-title">REKAP GAJI KARYAWAN</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <form action="<?php echo base_url() ?>Gaji/filter" method="post">
                <div class="row">
                  <div class="col-2">
                      <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_awal_gaji');?>" class="form-control" name="tgl_awal" placeholder="Tanggal Awal">
                  </div>
                  <p style="padding-top: 10px;">S.D.</p>
                  <div class="col-2">
                      <input type="date" id="birthday" value="<?php echo $this->session->userdata('ses_tgl_akhir_gaji');?>" class="form-control" name="tgl_akhir" placeholder="Tanggal Akhir">
                  </div> 
                  <div class="col-4">
                      <input type="submit" class="btn btn-primary" name="submitdata" value="SEARCH">
                      <input type="submit" class="btn btn-warning" name="submitdata" value="RESET">
                      <input type="submit" class="btn btn-info" name="submitdata" formtarget="_blank" value="PRINT">
                      <input type="submit" class="btn btn-success" name="submitdata" value="EXCEL">
                  </div>                 
                  <div class="col-4">
                  </div>
                </div>
                </form>
                <br>
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Kabag</th>
                      <th>Department</th>
                      <th>Gaji/Jam</th>
                      <th>Lembur/Jam</th>
                      <th>Total Hadir(Jam)</th>
                      <th>Total Overtime(Jam)</th>
                      <th>Gaji Pokok</th>
                      <th>Gaji Overtime</th>
                      <th>Tunjangan</th>
                      <th>Potongan</th>
                      <th>Total Gaji</th>
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
                        <td><?php echo $ad->ID_Kary;?></td>
                        <td><?php echo $ad->NamaKary;?></td>
                        <td><?php echo $ad->KepalaBagian;?></td>
                        <td><?php echo $ad->NamaBagian;?></td>
                        <td style="text-align: right;"><?php echo number_format($ad->GajiJam,0);?></td>
                        <td style="text-align: right;"><?php echo number_format($ad->LemburJam,0);?></td>
                        <td style="text-align: right;"><?php echo $ad->TotHadir;?></td>
                        <td style="text-align: right;"><?php echo $ad->TotLembur;?></td>
                        <td style="text-align: right;"><?php echo number_format($ad->GajiHadir,0);?></td>
                        <td style="text-align: right;"><?php echo number_format($ad->GajiLembur,0);?></td>
                        <td style="text-align: right;"><?php echo number_format($ad->Tunjangan,0);?></td>
                        <td style="text-align: right;"><?php echo number_format($ad->Potongan,0);?></td>
                        <?php 
                        if ($ad->TotGajiAll == 0) {
                          $tampil = "background-color: #dc3545;color:white;";
                        }else{
                          $tampil = "";                         
                        }?>
                        <td style="text-align: right;<?php echo $tampil;?>"><?php echo number_format($ad->TotGajiAll,0);?></td>
                      </tr>
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
  