<?php

class Jabatan extends Controller {
	public function __construct()
	{	
		if($_SESSION['session_login'] != 'sudah_login') {
			Flasher::setMessage('Login','Tidak ditemukan.','danger');
			header('location: '. base_url . '/login');
			exit;
		}
	} 
	public function index()
	{
		
		$data['title'] = 'Data Jabatan';
		$data['page'] = "jabatan";
		// $data['user'] = $this->model('UserModel')->getAllUser();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('Jabatan/index', $data);
		$this->view('templates/footer');
	}


	// untuk tambah data 
	public function tambahJabatan(){
				$data= $this->model('JabatanModel')->JabatanTambah($_POST);
				if(empty($data)){
					$data = null;
					echo json_encode($data);
				}else{
					echo json_encode($data);
				}
	}

		public function tampildata(){
			$data= $this->model('JabatanModel')->JabatanTampil();
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}


		public function deleteData(){
			$data= $this->model('JabatanModel')->JabatanDelete($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}

		public function editData(){
			$data= $this->model('JabatanModel')->JabatanEdit($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}




	
}