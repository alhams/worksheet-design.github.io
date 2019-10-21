    <?php
    echo"   <div class='col-xs-12'>  
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>Cetak Usulan Kegiatan</h3>
                  <a class='pull-right btn btn-primary btn-sm' data-toggle='modal' data-target='#modalForm'>Preview</a>

                </div>
                <div class='box-body'>
                  <table id='example1' class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>USULAN</th>
                        <th>DESA</th>
                        <th>KECAMATAN</th>
                        <th>SUMBER DANA</th>
                        <th>ANGGARAN</th>
                        <th>PRIORITAS</th>
                      </tr>
                    </thead>
                    <tbody>";

                    $no = 1;
                    foreach ($proses50 as $row){
                      $duit=$row['anggaran'];

                        $duit2= number_format($duit, 2, ".", ",");
                      echo "<tr><td>$no</td>

                              <td>$row[nm_usulan]</td>
                              <td>$row[nm_desa]</td>
                              <td>$row[nm_kec]</td>
                              <td>$row[nm_sumber_usulan]</td>
                              <td align='right'>$duit2</td>
                              <td>$row[prioritas]</td>
                          </tr>";
                      $no++;
                    }
                  echo"         
                  </tbody>
                </table>
              </div>";
echo "
<div class='modal fade' id='modalForm' role='dialog'>
    <div class='modal-dialog modal-md'>
        <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>
                    <span aria-hidden='true'>&times;</span>
                    <span class='sr-only'>Close</span>
                </button>
                <h4 class='modal-title' id='myModalLabel'>Cetak Verifikasi Usulan</h4>
            </div>
            

            <div class='modal-body'>";

              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/cetak_excel',$attributes); 
              echo"    <p class='statusMsg'></p>

                        <tr>               <td>
                      <select name='drop' id='drop' class='form-control'>
                       <option value='0' selected >- Pilih Sumber Usulan -</option>}";
                      foreach ($proses51 as $rows){
                      echo"
                       <option value='$rows[kd_sumber_usulan]'>$rows[nm_sumber_usulan]</option>";
                                
                              }

                          
                      echo"

                    </select></td></tr>";
                     echo"    <p class='statusMsg'></p>

                        <tr>               <td>
                      <select name='prio' id='prio' class='form-control'>
                       <option value='0' selected >- Pilih Prioritas -</option>}";
                      foreach ($proses52 as $rows){
                      echo"
                       <option value='$rows[nm_prio]'>$rows[nm_prio]</option>";
                                
                              }

                          
                      echo"

                    </select></td></tr>";
                    echo "
            </div>
            
            <!-- Modal Footer -->
            <div class='modal-footer'>";



            echo "
                <button type='submit' id='btn' class='btn btn-success glyphicon glyphicon-print'>Preview</button>";                       
                echo "
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                </button>
            </div>
            ";
          

               echo form_close();
                       ?>
                    
