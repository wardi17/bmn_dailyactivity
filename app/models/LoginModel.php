<?php

class LoginModel {
	
	private $table = 'DailyActivity_user';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function checkLogin($data)
	{
		$username =  addslashes($data["username"]);
		$pass = addslashes($data["password"]);
		$query = "SELECT * FROM $this->table WHERE email ='".$username."' AND password ='".$pass."'";
		$sql =$this->db->baca_sql($query);
		$pass2=odbc_result($sql,"password");
		$email=odbc_result($sql,"email");
		$nama=odbc_result($sql,"nama");
		$divisi=odbc_result($sql,"divisi");
		$jabatan=odbc_result($sql,"jabatan");
		$id_user=odbc_result($sql,"id_user");

	
		$datas =[];
		if($pass2 == $pass && $email == $username){
			$datas[] =[
				'nama' =>$nama,
				'username' =>$email,
				'divisi' =>$divisi,
				'jabatan' =>$jabatan,
				'id_user' =>$id_user
			];
		}
		if (empty($datas))
		{
			$userdata = null;
		}
		else
		{
			$userdata = $datas[0];
		} 
	
		return $userdata;
	}

}