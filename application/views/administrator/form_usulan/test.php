 <div class="row">
    <div class='box box-info'>
    <div class='box-header with-border'>
        <h3 class='box-title'>Tambah Usulan Kegiatan</h3>
    </div>
    <div class='box-body'>
        <div class="col-xs-6 form-group">
            <table class='table table-condensed table-bordered'>
                <tbody>
                    <input type='hidden' name='id' value='$nomor'>
            <label>Label1</label>
            <input class="form-control" type="text"/>
        </tbody>
        </table>


        </div>
        <div class="col-xs-6 form-group">
            <table class='table table-condensed table-bordered'>
            <label>Label2</label>
            <input class="form-control" type="text"/>
            </table>
        </div>
</div>
</div>
</div>

       <!--  <div class="col-xs-6">
            <div class="row">
                <label class="col-xs-12">Label3</label>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control" type="text"/>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input class="form-control" type="text"/>
                </div>
            </div>
        </div>
        <div class="col-xs-6 form-group">
            <label>Label4</label>
            <input class="form-control" type="text"/>
        </div>
    </div>

<div> -->
    
<!-- </div>
     <div class='row'>
          <div class='col-md-12'>      
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Usulan Kegiatan</h3>
                </div>
              <div class='box-body'>";
          <div class='col-xs-6 form-group'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input type='hidden' name='id' value='$nomor'>";
                                                                           
                    </td></tr>
                    <tr><th scope='row'>Kode Usulan</th>        <td><input type='text' class='form-control' name='a' required value='$no' readonly></td></tr>";

                    </td></tr>
                    <tr><th scope='row'>Usulan</th>        <td><input type='text' class='form-control' name='b' required value='' ></td></tr>";

                    </td></tr>
                    <tr><th scope='row'>Alamat</th>        <td><input type='text' class='form-control' name='c' required value='' ></td></tr>";

                    </td></tr>
                    <tr><th scope='row'>Sumber Usulan</th>        <td><input type='text' class='form-control' name='d' required value='' ></td></tr>";
                    </td></tr>
                    <tr><th scope='row'>Volume</th>        <td><input type='text' class='form-control' name='e' required value='' ></td></tr>
                    <tr><th scope='row'>Satuan</th>        <td><input type='text' class='form-control' name='e' required value='' ></td></tr>";

                                        <tr><th scope='row'>Kabupaten</th>                <td>
                      <select name='f' class='form-control' id='f' onchange required>
                      <option value='0'>- Pilih UTTP -</option>";
                    
                      foreach ($record as $row){

                    echo" <option value='$row[kd_uttp]'>$row[nm_uttp]</option>";                    }
                    </select>";
                                        <tr><th scope='row'>Kecamatan</th>                <td>
                      <select name='g' class='form-control' id='g' onchange required>
                      <option value='0'>- Pilih JENIS UTTP -</option>";
                    </select></td></tr>";

                                        <tr><th scope='row'>Desa</th>                <td>
                      <select name='h[]' class='form-control' id='h' onchange required>
                      <option value=''>- Pilih Alat UTTP -</option></select></td></tr>";
                    </td></tr>
                    <tr><th scope='row'>Jumlah UTTP</th>        <td><input type='number' class='form-control calculate ' id='i' name='i'  required></td></tr>";
                    </td></tr>
                    <tr><th scope='row'>No Seri Alat</th>        <td><input type='number' class='form-control' id='j' name='j'  required></td></tr>";
                    </td></tr>
                    <tr><th scope='row'>Kapasitas</th>        <td><input type='number' class='form-control' name='k' required></td></tr>";
                    </td></tr>
                    <tr><th scope='row'>Harga Satuan</th>        <td><input type='number' class='form-control calculate '  id='l' name='l' readonly required></td></tr>";
                    </td></tr>
                    <tr><th scope='row'>Total Harga</th>        <td><input type='number' class='form-control calculate' name='mtotal' id='mtotal'  readonly required></td></tr>";
                    echo"
                                                                           
                  </tbody>
                  </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
 -->