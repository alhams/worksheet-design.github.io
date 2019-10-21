    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Verifikiasi.xls");
    echo"
    <div style='text-align: center'>
    <table border='1' cellspacing='4' align='center' style='margin: 0px' >
    <tbody>
    <h2>FORMULA PENENTUAN SKOR USULAN PRIORITAS KEGIATAN JALAN, JEMBATAN, SIRING DAN BOX CULVERT</h2>
  
     <tr width='100%'>
   
                        <th style='text-align: center width=100%' rowspan='2'>No</th>
                        <th width='300px' style='text-align: center' rowspan='2'>USULAN</th>
                        <th width='300px' style='text-align: center' rowspan='2'>Mendukung Kawasan Stategi Pusat, Provinsi atau kabupaten</th>
                        <th width='300px' style='text-align: center' rowspan='2'>Koneksi Antar Desa</th>
                        <th width='300px' style='text-align: center' rowspan='2'>Kondisi Jalan</th>
                        <th width='300px' style='text-align: center' rowspan='2'>Status/kewenangan Jalan</th>
                        <th width='300px' style='text-align: center' rowspan='2'>Masuk kawasan hutan atau tidak</th>
                        <th width='300px' style='text-align: center' colspan='5'>Skor Prioritas</th>
                        <th width='300px' style='text-align: center' rowspan='2'>Anggaran</th>
                        <th width='300px' style='text-align: center' rowspan='2'>Prioritas</th>
                        <tr width='5px'>
                        <th width='100px' style='text-align: center'>Skor</th>
                        <th width='100px' style='text-align: center'>Skor</th>
                        <th width='100px' style='text-align: center'>Skor</th>
                        <th width='100px' style='text-align: center'>Skor</th>
                        <th width='100px' style='text-align: center'>Skor</th>

                        </tr>
                     
      </tr>
      </tbody>";

  
                   
    $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/cetak_pdf',$attributes);
      
    $no = 1; 
    foreach ($rows as $row){
         $duit=$row['anggaran'];

                        $duit2= number_format($duit, 2, ".", ",");
 echo "<tr>
        <td>$no</td>
        <td>$row[nm_usulan]</td>
        <td>$row[nm_kawasan]</td>
        <td>$row[nm_koneksi_desa]</td>
        <td>$row[nm_kondisi_jln]</td>
        <td>$row[nm_stts_jln]</td>
        <td>$row[nm_kawasan_hutan]</td>
        <td>$row[skor_a]</td>
        <td>$row[skor_b]</td>
        <td>$row[skor_c]</td>
        <td>$row[skor_d]</td>
        <td>$row[skor_e]</td>
        <td>$duit2</td>
        <td>$row[prioritas]</td>
      </tr>";
    $no++;
        }
echo "
  </table>
</div>
";

echo form_close();
?>