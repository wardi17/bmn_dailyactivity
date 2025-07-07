<?php
class HomeModel{
    private $table = '';
	private $db;
    private $tbl_de ='DailyActivity_divisi';
    private $tbl_user = 'DailyActivity_user';
    private $tbl_bln = 'DailyActivity_Bulan';
    private $tbl_trs ='DailyActivity_Transaksi';
    private $tbl_co = 'DailyActivity_Comment';
	public function __construct()
	{
		$this->db = new Database;
	}

    public function DataKategory($data){
      
        $tahun = $this->test_input($data['tahun']);
        $bulanpage = $this->test_input($data['bulan']);


        $query = "SELECT TOP 4 bulan_angka,bulan FROM $this->tbl_bln where bulan_angka<='".$bulanpage."' ORDER BY bulan_angka DESC";
      
        $result=$this->db->baca_sql($query);
        $bln_k =[];
        while($arr = odbc_fetch_array($result)){
          $bln_k[] = $arr;
        }; 
        foreach($bln_k as $bln){
           $bulan = $bln['bulan_angka'];
           $bln_h = $bln['bulan'];
            if($bulan == 1){
                $total= $this->data_jenis($tahun,$bulan);
                $data_full [] =[
                'bulan_h' =>$bln_h,
                'bulan' =>$bulan,
                'data'  =>$total
                ];
                }
                if($bulan == 2){
                    $total= $this->data_jenis($tahun,$bulan);
                    $data_full [] =[
                    'bulan_h' =>$bln_h,
                    'bulan' =>$bulan,
                    'data'  =>$total
                    ] ;
                }
               if($bulan == 3){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               if($bulan == 4){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 5){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 6){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 7){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 8){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 9){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 10){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 11){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }
               elseif($bulan == 12){
                $total= $this->data_jenis($tahun,$bulan);
                 $data_full [] =[
                  'bulan_h' =>$bln_h,
                   'bulan' =>$bulan,
                  'data'  =>$total
                 ] ;
               }

          
        }
        // echo "<pre>";
        // print_r($data_full);
        // echo "</pre>";
        // die();
        return $data_full;
    }        
    


    public function data_jenis($tahun,$bulan){
        $query2 = "SELECT kode_divisi,nama_divisi FROM $this->tbl_de ORDER BY kode_divisi DESC";
        $result2=$this->db->baca_sql($query2);
        while($arr = odbc_fetch_array($result2)){
            $kategory[] =[
             "kode"=> $arr['kode_divisi'],
             "nama"=> $arr['nama_divisi'],
            ]; 
          };
          $datas =[];
              foreach($kategory as $ktg){
                $kode_ktg = $ktg["kode"];
                $nama     = $ktg["nama"];
                $total = $this->totalDailyActivity($tahun,$bulan,$kode_ktg);
                  $datas[] =[
                    $nama =>$total,  
                  ];
                }

            return $datas;
        }


    public function totalDailyActivity($tahun,$bulan,$kode_ktg){
        $sql ="SELECT COUNT(t.tanggal) as jml  FROM $this->tbl_trs as t
        INNER JOIN  $this->tbl_user as u  ON t.pic = u.nama
        WHERE  YEAR(t.tanggal) ='".$tahun."' AND MONTH(t.tanggal) ='".$bulan."' AND u.divisi='".$kode_ktg."'";
        $result= $this->db->baca_sql($sql);
        $arr = odbc_fetch_array($result); 
        $jml= $arr['jml'];
          return $jml;
    }

 
    public function DataGrafik($data){
        $tahun = $this->test_input($data['tahun']);
        $bulan = $this->test_input($data['bulan']);
        $query = "SELECT bulan_angka FROM $this->tbl_bln ORDER BY bulan_angka ASC";
        $result=$this->db->baca_sql($query);
        while($arr = odbc_fetch_array($result)){
          $bln_k[] = $arr['bulan_angka'];
        }; 
      
        $query = "SELECT kode_divisi,nama_divisi FROM $this->tbl_de ORDER BY kode_divisi DESC";
        $result=$this->db->baca_sql($query);
        while($arr = odbc_fetch_array($result)){
          $kategory[] =[
            "kode"=> $arr['kode_divisi'],
            "nama"=> $arr['nama_divisi'],
           ];
        }; 
   
        $data_full =[];
  
        foreach ($kategory as $ktg){
          $kode_ktg = $ktg["kode"];
          $nama     = $ktg["nama"];
            $bln_data = $this->data_jenis_bulan($tahun,$bln_k,$kode_ktg,$nama);
            $data_full[] = $bln_data;
          
        }
        return $data_full;
    }


    private function data_jenis_bulan($tahun,$bln_k,$kode_ktg,$nama){
        $rowdata =[];
        foreach($bln_k as $bln){

        
                if($bln == 1){
                    $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                    $rowdata[] = $get_data;
                    
                    }
                    if($bln == 2){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 3){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 4){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 5){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 6){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 7){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 8){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 9){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 10){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 11){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
                    if($bln == 12){
                        $get_data = $this->get_data($tahun,$bln,$kode_ktg);
                        $rowdata[] = $get_data;
                        
                    }
          }  
        
          $expload = implode(",",$rowdata);
         
          $int = array_map('intval', explode(',', $expload));
       
          $data_array=[
            'name'=>$nama,
            'data'=> $int
          ];
     //die(var_dump($data_array));
          return $data_array;
             
    }

    private function get_data($tahun,$mont,$kode_ktg){
  
        $sql ="SELECT COUNT(t.tanggal) as jml  FROM $this->tbl_trs as t
        INNER JOIN  $this->tbl_user as u  ON t.pic = u.nama
        WHERE  YEAR(t.tanggal) ='".$tahun."' AND MONTH(t.tanggal) ='".$mont."' AND u.divisi='".$kode_ktg."'";
         
       $result= $this->db->baca_sql($sql);
        $arr = odbc_fetch_array($result); 
        $jml= $arr['jml'];
          return $jml;
        
      
      
      }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }


      public function DataMessage(){
        $tahunpage = date("Y");

        $query = "SELECT TOP 10 tanggal,user_name,comment FROM $this->tbl_co  WHERE YEAR(tanggal)= '".$tahunpage."' ORDER BY tanggal DESC";
        $result= $this->db->baca_sql($query);
        $this->confirm_query($result);
            return $result;
        
        }

        private function confirm_query($result) {
            if (!$result) {
              die("Database query failed.");
            }
        }

        public function SimpanMessage($data){
          
            $id_user = $_SESSION['id_user'];
            $nama = $_SESSION['nama'];

            $kirim = $this->test_input($data["kirim"]);
            //$tanggal = date_time();
            $tanggal =  date('Y-m-d H:i');
           //cek hewan tidak boleh sama
           $cek = 0;
           $valid = 0;
        if($valid == 0){
            $sql="INSERT INTO [DailyActivity_Comment] (tanggal,id_user,user_name,comment) Values ('". $tanggal."','". $id_user."','". $nama."','". $kirim."')"; 
          
            $result= $this->db->baca_sql($sql);

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
        return $status;
    }
}


?>