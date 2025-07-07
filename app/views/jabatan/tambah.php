      <!-- Modal  tambah baru -->
      <div class="modal fade" id="TambaModal" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_tambah" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form  id ="formtambah"  class ="form form-horizontal">
                          <div class="row col-md-12 mb-3">  
                                      <label for="kode_Jabatan" class="col-sm-3 col-form-label">Kode Jabatan</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control"  name="kode_Jabatan" id="kode_Jabatan" value="" required>
                                      </div>
                              </div>
                          
                              <div class="row col-md-12">  
                                      <label for="nama_Jabatan" class="col-sm-3 col-form-label">Nama Jabatan</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control"  name="nama_Jabatan" id="nama_Jabatan" value="" required>
                                      </div>
                              </div>
                              <div class="row col-md-12 mb-3">  
                                      <label for="level_jabatan" class="col-sm-3 col-form-label">Level</label>
                                      <div class="col-sm-3">
                                        <input type="number" class="form-control"  name="level_jabatan" id="level_jabatan" value="" required>
                                      </div>
                              </div>
                              </div>
                                  <div class="col-sm-11 d-flex justify-content-end">
                                          <button  type="submit" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Createdata">Save</button>
                                          <button type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal"  id="close_tambah2" >Close</button>
                                        </div>
            </form>
              </div>
      </div>
      </div>
      <!-- end modal tambah -->
<script>
        //tambah data
        $("#Createdata").on('click',function(e){
                e.preventDefault();
            
                let kode = $("#kode_Jabatan").val();
                let nama = $("#nama_Jabatan").val();
                let level = $("#level_jabatan").val();
                $.ajax({
                  url:'<?= base_url; ?>/Jabatan/tambahJabatan',
                  method:'POST',
                  data:{kode:kode,nama:nama,level:level},
                  cache:true,
                  dataType:'json',
                  success:function(result){
                    let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                          // showConfirmButton: false,
                          // timer: 500000
                          }); 
                          $("#formtambah").trigger('reset');
                          get_data_Jabatan();
                  }
                })
              });
              //end tambah data
</script>