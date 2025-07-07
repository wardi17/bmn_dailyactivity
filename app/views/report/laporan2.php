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
    margin-top: 0;
    margin-bottom: 0;
  }
}

/* .dataTables_wrapper .dt-buttons {
  float:none;  
  text-align:right;
} */
</style>

<?php $divisi = $data['divisi'];?>
<main id="main" class="main">
    <section id="tampildata" class="section">
        <div class ="card">
        
            <div class="card-body">
            <div class=" mt-4">
                <form id="form_filter">
                <div class="row col-md-12 mb-12">
                          <label for="direksi" class="col-sm-1 col-form-label">Divisi</label>
                                <div id="divisi" class ="col-md-4">
                                    <?php  foreach($divisi as $file):
                                      $id = $file['kode_divisi'];
                                      $nama = $file['nama_divisi'];
                                  ?>
                                  <div class="form-check form-check-inline col-md-5">
                                              <input class="form-check-input checkdivisi" for ="<?=$id?>" type="checkbox" id="button_<?=$id?>"name="divisi" value="<?=$id?>">
                                              <label class="form-check-label" for ="<?=$id?>"><?=$nama?></label>
                                    </div>
                                <?php endforeach;?>  
                                    </div>
                        </div>
                    <div class="text-start row col-md-8 mb-3">
                          <div class="row col-md-5 mb-3">
                                    <label class="col-md-4 col-form-label">Tgl Awal:</label>
                                    <div class = "col-md-6">
                                       <input type="text" class="datepicker_input form-control" id="tgl_from">
                                    </div>
                            </div>  
                            <div class="row col-md-5 mb-3">
                                    <label class="col-md-5 col-form-label">Tgl Akhir:</label>
                                    <div class = "col-md-6">
                                       <input type="text" class="datepicker_input form-control" id="tgl_to">
                                    </div>
                            </div>
                            <div class="row col-2 mb-3">
                              <button  type="sumbit" name="sumbit" id="filterdata"  class="btn btn-primary">Submit</button>
                            </div>
                    </div>
                        
                    </form>
            </div>
            <div id="header_data"></div>
            <div id="datalist">
    
                <div id="tabelhead"></div>
            </div>
            <div id="printinvoce"></div>
            </div>
          
        </div>
     
    </section>
    <section id="tampiledit" class="section">
    </section>

</main>

<script>
  $(document).ready(function(){

   $("#filterdata").on("click",function(e){
        e.preventDefault();

        let div =``;
          $(".checkdivisi:checked").each(function(){
            div += "'"+$(this).val()+ "'"+',';
          });
        let str_divisi = div.slice(0,-1);

        console.log(str_divisi);
        tgl_awal = $("#tgl_from").val();
        start_date = myformat(tgl_awal);
        tgl_akhir = $("#tgl_to").val();
        end_date = myformat(tgl_akhir);
        get_data_User(start_date,end_date,str_divisi);
   })

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

 
  });


  //fungsi format tanggal 
  function myformat(date){
  
    let d = date.split('/')[0];
   
    let m = date.split('/')[1];
    let y = date.split('/')[2];
    let format = y + "-" + m + "-" + d;
    return format;
  }
  //end format tanggal

    function get_data_User(start_date,end_date,str_divisi){
        $.ajax({
                url:'<?= base_url; ?>/listactivity/laporandata2',
                method:'POST',
                dataType:'json', 
                data:{start_date:start_date,end_date:end_date,divisi:str_divisi},     
                success:function(response){
                get_header();
                get_tables();
                let titles =`<h1 style="text-align:center;color:black;">Report Daily Activity</h1>`;
                $("#tabel1").DataTable({
                    
                    "ordering": false,
                    "destroy":true,
                    dom: 'Bfrtip',
                    buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        "columnDefs": [
                        { "targets": [0,2,3,4], "searchable": false }
                        ],
                        buttons: [
                            //{ extend: 'copyHtml5', footer: true },
                            { 
                              tag: "button",
                              className: "btn btn-primary",
                              extend: 'excelHtml5', footer: true },
                            // {  tag: "button",
                            //   className: "btn btn-success",
                            //   extend: 'csvHtml5', footer: true },
                            { 
                              tag: "button",
                              className: "btn btn-info",
                              extend: 'pdfHtml5', footer: true }
                        ],
                                    
                    //paging:true,
                    //     "bPaginate":false,
                    //     "bLengthChange": false,
                    //     "bFilter": true,
                    //     "bInfo": false,
                    //     "bAutoWidth": false,
                    //     dom: 'lrt',
                        fixedColumns:   {
                        // left: 1,
                            right: 1
                        },
                        // pageLength: 5,
                        // lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                        'rowCallback': function(row, data, index){
                            let status = data.status;
                            if(status =="DONE"){
                                $(row).find('td:eq(0)').css('color', '#4CAF50');
                                $(row).find('td:eq(1)').css('color', '#198754');
                                $(row).find('td:eq(2)').css('color', '#198754');
                                $(row).find('td:eq(3)').css('color', '#198754');
                                $(row).find('td:eq(4)').css('color', '#198754');
                                $(row).find('td:eq(5)').css('color', '#198754');
                                $(row).find('td:eq(6)').css('color', '#198754');

                            }  
                        },            
                        data: response,
                            columns: [
                                { 'data': 'pic' },
                                { 'data': 'tanggal' },
                                { 'data': 'activity' },
                                { 'data': 'category' }, 
                                { 'data': 'noted' },
                                { 'data': 'status' },
                                { 'data': 'dateline' },
                   
                            ]      
                
                });
                }
        });      
    } 

    function get_header(){
    let data_headr =`

    <div  class="page-heading mb-3">
    <div class="page-title">
    <h4 class="text-center">Daily Activity</h4>
    </div></div>

    `;
    $("#header_data").html(data_headr);
    }

    function get_tables(){
    //   let id ="#"+tabel;
    //   let substr_bulan = bulan.substr(0,3);
        let dataTable =`
                    <table id="tabel1" class='display table-info' style='width:100%'>                    
                                    <thead  id='thead'class ='thead'>
                                    <tr>
                                                <th>PIC</th>  
                                                <th>Tanggal</th>
                                                <th>Activity</th>
                                                <th>Category</th>
                                                <th>Noted</th>
                                                <th>Status</th>
                                                <th>Dateline</th>  
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                          

        `;
    $("#tabelhead").empty().html(dataTable);
    };


</script>
