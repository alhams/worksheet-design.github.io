<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Ubah Usulan Kegiatan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/ubah_usulan_kegiatan',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input type='hidden' name='id' value='$rows[no_urut]'>";
                                                                           
                    echo "</td></tr>
                    <tr><th scope='row'>Tahun</th>        <td><input type='text' class='form-control' name='thn' required value='$thn' readonly></td></tr>";

                    echo "</td></tr>
                    <tr><th scope='row'>Kode Usulan</th>        <td><input type='text' class='form-control' name='a' required value='$rows[kd_usulan]' readonly></td></tr>";

                   echo "
                    <tr><th scope='row'>Kabupaten</th>                <td>
                      <select  name='kab' class='form-control' id='kab' >";
                      if ($rows[kd_kab]==0){
                       echo"<option value='0' selected>- Pilih Kabupaten -</option>";}
                      
                       foreach ($proses4 as $proses11) {
                        
                        if ($rows[kd_kab]==$proses11[kd_kab]){
                        echo"<option value='$rows[kd_kab]' selected>$proses11[nm_kab]</option> ";
                          
                       }
                     }

                    echo "</select>";

                   echo "
                    <tr><th scope='row'>Kecamatan</th>                <td>
                      <select  name='kec' class='form-control' id='kec'  >";
                      if ($rows[kd_kec]==0){
                       echo"<option value='0' selected>- Pilih Kecamatan -</option>";}
                      
                       foreach ($proses5 as $proses12) {
                        
                        if ($rows[kd_kec]==$proses12[kd_kec]){
                        echo"<option value='$rows[kd_kec]' selected>$proses12[nm_kec]</option> ";
                          
                       }
                     }

                    echo "</select>";

                    echo "
                    <tr><th scope='row'>Desa</th>                <td>
                      <select  name='desa' class='form-control' id='desa'  >";
                      if ($rows[kd_desa]==0){
                       echo"<option value='0' selected>- Pilih Desa -</option>";}
                      
                       foreach ($proses6 as $proses13) {
                        
                        if ($rows[kd_desa]==$proses13[kd_desa]){
                        echo"<option value='$rows[kd_desa]' selected>$proses13[nm_desa]</option> ";
                          
                       }
                     }

                    echo "</select>";

                    echo "
                    <tr><th scope='row'>Usulan</th>        <td><input type='text' class='form-control' name='b' required value='$rows[nm_usulan]' ></td></tr>";
                     echo "
                    <tr><th scope='row'>Alamat</th>        <td><input type='text' class='form-control' name='c' required value='$rows[alamat]' ></td></tr>";
                    echo "
                    <tr><th scope='row'>Sumber Dana</th>                <td>
                      <select  name='dana' class='form-control' id='dana' >";
                      if ($rows[kd_dana]==0){
                      echo"<option value='0' selected>- Pilih Sumber Dana -</option>";}
                    
                      foreach ($proses3 as $proses14) {

                        if ($rows[kd_dana]==$proses14[kd_dana]){
                    echo" <option value='$rows[kd_dana]' selected>$proses14[nm_dana]</option>";                 
                        }
                      }
                    echo "</select>";
                     echo "
                    <tr><th scope='row'>Sumber Usulan</th>                <td>
                      <select  name='sumber' class='form-control' id='sumber'  >";
                      if ($rows[kd_sumber_usulan]==0){
                      echo" <option value='0' selected>- Pilih Sumber Usulan -</option>";}
                    
                      foreach ($proses1 as $proses15){

                        if ($rows[kd_sumber_usulan]==$proses15[kd_sumber_usulan]){
                    echo" <option value='$rows[kd_sumber_usulan]' selected>$proses15[nm_sumber_usulan]</option>";                    }
                  }
                    echo "</select>";

         echo "
                    <tr><th scope='row'>Volume</th>        <td><input type='number' class='form-control' name='e'  value='$rows[volume]' ></td></tr>";
                    echo "
                    <tr><th scope='row'>Satuan</th>                <td>
                      <select name='satuan' class='form-control' id='satuan' required>";
                      if ($rows[kd_satuan]==0){
                      echo"<option value='0' selected>- Pilih Satuan -</option>";}
                    
                      foreach ($proses2 as $proses16){

                        if ($rows[kd_satuan]==$proses16[kd_satuan]){

                    echo" <option value='$rows[kd_satuan]' selected>$proses16[nm_satuan]</option>";                    }
                  }
                    echo "</select>";

                     // $duit=$row['anggaran'];

                     //    $duit2= number_format($duit, 2, ".", ",");
                    echo "
                    <tr><th scope='row'>Total Usulan</th>        <td><input type='number' class='form-control ' name='mtotal' id='mtotal' value='$rows[anggaran]' required></td></tr>";
                    echo"
                                                                           
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' value='1' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/usulan'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();