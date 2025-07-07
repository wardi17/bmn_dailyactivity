      <!-- Modal  tambah baru -->
      <div class="modal fade" id="FinsihModal" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Finish Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_tambah" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    <form  id ="formtambah"  class ="form form-horizontal">
                      <input type="hidden" class="form-control" id="id_tr" value="">
                          <div class="row col-md-12 mb-3">  
                                      <label for="tanggal_finish" class="col-sm-4 col-form-label">Date Finish</label>
                                      <div class="col-sm-6">
                                        <input type="date" class="form-control datepicker_input"  name="tanggal_finish" id="tanggal_finish"  value="2001-08-01"required>
                                      </div>

                              </div>
                        
                                  <div class="col-sm-11 d-flex justify-content-end">
                                          <button  type="submit" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="UpdatData">Update</button>
                                          <button type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal"  id="close_tambah2" >Close</button>
                                        </div>
                    </form>
              </div>
              </div>
      </div>
      </div>
      <script>
        $(document).ready(function(){
    
                  //untuk tanggal
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        let  output =  d.getFullYear()+ '-'+(month<10 ? '0' : '') + month + '-' +
                      (day<10 ? '0' : '') + day;

          console.log(output)
          $("#tanggal_finish").val(output);


          $("#UpdatData").on("click",function(e){
            e.preventDefault();
            let tgl = $("#tanggal_finish").val();
            let id_ts = $("#id_tr").val();
            if(tgl !==""){
            $.ajax({
              url : "<?= base_url?>/newactivity/finishactivity",
              method: "POST",
              data :{tanggal:tgl,id:id_ts},
              dataType :"json",
              cache :true,
              success:function(result){
               let pesan  = result.error;
               Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title:pesan,
                          showConfirmButton: false,
                          timer:1000
                          }).then(
                            get_data_User()
                          ); 
              }
            })
          }else{
            Swal.fire({
                            position: 'top-center',
                          icon: 'warning',
                          title: "Tanggal tidak boleh kosong",
                          showConfirmButton: false,
                          timer:1000
                          }); 
          }
          })
          
        });

 
      </script>