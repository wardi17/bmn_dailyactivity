<?php

class StatusModel {
	
	private $table = 'DailyActivity_Status';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}


  
	public function StatusTambah($data)
	{
	

		$kode =$this->test_input($data["kode"]);
		$nama = $this->test_input($data["nama"]);
		$cek = 0;
		$valid = 0;

		if($kode && $nama){
		$query = "SELECT DISTINCT * FROM $this->table where kode_status ='$kode' ";
		$sql=$this->db->baca_sql($query);

		$rows= odbc_fetch_array($sql);
		if($rows > 0){
			$valid=1;
		}
		if($valid == 0){
			$sql="INSERT INTO $this->table (kode_status,nama_status) 
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
			$status['error']="id_Status Sudah terdaftar silahkan ganti";
		}
		
		return $status;

		}
	}


	public function StatusTampil(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_status  ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
		while(odbc_fetch_row($result)){
			$data[] = array(
				"kode_status"=>rtrim(odbc_result($result,'kode_status')),
				"nama_status"=>rtrim(odbc_result($result,'nama_status')),
			);
			
			}
		return $data;
	}

	public function StatusDelete(){
		$kode_Status = $this->test_input($_POST["kode"]);
		$sql="DELETE FROM $this->table WHERE kode_status = '".$kode_Status."'"; 
		$result = $this->db->baca_sql($sql);
	
		//$sql2="DELETE FROM member_Status_kunjungan WHERE kode_Status = '".$kode_Status."' "; 
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


	public function StatusEdit(){
		$kode_Status = $this->test_input($_POST["kode"]);
		$nama_Status = $this->test_input($_POST["nama"]);
		$sql="UPDATE $this->table SET kode_Status = '". $kode_Status ."', nama_Status = '". $nama_Status ."'WHERE kode_Status = '". $kode_Status ."' "; 
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

	public function getDataStatus(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_Status ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
        while(odbc_fetch_row($result)){

            $data[] = array(
                "kode_Status"=>rtrim(odbc_result($result,'kode_Status')),
                "nama_Status"=>rtrim(odbc_result($result,'nama_Status')),
            
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