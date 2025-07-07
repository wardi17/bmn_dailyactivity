 <!-- Modal delete -->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class ="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="EditModalLabel">Delete data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_delete" aria-label="Close"></button>
            </div>
                      <div class="modal-body">
                        <form id="formdelete">
                            <div class="row col-md-12 mb-3">  
                                    <label for="nama_delete" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-3">
                                      <input disabled type="text" class="form-control"  name="nama_delete" id="nama_delete" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label for="email_delete" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                      <input  disabled type="text" class="form-control"  name="email_delete" id="email_delete" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label for="divisi_delete" class="col-sm-3 col-form-label">Divisi</label>
                                    <div class="col-sm-6">
                                      <input  disabled type="text" class="form-control"  name="divisi_delete" id="divisi_delete" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label for="jabatan_delete" class="col-sm-3 col-form-label">Jabatan</label>
                                    <div class="col-sm-6">
                                      <input  disabled type="text" class="form-control"  name="jabatan_delete" id="jabatan_delete" value="" required>
                                    </div>
                            </div>

                            <div class="col-sm-11 d-flex justify-content-end">
                                  <button  id="delete" class="btn btn-primary text-center me-1 md-3" data-bs-dismiss="modal" >Yes</button> 
                                <button  id="close_delete" type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                              </div>
                              
                        </form>
                      </div>
                    </div>
          </div>
        </div>
      <!-- end form delete  -->

    <script>
                 // delete data 
                 $(document).on("click",".open-delete",function(){
                  let row = jQuery(this).closest('tr');
                    let columns = row.find('td'); 
                
                    columns.addClass('row-highlight');
                    jQuery.each(columns, function(key, item) { 
                        switch(key){
                          case 0:
                      let nama = item.innerHTML;
                      $(".modal-body #nama_delete").val(nama);
                        break;
                        case 1:
                      let email = item.innerHTML;
                      $(".modal-body #email_delete").val(email);
                        break;
                        case 2:
                      let divisi = item.innerHTML;
                      $(".modal-body #divisi_delete").val(divisi);
                        break;
                        case 3:
                      let jabatan = item.innerHTML;
                      $(".modal-body #jabatan_delete").val(jabatan);
                        break;
                      }
                    
                    });
                  
                


                });
                
                $("#delete").on("click",function(e){
                    e.preventDefault();
                    let email = $("#email_delete").val();
                
                    $.ajax({
                        url:"<?= base_url; ?>/user/deletedata",
                        type:"POST",
                        data:{email:email},
                            dataType:'json',                  
                        success: function(result){ 
                          let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                        
                          }); 
                          get_data_User();
                        }
                    
                    })
                });
                //end delete data
    </script>