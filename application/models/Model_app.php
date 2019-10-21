<?php 
class Model_app extends CI_model{
    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }
    
    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }
    

    public function view_where_ordering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $query = $this->db->get($table);
        return $query->result_array();
    }


    public function view_join_one($table1,$table2,$field,$order,$ordering){
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_one1($table1,$table2,$table3,$field,$order,$ordering){
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->join($table3, $table2.'.'.$field.'='.$table3.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_one11($table1,$table2,$table3,$field,$field1,$order,$ordering){
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->join($table3, $table2.'.'.$field.'='.$table3.'.'.$field); 
        $this->db->where($table2.'.'.$field1.'='.$table3.'.'.$field1); //pengalihan join 2 field
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_one111($table1,$table2,$table3,$table4,$table5,$table6,$field,$field1,$field2,$field3,$field4,$order,$ordering){
        $this->db->select("*");
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$field.'='.$table1.'.'.$field);
        $this->db->join($table3, $table3.'.'.$field1.'='.$table1.'.'.$field1); 
        $this->db->join($table4, $table4.'.'.$field2.'='.$table1.'.'.$field2); 
        $this->db->join($table5, $table5.'.'.$field3.'='.$table1.'.'.$field3);
        $this->db->join($table6, $table6.'.'.$field4.'='.$table1.'.'.$field4);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }


    public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }


public function view_where1($table,$field,$where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($table.'.'.$field. '='.$where);
         // $this->db->where($table.'.'.$field.'='.$table.'.'.$field);
        return $this->db->get()->result_array();
    }


    function umenu_akses($link,$id){
        return $this->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    }

    public function cek_login($username,$password,$table){
        return $this->db->query("SELECT * FROM $table where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."' AND blokir='N'");
    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    public function view_join($table1,$table2,$field){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        return $this->db->get()->result_array();
    }

    function getKec($postData){
        $response = array();
        if($postData['kd_kab'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_kab', $postData['kd_kab']);
            $q = $this->db->get('ref_tbl_kec');
            $response = $q->result_array();
        }    
        return $response;
    }

    function count(){
        $this->db->select('count(stts_ver)as count', FALSE);
         $this->db->group_by('stts_ver');
         $this->db->order_by('count', 'asc'); 
        $q = $this->db->get('tbl_ver_usulan');
        return $q->result_array();
    }

    function getDesa($postData){
        $response = array();
        if($postData['kd_kec'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_kec', $postData['kd_kec']);
            $q = $this->db->get('ref_tbl_desa');
            $response = $q->result_array();
        }    
        return $response;
    }

    function getAlatUttp($postData){
        $response = array();
        if($postData['kd_kategori'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_kategori', $postData['kd_kategori']);
            $q = $this->db->get('ref_tbl_harga_alat_uttp');
            $response = $q->result_array();
        }    
        return $response;
    }
    function gethargaUttp($postData){
        $response = array();
        if($postData['kd_alat'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_alat', $postData['kd_alat']);
            $q = $this->db->get('ref_tbl_harga_alat_uttp');
            $response = $q->result_array();
        }    
        return $response;
    }

    function nomor_urut_kab(){
        $this->db->select('RIGHT(ref_tbl_kab.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kab');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

    function nomor_kab(){
        $this->db->select('RIGHT(ref_tbl_kab.kd_kab,4) as kode', FALSE);
        $this->db->order_by('kd_kab','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kab');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }   

        function nomor_urut_kec(){
        $this->db->select('RIGHT(ref_tbl_kec.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kec');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_kec(){
        $this->db->select('RIGHT(ref_tbl_kec.kd_kec,4) as kode', FALSE);
        $this->db->order_by('kd_kec','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kec');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }   

        function nomor_urut_desa(){
        $this->db->select('RIGHT(ref_tbl_desa.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_desa');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_desa(){
        $this->db->select('RIGHT(ref_tbl_desa.kd_desa,4) as kode', FALSE);
        $this->db->order_by('kd_desa','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_desa');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }   

        function nomor_urut_dana(){
        $this->db->select('RIGHT(ref_tbl_dana.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_dana');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_dana(){
        $this->db->select('RIGHT(ref_tbl_dana.kd_dana,4) as kode', FALSE);
        $this->db->order_by('kd_dana','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_dana');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }   


        function nomor_urut_kawasan(){
        $this->db->select('RIGHT(ref_tbl_kawasan.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kawasan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_kawasan(){
        $this->db->select('RIGHT(ref_tbl_kawasan.kd_kawasan,4) as kode', FALSE);
        $this->db->order_by('kd_kawasan','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kawasan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }   


function nomor_urut_kawasan_hutan(){
        $this->db->select('RIGHT(ref_tbl_kawasan_hutan.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kawasan_hutan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_kawasan_hutan(){
        $this->db->select('RIGHT(ref_tbl_kawasan_hutan.kd_kawasan_hutan,4) as kode', FALSE);
        $this->db->order_by('kd_kawasan_hutan','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kawasan_hutan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }   


    function nomor_urut_kondisi_jalan(){
        $this->db->select('RIGHT(ref_tbl_kondisi_jalan.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kondisi_jalan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_kondisi_jalan(){
        $this->db->select('RIGHT(ref_tbl_kondisi_jalan.kd_kondisi_jln,4) as kode', FALSE);
        $this->db->order_by('kd_kondisi_jln','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_kondisi_jalan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }   

    function nomor_urut_koneksi_desa(){
        $this->db->select('RIGHT(ref_tbl_koneksi_desa.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_koneksi_desa');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_koneksi_desa(){
        $this->db->select('RIGHT(ref_tbl_koneksi_desa.kd_koneksi_desa,4) as kode', FALSE);
        $this->db->order_by('kd_koneksi_desa','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_koneksi_desa');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }

    function nomor_urut_status_jalan(){
        $this->db->select('RIGHT(ref_tbl_status_jln.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_status_jln');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_status_jalan(){
        $this->db->select('RIGHT(ref_tbl_status_jln.kd_stts_jln,4) as kode', FALSE);
        $this->db->order_by('kd_stts_jln','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_status_jln');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }

    function nomor_urut_sumber_usulan(){
        $this->db->select('RIGHT(ref_tbl_sumber_usulan.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_sumber_usulan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_sumber_usulan(){
        $this->db->select('RIGHT(ref_tbl_sumber_usulan.kd_sumber_usulan,4) as kode', FALSE);
        $this->db->order_by('kd_sumber_usulan','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_sumber_usulan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }


    function nomor_urut_usulan(){
        $this->db->select('RIGHT(tbl_usulan.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('tbl_usulan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_usulan(){
        $this->db->select('RIGHT(tbl_usulan.kd_usulan,4) as kode', FALSE);
        $this->db->order_by('kd_usulan','DESC');
        $this->db->limit(1);
        $query=$this->db->get('tbl_usulan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }


        function nomor_urut_satuan(){
        $this->db->select('RIGHT(ref_tbl_satuan.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_satuan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_satuan(){
        $this->db->select('RIGHT(ref_tbl_satuan.kd_satuan,4) as kode', FALSE);
        $this->db->order_by('kd_satuan','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_satuan');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }


   function nomor_urut_prio(){
        $this->db->select('RIGHT(ref_tbl_prio.no_urut,1) as kode', FALSE);
        $this->db->order_by('no_urut','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_prio');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        return $kode_max;
    }

        function nomor_prio(){
        $this->db->select('RIGHT(ref_tbl_prio.kd_prio,4) as kode', FALSE);
        $this->db->order_by('kd_prio','DESC');
        $this->db->limit(1);
        $query=$this->db->get('ref_tbl_prio');
        if ($query->num_rows()!=0) 
        {
           $data=$query->row();
           $kode=intval($data->kode)+1;
        } 
        else
        {
            $kode=1;
        }
        $kode_max=str_pad($kode,1,"0",STR_PAD_LEFT);
        $kode_jadi="0".$kode_max;
        return $kode_jadi;
    }


        function cetak($id_pemohon)
         {
         $return = array();
         if($id_pemohon = $this->uri->segment(3) ){
         $this->db->select('*');
         $this->db->where('id_pemohon', $id_pemohon = $this->uri->segment(3));
           $this->db->from('tbl_order');
              $q = $this->db->get();
            if ($q->num_rows()>0) {
                foreach ($q->result() as $row) {
                 array_push($return, $row);
                    }
                }
          }
         return $return;
         }

         function tahun(){
            $tahun= date('Y');
            return $tahun;

         }
    
    function getStra($postData){
        $response = array();
        if($postData['kd_kawasan'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_kawasan', $postData['kd_kawasan']);
            $q = $this->db->get('ref_tbl_kawasan');
            $response = $q->result_array();
        }    
        return $response;
    }


    function getHutan($postData){
        $response = array();
        if($postData['kd_kawasan_hutan'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_kawasan_hutan', $postData['kd_kawasan_hutan']);
            $q = $this->db->get('ref_tbl_kawasan_hutan');
            $response = $q->result_array();
        }    
        return $response;
    }

    function getJalan($postData){
        $response = array();
        if($postData['kd_kondisi_jln'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_kondisi_jln', $postData['kd_kondisi_jln']);
            $q = $this->db->get('ref_tbl_kondisi_jalan');
            $response = $q->result_array();
        }    
        return $response;
    }

     function getKoneksi($postData){
        $response = array();
        if($postData['kd_koneksi_desa'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_koneksi_desa', $postData['kd_koneksi_desa']);
            $q = $this->db->get('ref_tbl_koneksi_desa');
            $response = $q->result_array();
        }    
        return $response;
    }

    function getStts($postData){
        $response = array();
        if($postData['kd_stts_jln'] ){
        // Select record
            $this->db->select('*');
            $this->db->where('kd_stts_jln', $postData['kd_stts_jln']);
            $q = $this->db->get('ref_tbl_stts_jln');
            $response = $q->result_array();
        }    
        return $response;
    }

    function getCetak($kd_sumber_usulan,$nm_prio){
        $response = array();
        if( $kd_sumber_usulan=$this->input->post('drop') && $nm_prio=$this->input->post('prio') ){
        // Select record
            $this->db->select('*');
            $this->db->join('ref_tbl_kawasan','tbl_ver_usulan.kd_kawasan = ref_tbl_kawasan.kd_kawasan');
            $this->db->join('ref_tbl_stts_jln','tbl_ver_usulan.kd_stts_jln = ref_tbl_stts_jln.kd_stts_jln');
            $this->db->join('ref_tbl_koneksi_desa','tbl_ver_usulan.kd_koneksi_desa = ref_tbl_koneksi_desa.kd_koneksi_desa');
            $this->db->join('ref_tbl_kondisi_jalan','tbl_ver_usulan.kd_kondisi_jln = ref_tbl_kondisi_jalan.kd_kondisi_jln');
            $this->db->join('ref_tbl_kawasan_hutan','tbl_ver_usulan.kd_kawasan_hutan = ref_tbl_kawasan_hutan.kd_kawasan_hutan');
            $this->db->where('kd_sumber_usulan', $kd_sumber_usulan=$this->input->post('drop'));
             $this->db->where('prioritas', $nm_prio=$this->input->post('prio'));
            $q = $this->db->get('tbl_ver_usulan');
            $response = $q->result_array();

        }    
        return $response;

    }
        



// function cetak1($kd_sumber_usulan)
//          {
//          $return = array();
//          if($kd_sumber_usulan = 'kd_sumber_usulan' ){
//          $this->db->select('*');
//          $this->db->where('kd_sumber_usulan', $kd_sumber_usulan = 'kd_sumber_usulan');
//            $this->db->from('tbl_ver_usulan');
//               $q = $this->db->get();
//             if ($q->num_rows()>0) {
//                 foreach ($q->result() as $row) {
//                  array_push($return, $row);
//                     }
//                 }
//           }
//          return $return;
//          }

}