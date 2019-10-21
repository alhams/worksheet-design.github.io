            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Status Jalan</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_status_jalan'>Tambahkan Status Jalan</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Status Jalan</th>
                        <th>Skor</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                      echo "<tr><td>$no</td>
                              <td>$row[nm_stts_jln]</td>
                              <td>$row[skor]</td>
                               <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/ubah_status_jalan/$row[no_urut]'><span class='glyphicon glyphicon-edit'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>