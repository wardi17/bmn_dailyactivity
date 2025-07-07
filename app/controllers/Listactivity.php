<?php

class Listactivity extends Controller {
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
	

		$data['title'] = 'Data listactivity';
		$data['page'] = "listactivity";
		// $data['user'] = $this->model('UserModel')->getAllUser();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('listactivity/index', $data);
		$this->view('templates/footer');
	}


	// untuk tambah data 
	public function tambahdivisi(){
				$data= $this->model('DivisiModel')->DivisiTambah($_POST);
				if(empty($data)){
					$data = null;
					echo json_encode($data);
				}else{
					echo json_encode($data);
				}
	}

		public function tampildata(){
			$data= $this->model('NewActivityModel')->NewActivityTampil();
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}

		public function laporanData1(){
			$data= $this->model('NewActivityModel')->ActivityLaporan1($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}


		public function laporanData2(){
			$data= $this->model('NewActivityModel')->ActivityLaporan2($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}



		public function deleteData(){
			$data= $this->model('DivisiModel')->DivisiDelete($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}

		public function editData(){
			$data= $this->model('DivisiModel')->DivisiEdit($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}


		public function updateActivity(){	
			$data= $this->model('NewActivityModel')->NewActivityUpdate($_POST);
				if(empty($data)){
					$data = null;
					echo json_encode($data);
				}else{
					echo json_encode($data);
				}
			
		}

	
}