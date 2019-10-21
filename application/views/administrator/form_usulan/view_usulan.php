            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Usulan Kegiatan</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_usulan_kegiatan'>Tambahkan Usulan Kegiatan</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>USULAN</th>
                        <th>DESA</th>
                        <th>KECAMATAN</th>
                        <th>SUMBER DANA</th>
                        <th>ANGGARAN</th>
                        <th>STATUS</th>
                        <th style='width:70px'>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                        if ($row['stts_usulan']=='1'){
                          $status = '<span style="color:red">Proses Verifikasi</span>'; 
                          $but = '<a class="btn btn-success btn-xs" title="Edit Data" href="'.base_url().'administrator/ubah_usulan_kegiatan/'.$no.'"><span class="glyphicon glyphicon-edit"></span></a>';
                        }else{
                          $status = '<span style="color:grean">Verifikasi</span>';
                           $but = '<a class="btn btn-success disabled btn-xs" title="Edit Data" href="'.base_url().'administrator/ubah_usulan_kegiatan/'.$no.'"><span class="glyphicon glyphicon-edit"></span></a>';
                        }

                        $duit=$row['anggaran'];

                        $duit2= number_format($duit, 2, ".", ",");
                      echo "<tr><td>$no</td>
                              <td>$row[nm_usulan]</td>
                              <td>$row[nm_desa]</td>
                              <td>$row[nm_kec]</td>
                              <td>$row[nm_sumber_usulan]</td>
                              <td align='right'>$duit2</td>
                              <td align='center'>$status</td>
                              <td align='center'>$but</td>
                             
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>