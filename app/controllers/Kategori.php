<?php

class Kategori extends Controller {
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
	
		$data['title'] = 'Data Kategori';
		$data['page'] = "kategori";
		// $data['user'] = $this->model('UserModel')->getAllUser();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('Kategori/index', $data);
		$this->view('templates/footer');
	}


	// untuk tambah data 
	public function tambahKategori(){
				$data= $this->model('KategoriModel')->KategoriTambah($_POST);
				if(empty($data)){
					$data = null;
					echo json_encode($data);
				}else{
					echo json_encode($data);
				}
	}

		public function tampildata(){
			$data= $this->model('KategoriModel')->KategoriTampil();
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}


		public function deleteData(){
			$data= $this->model('KategoriModel')->KategoriDelete($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}

		public function editData(){
			$data= $this->model('KategoriModel')->KategoriEdit($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}




	
}