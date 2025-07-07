<?php

class NewActivity extends Controller {
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
		$data['title'] = 'Data NewActivity';
		$data['page'] = "new";
		$data['kategori'] = $this->model('KategoriModel')->getDataKategori();
		$data['status'] = $this->model('StatusModel')->getDataStatus();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('newactivity/index', $data);
		$this->view('templates/footer');
	}


	// untuk tambah data 
		public function tambahActivity(){
			
					$data= $this->model('NewActivityModel')->NewActivityTambah($_POST);
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


		public function deleteActivity(){
			$data= $this->model('NewActivityModel')->ActivityDelete($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}

		public function editData(){
			$data['activity']= $this->model('NewActivityModel')->getActivityById($_POST);
			$data['kategori'] = $this->model('KategoriModel')->getDataKategori();
			$data['status'] = $this->model('StatusModel')->getDataStatus();
			$this->view('listactivity/edit_activity',$data);
			
		}

		public function finishActivity(){
			$data= $this->model('NewActivityModel')->FinishActivity($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}


	
}