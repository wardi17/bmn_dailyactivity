<style> 

.highcharts-exporting-group{
        visibility: hidden;
    }

    .highcharts-figure,
    .highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
    }

    .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
    }

    .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
    }

    .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
    padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
    background: #f1f7ff;
    }

 .nowrap{
    white-space: nowrap !important;
 }


        /* ini untuk mengilangak scrollbar di samping */
    .scrollbar::-webkit-scrollbar
        {
            width: 1px;
            background-color: #FFFFFF;
        }
        .scrollbar::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 1px rgba(0,0,0,.9);
            background-color: #FFFFFF;
        }

        /* end scrolbar */
 /* unutk tabel comment mengilangkan garis head dan footer  */
    .dataTables_scrollBody {
            overflow-x: hidden !important;
             
        border-top: none !important;
        border-bottom: none !important;
        }
     
 /* end tabel comment */
 
 .tanggal-icon {
  position: relative;
  width: 40px;
  height: 40px;
  background-color: #ccc;
  border-radius: 50%;
}

.tanggal {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 16px;
  font-weight: bold;
}
.board{
    font-weight: bold;
}

/* untuk disabel tulisan highchart.com */
.highcharts-credits{
    display: none;
}
</style>
<body>
    <div id="app">
       
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div id="katalog" class="row"></div>
            <div class="row"></div>
            <div id="grafik" class="row"></div>
        </div>
        <div class="col-12 col-lg-3">
         
            <div class="card">
                <div class="card-header">
                </div>
   
               
                <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel_comment" class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                     
                                            <th>Name</th>
                                            <th>Comment<button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal">
                                            <i class="fa-regular fa-file"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $datacome = $data['message']; 
                                    ?>
                                    <?php 
                                    $tanggal ="";
                                     $nama ="";
                                     $comment ="";
                                       while(odbc_fetch_row($datacome)){
                                            $tanggal = rtrim(odbc_result($datacome,"tanggal"));
                                             $nama = rtrim(odbc_result($datacome,"user_name"));
                                             $comment = rtrim(odbc_result($datacome,"comment"));
                                        ?>
                                             <tr>
                                           
                                            <td class="col-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="row">
                                                    <p class="font-bold ms-3 mb-2"><?=$nama?></p>
                                                    <p class="font-bold ms-3 mb-2"><?=date("d-F-Y",strtotime($tanggal))?></p>
                                                    </div>
                                                  
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-2"><?=$comment?></p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
           
        </div>
    </section>
</div>

        </div>
    </div>



