
<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>             
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/verifikasi_usulan',$attributes); 
         echo "<div class='col-md-6'>
         <div class='box-header with-border'>
                  <h3 class='box-title'>Verifikasi Usulan Kegiatan</h3>
                </div>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input type='hidden' name='id' value='$rows[no_urut]'>";
                    echo "
                    <tr><th scope='row'>Tahun</th>        <td><input type='text' class='form-control' name='thn' value='$rows[thn_usulan]' disabled readonly></td></tr>";                                                       
                    echo "
                    <tr><th scope='row'>Kode Usulan</th>        <td><input type='text' class='form-control' name='a' value='$rows[kd_usulan]' disabled readonly></td></tr>";
                    echo "
                    <tr><th scope='row'>Kabupaten</th>                <td>
                      <select disabled name='kab' class='form-control' id='kab' readonly >";
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
                      <select disabled name='kec' class='form-control' id='kec' readonly >";
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
                      <select disabled name='desa' class='form-control' id='desa' readonly >";
                      if ($rows[kd_desa]==0){
                       echo"<option value='0' selected>- Pilih Desa -</option>";}
                      
                       foreach ($proses6 as $proses13) {
                        
                        if ($rows[kd_desa]==$proses13[kd_desa]){
                        echo"<option value='$rows[kd_desa]' selected>$proses13[nm_desa]</option> ";
                          
                       }
                     }

                    echo "</select>";

                    echo "
                    <tr><th scope='row'>Usulan</th>        <td><textarea disabled rows='1' cols='35'>$rows[nm_usulan]</textarea></td></tr>";
                     echo "
                    <tr><th scope='row'>Alamat</th>        <td><input type='text' class='form-control' name='c' readonly value='$rows[alamat]' ></td></tr>";
                    echo "
                    <tr><th scope='row'>Sumber Dana</th>                <td>
                      <select disabled name='dana' class='form-control' id='dana' readonly>";
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
                      <select disabled name='sumber' class='form-control' id='sumber' readonly >";
                      if ($rows[kd_sumber_usulan]==0){
                      echo" <option value='0' selected>- Pilih Sumber Usulan -</option>";}
                    
                      foreach ($proses1 as $proses15){

                        if ($rows[kd_sumber_usulan]==$proses15[kd_sumber_usulan]){
                    echo" <option value='$rows[kd_sumber_usulan]' selected>$proses15[nm_sumber_usulan]</option>";                    }
                  }
                    echo "</select>";

                    echo "
                    <tr><th scope='row'>Volume</th>        <td><input type='number' class='form-control' name='e' disabled readonly value='$rows[volume]' ></td></tr>";
                    echo "
                    <tr><th scope='row'>Satuan</th>                <td>
                      <select name='satuan' class='form-control' id='satuan' disabled readonly>";
                      if ($rows[kd_satuan]==0){
                      echo"<option value='0' selected>- Pilih Satuan -</option>";}
                    
                      foreach ($proses2 as $proses16){

                        if ($rows[kd_satuan]==$proses16[kd_satuan]){

                    echo" <option value='$rows[kd_satuan]' selected>$proses16[nm_satuan]</option>";                    }
                  }
                    echo "</select>";

                    echo "
                    <tr><th scope='row'>Total Usulan</th>        <td><input type='number' class='form-control ' name='mtotal' id='mtotal' value='$rows[anggaran]' disabled readonly></td></tr>";
                    echo"
                                                                           
                  </tbody>
                  </table>
                  </div>";
                  echo "<div class='col-md-5'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Prioritas</h3>
                </div>
                <table class='table table-condensed table-bordered'>
                <tbody>";
                    echo "
                    <tr><th scope='row'>Kawasan Strategis</th>                <td>
                      <select name='stra' class='form-control ' id='stra' required>";
                      echo"<option value='0'>- Pilih Kawasan Strategis -</option>";                    
                      foreach ($proses7 as $proses17) {
                    echo" <option value='$proses17[kd_kawasan]'>$proses17[nm_kawasan]</option>";                 
                        }
                      
                    echo "</select>";
                    echo "
                    <tr><th scope='row'>Kawasan Hutan</th>                <td>
                      <select name='hutan' class='form-control ' id='hutan' required>";
                      echo"<option value='0'>- Pilih Kawasan Hutan -</option>";
                    
                      foreach ($proses8 as $proses18) {
                    echo" <option value='$proses18[kd_kawasan_hutan]'>$proses18[nm_kawasan_hutan]</option>";                 
                        }

                    echo "</select>";
                    echo "
                    <tr><th scope='row'>Kondisi Jalan</th>                <td>
                      <select name='jln' class='form-control ' id='jln' required>";
                      echo"<option value='0'>- Pilih Kondisi Jalan -</option>";
                    
                      foreach ($proses9 as $proses19) {
                    echo" <option value='$proses19[kd_kondisi_jln]'>$proses19[nm_kondisi_jln]</option>";                 
                      }
                    echo "</select>";
                    echo "
                    <tr><th scope='row'>Koneksi Desa</th>                <td>
                      <select name='koneksi' class='form-control' id='koneksi' required>";
                      echo"<option value='0' >- Pilih Koneksi Desa -</option>";
                    
                      foreach ($proses10 as $proses20) {

                    echo" <option value='$proses20[kd_koneksi_desa] '>$proses20[nm_koneksi_desa]</option>";                 
                      }
                    echo "</select>";
                    echo "
                    <tr><th scope='row'>Status Jalan</th>                <td>
                      <select name='stts' class='form-control' id='stts' required>";
                      echo"<option value='0' >- Pilih Koneksi Desa -</option>";
                    
                      foreach ($proses30 as $proses21) {

                    echo" <option value='$proses21[kd_stts_jln] '>$proses21[nm_stts_jln]</option>";                 
                      }
                    echo "</select>";
                    echo "
                    <tr><th scope='row'>Total Skor</th>        <td><input type='text' class='form-control' name='total' onclick='sum()' id='total' readonly></td></tr>";
                       echo "
                    <tr><th scope='row'>PRIORITAS</th>        <td><input type='text' class='form-control ' onclick='prio()' name='prioritas' id='prioritas'   readonly ></td></tr>";
                    echo"</tbody>
                </table>
              
              </div>";

               echo "<div class='col-md-1'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Skor</h3>
                </div>
                <table class='table table-condensed table-bordered'>
                <tbody>";
                    echo "
                    <tr><td><input type='text' class='form-control ' onclick='sum()' name='skor1' id='skor1'   readonly ></td></tr>";
                    echo "
                    <tr><td><input type='text' class='form-control '  onclick='sum()' name='skor2' id='skor2'    readonly></td></tr>";
                    echo "
                    <tr><td><input type='text' class='form-control ' onclick='sum()' name='skor3' id='skor3'  readonly ></td></tr>";
                    echo "
                    <tr><td><input type='text' class='form-control ' onclick='sum()' name='skor4' id='skor4'  readonly></td></tr>";
                  echo "
                    <tr><td><input type='text' class='form-control ' onclick='sum()' name='skor5' id='skor5'  readonly ></td></tr>";
                  
                    echo"</tbody>
                </table>
              
              </div>";

              echo"<div class='col-md-12'>
              <div class='box-footer'>
                    <button type='submit' value='2'  name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url()."administrator/v_usulan'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>

            </div>";


            echo form_close();