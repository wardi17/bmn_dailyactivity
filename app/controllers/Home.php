<?php

class Home extends Controller {
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
		
		$data['title'] = 'Halaman Home';
		$data['message']= $this->model('HomeModel')->DataMessage();
		 $this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('home/get_category_js');
		$this->view('home/get_grafik_js');
		$this->view('home/message');
		$this->view('home/index', $data);
		$this->view('templates/footer');
	}

	public function get_Category(){
		$data= $this->model('HomeModel')->DataKategory($_POST);
		if(empty($data)){
			$data = null;
		  
			echo json_encode($data);
		  }else{
			
			echo json_encode($data);
		  }
	}


	public function get_Grafik(){
		$data= $this->model('HomeModel')->DataGrafik($_POST);
		if(empty($data)){
			$data = null;
		  
			echo json_encode($data);
		  }else{
			
			echo json_encode($data);
		  }
	}

	public function simpancomment(){
		$data = $this->model('HomeModel')->SimpanMessage($_POST);
		if(empty($data)){
			$data = null;
		  
			echo json_encode($data);
		  }else{
			
			echo json_encode($data);
		  }
	}

}