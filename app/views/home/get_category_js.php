<script>
    $(document).ready(function(){
       
        const dateya = new Date();
        let bulan = dateya.getMonth()+1;
        let tahun = dateya.getFullYear();
    //get_datagrafik(tahun,bulan);
        getdata(tahun,bulan);
    });

    //get data kategory 
    function getdata(tahun,bulan){
        $.ajax({
            url:"<?=base_url?>/home/get_category",
            method:'POST',
            data:{tahun:tahun,bulan:bulan},
            dataType:'json',
            success:function(result){
                const data = result.reverse();
           let katalog =``;
        
            $.each(data,function(key,val){
                 
                let bln_h = val['bulan_h'];
                let bln = val['bulan'];
                let jenis = val['data']; 

                let rgb1 ="#B9EDDD";
  
                katalog +=`
                        <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div style="background-color:${rgb1}"  class="stats-icon mb-2">${bln}</div>
                                    </div>
                                    <div class="col-md-10 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">${bln_h}</h6>
                                        <h6 style="font-size:12px" class="font-semibold  mb-2"><a id="bln_data${bln}"></a>
                                        </h6>
                                        <h6 style="font-size:12px" id="color1" class="font-extrabold text-center"><a id="bln_total${bln}"></a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        `;
               
            });
            $("#katalog").empty().html(katalog);
            $.each(data,function(key,vals){
                 let bln = vals['bulan'];
                 let jenis = vals['data']; 
            dataDivisi(jenis,bln); 
            });  
            }
            });

    }

    function   dataDivisi(jenis,bulan){
       // console.log(bulan)
                let data_k =``;
                let ttl = 0;
                for(let js of jenis){
                    $.each(js,function(key,value){
                        let str = key.substr(0,3);
                        data_k +=`<a>${str}. ${value} </a>`;
                        ttl +=parseInt(value)
                    })
                   
                }
           
        let id_dt ="#bln_data"+bulan;
        let id_ttl ="#bln_total"+bulan;
             if(ttl <= 0){
                $(id_ttl).css("color", "red");
                }else{
                    $(id_ttl).css("color", "black");
                }
        $(id_ttl).empty().html(ttl);
        $(id_dt).empty().html(data_k);
    }
</script>