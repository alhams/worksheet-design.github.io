     <?php
        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        use PhpOffice\PhpSpreadsheet\Style\Alignment;
        use PhpOffice\PhpSpreadsheet\Style\Fill;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);
        // Membuat Judul Table
        $spreadsheet->getActiveSheet()
        ->setCellValue('A1',"FORMULA PENENTUAN SKOR USULAN PRIORITAS KEGIATAN JALAN, JEMBATAN, SIRING DAN BOX CULVERT");
        $spreadsheet->getActiveSheet()->mergeCells("A1:N1");
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        // mengatur lebar colomn table
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->SetWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->SetWidth(50);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->SetWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->SetWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->SetWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->SetWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->SetWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->SetWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->SetWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->SetWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->SetWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->SetWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->SetWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->SetWidth(15);

        $spreadsheet->getActiveSheet()->getStyle('A2:N2')->getAlignment()->setWrapText(true);


$center = [
'alignment' => [
    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
]];

        $spreadsheet->getActiveSheet()->getStyle('A2:N2')->applyFromArray($center);
        // membuat kepala colomn Table
        $spreadsheet->getActiveSheet()
        ->setCellValue('A2',"No")
        ->setCellValue('B2',"Usulan")
        ->setCellValue('C2',"Mendukung Kawasan Stategi Pusat, Provinsi atau kabupaten")
        ->setCellValue('D2',"Koneksi Antar Desa")
        ->setCellValue('E2',"Kondisi Jalan")
        ->setCellValue('F2',"Status/kewenangan Jalan")
        ->setCellValue('G2',"Masuk kawasan hutan atau tidak")
        ->setCellValue('H2',"Skor a")
        ->setCellValue('I2',"Skor b")
        ->setCellValue('J2',"Skor c")
        ->setCellValue('K2',"Skor d")
        ->setCellValue('L2',"Skor e")
        ->setCellValue('M2',"Jumlah")
        ->setCellValue('N2',"Prioritas");

        // membuat Warna Table
        $tableHead = [
            'font'=>[
                'color'=>[
                    'rgb'=>'FFFFF'
                ],
                'bold'=>true,
                'size'=>11
            ],
            'fill'=>[
                'fillType'=> Fill::FILL_SOLID,
                'startColor'=>[
                    'rgb'=>'538ED5'
                ]
            ],
        ];

        $spreadsheet->getActiveSheet()->getStyle('A2:N2')->applyFromArray($tableHead);
        // membuat warna field
        $evenRow = [
            'fill'=>[
                'fillType'=> Fill::FILL_SOLID,
                'startColor'=> [
                    'rgb'=>'00BDFF'
                ]
            ]
        ];

        $oddRow = [
            'fill'=>[
                'fillType'=> Fill::FILL_SOLID,
                'startColor'=> [
                    'rgb'=>'00CDFF'
                ]
            ]
        ];

              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/cetak_excel',$attributes); 
        $row=3;
        $no=1;
        foreach ($rows as $usulan1) {
            $spreadsheet->getActiveSheet()

            ->setCellValue('A'.$row , $no)
            ->setCellValue('B'.$row , $usulan1['nm_usulan'])
            ->setCellValue('C'.$row , $usulan1['nm_kawasan'])
            ->setCellValue('D'.$row , $usulan1['nm_koneksi_desa'])
            ->setCellValue('E'.$row , $usulan1['nm_kondisi_jln'])
            ->setCellValue('F'.$row , $usulan1['nm_stts_jln'])
            ->setCellValue('G'.$row , $usulan1['nm_kawasan_hutan'])
            ->setCellValue('H'.$row , $usulan1['skor_a'])
            ->setCellValue('I'.$row , $usulan1['skor_b'])
            ->setCellValue('J'.$row , $usulan1['skor_c'])
            ->setCellValue('K'.$row , $usulan1['skor_d'])
            ->setCellValue('L'.$row , $usulan1['skor_e'])
            ->setCellValue('M'.$row , $usulan1['anggaran'])
            ->setCellValue('N'.$row , $usulan1['prioritas']);
            if ( $row % 2 == 0){
                $spreadsheet->getActiveSheet()->getStyle('A'.$row.':N'.$row)->applyFromArray($evenRow);
            }else{
                $spreadsheet->getActiveSheet()->getStyle('A'.$row.':N'.$row)->applyFromArray($oddRow);
                }
                $no++;
            $row++;
        }
        



            $writer = new Xlsx($spreadsheet);

        $time = time();
        $filename = 'Hasil_Verifikasi_'.$time.'.xlsx';
        $writer->save('assets/download/'.$filename);

        
       header('Content-Description: File Transfer');
       header('Content-type: application/octet-stream');
       header('Content-Disposition: attachment; filename='.basename($filename));
       header('Content-Transfer-Encoding: binary');
       header('Content-Length: '.filesize('assets/download/'.$filename));
       redirect('assets/download/'.$filename);  
echo form_close();
       ?>