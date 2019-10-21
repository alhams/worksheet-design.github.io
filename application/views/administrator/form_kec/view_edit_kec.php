<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Ubah Kecamatan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/ubah_kec',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[no_urut]'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Kode Kecamatan</th>                <td><input type='text' class='form-control' name='b' value='$rows[kd_kec]' readonly required></td></tr>
                    <tr><th scope='row'>NAMA Kabupaten</th>                <td>
                      <select name='kab' class='form-control' id='kab' onchange required>";
                      if ($rows[kd_kab]==0){
                           echo"<option value='0' selected>- Pilih Kabupaten -</option>";}
                           foreach ($proses1 as $proses11) {
                          if ($rows[kd_kab]==$proses11[kd_kab]){
                          echo" <option value='$rows[kd_kab]'>$proses11[nm_kab]</option>";                                                                           }
                                                                            }
                                                                            
                    echo " </td></tr>";
                    echo "
                    <tr><th scope='row'>Nama Kecamatan</th>  <td><input type='text' class='form-control' name='c' value='$rows[nm_kec]'required></td></tr>
                    ";
                     echo "</td></tr>
                                                        
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/kec'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
