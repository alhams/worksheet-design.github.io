<style type="text/css">
  * {
  .border-radius(0) !important;
}

#field {
    margin-bottom:20px;
}
</style>

<?php 
    echo "
    <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Usulan Kegiatan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_usulan_kegiatan',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input type='hidden' name='id' value='$nomor'>";
                    echo "
                    <tr><th scope='row'>Tahun</th>        <td><input type='text' class='form-control' name='thn' required value='$thn' readonly></td></tr>";                                                       
                    echo "
                    <tr><th scope='row'>Kode Usulan</th>        <td><input type='text' class='form-control' name='a' required value='$no' readonly></td></tr>";
                    echo "
                    <tr><th scope='row'>Kabupaten</th>                <td>
                      <select name='kab' class='form-control' id='kab' onchange required>
                      <option value='0'>- Pilih Kabupaten -</option>";
                    
                      foreach ($record as $row){

                    echo" <option value='$row[kd_kab]'>$row[nm_kab]</option>";                    }
                    echo "</select>";
                    echo "
                    <tr><th scope='row'>Kecamatan</th>                <td>
                      <select name='kec' class='form-control' id='kec' onchange required>
                      <option value='0'>- Pilih Kecamatan -</option>";
                    echo "</select></td></tr>";

                    echo "
                    <tr><th scope='row'>Desa</th>                <td>
                      <select name='desa' class='form-control' id='desa' onchange required>
                      <option value=''>- Pilih Desa -</option></select></td></tr>";

                      echo "
                    <tr><th scope='row'>Usulan</th>        <td><input type='text' class='form-control' name='b' required value='' ></td></tr>";
                     echo "
                    <tr><th scope='row'>Alamat</th>        <td><input type='text' class='form-control' name='c' required value='' ></td></tr>";
                    echo "
                    <tr><th scope='row'>Sumber Dana</th>                <td>
                      <select name='dana' class='form-control' id='dana' onchange required>
                      <option value='0'>- Pilih Sumber Dana -</option>";
                    
                      foreach ($proses3 as $rowsss){

                    echo" <option value='$rowsss[kd_dana]'>$rowsss[nm_dana]</option>";                    }
                    echo "</select>";

                    
                    echo "
                    <tr><th scope='row'>Sumber Usulan</th>                <td>
                      <select name='f' class='form-control' id='f' onchange required>
                      <option value='0'>- Pilih Sumber Usulan -</option>";
                    
                      foreach ($proses1 as $rowss){

                    echo" <option value='$rowss[kd_sumber_usulan]'>$rowss[nm_sumber_usulan]</option>";                    }
                    echo "</select>";

                    echo "
                    <tr><th scope='row'>Volume</th>        <td><input type='number' class='form-control' name='e' required value='' ></td></tr>";
                    echo "
                    <tr><th scope='row'>Satuan</th>                <td>
                      <select name='satuan' class='form-control' id='satuan' onchange required>
                      <option value='0'>- Pilih Satuan -</option>";
                    
                      foreach ($proses2 as $rowsss){

                    echo" <option value='$rowsss[kd_satuan]'>$rowsss[nm_satuan]</option>";                    }
                    echo "</select>";

                    echo "
                    <tr><th scope='row'>Total Usulan</th>        <td><input type='number' class='form-control ' name='mtotal' id='mtotal' required></td></tr>";
                 
                    echo"
                                                                           
                  </tbody>
                  </table>
                  </div>
              
              <div class='box-footer'>
                    <button type='submit' value='1' name='submit' class='btn btn-info'>Simpan</button>
                    <a href='".base_url()."administrator/usulan'><button type='button' class='btn btn-default pull-right'>Batal</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();