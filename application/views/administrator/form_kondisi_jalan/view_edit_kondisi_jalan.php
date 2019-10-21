<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Ubah Kondisi Jalan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/ubah_kondisi_jalan',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[no_urut]'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Kode Kabupaten</th>                <td><input type='text' class='form-control' name='b' value='$rows[kd_kondisi_jln]' readonly required></td></tr>
                    <tr><th scope='row'>Nama Kabupaten</th>  <td><input type='text' class='form-control' name='c' value='$rows[nm_kondisi_jln]'required></td></tr>
                    <tr><th scope='row'>Nama Kabupaten</th>  <td><input type='text' class='form-control' name='d' value='$rows[skor]'required></td></tr>
                    ";
                     echo "</td></tr>
                                                        
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/kondisi_jalan'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
