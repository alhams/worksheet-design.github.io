<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Ubah Kawasan Strategis</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/ubah_kawasan_hutan',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[no_urut]'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Kode Kawasan Hutan</th>                <td><input type='text' class='form-control' name='b' value='$rows[kd_kawasan_hutan]' readonly required></td></tr>
                    <tr><th scope='row'>Kawasan Hutan</th>  <td><input type='text' class='form-control' name='c' value='$rows[nm_kawasan_hutan]'required></td></tr>
                    <tr><th scope='row'>Skor</th>  <td><input type='text' class='form-control' name='d' value='$rows[skor]'required></td></tr>
                    ";
                     echo "</td></tr>
                                                        
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/kawasan_hutan'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
