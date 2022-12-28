 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">            
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">DATA PERIODE GAJI</h5>
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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Tambah</button>
                  </div>
                  <div class="col-3"></div>
                  <div class="col-2"></div>
                  <div class="col-4">
                    
                  </div>
                </div>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Periode</th>
                      <th>Tanggal Awal</th>
                      <th>Tanggal Akhir</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($periode->result() as $ad): ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo date('F Y',strtotime($ad->NamaPeriode));?></td>
                      <td><?php echo date('d M y',strtotime($ad->Tglawal_cutoff));?></td>
                      <td><?php echo date('d M y',strtotime('-1 days',strtotime($ad->Tglakhir_cutoff)));?></td>
                      <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#ubah-info-<?php echo $ad->ID_periode;?>"><li class="fas fa-pencil-alt"></li> Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_periode;?>"><li class="fas fa-trash"></li> Hapus</button>
                      </td>
                    </tr>

                    <!-- modal ubah -->
                    <div class="modal fade" id="ubah-info-<?php echo $ad->ID_periode;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Periode/update" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#17a2b8;color:#FFFFFF;">
                            <h4 class="modal-title">Edit Periode</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">                           

                            <input type="text" name="id" value="<?php echo $ad->ID_periode;?>" hidden>

                            <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Periode <span>*</span></label>
                            <div class="col-sm-4">
                              <select class="form-control" name="periode_bulan">

                                <?php
                                $bulan = date('m',strtotime($ad->NamaPeriode)); 
                                if ($bulan == '01') {
                                  $jan = 'selected';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '02'){
                                  $jan = '';
                                  $feb = 'selected';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '03'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = 'selected';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '04'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = 'selected';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '05'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = 'selected';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '06'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = 'selected';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '07'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = 'selected';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '08'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = 'selected';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '09'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = 'selected';
                                  $okt = '';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '10'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = 'selected';
                                  $nov = '';
                                  $des = '';
                                }elseif($bulan == '11'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = 'selected';
                                  $des = '';
                                }elseif($bulan == '12'){
                                  $jan = '';
                                  $feb = '';
                                  $mar = '';
                                  $apr = '';
                                  $mei = '';
                                  $jun = '';
                                  $jul = '';
                                  $agt = '';
                                  $sep = '';
                                  $okt = '';
                                  $nov = '';
                                  $des = 'selected';
                                }
                                ?>

                                <option value="01" <?php echo $jan;?>>Januari</option>
                                <option value="02" <?php echo $feb;?>>Februari</option>
                                <option value="03" <?php echo $mar;?>>Maret</option>
                                <option value="04" <?php echo $apr;?>>April</option>
                                <option value="05" <?php echo $mei;?>>Mei</option>
                                <option value="06" <?php echo $jun;?>>Juni</option>
                                <option value="07" <?php echo $jul;?>>Juli</option>
                                <option value="08" <?php echo $agt;?>>Agustus</option>
                                <option value="09" <?php echo $sep;?>>September</option>
                                <option value="10" <?php echo $okt;?>>Oktober</option>
                                <option value="11" <?php echo $nov;?>>November</option>
                                <option value="12" <?php echo $des;?>>Desember</option>
                              </select>
                            </div>
                            <p style="font-size: 15px;padding-top: calc(.375rem + 1px);">-</p>
                            <div class="col-sm-4">
                              <input type="text" id="yearpicker2" name="periode_tahun" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#yearpicker2" value="<?php echo date('Y',strtotime($ad->NamaPeriode));?>" autocomplete="off" />
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"> Tanggal <span>*</span></label>
                            <div class="col-sm-4">
                              <input type="text" id="startdate2" name="tgl_awal" class="form-control datetimepicker-input" data-toggle="datetimepicker" value="<?php echo date('d-m-Y',strtotime($ad->Tglawal_cutoff)) ?>" data-target="#startdate2" autocomplete="off" />
                            </div>
                            <p style="font-size: 15px;padding-top: calc(.375rem + 1px);">s.d.</p>
                            <div class="col-sm-4">
                              <input type="text" id="enddate2" name="tgl_akhir" class="form-control datetimepicker-input" data-toggle="datetimepicker" value="<?php echo date('d-m-Y',strtotime($ad->Tglakhir_cutoff)) ?>" data-target="#enddate2" autocomplete="off" />
                            </div>
                          </div>

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
                    <div class="modal fade" id="hapus-info-<?php echo $ad->ID_periode;?>">
                      <div class="modal-dialog">
                        <form action="<?php echo base_url() ?>Periode/hapus" method="post">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc3545;color:#FFFFFF;">
                            <h4 class="modal-title">Hapus Periode</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <input type="text" name="id" value="<?php echo $ad->ID_periode;?>" hidden>

                            <p>Apakah mau menghapus data Periode <b><?php echo date('F Y',strtotime($ad->NamaPeriode));?></b> ini ?</p>

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
      <form action="<?php echo base_url() ?>Periode/simpan" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#28a745;color:#FFFFFF;">
          <h4 class="modal-title">Periode Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Periode <span>*</span></label>
            <div class="col-sm-4">
              <select class="form-control" name="periode_bulan">

                <?php
                $bulan = date('m'); 
                if ($bulan == '01') {
                  $jan = 'selected';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '02'){
                  $jan = '';
                  $feb = 'selected';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '03'){
                  $jan = '';
                  $feb = '';
                  $mar = 'selected';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '04'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = 'selected';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '05'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = 'selected';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '06'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = 'selected';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '07'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = 'selected';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '08'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = 'selected';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '09'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = 'selected';
                  $okt = '';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '10'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = 'selected';
                  $nov = '';
                  $des = '';
                }elseif($bulan == '11'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = 'selected';
                  $des = '';
                }elseif($bulan == '12'){
                  $jan = '';
                  $feb = '';
                  $mar = '';
                  $apr = '';
                  $mei = '';
                  $jun = '';
                  $jul = '';
                  $agt = '';
                  $sep = '';
                  $okt = '';
                  $nov = '';
                  $des = 'selected';
                }
                ?>

                <option value="01" <?php echo $jan;?>>Januari</option>
                <option value="02" <?php echo $feb;?>>Februari</option>
                <option value="03" <?php echo $mar;?>>Maret</option>
                <option value="04" <?php echo $apr;?>>April</option>
                <option value="05" <?php echo $mei;?>>Mei</option>
                <option value="06" <?php echo $jun;?>>Juni</option>
                <option value="07" <?php echo $jul;?>>Juli</option>
                <option value="08" <?php echo $agt;?>>Agustus</option>
                <option value="09" <?php echo $sep;?>>September</option>
                <option value="10" <?php echo $okt;?>>Oktober</option>
                <option value="11" <?php echo $nov;?>>November</option>
                <option value="12" <?php echo $des;?>>Desember</option>
              </select>
            </div>
            <p style="font-size: 15px;padding-top: calc(.375rem + 1px);">-</p>
            <div class="col-sm-4">
              <input type="text" id="yearpicker" name="periode_tahun" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#yearpicker" value="<?php echo date('Y');?>" autocomplete="off" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label"> Tanggal <span>*</span></label>
            <div class="col-sm-4">
              <input type="text" id="startdate" name="tgl_awal" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#startdate" autocomplete="off" />
            </div>
            <p style="font-size: 15px;padding-top: calc(.375rem + 1px);">s.d.</p>
            <div class="col-sm-4">
              <input type="text" id="enddate" name="tgl_akhir" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#enddate" autocomplete="off" />
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