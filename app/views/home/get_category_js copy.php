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

                let b =``;
                let g =``;
                let m =``;
                let s =``;
                let st =``;
                for(let js of jenis){
                    if( js['BOD']){
                      
                        if(js['BOD'] == undefined){
                        break;
                        }
                        b+=js['BOD'];
                    }
                    if(js['GM']){
                        if(js['GM']== undefined){
                                break;
                            }
                        g +=js['GM'];
                    }
                    if(js['MGR']){
                        if(js['MGR']== undefined){
                                break;
                            }
                        m +=js['MGR'];
                    }
                    if(js['SPV']){
                        if(js['SPV']== undefined){
                                break;
                            }
                        s +=js['SPV'];
                    }
                    if(js['STAFF']){
                        if(js['STAFF']== undefined){
                                break;
                            }
                        st +=js['STAFF'];
                    }
                }
                t = parseInt(b)+ parseInt(g) + parseInt(m) + parseInt(s) + parseInt(st);
             
               
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
                                        <h6 style="font-size:12px" class="font-semibold  mb-2"id="bln_data">B.${b} &nbsp;  G.${g} &nbsp; M.${m} &nbsp; S.${s}
                                        &nbsp; ST.${st}
                                        </h6>
                                        <h6 style="font-size:12px" id="color1" class="font-extrabold text-center">${t} &nbsp;&nbsp;</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        `;
               
                 
            });
            $("#katalog").empty().html(katalog); 
            }
            });
    }
</script>