<script src="<?= base_url; ?>/assets/js/printObject.js"></script>
<?php include("finish_activity.php")?>
<main id="main" class="main">
    <section id="tampildata" class="section">
        <div class ="card">
            <!-- <div class="card-header">
                    <div class="col-md-12 text-end mb-3">
                        <a id="printInvoice" class="btn float-right btn-xs btn btn-primary">Print</a>
                    </div>
            </div> -->
            <div class="card-body">
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
    get_data_User();

    $('#printInvoice').click(function(){
            Popup($('#tabelhead')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
        $(document).on("click","#finishActivity",function(){
            let id = $(this).data('id');
            $("#id_tr").val(id);
            $("#FinsihModal").modal("show");
        });

        $(document).on("click","#deleteActivity",function(){
            let id_ts = $(this).data('id');
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Hapus Data Ini!",
                type: "warning",
                showDenyButton: true,
                confirmButtonColor: "#DD6B55",
                denyButtonColor: "#757575",
                confirmButtonText: "Ya, Hapus!",
                denyButtonText: "Tidak, Batal!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : "<?= base_url?>/newactivity/deleteactivity",
                            method: "POST",
                            data :{id:id_ts},
                            dataType :"json",
                            cache :true,
                            success:function(data){
                                Swal.fire('Deleted!', data.error, 'success');
                                get_data_User();
                            }
                        })
                    }else if(data.isDenied) {
                        Swal.fire('Data kamu aman :)', '', 'info')
                    }
                });
        });

        $(document).on("click","#editActivity",function(){
            let id = $(this).data("id");
            $("#tampildata").hide();
            $("#tampiledit").load("<?= base_url; ?>/newactivity/editdata",{id:id});
        })
  });

    function get_data_User(){
        $.ajax({
                url:'<?= base_url; ?>/listactivity/tampildata',
                method:'POST',
                dataType:'json',      
                success:function(response){
                get_header();
                get_tables();

                $("#tabel1").DataTable({
                    
                    "ordering": false,
                    "destroy":true,
                    // dom: 'Plfrtip',
                    //     scrollCollapse: true,
                    paging:true,
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
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
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
                                { "render": function ( data, type,row) { 
                                    // Tampilkan kolom aksi
                                let id = row.id;
                                let status = row.status;
                                let html =``;
                                if(status =="DONE"){
                                  

                                    html +=` <td style="vertical-align: middle; text-align:center;">
                                            <a class="btn btn-success btn-sm">
                                               Finish
                                            </a>
                                            </td>`;
                                }else{
                                    html +=`
                                    <td style="vertical-align: middle; text-align:center;">
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="fas fa-align-left"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" data-id="${id}" id="editActivity">Edit</a></li>
                                            <li><a class="dropdown-item" data-id="${id}" id="finishActivity">Finish</a></li>
                                            <li><a class="dropdown-item" data-id="${id}" id="deleteActivity">Hapus</a></li>
                                        </ul>
                                        </div>
                                    </td>
                                        `
                                    }
                                return html;
                                }
                            },
                            ]      
                
                });
                }
        });      
    } 

    function get_header(){
    let data_headr =`

    <div  class="page-heading mb-3">
    <div class="page-title">
    <h4 class="text-center">List Daily Activity</h4>
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
                                                <th>Pic</th>  
                                                <th>Tanggal</th>
                                                <th>Activity</th>
                                                <th>Category</th>
                                                <th>Noted</th>
                                                <th>Status</th>
                                                <th>Dateline</th>  
                                                <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                          

        `;
    $("#tabelhead").empty().html(dataTable);
    };


</script>
