            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Kawasan Hutan</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_kawasan_hutan'>Tambahkan Kawasan Hutan</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Kawasan Hutan</th>
                        <th>Skor</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                      echo "<tr><td>$no</td>
                              <td>$row[nm_kawasan_hutan]</td>
                              <td>$row[skor]</td>
                               <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/ubah_kawasan_hutan/$row[no_urut]'><span class='glyphicon glyphicon-edit'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>