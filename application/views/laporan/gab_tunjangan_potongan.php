 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">            
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">DATA TUNJANGAN & POTONGAN</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Periode</th>
                      <th>Tunjangan</th>
                      <th>Potongan</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $no=1; foreach ($periode->result() as $ad): ?>
                      <tr>
                        <td><?php echo $no++;?></td>
                       <td><?php echo date('F - Y',strtotime($ad->NamaPeriode));?></td>
                       <td>
                         <?php
                           $id = $ad->ID_periode;
                           $nama = date('F - Y',strtotime($ad->NamaPeriode));
                           $query1 = $this->db->query("SELECT COUNT(*) AS total_tunjangan FROM tbl_tunjangan WHERE JenisTunjangan = 0 AND ID_periode = '$id' "); 
                          ?>
                          <?php foreach ($query1->result() as $ae): ?>
                            <a href="<?php echo base_url() ?>Tunjangan/load_tunjangan?us=<?php echo $id;?>&nama=<?php echo $nama;?>"><button class="btn btn-success"><?php echo $ae->total_tunjangan;?> Karyawan</button></a>
                          <?php endforeach ?>
                       </td>
                       <td>
                         <?php
                           $id = $ad->ID_periode;
                           $query2 = $this->db->query("SELECT COUNT(*) AS total_potongan FROM tbl_tunjangan WHERE JenisTunjangan = 1 AND ID_periode = '$id' ");
                          ?>
                          <?php foreach ($query2->result() as $af): ?>
                            <a href="<?php echo base_url() ?>Tunjangan/load_potongan?us=<?php echo $id ?>&nama=<?php echo $nama;?>"><button class="btn btn-danger"><?php echo $af->total_potongan;?> Karyawan</button></a>
                          <?php endforeach ?>
                       </td>
                      </tr>
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