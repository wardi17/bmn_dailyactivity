<style>

element.style {
    /* color: rgb(51, 51, 51);
    font-size: 1.2em;
    font-weight: bold;
    fill: rgb(51, 51, 51); */
    fill: #25396f;
  
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 0.5rem;
    margin-top: 0;
}
@media print {
  @page {
    margin-top: 5rem;
    margin-bottom: 2rem;
  }
  thead{  
    background-color:Chartreuse;
  }
  #dvContainer {
           background-color: blue !important;
        }
  body  {
    padding-top: 5rem;
    padding-bottom: 2rem;
  }
}

.action {
	display: none;
}
.thead{
  background-color:#E7CEA6;
  /* font-size: 8px;
  font-weight: 100 !important; */
  color :#000000;
}
/* memberikan border pada tabel */
.table { border-right: 1px solid black; border-bottom: 1px solid black; }
.table th, .table td { border-left: 1px solid black; border-top: 1px solid black; padding: 3px; font-size: 12px}
</style>

<script src="<?= base_url; ?>/assets/js/jquery.PrintArea.js"></script>
<main id="main" class="main">
    <section id="tampildata" class="section">
        <div class ="card">
        
            <div class="card-body">
            <div class=" mt-4">
                <form id="form_filter">
                        <input type="hidden" id="kode_strdiv">
                        <div class="row col-md-12-sm-12">
                        <div class ="left col-md-10 mb-2">
                                <label>Divisi</label>
                                <div id="filter_divisi" class ="col-md-10"></div>
                        </div>
                        </div>
                        </div>
                        <div id="filtertgl"></div>
                    </form>
            </div>
            <div id="header_data"></div>
            <div id="printdata"></div>
            <div id="datalist">
                <div id="tabelhead"></div>
            </div>
            </div>
          
        </div>
     
    </section>
 

</main>
<script>
  $(document).ready(function(){

   // get_data_User();

   filter_divisi();
   //untuk change divisi

   $(document).on('change',".checkdivisi",function(){
        let div =``;
        let id_div =``;
   
        let kode_strdiv = $("#kode_strdiv").val();
        let split_kode = kode_strdiv.split(",");

    
        let data =``;
           $(".checkdivisi:checked").each(function(){
            div += "'"+$(this).val()+ "'"+",";
            id_div += $(this).val()+",";
          });

        let str_divisi = div.slice(0,-1);
        let st_id = id_div.slice(0,-1);
        let split_id = st_id.split(",");
      

        $.ajax({
            url:"<?=base_url?>/user/getuser",
            method:'POST',
            dataType:'json',
            data :{divisi:str_divisi},    
            success:function(response){
              if(response !== null){
                
                $.each(response,function(key,value){
                  let div = value.divisi_user;
                  let id =``;
               
                    let kode = value.id_user;
                    let nama = value.nama;
                    if(div !==undefined){
                     id += "#"+div;
                      $(id).empty();
                  }
                   
              
                  data +=`
                  <div class="form-check form-check-inline">
                                  <input class="form-check-input checknama" for ="${kode}" type="checkbox" id="namaUser"name="namauser[]" value="${nama}">
                                  <label class="form-check-label" for ="${kode}" >${nama}</label>
                      </div>
                  `;
                  $(id).empty().html(data); 
                  
               
                
                });
                getformtanggal();
              }else{
                window.location.replace("<?= base_url; ?>/report/index");
              }
                
            }

        })
   });
  
   // untuk menamilkan data
   $(document).on("click","#filterdata",function(e){
        e.preventDefault();
        tgl_awal = $("#tgl_from").val();
        start_date = myformat(tgl_awal);
        tgl_akhir = $("#tgl_to").val();
        end_date = myformat(tgl_akhir);

        let  nam=``;
          $(".checknama:checked").each(function(){
            nam += $(this).val()+',';
          });
        let str_nam = nam.slice(0,-1);
        get_data_User(start_date,end_date,str_nam);
        //console.log({tanggal_from:tanggal_awal,tanggal_to:tanggal_akhir})
   })
   //end data
  });

  // untuk divisi 
    function filter_divisi(){
        $.ajax({
            url:"<?=base_url?>/divisi/tampildata",
            method:'POST',
            dataType:'json',      
            success:function(response){
                  let data =``;
                  let id_kode =``;
                $.each(response,function(key,value){
                  let kode = value.kode_divisi;
                  let jenis = value.nama_divisi;
                    id_kode += kode +',';
                  data +=`
                  <div class="row col-md-12">
                  <div class="col-md-4">
                    <div class="form-check">
                                    <input class="form-check-input checkdivisi" for ="${kode}" type="checkbox" id="divisi"name="divisi[]" value="${kode}">
                                    <label class="form-check-label" for ="${kode}">${jenis}</label>
                        </div>
                    </div>
                    <div class="col-md-6 divisi_code" id="${kode}">  
                    </div>
                    </div>
                    
                  `;
                  $("#filter_divisi").empty().html(data); 
                  
                });
                let str_kode = id_kode.slice(0,-1);
                $("#kode_strdiv").val(str_kode);
                
          }

          })
    }

  //end divisi
// UNTUK MENAMILKAN DATA USER
function get_data_jenis(divisi){
  $.ajax({
        url:"<?=base_url?>/report/getuser",
        method:'POST',
        dataType:'json', 
        data:{kode_div:divisi},     
        success:function(response){
              let data =``;
            $.each(response,function(key,value){
              
              let jenis = value.nama_jenis_kon;
               $("#jenis").append($('<option/>').val(jenis).html(jenis));  
            });
        
      }

      });
}
//END DATA USER

function getformtanggal(){
        let formtgl =`
                <div class="left atas">  
                        <label>Tgl Awal :</label>
                                    <input type="text" style="width:100px"  class="datepicker_input" id="tgl_from" name="tglku1">
                        <label>Tgl Akhir :</label>
                                    <input type="text" style="width:100px"  class="datepicker_input" id="tgl_to" name="tglku2">
                                <button  type="sumbit" name="sumbit" id="filterdata" style="background-color: #008CBA" class="btn-primary">Submit</button>
                    </div>
        `
        $("#filtertgl").empty().html(formtgl);

   //untuk tanggal awal
   var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        let  output = (day<10 ? '0' : '') + day + '/' +
                    (month<10 ? '0' : '') + month + '/' +
                    d.getFullYear() ;
          $("#tgl_from").val(output);
          $("#tgl_to").val(output);
          const getDatePickerTitle = elem => {
  // From the label or the aria-label
          const label = elem.nextElementSibling;
          let titleText = '';
          if (label && label.tagName === 'LABEL') {
            titleText = label.textContent;
          } else {
            titleText = elem.getAttribute('aria-label') || '';
          }
          return titleText;
        }

        const elems = document.querySelectorAll('.datepicker_input');
        for (const elem of elems) {
          const datepicker = new Datepicker(elem, {
            'format': 'dd/mm/yyyy', // UK format
            title: getDatePickerTitle(elem)
          });
        }
   //end tanggal awal

}

  //fungsi format tanggal 
      function myformat(date){
      let d = date.split('/')[0];
    
      let m = date.split('/')[1];
      let y = date.split('/')[2];
      let format = y + "-" + m + "-" + d;
      return format;
    }
//end format tanggal


    function get_data_User(start_date,end_date,str_nam){
        get_header();
        $.ajax({
                url:'<?= base_url; ?>/listactivity/laporandata1',
                method:'POST',
                dataType:'json',
                data:{start_date:start_date,end_date:end_date,nama_user:str_nam},     
                success:function(response){
                        let dataTable =``;
                        let  id =``;
                    $.each(response,function(key,value){
                        let nama = value.nama;
                        let tb_nama =value.nama+"_tabel";
                          id+= tb_nama +',';
                        let data_tabel = value.data;
                        dataTable +=`
                                    <h6 class="mt-2">${nama}</h6>
                                    <table id="${tb_nama}" class='display table-info' style='width:100%'>                    
                                                    <thead class="thead">
                                                    <tr>
                                                                <th>Tanggal</th>
                                                                <th>Activity</th>
                                                                <th>Category</th>
                                                                <th>Noted</th>
                                                                <th>Status</th>
                                                                <th>Dateline</th>  
                                                                <th>Pic</th>  
                                                    </tr>
                                                    </thead>
                                                    <tbody>`;
                       // datatabelUser(data_tabel,id_tabel);
                        $.each(data_tabel,function(a,b){
                              dataTable +=`
                                          <tr>
                                            <td>${b.tanggal}</td>
                                            <td>${b.activity}</td>
                                            <td>${b.category}</td>
                                            <td>${b.noted}</td>
                                            <td>${b.status}</td>
                                            <td>${b.dateline}</td>
                                            <td>${b.pic}</td>

                       `
                            dataTable+=`</tr>`;
                        });
                        dataTable+=`</tbody></table>`;
                    });
                  $("#tabelhead").empty().html(dataTable);
                  let str_id = id.slice(0,-1);
                  datatabelUser(str_id)
                }
        });      
    } 

    function datatabelUser(str_id){
          let data_id = str_id.split(",");
          $.each(data_id,function(index,value){
                let id_tbl ="#"+value;
                $(id_tbl).DataTable({
                  // columnDefs: [{ 
                  //   width: "20%", targets: 0,
                  //   width: "30%", targets: 1,
                  //   width: "20%", targets: 2,
                  //   width: "20%", targets: 3,
                  //   width: "20%", targets: 4,
                  //   width: "20%", targets: 5,
                  //   width: "20%", targets: 6,
                  // }],
              "responsive": true,
              "ordering": false,
                 "":true,
                  dom: 'Plfrtip',
                    scrollCollapse: true,
                    paging:false,
                    "bPaginate":false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false,
                    dom: 'lrt',
                    fixedColumns:   {
                       // left: 1,
                        right: 1
                    },
                    style_cell:{'fontSize':5, 'font-family':'sans-serif'},
                    "order":[[0,'desc']],
            })
          });
          printdata();

      
        
              
    }

      function get_header(){
      let data_headr =`
      <div  class="page-heading mb-3">
      <div class="page-title">
      <h4 class="text-center">Laporan Daily Activity</h4>
      </div></div>

      `;
      $("#header_data").html(data_headr);
      }

  

      function printdata(){
        let print =` <div class="text-end">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
        </div>`
        $("#printdata").empty().html(print);
      }

      $(document).on("click","#printInvoice",function(){
        $('#tabelhead').printArea();
        });

</script>
