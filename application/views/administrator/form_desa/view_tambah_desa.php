<?php 


    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Desa</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_desa',$attributes); 

          echo "
          
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input type='hidden' name='id' value='$nourut'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Kode Desa</th>                <td><input type='text' class='form-control' name='b' readonly required value='$no'></td></tr>";
                    echo "
                    <tr><th scope='row'>Nama Kabupaten</th>                <td>
                      <select name='kab' class='form-control' id='kab' click required>
                      <option value='' selected>- Pilih Kabupaten -</option>";
                        foreach ($record as $row){
                          echo" <option value='$row[kd_kab]'>$row[nm_kab]</option>";                      }                                                
                          echo " </td></tr>";
                          echo "
                    <tr><th scope='row'>Nama Kecamatan</th>                <td>
                      <select name='kec' class='form-control' id='kec' click required>
                      <option value='0'>- Pilih Kecamatan -</option>";
                      echo "                    
                    <tr><th scope='row'>Nama Desa</th>  <td><input type='text' class='form-control' name='c' required></td></tr>
                                                                           
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Simpan</button>
                    <a href='".base_url()."administrator/desa'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>
             ";
             
            echo form_close();
