<?php
class HomeModel{
    private $table = '';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

    public function DataKategory($data){
      
        $tahun = $this->test_input($data['tahun']);
        $bulanpage = $this->test_input($data['bulan']);

       
    
        $query = "SELECT TOP 4 bulan_angka,bulan FROM DailyActivity_Bulan where bulan_angka<='".$bulanpage."' ORDER BY bulan_angka DESC";
      
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
        $query2 = "SELECT kode_jabatan FROM DailyActivity_Jabatan ORDER BY kode_jabatan DESC";
        $result2=$this->db->baca_sql($query2);


        while($arr = odbc_fetch_array($result2)){
            $kategory[] = $arr['kode_jabatan'];
          };
     
              foreach($kategory as $ktg){
                $total = $this->totalDailyActivity($tahun,$bulan,$ktg);
                //$totalful = total_executfull($conn,$tahun,$bulan);
                  $datas[] =[
                    $ktg =>$total,
                    
                  ];
                    
      
                }
            return $datas;
        }


    public function totalDailyActivity($tahun,$bulan,$ktg){
        $sql ="SELECT COUNT(t.tanggal) as jml  FROM DailyActivity_Transaksi as t
        INNER JOIN  DailyActivity_user as u  ON t.pic = u.nama
        WHERE  YEAR(t.tanggal) ='".$tahun."' AND MONTH(t.tanggal) ='".$bulan."' AND u.jabatan='".$ktg."'";
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
}


?>