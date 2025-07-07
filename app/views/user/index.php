<?php 
include("delete_data.php");
?>
<div id="main">
    <section id="TableUser">
      <div class="card" >
        <div class="card-header">
          
                  <div class="col-md-12 text-end mb-3">
                    <a href="<?= base_url; ?>/user/tambah" class="btn float-right btn-xs btn btn-primary">Tambah User</a>
                  </div>
        </div>
        <div class="card-body">
        <?php
        $pesan = (isset($msg))? $msg : '';
        if($pesan !== ''){
          Flasher::Message();
        }
      ?>
        <div id="tabelhead"></div>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

    <section id="editUser"></section>
  </div>
  <!-- /.content-wrapper -->
<script>
  $(document).ready(function(){
    get_data_User();

    $(document).on("click","#Edit_data",function(){
      $("#TableUser").hide();
        let email = $(this).data('email');
      $("#editUser").load("<?= base_url; ?>/user/editdata",{email:email})
    });
  });

  function get_data_User(){
    $.ajax({
            url:'<?= base_url; ?>/user/tampildata',
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
                            { 'data': 'nama' },
                            { 'data': 'email' },
                            { 'data': 'divisi' }, 
                            { 'data': 'jabatan' },
                            { "render": function ( data, type,row) { // Tampilkan kolom aksi
                            
                              let Email = row.email;
                              let html  =`<button type="button" id="Edit_data" data-email ="${Email}" class="btn btn-lg btn-space" ><i class="fa-regular fa-pen-to-square"></i></button>`

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
    <h4 class="text-center">Master Status </h4>
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
                                                <th style="width:2%">Nama</th>
                                                <th style="width:3%">Email</th>
                                                <th style="width:3%">Divisi</th>
                                                <th style="width:3%">Jabatan</th>
                                                <th style="width:2%">Action</th>  
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                          

        `;
    $("#tabelhead").empty().html(dataTable);
    };


</script>
