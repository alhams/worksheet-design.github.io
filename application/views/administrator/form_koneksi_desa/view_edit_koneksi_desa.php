<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Ubah Koneksi Desa</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/ubah_koneksi_desa',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[no_urut]'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Kode Koneksi Desa</th>                <td><input type='text' class='form-control' name='b' value='$rows[kd_koneksi_desa]' readonly required></td></tr>
                    <tr><th scope='row'>Koneksi Desa</th>  <td><input type='text' class='form-control' name='c' value='$rows[nm_koneksi_desa]'required></td></tr>
                    <tr><th scope='row'>Skor</th>  <td><input type='text' class='form-control' name='d' value='$rows[skor]'required></td></tr>
                    ";
                     echo "</td></tr>
                                                        
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/koneksi_desa'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
