            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Verifikasi Usulan Kegiatan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>USULAN</th>
                        <th>DESA</th>
                        <th>KECAMATAN</th>
                        <th>PRIORITAS</th>
                        <th>SUMBER USULAN</th>
                        <th>ANGGARAN</th>
                        <th>STATUS</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                      if ($row['stts_ver']=='1'){
                          $status = '<span style="color:red">Belum Verifikasi</span>'; 
                          $but = '<a class="btn btn-success btn-xs" title="Verifikasi Data" href="'.base_url().'administrator/verifikasi_usulan/'.$no.'"><span class="glyphicon glyphicon-edit"></span></a>';
                        }else{
                          $status = '<span style="color:grean">Verifikasi</span>';
                           $but = '<a class="btn btn-success disabled btn-xs" title="Verifikasi Data" href="'.base_url().'administrator/verifikasi_usulan/'.$no.'"><span class="glyphicon glyphicon-edit"></span></a>';
                        }

                        $duit=$row['anggaran'];

                        $duit2= number_format($duit, 2, ".", ",");
                      echo "<tr><td>$no</td>
                              <td>$row[nm_usulan]</td>
                              <td>$row[nm_desa]</td>
                              <td>$row[nm_kec]</td>
                              <td>$row[prioritas]</td>
                              <td>$row[nm_sumber_usulan]</td>
                              <td align='right'>$duit2</td>
                              <td>$status</td>
                              <td>$but</td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>