<?php 


    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Prioritas</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_prio',$attributes); 

          echo "
          
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input type='hidden' name='id' value='$nourut'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Kode Prioritas</th>                <td><input type='text' class='form-control' name='b' readonly required value='$no'></td></tr>
                    <tr><th scope='row'>Prioritas</th>  <td><input type='text' class='form-control' name='c' required></td></tr>
                                                                           
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Simpan</button>
                    <a href='".base_url()."administrator/prio'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>
             ";
             
            echo form_close();
