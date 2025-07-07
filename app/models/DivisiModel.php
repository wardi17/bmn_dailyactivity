<?php

class DivisiModel {
	
	private $table = 'DailyActivity_divisi';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}



  
	public function DivisiTambah()
	{
		$kode =$this->test_input($_POST["kode"]);
		$nama = $this->test_input($_POST["nama"]);
		$cek = 0;
		$valid = 0;

		if($kode && $nama){
		$query = "SELECT DISTINCT * FROM $this->table where kode_divisi ='$kode' ";
		$sql=$this->db->baca_sql($query);

		$rows= odbc_fetch_array($sql);
		if($rows > 0){
			$valid=1;
		}
		if($valid == 0){
			$sql="INSERT INTO $this->table (kode_divisi,nama_divisi) 
			Values ('". $kode ."','".$nama."')"; 
			
			$result = $this->db->baca_sql($sql);
			if(!$result){
			$cek =$cek+1;
			}
		
			if ($cek==0){
			$status['nilai']=1; //bernilai benar
			$status['error']="Data Berhasil Ditambahkan";
			}else{
			$status['nilai']=0; //bernilai benar
			$status['error']="Data Gagal Ditambahkan";
			}
		}
		else{
			$status['nilai']= 0; //bernilai salah
			$status['error']="id_divisi Sudah terdaftar silahkan ganti";
		}
		
		return $status;

		}
	}


	public function DivisiTampil(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_divisi  ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
		while(odbc_fetch_row($result)){
			$data[] = array(
				"kode_divisi"=>rtrim(odbc_result($result,'kode_divisi')),
				"nama_divisi"=>rtrim(odbc_result($result,'nama_divisi')),
			);
			
			}
		return $data;
	}

	public function DivisiDelete(){
		$kode_divisi = $this->test_input($_POST["kode"]);
		$sql="DELETE FROM $this->table WHERE kode_divisi = '".$kode_divisi."'"; 
		$result = $this->db->baca_sql($sql);
	
		$sql2="DELETE FROM DailyActivity_user WHERE divisi = '".$kode_divisi."' "; 
			$result2 =  $this->db->baca_sql($sql2);
		$cek = 0;
		if(!$result){
			$cek = $cek+1;
		}
		if ($cek==0){
			$status['nilai']=1; //bernilai benar
			$status['error']="Data Berhasil Dihapus";
		}else{
			$status['nilai']=0; //bernilai benar
			$status['error']="Data Gagal Dihapus";
  		}
		return $status;
	}


	public function DivisiEdit(){
		$kode_divisi = $this->test_input($_POST["kode"]);
		$nama_divisi = $this->test_input($_POST["nama"]);
		$sql="UPDATE $this->table SET kode_divisi = '". $kode_divisi ."', nama_divisi = '". $nama_divisi ."'WHERE kode_divisi = '". $kode_divisi ."' "; 
		$result = $this->db->baca_sql($sql);
		$cek =0;
		if(!$result){
		$cek = $cek+1;
		}
		if ($cek==0){
		$status['nilai']=1; //bernilai benar
		$status['error']="Data Berhasil di edit";
		}else{
		$status['nilai']=0; //bernilai benar
		$status['error']="Data Gagal di edit";
		}
		return $status;
	}

	public function getDatadivisi(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_divisi ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
        while(odbc_fetch_row($result)){


            $data[] = array(
                "kode_divisi"=>rtrim(odbc_result($result,'kode_divisi')),
                "nama_divisi"=>rtrim(odbc_result($result,'nama_divisi')),
            
            );
		}

		return $data;
	}


	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}


		









	
}