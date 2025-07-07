<?php

class KategoriModel {
	
	private $table = 'DailyActivity_Kategori';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getUserById($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		return $this->db->single();
	}
  
	public function KategoriTambah($data)
	{
	
		$kode =$this->test_input($data["kode"]);
		$nama = $this->test_input($data["nama"]);
		$cek = 0;
		$valid = 0;

		if($kode && $nama){
		$query = "SELECT DISTINCT * FROM $this->table where kode_Kategori ='$kode' ";
		$sql=$this->db->baca_sql($query);

		$rows= odbc_fetch_array($sql);
		if($rows > 0){
			$valid=1;
		}
		if($valid == 0){
			$sql="INSERT INTO $this->table (kode_kategori,nama_kategori) 
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
			$status['error']="id_Kategori Sudah terdaftar silahkan ganti";
		}
		
		return $status;

		}
	}


	public function KategoriTampil(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_Kategori  ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
		while(odbc_fetch_row($result)){
			$data[] = array(
				"kode_Kategori"=>rtrim(odbc_result($result,'kode_Kategori')),
				"nama_Kategori"=>rtrim(odbc_result($result,'nama_Kategori')),
			);
			
			}
		return $data;
	}

	public function KategoriDelete(){
		$kode_Kategori = $this->test_input($_POST["kode"]);
		$sql="DELETE FROM $this->table WHERE kode_Kategori = '".$kode_Kategori."'"; 
		$result = $this->db->baca_sql($sql);
	
		//$sql2="DELETE FROM member_Kategori_kunjungan WHERE kode_Kategori = '".$kode_Kategori."' "; 
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


	public function KategoriEdit(){
		$kode_Kategori = $this->test_input($_POST["kode"]);
		$nama_Kategori = $this->test_input($_POST["nama"]);
		$sql="UPDATE $this->table SET kode_Kategori = '". $kode_Kategori ."', nama_Kategori = '". $nama_Kategori ."'WHERE kode_Kategori = '". $kode_Kategori ."' "; 
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

	public function getDataKategori(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_Kategori ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
        while(odbc_fetch_row($result)){


            $data[] = array(
                "kode_Kategori"=>rtrim(odbc_result($result,'kode_Kategori')),
                "nama_Kategori"=>rtrim(odbc_result($result,'nama_Kategori')),
            
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