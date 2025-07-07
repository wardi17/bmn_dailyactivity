<?php

class Report extends Controller {
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
	
		//die(var_dump($this->model('KategoriModel')));
		$data['title'] = 'Report transaksi';
		$data['page'] ='report';
		$data['divisi']= $this->model('DivisiModel')->DivisiTampil();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('report/index',$data);
		$this->view('templates/footer');
	}

	public function laporan2(){
		$data['title'] = 'Report transaksi';
		$data['page'] ='report2';
		$data['divisi']= $this->model('DivisiModel')->DivisiTampil();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('report/laporan2',$data);
		$this->view('templates/footer');
	}


	



}