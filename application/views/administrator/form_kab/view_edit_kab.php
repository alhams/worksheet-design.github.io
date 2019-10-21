<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Ubah Kabupaten</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/ubah_kab',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[no_urut]'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Kode Kabupaten</th>                <td><input type='text' class='form-control' name='b' value='$rows[kd_kab]' readonly required></td></tr>
                    <tr><th scope='row'>Nama Kabupaten</th>  <td><input type='text' class='form-control' name='c' value='$rows[nm_kab]'required></td></tr>
                    ";
                     echo "</td></tr>
                                                        
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/kab'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
