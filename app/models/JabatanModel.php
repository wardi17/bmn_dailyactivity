<?php

class JabatanModel {
	
	private $table = 'DailyActivity_Jabatan';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAllUser()
	{
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->resultSet();
	}

	public function getUserById($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		return $this->db->single();
	}
  
	public function JabatanTambah()
	{
		$kode =$this->test_input($_POST["kode"]);
		$nama = $this->test_input($_POST["nama"]);
		$level = $this->test_input($_POST["level"]);
		$cek = 0;
		$valid = 0;

		if($kode && $nama){
		$query = "SELECT DISTINCT * FROM $this->table where kode_jabatan ='$kode' ";
		$sql=$this->db->baca_sql($query);

		$rows= odbc_fetch_array($sql);
		if($rows > 0){
			$valid=1;
		}
		if($valid == 0){
			$sql="INSERT INTO $this->table (kode_jabatan,nama_jabatan,level_jabatan) 
			Values ('". $kode ."','".$nama."','".$level."')"; 
			
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
			$status['error']="id_Jabatan Sudah terdaftar silahkan ganti";
		}
		
		return $status;

		}
	}


	public function JabatanTampil(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_Jabatan  ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
		while(odbc_fetch_row($result)){
			$data[] = array(
				"kode_jabatan"=>rtrim(odbc_result($result,'kode_jabatan')),
				"level_jabatan"=>rtrim(odbc_result($result,'level_jabatan')),
				"nama_jabatan"=>rtrim(odbc_result($result,'nama_jabatan')),
			);
			
			}
		return $data;
	}

	public function JabatanDelete(){
		$kode_Jabatan = $this->test_input($_POST["kode"]);
		$sql="DELETE FROM $this->table WHERE kode_Jabatan = '".$kode_Jabatan."'"; 
		$result = $this->db->baca_sql($sql);
	
		//$sql2="DELETE FROM member_Jabatan_kunjungan WHERE kode_Jabatan = '".$kode_Jabatan."' "; 
			//$result2 = odbc_exec($connection, $sql2); 
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


	public function JabatanEdit(){
		$kode_Jabatan = $this->test_input($_POST["kode"]);
		$nama_Jabatan = $this->test_input($_POST["nama"]);
		$level = $this->test_input($_POST["level"]);
		$sql="UPDATE $this->table SET level_jabatan = '". $level."', kode_jabatan = '". $kode_Jabatan ."', nama_jabatan = '". $nama_Jabatan ."'WHERE kode_jabatan = '". $kode_Jabatan ."' "; 
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

	public function getDataJabatan(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_jabatan ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
        while(odbc_fetch_row($result)){


            $data[] = array(
                "kode_jabatan"=>rtrim(odbc_result($result,'kode_jabatan')),
                "nama_jabatan"=>rtrim(odbc_result($result,'nama_jabatan')),
            
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