<?php

class NewActivityModel {
	
	private $table = 'DailyActivity_Transaksi';
	private $st_table ='DailyActivity_Status';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getActivityById($data)
	{
		$id = $this->test_input($data["id"]);
		$query = "SELECT * FROM $this->table  WHERE id='".$id."' ";
		$result = $this->db->baca_sql($query);
		$data =[];
		while(odbc_fetch_row($result)){
			$data[] = array(
				"tanggal"=>date('d/m/Y',strtotime(rtrim(odbc_result($result,'tanggal')))),
				"activity"=>rtrim(odbc_result($result,'activity')),
				"category"=>rtrim(odbc_result($result,'category')),
				"noted"=>rtrim(odbc_result($result,'noted')),
				"status"=>rtrim(odbc_result($result,'status')),
				"dateline"=>date('d/m/Y',strtotime(rtrim(odbc_result($result,'dateline')))),
				"pic"=>rtrim(odbc_result($result,'pic')),
				"id"=>rtrim(odbc_result($result,'id')),
			);
			
			}
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";die();
		return $data;		
	}
  
	public function NewActivityTambah($data)
	{
		$tanggal =$this->test_input($data["tanggal"], ENT_QUOTES, 'UTF-8');
		$activity = $this->test_input($data["activity"], ENT_QUOTES, 'UTF-8');
		$categori = $this->test_input($data["categori"], ENT_QUOTES, 'UTF-8');
		$noted =$this->test_input($data["noted"], ENT_QUOTES, 'UTF-8');
		$status = $this->test_input($data["status"], ENT_QUOTES, 'UTF-8');
		$dateline = $this->test_input($data["dateline"], ENT_QUOTES, 'UTF-8');
		$pic = $this->test_input($data["pic"], ENT_QUOTES, 'UTF-8');

		$getsatus = $this->get_Status($status);
		if($getsatus == "DONE"){
			$tgl_status = $dateline;
		}else{
			$tgl_status ="";
		}
		$cek = 0;
			$sql="INSERT INTO $this->table (tanggal,activity,category,noted,status,dateline,pic,tanggal_status) 
			Values ('". $tanggal ."','".$activity."','".$categori."','".$noted."','".$status."','".$dateline."','".$pic."','".$tgl_status."')"; 
			
			$result = $this->db->baca_sql($sql);
			if(!$result){
			$cek =$cek+1;
			}
		
			if ($cek==0){
			$pesan['nilai']=1; //bernilai benar
			$pesan['error']="Data Berhasil Ditambahkan";
			}else{
			$pesan['nilai']=0; //bernilai benar
			$pesan['error']="Data Gagal Ditambahkan";
			}
		
		
		return $pesan;

		
	}


	public function NewActivityTampil(){
		$divisi = $_SESSION['divisi'];
		$jabatan = $_SESSION['jabatan'];
			
		$query1 = "SELECT * FROM DailyActivity_Jabatan  WHERE kode_jabatan = '".$jabatan."'";
		$sql = $this->db->baca_sql($query1);
		$level=odbc_result($sql,"level_jabatan");

		

		$status = $this->getStatusId();
	
		$query = $this->get_query($level,$divisi,$status);

		$result = $this->db->baca_sql($query);
		$data =[];
		while(odbc_fetch_row($result)){
			$data[] = array(
				"id"=>rtrim(odbc_result($result,'id')),
				"tanggal"=>rtrim(odbc_result($result,'tanggal')),
				"activity"=>rtrim(odbc_result($result,'activity')),
				"category"=>rtrim(odbc_result($result,'category')),	
				"noted"=>preg_replace('/(<p><br><\/p>)+/', '',odbc_result($result,'noted')),
				"status"=>rtrim(odbc_result($result,'status')),
				"dateline"=>rtrim(odbc_result($result,'dateline')),
				"pic"=>rtrim(odbc_result($result,'pic'))

			);
			
			}
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			// die();
			$datafull =[];
			foreach($data as $item){
				$datafull [] =[
					'id' =>$item['id'],
					'tanggal' 	=> date('d-m-Y',strtotime($item['tanggal'])),
					'activity' 	=> $item['activity'],
					'category'	=> $this->get_Category($item['category']),
					'noted' 	=> $this->replaceNode($item['noted']),
					'status'	=> $this->get_Status($item['status']),
					'dateline' 	=> date('d-m-Y',strtotime($item['dateline'])),
					'pic' 	=> $item['pic'],

				];
				
			}
	
			return $datafull;
	}

	public function ActivityDelete($data){
		$id = $this->test_input($data["id"]);
		$sql="DELETE FROM $this->table WHERE id = '".$id."'"; 
		$result = $this->db->baca_sql($sql);
	
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

	private function get_query($level,$divisi,$status){
		
		if($level ==1){
				$query_sql = "SELECT t.id as id,t.tanggal as tanggal,t.activity as activity , t.category as category,
					t.noted as noted,t.status as status,t.dateline as dateline,t.pic as pic
					FROM DailyActivity_Transaksi AS t
					INNER JOIN DailyActivity_user AS u ON t.pic = u.nama
					INNER JOIN DailyActivity_Jabatan AS j ON u.jabatan = j.kode_jabatan
					WHERE j.level_jabatan >='".$level."' AND t.status='".$status."' ";
		}elseif($level ==2){
				$query_sql = "SELECT t.id as id,t.tanggal as tanggal,t.activity as activity , t.category as category,
				t.noted as noted,t.status as status,t.dateline as dateline,t.pic as pic
				FROM DailyActivity_Transaksi AS t
				INNER JOIN DailyActivity_user AS u ON t.pic = u.nama
				INNER JOIN DailyActivity_Jabatan AS j ON u.jabatan = j.kode_jabatan
				WHERE j.level_jabatan >='".$level."' AND t.status='".$status."'";
		}else{
				$query_sql ="SELECT t.id as id, t.tanggal as tanggal,t.activity as activity , t.category as category,
					t.noted as noted,t.status as status,t.dateline as dateline,t.pic as pic
					FROM DailyActivity_Transaksi AS t
				INNER JOIN DailyActivity_user AS u ON t.pic = u.nama
				INNER JOIN DailyActivity_Jabatan AS j ON u.jabatan = j.kode_jabatan
				WHERE j.level_jabatan >='".$level."' AND u.divisi ='".$divisi."' AND t.status='".$status."'";
		}	
		return $query_sql;	
		
	}
	public function NewActivityUpdate($data){
		$tanggal =$this->test_input($data["tanggal"]);
		$activity = $this->test_input($data["activity"]);
		$categori = $this->test_input($data["categori"]);
		$noted =$this->test_input($data["noted"]);
		$status = $this->test_input($data["status"]);
		$dateline = $this->test_input($data["dateline"]);
		$pic = $this->test_input($data["pic"]);
		$id = $this->test_input($data['id']);
		$sql="UPDATE $this->table SET tanggal = '". $tanggal ."', activity = '". $activity ."' , category = '". $categori ."',
		noted = '". $noted ."',status = '". $status ."', dateline = '". $dateline ."', pic = '". $pic ."'
		WHERE id = '". $id ."' ";  
		$result = $this->db->baca_sql($sql);
		$cek =0;
		if(!$result){
		$cek = $cek+1;
		}
		if ($cek==0){
		$pesan['nilai']=1; //bernilai benar
		$pesan['error']="Data Berhasil di edit";
		}else{
		$pesan['nilai']=0; //bernilai benar
		$pesan['error']="Data Gagal di edit";
		}
		return $pesan;
	}

	public function getDataNewActivity(){
		$query = "SELECT * FROM $this->table  ORDER BY kode_NewActivity ASC";
		$result = $this->db->baca_sql($query);
		$data =[];
        while(odbc_fetch_row($result)){


            $data[] = array(
                "kode_NewActivity"=>rtrim(odbc_result($result,'kode_NewActivity')),
                "nama_NewActivity"=>rtrim(odbc_result($result,'nama_NewActivity')),
            
            );
		}

		return $data;
	}

	private function get_Status($kode){
		$query = "SELECT nama_status FROM DailyActivity_Status  WHERE kode_status ='".$kode."'";
		$result = $this->db->baca_sql($query);
		$arr = odbc_fetch_array($result);
		$nama_k = $arr['nama_status'];
		return $nama_k;

	}

	private function get_Category($kode){
		$query = "SELECT nama_kategori FROM DailyActivity_Kategori  WHERE kode_kategori ='".$kode."'";
		$result = $this->db->baca_sql($query);
		$arr = odbc_fetch_array($result);
		$nama_k = $arr['nama_kategori'];
		return $nama_k;

	}
	private function replaceNode($noted){
		
		$string = preg_replace('/(<p><br><\/p>)+/', '', $noted);
		return $string;
	}


	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}



	public function FinishActivity($data){
		$tanggal = $this->test_input($data['tanggal']);
		$id = $this->test_input($data['id']);
		
		$jam = date("H:i:s");
		$tgl_done = $tanggal." ".$jam;
		$user_finish = $_SESSION['nama'];
		$nama_st = "DONE";

		$query1 = " SELECT * FROM DailyActivity_Status WHERE nama_status ='".$nama_st."'";
		$sql1 =$this->db->baca_sql($query1);
		$status=odbc_result($sql1,"kode_status");
		
		$query ="UPDATE  $this->table SET status ='".$status."',user_finish ='".$user_finish."',tanggal_status ='".$tgl_done."'
		WHERE id='".$id."'
		";

		$result = $this->db->baca_sql($query);
		$cek =0;
		if(!$result){
		$cek = $cek+1;
		}
		if ($cek==0){
		$pesan['nilai']=1; //bernilai benar
		$pesan['error']="Data Sudah Di Konfirm";
		}else{
		$pesan['nilai']=0; //bernilai benar
		$pesan['error']="Data Gagal Konfirm";
		}
		return $pesan;
	}



	//fungsi untuk tampil data filter tanggal stardate - enddate and user 
	public function ActivityLaporan1($data){
		$start_date =$this->test_input($data["start_date"], ENT_QUOTES, 'UTF-8');
		$end_date =$this->test_input($data["end_date"], ENT_QUOTES, 'UTF-8');
		$nama_user =$this->test_input($data["nama_user"], ENT_QUOTES, 'UTF-8');
		$data = $this->getDataUser($start_date,$end_date,$nama_user);

		return $data;
		
	}
	//end
	//get data user 
		private function getDataUser($start_date,$end_date,$nama_user){
			$expload_user = explode(",",$nama_user);
				$data_full =[];
			foreach($expload_user as $item){
				$data_full[] =[
					'nama' =>$item,
					'data' => $this->DataUserBy($item,$start_date,$end_date)
				];
			}
			// echo "<pre>";
			// print_r($data_full);
			// echo "</pre>";
			// die();
			
			return $data_full;
			
		} 
	//end 
		private function DataUserBy($item,$start_date,$end_date){
			$query ="dailyactivitylaporan1 '".$item."','".$start_date."','".$end_date."'";
			
			$result = $this->db->baca_sql($query);
			$data =[];
			while(odbc_fetch_row($result)){
				$data[] = array(
					"id"=>rtrim(odbc_result($result,'id')),
					"tanggal"=>rtrim(odbc_result($result,'tanggal')),
					"activity"=>rtrim(odbc_result($result,'activity')),
					"category"=>rtrim(odbc_result($result,'category')),	
					"noted"=>preg_replace('/(<p><br><\/p>)+/', '',odbc_result($result,'noted')),
					"status"=>rtrim(odbc_result($result,'status')),
					"dateline"=>rtrim(odbc_result($result,'dateline')),
					"pic"=>rtrim(odbc_result($result,'pic')),
					"tanggal_status"=>rtrim(odbc_result($result,'tanggal_status'))
				);
				
				}
		
				$datafull =[];
				foreach($data as $item){
					$datafull [] =[
						'id' =>$item['id'],
						'tanggal' 	=> date('d-m-Y',strtotime($item['tanggal'])),
						'activity' 	=> $item['activity'],
						'category'	=> $this->get_Category($item['category']),
						'noted' 	=> $this->replaceNode($item['noted']),
						'status'	=> $this->get_Status($item['status']),
						'dateline' 	=> date('d-m-Y',strtotime($item['dateline'])),
						'pic' 	=> $item['pic'],
						'tanggal_status' 	=> date('d-m-Y',strtotime($item['tanggal_status'])),

	
					];
					
				}
		
		
				return $datafull;
		}

		//fungsi untuk tampil data filter tanggal stardate - enddate
		public function ActivityLaporan2($data){
		
			$divisi =$this->test_input($data["divisi"], ENT_QUOTES, 'UTF-8');
			$start_date =$this->test_input($data["start_date"], ENT_QUOTES, 'UTF-8');
			$end_date =$this->test_input($data["end_date"], ENT_QUOTES, 'UTF-8');

			$query ="SELECT t.id as id,t.tanggal as tanggal,t.activity as activity , t.category as category,
			t.noted as noted,t.status as status,t.dateline as dateline,t.pic as pic,u.divisi as divisi, j.level_jabatan as level
							  FROM [bmn].[dbo].[DailyActivity_Transaksi] AS t
							  INNER JOIN [bmn].[dbo].[DailyActivity_user] AS u ON t.pic = u.nama
							  INNER JOIN [bmn].[dbo].[DailyActivity_Jabatan] AS j ON u.jabatan = j.kode_jabatan
							  WHERE u.divisi IN($divisi) AND t.tanggal BETWEEN '".$start_date."' AND '".$end_date."'";
			//$query ="dailyactivitylaporan2 '".$divisi."','".$start_date."','".$end_date."'";
	
			$result = $this->db->baca_sql($query);
			$data =[];
			while(odbc_fetch_row($result)){
				$data[] = array(
					"id"=>rtrim(odbc_result($result,'id')),
					"tanggal"=>rtrim(odbc_result($result,'tanggal')),
					"activity"=>rtrim(odbc_result($result,'activity')),
					"category"=>rtrim(odbc_result($result,'category')),	
					"noted"=>preg_replace('/(<p><br><\/p>)+/', '',odbc_result($result,'noted')),
					"status"=>rtrim(odbc_result($result,'status')),
					"dateline"=>rtrim(odbc_result($result,'dateline')),
					"pic"=>rtrim(odbc_result($result,'pic'))
				);
				
				}
		
				$datafull =[];
				foreach($data as $item){
					$datafull [] =[
						'id' =>$item['id'],
						'tanggal' 	=> date('d-m-Y',strtotime($item['tanggal'])),
						'activity' 	=> $item['activity'],
						'category'	=> $this->get_Category($item['category']),
						'noted' 	=> $this->replaceNode($item['noted']),
						'status'	=> $this->get_Status($item['status']),
						'dateline' 	=> date('d-m-Y',strtotime($item['dateline'])),
						'pic' 	=> $item['pic'],
	
					];
					
				}
		
				return $datafull;
		}
		//end
	

		public function getStatusId(){
			$nama ="PROGRESS";
			$query = "SELECT kode_Status FROM $this->st_table  WHERE nama_Status ='".$nama."'";
			$result = $this->db->baca_sql($query);
			$kode_Status = odbc_result($result,"kode_Status");
			
			return $kode_Status;
	
		}



	
}