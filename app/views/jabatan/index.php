<?php 
include('edit_data.php');
include('tambah.php');
include('delete_data.php');
?>

<div id="data_Jabatan">
  <div id="main">
  <section class="section">
        <div class="card">
          <div class="card-body">
          <div id="header_data"></div>
            <div class ="col-md-12 col-12">
                <!-- <h3 class="text-center">Target upload</h3> -->
                      <div class="col-md-12 text-end mb-3">
                                      <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#TambaModal">
                                      <i class="fa-regular fa-file"></i>   
                      </div>
            </div>
      <!-- Basic Tables start -->
      <div id="tabelhead"></div>
      <!-- Basic Tables end -->
          </div>
        </div>
  </section>
 

  </div>

        <script>
            $(document).ready(function(){
                get_data_Jabatan();
            
      
            
      //restet tambah
                  $("#close_tambah").on("click",function(e){
                    
                    e.preventDefault();
                    $("#formtambah").trigger("reset");
                  })
                  $("#close_tambah2").on("click",function(e){
                    
                    e.preventDefault();
                    $("#formtambah").trigger("reset");
                  })
      //reset tambah
      //restet edit
      $("#close_edit").on("click",function(e){
                    e.preventDefault();
                    $("#formedit").trigger("reset");
                  })
      //reset edit
      //restet delete
      $("#close_delete").on("click",function(e){
                    e.preventDefault();
                    $("#formedit").trigger("reset");
                  })
      //reset delete
          

            
            });



            function delete_row(){
            
            }

            function get_data_Jabatan(){

                $.ajax({
                        url:'<?= base_url; ?>/Jabatan/tampildata',
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
                                            
                                data: response,
                                    columns: [
                                        { 'data': 'kode_jabatan' },
                                        { 'data': 'nama_jabatan' },
                                        { 'data': 'level_jabatan' },
                                        { "render": function ( data, type,row) { // Tampilkan kolom aksi
                                        
                                          let div = row.kode_Jabatan;
                                          let html  =`<button type="button"   class=" open-edit btn btn-lg btn-space" data-bs-toggle="modal" data-bs-target="#EditModal"><i class="fa-regular fa-pen-to-square"></i></button>`

                                        html += `<button type="button" class=" open-delete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>`
                                        //html += `<button type="button" onclick ="member_div('${div}')"class="btn  btn-lg"><i class="fa-solid fa-binoculars"></i></button>`

                                        return html
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
                <h4 class="text-center">Master Jabatan </h4>
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
                                                            <th style="width:2%">Kode Jabatan</th>
                                                            <th style="width:3%">Nama Jabatan</th>
                                                            <th style="width:3%">Level</th>
                                                            <th style="width:2%">Action</th>  
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                      

                    `;
                $("#tabelhead").empty().html(dataTable);
            };

            function member_div(div){
              getmember_Jabatan(div);
                $("#data_id").val(div);
                $("#data_Jabatan").hide();
                $("#member_Jabatan").show();
              
            }
        </script>
</div>





