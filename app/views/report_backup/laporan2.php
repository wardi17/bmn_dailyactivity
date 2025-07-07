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
<main id="main" class="main">
    <section id="tampildata" class="section">
        <div class ="card">
        
            <div class="card-body">
            <div class=" mt-4">
                <form id="form_filter">
                    <div class="left atas">  
                        <label>Tgl Awal :</label>
                                    <input type="text" style="width:100px"  class="datepicker_input" id="tgl_from" name="tglku1">
                        <label>Tgl Akhir :</label>
                                    <input type="text" style="width:100px"  class="datepicker_input" id="tgl_to" name="tglku2">
                                <button  type="sumbit" name="sumbit" id="filterdata"class="btn btn-primary">Submit</button>

                    
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
        tgl_awal = $("#tgl_from").val();
        start_date = myformat(tgl_awal);
        tgl_akhir = $("#tgl_to").val();
        end_date = myformat(tgl_akhir);
        get_data_User(start_date,end_date);
        //console.log({tanggal_from:tanggal_awal,tanggal_to:tanggal_akhir})
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

    function get_data_User(start_date,end_date){
        $.ajax({
                url:'<?= base_url; ?>/listactivity/laporandata2',
                method:'POST',
                dataType:'json', 
                data:{start_date:start_date,end_date:end_date},     
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
                            { extend: 'copyHtml5', footer: true },
                            { extend: 'excelHtml5', footer: true },
                            { extend: 'csvHtml5', footer: true },
                            { extend: 'pdfHtml5', footer: true }
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
                                    
                        data: response,
                            columns: [
                                { 'data': 'tanggal' },
                                { 'data': 'activity' },
                                { 'data': 'category' }, 
                                { 'data': 'noted' },
                                { 'data': 'status' },
                                { 'data': 'dateline' },
                                { 'data': 'pic' },
                   
                            ]      
                
                });
                }
        });      
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

    function get_tables(){
    //   let id ="#"+tabel;
    //   let substr_bulan = bulan.substr(0,3);
        let dataTable =`
                    <table id="tabel1" class='display table-info' style='width:100%'>                    
                                    <thead  id='thead'class ='thead'>
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
                                    <tbody>
                                    </tbody>
                                </table>
                          

        `;
    $("#tabelhead").empty().html(dataTable);
    };


</script>
