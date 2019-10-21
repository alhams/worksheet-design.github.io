<?php
defined('BASEPATH') OR exit('No direct script access allowed');

        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        use PhpOffice\PhpSpreadsheet\Style\Alignment;
        use PhpOffice\PhpSpreadsheet\Style\Fill;

class Administrator extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = hash("sha512", md5($this->input->post('b')));
			$cek = $this->model_app->cek_login($username,$password,'users');
          $row = $cek->row_array();
          $total = $cek->num_rows();
          if ($total > 0){
            $this->session->set_userdata('upload_image_file_manager',true);
            $this->session->set_userdata(array('username'=>$row['username'],
             'level'=>$row['level'],
             'id_session'=>$row['id_session']));

            redirect('administrator/home');
        }else{
            $data['title'] = 'Username atau Password salah!';
            $this->load->view('administrator/view_login',$data);
        }
    }else{
     $data['title'] = 'Administrator &rsaquo; Log In';
     $this->load->view('administrator/view_login',$data);
 }
}


function logout(){
    $this->session->sess_destroy();
    redirect('administrator');
}

function reset_password(){
    if (isset($_POST['submit'])){
        $usr = $this->model_app->edit('users', array('id_session' => $this->input->post('id_session')));
        if ($usr->num_rows()>=1){
            if ($this->input->post('a')==$this->input->post('b')){
                $data = array('password'=>hash("sha512", md5($this->input->post('a'))));
                $where = array('id_session' => $this->input->post('id_session'));
                $this->model_app->update('users', $data, $where);
                $row = $usr->row_array();
                $this->session->set_userdata('upload_image_file_manager',true);
                $this->session->set_userdata(array('username'=>$row['username'],
                 'level'=>$row['level'],
                 'id_session'=>$row['id_session']));
                redirect('administrator/home');
            }else{
                $data['title'] = 'Password Tidak sama!';
                $this->load->view('administrator/view_reset',$data);
            }
        }else{
            $data['title'] = 'Terjadi Kesalahan!';
            $this->load->view('administrator/view_reset',$data);
        }
    }else{
        $this->session->set_userdata(array('id_session'=>$this->uri->segment(3)));
        $data['title'] = 'Reset Password';
        $this->load->view('administrator/view_reset',$data);
    }
}

function manajemenuser(){
    cek_session_akses('manajemenuser',$this->session->id_session);
    $data['record'] = $this->model_app->view_ordering('users','username','DESC');
    $this->template->load('administrator/template','administrator/form_users/view_users',$data);
}

function edit_manajemenuser(){
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
        $config['upload_path'] = 'assets/foto_user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']=='' AND $this->input->post('b') ==''){
                $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                    'email'=>$this->db->escape_str($this->input->post('d')),
                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') ==''){
                $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                    'email'=>$this->db->escape_str($this->input->post('d')),
                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                    'foto'=>$hasil['file_name'],
                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']=='' AND $this->input->post('b') !=''){
                $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                    'password'=>hash("sha512", md5($this->input->post('b'))),
                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                    'email'=>$this->db->escape_str($this->input->post('d')),
                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') !=''){
                $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                    'password'=>hash("sha512", md5($this->input->post('b'))),
                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                    'email'=>$this->db->escape_str($this->input->post('d')),
                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                    'foto'=>$hasil['file_name'],
                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }
            if($this->session->level=='admin'){
                $where = array('username' => $this->input->post('id'));
            }elseif ($this->session->username==$this->input->post('id')){
                $where = array('username' => $this->session->username);
            }
            $this->model_app->update('users', $data, $where);
            $mod=count($this->input->post('modul'));
            $modul=$this->input->post('modul');
            for($i=0;$i<$mod;$i++){
                $datam = array('id_session'=>$this->input->post('ids'),
                  'id_modul'=>$modul[$i]);
                $this->model_app->insert('users_modul',$datam);
            }
            redirect('administrator/edit_manajemenuser/'.$this->input->post('id'));
        }else{
            if ($this->session->username==$this->uri->segment(3) OR $this->session->level=='admin'){
                $proses = $this->model_app->edit('users', array('username' => $id))->row_array();
                $akses = $this->model_app->view_join_where('users_modul','modul','id_modul', array('id_session' => $proses['id_session']),'id_umod','DESC');
                $modul = $this->model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
                $data = array('rows' => $proses, 'record' => $modul, 'akses' => $akses);
                $this->template->load('administrator/template','administrator/form_users/view_users_edit',$data);
            }else{
                redirect('administrator/edit_manajemenuser/'.$this->session->username);
            }
        }
    }


    function home(){
        if ($this->session->level=='admin'){
            $this->template->load('administrator/template','administrator/view_home_admin');
        }else{
          $data['users'] = $this->model_app->view_where('users',array('username'=>$this->session->username))->row_array();
          $data['modul'] = $this->model_app->view_join_one('users','users_modul','id_session','id_umod','DESC');
          $this->template->load('administrator/template','administrator/view_home_users',$data);
      }
  }

  function identitaswebsite(){
    cek_session_akses('identitaswebsite',$this->session->id_session);
    if (isset($_POST['submit'])){
        $config['upload_path'] = 'assets/images/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size'] = '500'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('j');
            $hasil=$this->upload->data();


            if ($hasil['file_name']==''){
                $data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                    'email'=>$this->db->escape_str($this->input->post('b')),
                    'url'=>$this->db->escape_str($this->input->post('c')),
                    'facebook'=>$this->input->post('d'),
                    'no_telp'=>$this->db->escape_str($this->input->post('f')),
                    'meta_deskripsi'=>$this->input->post('g'),
                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                    'maps'=>$this->input->post('i'));
            }else{
                $data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                    'email'=>$this->db->escape_str($this->input->post('b')),
                    'url'=>$this->db->escape_str($this->input->post('c')),
                    'facebook'=>$this->input->post('d'),
                    'no_telp'=>$this->db->escape_str($this->input->post('f')),
                    'meta_deskripsi'=>$this->input->post('g'),
                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                    'favicon'=>$hasil['file_name'],
                    'maps'=>$this->input->post('i'));
            }
            $where = array('id_identitas' => $this->input->post('id'));
            $this->model_app->update('identitas', $data, $where);

            redirect('administrator/identitaswebsite');
        }else{
            $proses = $this->model_app->edit('identitas', array('id_identitas' => 1))->row_array();
            $data = array('record' => $proses);
            $this->template->load('administrator/template','administrator/form_identitas/view_identitas',$data);
        }
    }


    function search()
    {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);
        // cari di database
        $data = $this->db->from('dat_penduduk')->like('subjek_pajak_id',$keyword)->get();   
        // format keluaran di dalam array
        foreach($data->result() as $row)
        {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' =>$row->nama_wp,
                'nama'  =>$row->nama,
                'gol'   =>$row->gol,
                'unit_kerja'    =>$row->unit_kerja
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }


    function kab(){
       cek_session_akses('kab',$this->session->id_session);
       if ($this->session->level=='admin'){
        $data['record'] = $this->model_app->view_ordering('ref_tbl_kab','no_urut','ASC');
    }else{
        $data['record'] = $this->model_app->view_where_ordering('ref_tbl_kab',array('username'=>$this->session->username),'no_urut','ASC');
    }
    $this->template->load('administrator/template','administrator/form_kab/view_kab',$data);
}


function tambah_kab(){
    cek_session_akses('tambah_kab',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_kab'=>$this->db->escape_str($this->input->post('b')),
            'nm_kab'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_kab',$data);
        redirect('administrator/kab');
    }else{
     $proses = $this->model_app->view('ref_tbl_kab');
     $data1= $this->model_app->nomor_kab();
     $data2= $this->model_app->nomor_urut_kab();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_kab/view_tambah_kab',$data);
 }
}

function ubah_kab(){
    cek_session_akses('ubah_kab',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_kab'=>$this->db->escape_str($this->input->post('b')),
            'nm_kab'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $where = array('no_urut' => $this->input->post('id'));
        $this->model_app->update('ref_tbl_kab',$data,$where);
        redirect('administrator/kab');
    }else{
        if($this->session->level=='admin'){
            $proses = $this->model_app->edit('ref_tbl_kab', array('no_urut' => $a))->row_array();
        }else{
           $proses = $this->model_app->edit('ref_tbl_kab', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
       }
       $data = array('rows' => $proses);
       $this->template->load('administrator/template','administrator/form_kab/view_edit_kab',$data);
   }
}

function kec(){
   cek_session_akses('kec',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_join_one('ref_tbl_kab','ref_tbl_kec','kd_kab','kd_kec','ASC');
}else{
    $data['record'] = $this->model_app->view_join_one('ref_tbl_kab','ref_tbl_kec','kd_kab','kd_kec','ASC');
}
$this->template->load('administrator/template','administrator/form_kec/view_kec',$data);
}

function tambah_kec(){
    cek_session_akses('tambah_kec',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
            'kd_kec'=>$this->db->escape_str($this->input->post('b')),
            'nm_kec'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_kec',$data);
        redirect('administrator/kec');
    }else{
     $proses = $this->model_app->view_ordering('ref_tbl_kab','no_urut','ASC');
     $data1= $this->model_app->nomor_kec();
     $data2= $this->model_app->nomor_urut_kec();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_kec/view_tambah_kec',$data);
 }
}

function ubah_kec(){
    cek_session_akses('ubah_kec',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
        'kd_kec'=>$this->db->escape_str($this->input->post('b')),
        'nm_kec'=>$this->db->escape_str($this->input->post('c')),
        'username'=>$this->session->username);
       $where = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('ref_tbl_kec',$data,$where);
       redirect('administrator/kec');
   }else{
    if($this->session->level=='admin'){

        $proses = $this->model_app->edit('ref_tbl_kec', array('no_urut' => $a))->row_array();
        $proses1 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','ASC');
      
    }else{
        $proses1 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','ASC');
        $proses = $this->model_app->edit('ref_tbl_kec', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
    }
    $data = array('rows' => $proses, 'proses1' =>$proses1);
    $this->template->load('administrator/template','administrator/form_kec/view_edit_kec',$data);
}
}

function desa(){
   cek_session_akses('desa',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_join_one11('ref_tbl_kab','ref_tbl_kec','ref_tbl_desa','kd_kab','kd_kec','kd_desa','ASC');
}else{
    $data['record'] = $this->model_app->view_join_one11('ref_tbl_kab','ref_tbl_kec','ref_tbl_desa','kd_kab','kd_kec','kd_desa','ASC');
}
$this->template->load('administrator/template','administrator/form_desa/view_desa',$data);
}

function tambah_desa(){
    cek_session_akses('tambah_desa',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
            'kd_kec'=>$this->db->escape_str($this->input->post('kec')),
            'kd_desa'=>$this->db->escape_str($this->input->post('b')),
            'nm_desa'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_desa',$data);
        redirect('administrator/desa');
    }else{
     $proses = $this->model_app->view_ordering('ref_tbl_kab','no_urut','ASC');
     $data1= $this->model_app->nomor_desa();
     $data2= $this->model_app->nomor_urut_desa();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_desa/view_tambah_desa',$data);
 }
}


function ubah_desa(){
    cek_session_akses('ubah_desa',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
        'kd_kec'=>$this->db->escape_str($this->input->post('kec')),
        'nm_desa'=>$this->db->escape_str($this->input->post('desa')),
        'username'=>$this->session->username);
       $where = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('ref_tbl_desa',$data,$where);
       redirect('administrator/desa');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_desa', array('no_urut' => $a))->row_array();
        $proses1 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','ASC');
         $proses2 = $this->model_app->view_ordering('ref_tbl_kec','no_urut','ASC');
    }else{
      
        $proses = $this->model_app->edit('ref_tbl_desa', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
          $proses1 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','ASC');
           $proses2 = $this->model_app->view_ordering('ref_tbl_kec','no_urut','ASC');
    }
    $data = array('rows' => $proses, 'proses1' =>$proses1, 'proses2' =>$proses2);
    $this->template->load('administrator/template','administrator/form_desa/view_edit_desa',$data);
}
}


function sumber_dana(){
   cek_session_akses('sumber_dana',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_ordering('ref_tbl_dana','no_urut','ASC');
}else{
    $data['record'] = $this->model_app->view_where_ordering('ref_tbl_dana',array('username'=>$this->session->username),'no_urut','ASC');
}
$this->template->load('administrator/template','administrator/form_sumber_dana/view_sumber_dana',$data);
}


function tambah_sumber_dana(){
    cek_session_akses('tambah_sumber_dana',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_dana'=>$this->db->escape_str($this->input->post('b')),
            'nm_dana'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_dana',$data);
        redirect('administrator/sumber_dana');
    }else{
     $proses = $this->model_app->view('ref_tbl_dana');
     $data1= $this->model_app->nomor_dana();
     $data2= $this->model_app->nomor_urut_dana();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_sumber_dana/view_tambah_sumber_dana',$data);
 }
}

function ubah_sumber_dana(){
    cek_session_akses('ubah_sumber_dana',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_dana'=>$this->db->escape_str($this->input->post('b')),
            'nm_dana'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $where = array('no_urut' => $this->input->post('id'));
        $this->model_app->update('ref_tbl_dana',$data,$where);
        redirect('administrator/sumber_dana');
    }else{
        if($this->session->level=='admin'){
            $proses = $this->model_app->edit('ref_tbl_dana', array('no_urut' => $a))->row_array();
        }else{
           $proses = $this->model_app->edit('ref_tbl_dana', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
       }
       $data = array('rows' => $proses);
       $this->template->load('administrator/template','administrator/form_sumber_dana/view_edit_sumber_dana',$data);
   }
}


function kawasan_strategis(){
   cek_session_akses('kawasan_strategis',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_ordering('ref_tbl_kawasan','no_urut','ASC');
}else{
    $data['record'] = $this->model_app->view_where_ordering('ref_tbl_kawasan',array('username'=>$this->session->username),'no_urut','ASC');
}
$this->template->load('administrator/template','administrator/form_kawasan_strategis/view_kawasan_strategis',$data);
}


function tambah_kawasan_strategis(){
    cek_session_akses('tambah_kawasan_strategis',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_kawasan'=>$this->db->escape_str($this->input->post('b')),
            'nm_kawasan'=>$this->db->escape_str($this->input->post('c')),
            'skor'=>$this->db->escape_str($this->input->post('d')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_kawasan',$data);
        redirect('administrator/kawasan_strategis');
    }else{
     $proses = $this->model_app->view('ref_tbl_kawasan');
     $data1= $this->model_app->nomor_kawasan();
     $data2= $this->model_app->nomor_urut_kawasan();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_kawasan_strategis/view_tambah_kawasan_strategis',$data);
 }
}

function ubah_kawasan_strategis(){
    cek_session_akses('ubah_kawasan_strategis',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
      $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_kawasan'=>$this->db->escape_str($this->input->post('b')),
        'nm_kawasan'=>$this->db->escape_str($this->input->post('c')),
        'skor'=>$this->db->escape_str($this->input->post('d')),
        'username'=>$this->session->username);
      $where = array('no_urut' => $this->input->post('id'));
      $this->model_app->update('ref_tbl_kawasan',$data,$where);
      redirect('administrator/kawasan_strategis');
  }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_kawasan', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_kawasan', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_kawasan_strategis/view_edit_kawasan_strategis',$data);
}
}


function kawasan_hutan(){
   cek_session_akses('kawasan_hutan',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_ordering('ref_tbl_kawasan_hutan','no_urut','ASC');
}else{
    $data['record'] = $this->model_app->view_where_ordering('ref_tbl_kawasan_hutan',array('username'=>$this->session->username),'no_urut','ASC');
}
$this->template->load('administrator/template','administrator/form_kawasan_hutan/view_kawasan_hutan',$data);
}


function tambah_kawasan_hutan(){
    cek_session_akses('tambah_kawasan_hutan',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_kawasan_hutan'=>$this->db->escape_str($this->input->post('b')),
            'nm_kawasan_hutan'=>$this->db->escape_str($this->input->post('c')),
            'skor'=>$this->db->escape_str($this->input->post('d')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_kawasan_hutan',$data);
        redirect('administrator/kawasan_hutan');
    }else{
     $proses = $this->model_app->view('ref_tbl_kawasan_hutan');
     $data1= $this->model_app->nomor_kawasan_hutan();
     $data2= $this->model_app->nomor_urut_kawasan_hutan();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_kawasan_hutan/view_tambah_kawasan_hutan',$data);
 }
}

function ubah_kawasan_hutan(){
    cek_session_akses('ubah_kawasan_hutan',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
      $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_kawasan_hutan'=>$this->db->escape_str($this->input->post('b')),
        'nm_kawasan_hutan'=>$this->db->escape_str($this->input->post('c')),
        'skor'=>$this->db->escape_str($this->input->post('d')),
        'username'=>$this->session->username);
      $where = array('no_urut' => $this->input->post('id'));
      $this->model_app->update('ref_tbl_kawasan_hutan',$data,$where);
      redirect('administrator/kawasan_hutan');
  }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_kawasan_hutan', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_kawasan_hutan', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_kawasan_hutan/view_edit_kawasan_hutan',$data);
}
}


function kondisi_jalan(){
   cek_session_akses('kondisi_jalan',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_ordering('ref_tbl_kondisi_jalan','no_urut','ASC');
}else{
    $data['record'] = $this->model_app->view_where_ordering('ref_tbl_kondisi_jalan',array('username'=>$this->session->username),'no_urut','ASC');
}
$this->template->load('administrator/template','administrator/form_kondisi_jalan/view_kondisi_jalan',$data);
}


function tambah_kondisi_jalan(){
    cek_session_akses('tambah_kondisi_jalan',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_kondisi_jln'=>$this->db->escape_str($this->input->post('b')),
            'nm_kondisi_jln'=>$this->db->escape_str($this->input->post('c')),
            'skor'=>$this->db->escape_str($this->input->post('d')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_kondisi_jalan',$data);
        redirect('administrator/kondisi_jalan');
    }else{
     $proses = $this->model_app->view('ref_tbl_kondisi_jalan');
     $data1= $this->model_app->nomor_kondisi_jalan();
     $data2= $this->model_app->nomor_urut_kondisi_jalan();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_kondisi_jalan/view_tambah_kondisi_jalan',$data);
 }
}

function ubah_kondisi_jalan(){
    cek_session_akses('ubah_kondisi_jalan',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
      $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_kondisi_jln'=>$this->db->escape_str($this->input->post('b')),
        'nm_kondisi_jln'=>$this->db->escape_str($this->input->post('c')),
        'skor'=>$this->db->escape_str($this->input->post('d')),
        'username'=>$this->session->username);
      $where = array('no_urut' => $this->input->post('id'));
      $this->model_app->update('ref_tbl_kondisi_jalan',$data,$where);
      redirect('administrator/kondisi_jalan');
  }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_kondisi_jalan', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_kondisi_jalan', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_kondisi_jalan/view_edit_kondisi_jalan',$data);
}
}


function koneksi_desa(){
   cek_session_akses('koneksi_desa',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_ordering('ref_tbl_koneksi_desa','no_urut','ASC');
}else{
    $data['record'] = $this->model_app->view_where_ordering('ref_tbl_koneksi_desa',array('username'=>$this->session->username),'no_urut','ASC');
}
$this->template->load('administrator/template','administrator/form_koneksi_desa/view_koneksi_desa',$data);
}


function tambah_koneksi_desa(){
    cek_session_akses('tambah_koneksi_desa',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_koneksi_desa'=>$this->db->escape_str($this->input->post('b')),
            'nm_koneksi_desa'=>$this->db->escape_str($this->input->post('c')),
            'skor'=>$this->db->escape_str($this->input->post('d')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_koneksi_desa',$data);
        redirect('administrator/koneksi_desa');
    }else{
     $proses = $this->model_app->view('ref_tbl_koneksi_desa');
     $data1= $this->model_app->nomor_koneksi_desa();
     $data2= $this->model_app->nomor_urut_koneksi_desa();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_koneksi_desa/view_tambah_koneksi_desa',$data);
 }
}

function ubah_koneksi_desa(){
    cek_session_akses('ubah_koneksi_desa',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_koneksi_desa'=>$this->db->escape_str($this->input->post('b')),
        'nm_koneksi_desa'=>$this->db->escape_str($this->input->post('c')),
        'skor'=>$this->db->escape_str($this->input->post('d')),
        'username'=>$this->session->username);
       $where = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('ref_tbl_koneksi_desa',$data,$where);
       redirect('administrator/koneksi_desa');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_koneksi_desa', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_koneksi_desa', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_koneksi_desa/view_edit_koneksi_desa',$data);
}
}


function status_jalan(){
   cek_session_akses('status_jalan',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_ordering('ref_tbl_stts_jln','no_urut','ASC');
}else{
    $data['record'] = $this->model_app->view_where_ordering('ref_tbl_stts_jln',array('username'=>$this->session->username),'no_urut','ASC');
}
$this->template->load('administrator/template','administrator/form_status_jalan/view_status_jalan',$data);
}

function tambah_status_jalan(){
    cek_session_akses('tambah_status_jalan',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_stts_jln'=>$this->db->escape_str($this->input->post('b')),
            'nm_stts_jln'=>$this->db->escape_str($this->input->post('c')),
            'skor'=>$this->db->escape_str($this->input->post('d')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_stts_jln',$data);
        redirect('administrator/status_jalan');
    }else{
     $proses = $this->model_app->view('ref_tbl_stts_jln');
     $data1= $this->model_app->nomor_status_jalan();
     $data2= $this->model_app->nomor_urut_status_jalan();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_status_jalan/view_tambah_status_jalan',$data);
 }
}

function ubah_status_jalan(){
    cek_session_akses('ubah_status_jalan',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_stts_jln'=>$this->db->escape_str($this->input->post('b')),
        'nm_stts_jln'=>$this->db->escape_str($this->input->post('c')),
        'skor'=>$this->db->escape_str($this->input->post('d')),
        'username'=>$this->session->username);
       $where = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('ref_tbl_stts_jln',$data,$where);
       redirect('administrator/status_jalan');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_stts_jln', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_stts_jln', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_status_jalan/view_edit_status_jalan',$data);
}
}

function sumber_usulan(){
   cek_session_akses('sumber_usulan',$this->session->id_session);
   if ($this->session->level=='admin'){
    $data['record'] = $this->model_app->view_ordering('ref_tbl_sumber_usulan','no_urut','ASC');
}else{
    $data['record'] = $this->model_app->view_where_ordering('ref_tbl_sumber_usulan',array('username'=>$this->session->username),'no_urut','ASC');
}
$this->template->load('administrator/template','administrator/form_sumber_usulan/view_sumber_usulan',$data);
}

function tambah_sumber_usulan(){
    cek_session_akses('tambah_sumber_usulan',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_sumber_usulan'=>$this->db->escape_str($this->input->post('b')),
            'nm_sumber_usulan'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_sumber_usulan',$data);
        redirect('administrator/sumber_usulan');
    }else{
     $proses = $this->model_app->view('ref_tbl_sumber_usulan');
     $data1= $this->model_app->nomor_sumber_usulan();
     $data2= $this->model_app->nomor_urut_sumber_usulan();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_sumber_usulan/view_tambah_sumber_usulan',$data);
 }
}

function ubah_sumber_usulan(){
    cek_session_akses('ubah_sumber_usulan',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_sumber_usulan'=>$this->db->escape_str($this->input->post('b')),
        'nm_sumber_usulan'=>$this->db->escape_str($this->input->post('c')),
        'username'=>$this->session->username);
       $where = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('ref_tbl_sumber_usulan',$data,$where);
       redirect('administrator/sumber_usulan');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_sumber_usulan', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_sumber_usulan', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_sumber_usulan/view_edit_sumber_usulan',$data);
}
}


function satuan(){
    cek_session_akses('satuan',$this->session->id_session);
    if ($this->session->level=='admin'){
        $data['record'] = $this->model_app->view_ordering('ref_tbl_satuan','no_urut','ASC');
    }else{
        $data['record'] = $this->model_app->view_where_ordering('ref_tbl_satuan',array('username'=>$this->session->username),'no_urut','ASC');
    }
    $this->template->load('administrator/template','administrator/form_satuan/view_satuan',$data);
}

function tambah_satuan(){
    cek_session_akses('tambah_satuan',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_satuan'=>$this->db->escape_str($this->input->post('b')),
            'nm_satuan'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_satuan',$data);
        redirect('administrator/satuan');
    }else{
     $proses = $this->model_app->view('ref_tbl_satuan');
     $data1= $this->model_app->nomor_satuan();
     $data2= $this->model_app->nomor_urut_satuan();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_satuan/view_tambah_satuan',$data);
 }
}

function ubah_satuan(){
    cek_session_akses('ubah_satuan',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_satuan'=>$this->db->escape_str($this->input->post('b')),
        'nm_satuan'=>$this->db->escape_str($this->input->post('c')),
        'username'=>$this->session->username);
       $where = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('ref_tbl_satuan',$data,$where);
       redirect('administrator/satuan');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_satuan', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_satuan', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_satuan/view_edit_satuan',$data);
}
}

function prio(){
    cek_session_akses('prio',$this->session->id_session);
    if ($this->session->level=='admin'){
        $data['record'] = $this->model_app->view_ordering('ref_tbl_prio','no_urut','ASC');
    }else{
        $data['record'] = $this->model_app->view_where_ordering('ref_tbl_prio',array('username'=>$this->session->username),'no_urut','ASC');
    }
    $this->template->load('administrator/template','administrator/form_prio/view_prio',$data);
}

function tambah_prio(){
    cek_session_akses('tambah_prio',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'kd_prio'=>$this->db->escape_str($this->input->post('b')),
            'nm_prio'=>$this->db->escape_str($this->input->post('c')),
            'username'=>$this->session->username);
        $this->model_app->insert('ref_tbl_prio',$data);
        redirect('administrator/prio');
    }else{
     $proses = $this->model_app->view('ref_tbl_prio');
     $data1= $this->model_app->nomor_prio();
     $data2= $this->model_app->nomor_urut_prio();
     $data = array('record' => $proses, 'no' =>$data1, 'nourut' =>$data2);
     $this->template->load('administrator/template','administrator/form_prio/view_tambah_prio',$data);
 }
}


function ubah_prio(){
    cek_session_akses('ubah_prio',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_prio'=>$this->db->escape_str($this->input->post('b')),
        'nm_prio'=>$this->db->escape_str($this->input->post('c')),
        'username'=>$this->session->username);
       $where = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('ref_tbl_prio',$data,$where);
       redirect('administrator/prio');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('ref_tbl_prio', array('no_urut' => $a))->row_array();
    }else{
       $proses = $this->model_app->edit('ref_tbl_prio', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
   }
   $data = array('rows' => $proses);
   $this->template->load('administrator/template','administrator/form_prio/view_edit_prio',$data);
}
}


function usulan(){
    cek_session_akses('usulan',$this->session->id_session);
    if ($this->session->level=='admin'){
        $data['record'] = $this->model_app->view_join_one111('tbl_usulan','ref_tbl_kab','ref_tbl_kec','ref_tbl_desa','ref_tbl_satuan','ref_tbl_sumber_usulan','kd_kab','kd_kec','kd_desa','kd_satuan','kd_sumber_usulan','kd_usulan','ASC');
    }else{
        $data['record'] = $this->model_app->view_where_ordering('tbl_usulan',array('username'=>$this->session->username),'no_urut','ASC');
    }
    $this->template->load('administrator/template','administrator/form_usulan/view_usulan',$data);
}


function tambah_usulan_kegiatan(){
    cek_session_akses('tambah_usulan_kegiatan',$this->session->id_session);
    if (isset($_POST['submit'])){
        $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'thn_usulan'=>$this->db->escape_str($this->input->post('thn')),
            'kd_usulan'=>$this->db->escape_str($this->input->post('a')),
            'nm_usulan'=>$this->db->escape_str($this->input->post('b')),
            'alamat'=>$this->db->escape_str($this->input->post('c')),
            'kd_sumber_usulan'=>$this->db->escape_str($this->input->post('f')),
            'volume'=>$this->db->escape_str($this->input->post('e')),
            'kd_dana'=>$this->db->escape_str($this->input->post('dana')),
            'kd_satuan'=>$this->db->escape_str($this->input->post('satuan')),
            'anggaran'=>$this->db->escape_str($this->input->post('mtotal')),
            'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
            'kd_kec'=>$this->db->escape_str($this->input->post('kec')),
            'kd_desa'=>$this->db->escape_str($this->input->post('desa')),
            'username'=>$this->session->username,
            'stts_usulan'=>$this->db->escape_str($this->input->post('submit')));
        $data1 = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'thn_usulan'=>$this->db->escape_str($this->input->post('thn')),
            'kd_usulan'=>$this->db->escape_str($this->input->post('a')),
            'nm_usulan'=>$this->db->escape_str($this->input->post('b')),
            'alamat'=>$this->db->escape_str($this->input->post('c')),
            'kd_sumber_usulan'=>$this->db->escape_str($this->input->post('f')),
            'volume'=>$this->db->escape_str($this->input->post('e')),
            'kd_dana'=>$this->db->escape_str($this->input->post('dana')),
            'kd_satuan'=>$this->db->escape_str($this->input->post('satuan')),
            'anggaran'=>$this->db->escape_str($this->input->post('mtotal')),
            'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
            'kd_kec'=>$this->db->escape_str($this->input->post('kec')),
            'kd_desa'=>$this->db->escape_str($this->input->post('desa')),
            'username'=>$this->session->username,
            'stts_ver'=>$this->db->escape_str($this->input->post('submit')));
        $this->model_app->insert('tbl_usulan',$data);
        $this->model_app->insert('tbl_ver_usulan',$data1);
        redirect('administrator/usulan');
    }else{

        $proses = $this->model_app->view_ordering('ref_tbl_kab','no_urut','DESC');
        $proses1 = $this->model_app->view_ordering('ref_tbl_sumber_usulan','no_urut','DESC');
        $proses2 = $this->model_app->view_ordering('ref_tbl_satuan','no_urut','DESC');
        $proses3 = $this->model_app->view_ordering('ref_tbl_dana','no_urut','DESC');
        $thn = $this->model_app->tahun();
        $data1= $this->model_app->nomor_usulan();
        $data2= $this->model_app->nomor_urut_usulan();
        $data = array('record' => $proses,'no'=> $data1,'nomor'=> $data2, 'proses1'=> $proses1,'proses2'=>$proses2,'proses3'=>$proses3,'thn'=>$thn);
        $this->template->load('administrator/template','administrator/form_usulan/view_tambah_usulan',$data);
    }
}

function ubah_usulan_kegiatan(){
    cek_session_akses('ubah_usulan_kegiatan',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
             'thn_usulan'=>$this->db->escape_str($this->input->post('thn')),
            'kd_usulan'=>$this->db->escape_str($this->input->post('a')),
            'nm_usulan'=>$this->db->escape_str($this->input->post('b')),
            'alamat'=>$this->db->escape_str($this->input->post('c')),
            'kd_sumber_usulan'=>$this->db->escape_str($this->input->post('sumber')),
            'volume'=>$this->db->escape_str($this->input->post('e')),
            'kd_dana'=>$this->db->escape_str($this->input->post('dana')),
            'kd_satuan'=>$this->db->escape_str($this->input->post('satuan')),
            'anggaran'=>$this->db->escape_str($this->input->post('mtotal')),
            'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
            'kd_kec'=>$this->db->escape_str($this->input->post('kec')),
            'kd_desa'=>$this->db->escape_str($this->input->post('desa')),
            'username'=>$this->session->username,
            'stts_usulan'=>$this->db->escape_str($this->input->post('submit')));
       $where = array('no_urut' => $this->input->post('id'));
       $data1 = array('no_urut'=>$this->db->escape_str($this->input->post('id')),
            'thn_usulan'=>$this->db->escape_str($this->input->post('thn')),
            'kd_usulan'=>$this->db->escape_str($this->input->post('a')),
            'nm_usulan'=>$this->db->escape_str($this->input->post('b')),
            'alamat'=>$this->db->escape_str($this->input->post('c')),
            'kd_sumber_usulan'=>$this->db->escape_str($this->input->post('sumber')),
            'volume'=>$this->db->escape_str($this->input->post('e')),
            'kd_dana'=>$this->db->escape_str($this->input->post('dana')),
            'kd_satuan'=>$this->db->escape_str($this->input->post('satuan')),
            'anggaran'=>$this->db->escape_str($this->input->post('mtotal')),
            'kd_kab'=>$this->db->escape_str($this->input->post('kab')),
            'kd_kec'=>$this->db->escape_str($this->input->post('kec')),
            'kd_desa'=>$this->db->escape_str($this->input->post('desa')),
            'username'=>$this->session->username,
            'stts_ver'=>$this->db->escape_str($this->input->post('submit')));
       $where1 = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('tbl_usulan',$data,$where);
       $this->model_app->update('tbl_ver_usulan',$data1,$where1);
       redirect('administrator/usulan');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('tbl_ver_usulan', array('no_urut' => $a))->row_array();
        $proses1 = $this->model_app->view_ordering('ref_tbl_sumber_usulan','no_urut','DESC');
        $proses2 = $this->model_app->view_ordering('ref_tbl_satuan','no_urut','DESC');
        $proses3 = $this->model_app->view_ordering('ref_tbl_dana','no_urut','DESC');
        $proses4 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','DESC');
        $proses5 = $this->model_app->view_ordering('ref_tbl_kec','no_urut','DESC');
        $proses6 = $this->model_app->view_ordering('ref_tbl_desa','no_urut','DESC');               
        $proses7 = $this->model_app->view_ordering('ref_tbl_kawasan','no_urut','DESC');
        $proses8 = $this->model_app->view_ordering('ref_tbl_kawasan_hutan','no_urut','DESC');
        $proses9 = $this->model_app->view_ordering('ref_tbl_kondisi_jalan','no_urut','DESC');
        $proses10 = $this->model_app->view_ordering('ref_tbl_koneksi_desa','no_urut','DESC');
        $proses30 = $this->model_app->view_ordering('ref_tbl_stts_jln','no_urut','DESC');
        $thn = $this->model_app->tahun();
    }else{
       $proses = $this->model_app->edit('tbl_ver_usulan', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
       $proses1 = $this->model_app->view_ordering('ref_tbl_sumber_usulan','no_urut','DESC');
       $proses2 = $this->model_app->view_ordering('ref_tbl_satuan','no_urut','DESC');
       $proses3 = $this->model_app->view_ordering('ref_tbl_dana','no_urut','DESC');
       $proses4 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','DESC');
       $proses5 = $this->model_app->view_ordering('ref_tbl_kec','no_urut','DESC');
       $proses6 = $this->model_app->view_ordering('ref_tbl_desa','no_urut','DESC');               
       $proses7 = $this->model_app->view_ordering('ref_tbl_kawasan','no_urut','DESC');
       $proses8 = $this->model_app->view_ordering('ref_tbl_kawasan_hutan','no_urut','DESC');
       $proses9 = $this->model_app->view_ordering('ref_tbl_kondisi_jalan','no_urut','DESC');
       $proses10 = $this->model_app->view_ordering('ref_tbl_koneksi_desa','no_urut','DESC');
       $proses30 = $this->model_app->view_ordering('ref_tbl_stts_jln','no_urut','DESC');
       $thn = $this->model_app->tahun();
   }
   $data = array('rows' => $proses,'proses1'=> $proses1,'proses2'=>$proses2,'proses3'=>$proses3,'thn'=>$thn,'proses4'=>$proses4,'proses5'=>$proses5,'proses6'=>$proses6,'proses7'=>$proses7,'proses8'=>$proses8,'proses9'=>$proses9,'proses10'=>$proses10,'proses30'=>$proses30);
   $this->template->load('administrator/template','administrator/form_usulan/view_edit_usulan',$data);
}
}





function v_usulan(){
    cek_session_akses('v_usulan',$this->session->id_session);
    if ($this->session->level=='admin'){
        $data['record'] = $this->model_app->view_join_one111('tbl_ver_usulan','ref_tbl_kab','ref_tbl_kec','ref_tbl_desa','ref_tbl_satuan','ref_tbl_sumber_usulan','kd_kab','kd_kec','kd_desa','kd_satuan','kd_sumber_usulan','kd_usulan','ASC');
    }else{
        $data['record'] = $this->model_app->view_where_ordering('tbl_ver_usulan',array('username'=>$this->session->username),'no_urut','ASC');
    }
    $this->template->load('administrator/template','administrator/form_verifikasi_usulan/view_verifikasi_usulan',$data);
}

function verifikasi_usulan(){
    cek_session_akses('verifikasi_usulan',$this->session->id_session);
    $a = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array( 'no_urut'=>$this->db->escape_str($this->input->post('id')),
        'kd_kawasan'=>$this->db->escape_str($this->input->post('stra')),
        'kd_kawasan_hutan'=>$this->db->escape_str($this->input->post('hutan')),
        'kd_kondisi_jln'=>$this->db->escape_str($this->input->post('jln')),
        'kd_koneksi_desa'=>$this->db->escape_str($this->input->post('koneksi')),
        'kd_stts_jln'=>$this->db->escape_str($this->input->post('stts')),
        'skor_a'=>$this->db->escape_str($this->input->post('skor1')),
        'skor_b'=>$this->db->escape_str($this->input->post('skor2')),
        'skor_c'=>$this->db->escape_str($this->input->post('skor3')),
        'skor_d'=>$this->db->escape_str($this->input->post('skor4')),
        'skor_e'=>$this->db->escape_str($this->input->post('skor5')),
        'prioritas'=>$this->db->escape_str($this->input->post('prioritas')),
        'ttl_skor'=>$this->db->escape_str($this->input->post('total')),
        'username'=>$this->session->username,
        'stts_ver'=>$this->db->escape_str($this->input->post('submit')));
       $where = array('no_urut' => $this->input->post('id'));
       $data1 = array('stts_usulan'=>$this->db->escape_str($this->input->post('submit')));
       $where1 = array('no_urut' => $this->input->post('id'));
       $this->model_app->update('tbl_ver_usulan',$data,$where);
       $this->model_app->update('tbl_usulan',$data1,$where1);
       redirect('administrator/v_usulan');
   }else{
    if($this->session->level=='admin'){
        $proses = $this->model_app->edit('tbl_ver_usulan', array('no_urut' => $a))->row_array();
        $proses1 = $this->model_app->view_ordering('ref_tbl_sumber_usulan','no_urut','DESC');
        $proses2 = $this->model_app->view_ordering('ref_tbl_satuan','no_urut','DESC');
        $proses3 = $this->model_app->view_ordering('ref_tbl_dana','no_urut','DESC');
        $proses4 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','DESC');
        $proses5 = $this->model_app->view_ordering('ref_tbl_kec','no_urut','DESC');
        $proses6 = $this->model_app->view_ordering('ref_tbl_desa','no_urut','DESC');               
        $proses7 = $this->model_app->view_ordering('ref_tbl_kawasan','no_urut','DESC');
        $proses8 = $this->model_app->view_ordering('ref_tbl_kawasan_hutan','no_urut','DESC');
        $proses9 = $this->model_app->view_ordering('ref_tbl_kondisi_jalan','no_urut','DESC');
        $proses10 = $this->model_app->view_ordering('ref_tbl_koneksi_desa','no_urut','DESC');
        $proses30 = $this->model_app->view_ordering('ref_tbl_stts_jln','no_urut','DESC');
        $thn = $this->model_app->tahun();
    }else{
       $proses = $this->model_app->edit('tbl_ver_usulan', array('no_urut' => $a, 'username'=>$this->session->username))->row_array();
       $proses1 = $this->model_app->view_ordering('ref_tbl_sumber_usulan','no_urut','DESC');
       $proses2 = $this->model_app->view_ordering('ref_tbl_satuan','no_urut','DESC');
       $proses3 = $this->model_app->view_ordering('ref_tbl_dana','no_urut','DESC');
       $proses4 = $this->model_app->view_ordering('ref_tbl_kab','no_urut','DESC');
       $proses5 = $this->model_app->view_ordering('ref_tbl_kec','no_urut','DESC');
       $proses6 = $this->model_app->view_ordering('ref_tbl_desa','no_urut','DESC');               
       $proses7 = $this->model_app->view_ordering('ref_tbl_kawasan','no_urut','DESC');
       $proses8 = $this->model_app->view_ordering('ref_tbl_kawasan_hutan','no_urut','DESC');
       $proses9 = $this->model_app->view_ordering('ref_tbl_kondisi_jalan','no_urut','DESC');
       $proses10 = $this->model_app->view_ordering('ref_tbl_koneksi_desa','no_urut','DESC');
       $proses30 = $this->model_app->view_ordering('ref_tbl_stts_jln','no_urut','DESC');
       $thn = $this->model_app->tahun();
   }
   $data = array('rows' => $proses,'proses1'=> $proses1,'proses2'=>$proses2,'proses3'=>$proses3,'thn'=>$thn,'proses4'=>$proses4,'proses5'=>$proses5,'proses6'=>$proses6,'proses7'=>$proses7,'proses8'=>$proses8,'proses9'=>$proses9,'proses10'=>$proses10,'proses30'=>$proses30);
   $this->template->load('administrator/template','administrator/form_verifikasi_usulan/view_edit_verifikasi_usulan',$data);
}
}

function lihat_cetak_usulan(){
    cek_session_akses('lihat_cetak_usulan',$this->session->id_session);
    if ($this->session->level=='admin'){
        $proses50 = $this->model_app->view_join_one111('tbl_ver_usulan','ref_tbl_kab','ref_tbl_kec','ref_tbl_desa','ref_tbl_satuan','ref_tbl_sumber_usulan','kd_kab','kd_kec','kd_desa','kd_satuan','kd_sumber_usulan','kd_usulan','ASC');
        $proses51 = $this->model_app->view_where_ordering('ref_tbl_sumber_usulan',array('username'=>$this->session->username),'no_urut','ASC');
        $proses52 = $this->model_app->view_where_ordering('ref_tbl_prio',array('username'=>$this->session->username),'no_urut','ASC');
    }else{
        $proses50 = $this->model_app->view_join_one111('tbl_ver_usulan','ref_tbl_kab','ref_tbl_kec','ref_tbl_desa','ref_tbl_satuan','ref_tbl_sumber_usulan','kd_kab','kd_kec','kd_desa','kd_satuan','kd_sumber_usulan','kd_usulan','ASC');
        $proses51 = $this->model_app->view_where_ordering('ref_tbl_sumber_usulan',array('username'=>$this->session->username),'no_urut','ASC');
        $proses52 = $this->model_app->view_where_ordering('ref_tbl_prio',array('username'=>$this->session->username),'no_urut','ASC');
    }
    $data = array('proses50' => $proses50,'proses51'=> $proses51,'proses52'=> $proses52);
    $this->template->load('administrator/template','administrator/form_cetak_usulan/view_cetak_usulan',$data);
}

function cetak_excel(){
    cek_session_akses('cetak_excel',$this->session->id_session);
    $kd_sumber_usulan=$this->input->post('drop');
    $nm_prio=$this->input->post('prio');
    // echo ( $nm_prio); 
    // untuk menampilkan variable
    $record = $this->model_app->getCetak($kd_sumber_usulan,$nm_prio);
          // melihat qeury jalan atau tidaknya
    // printf($kd_sumber_usulan,$nm_prio); 
    $data = array('rows' => $record);
    $this->template->load('administrator/template','administrator/form_cetak_usulan/laporan_pdf',$data);
}

function export(){
        cek_session_akses('export',$this->session->id_session);
         $a = $this->uri->segment(3);
         if (isset($_POST['submit'])){
        $no_urut = array('no_urut'=>$this->db->escape_str($this->input->post('id')));
        $record = $this->model_app->getCetak($no_urut);
printf($rocord);
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

              // $attributes = array('class'=>'form-horizontal','role'=>'form');
              // echo form_open_multipart('administrator/cetak_excel',$attributes); 
        $row=3;
        $no=1;
        foreach ($record as $usulan1) {
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
// echo form_close();
}
}

function cetak_pdf(){
    cek_session_akses('cetak_pdf',$this->session->id_session);
    $kd_sumber_usulan=$this->input->post('drop');
    $nm_prio=$this->input->post('prio');
    // echo $kd_sumber_usulan; untuk menampilkan variable
    $record = $this->model_app->getCetak($kd_sumber_usulan,$nm_prio);
          // melihat qeury jalan atau tidaknya
    print_r($record); 
    $data = array('rows' => $record);
    $this->template->load('administrator/template','administrator/form_cetak_usulan/laporan_pdf',$data);
}



    // combo box dinamis 
function combo_kec(){

  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getKec($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}

     // combo box dinamis 
function combo_desa(){

  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getDesa($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}

// combo box dinamis 
function combo_stra(){

  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getStra($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}

 // combo box dinamis 
function combo_hutan(){

  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getHutan($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}

function combo_jln(){

  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getJalan($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}

function combo_koneksi(){

  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getKoneksi($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}

function combo_stts(){

  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getStts($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}

function combo_cetak(){
  $postData = $this->input->post();
  $this->load->model('Model_app');
  $data = $this->model_app->getCetak($postData);
  echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
}


}