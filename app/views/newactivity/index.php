<style>
option{
  font-family: Helvetica !important;
  line-height: 1.0 !important;
  /* margin-bottom: 0;
  padding-bottom: calc(.375rem + 1px);
  padding-top: calc(.375rem + 1px); */
}
</style>
<div id="main">
<?php $kategori = $data['kategori'];
      $status = $data['status'];
?>
    <!-- Main content -->
    <section id="basic-horizontal-layouts">
    <div class ="col-md-12 col-12">
  
  <div class="card">
    <div class="card-content">
      <div class="card-body">
      <h5 class="mt-2">New Daily Activity</h5>
      <form  id ="formtambah" class ="form form-horizontal"  enctype="multipart/form-data">
        <div class="row col-md-12-col-12">
                  <div class =" row col-md-12 mb-3">
                      <label for="tanggal" class="col-sm-2 col-form-label" >Date entry</label>
                        <div class = "col-md-2">
                        <input type="text" id="tanggal" class="datepicker_input form-control"required>
                        </div>
                    </div>
                      <div class="row col-md-12 mb-3">
                                <label for="activity" class="col-sm-2 col-form-label">Activity</label>
                                <div class="col-sm-6">
                                <textarea style="height:100px;"  class="form-control" name ="activity" id="activity" value="" required></textarea>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-4">
                                <label for="categori" class="col-sm-2 col-form-label">Category</label>
                               <div class="col-sm-3">
                             
                               <select class ="form-control" id="kategori">
                               <option class="col-form-label option" selected="selected">Please Select </option>
                                    <?php  foreach($kategori as $file):
                                        $kode = $file['kode_Kategori'];
                                        $nama = $file['nama_Kategori'];

                                    ?>
                                        <option class=" col-sm-2 col-form-label option" value="<?= $kode ?>"><?= $nama ?></option>
                                  <?php endforeach;?>  
                               </select> 
                            
                               </div> 
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="noted" class="col-sm-2 col-form-label">Noted</label>
                                <div class="col-sm-6">
                                <textarea style="height:100px;"  class="form-control" name ="noted" id="noted" value="" required></textarea>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                               <div class="col-sm-2">
                               <select class ="form-control" id="status">
                               <option selected="selected">Please Select </option>
                                    <?php  foreach($status as $file):
                                        $kode = $file['kode_Status'];
                                        $nama = $file['nama_Status'];
                                    ?>
                                        <option value="<?= $kode ?>"><?= $nama ?></option>
                                  <?php endforeach;?> 
                               </select> 
                               </div> 
                        </div>
                        <div class =" row col-md-12 mb-3">
                          <label for="dateline" class="col-sm-2 col-form-label" >Dateline</label>
                            <div class = "col-md-2">
                            <input type="text" id="dateline" class="datepicker_input form-control"required>
                            </div>
                      </div>
                      <div class =" row col-md-12 mb-3">
                      <label for="pic" class="col-sm-2 col-form-label" >PIC</label>
                        <div class = "col-md-2">
                        <input disabled type="text" id="pic" value="<?=$_SESSION['nama']?>" class="form-control"required>
                        
                        </div>
                    </div>

              </div>
    
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Createdata">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" id="clear">Clear</button>
                                  </div>
          </form>
      </div>
    </div>
  </div>
  </div>
</div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 </div>

 <script>
$(document).ready(function(){
        // $("#noted").summernote({
        //   height: 200,
        //   focus: true
        // });

        //untuk tanggal
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        let  output = (day<10 ? '0' : '') + day + '/' +
                    (month<10 ? '0' : '') + month + '/' +
                    d.getFullYear() ;
          $("#tanggal").val(output);
          $("#dateline").val(output);
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
        //end tanggal
        $(document).on("click",".toggle-password",function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(document).on("click",".checkNamaDivisi",function(){
          $('.checkNamaDivisi').not(this).prop('checked', false); 
        });

        $(document).on("click",".checkNamaJabatan",function(){
          $('.checkNamaJabatan').not(this).prop('checked', false); 
        });

      //untuk clear form 
            $("#clear").on("click",function(){
              window.location.reload(true);
            })
      //end clear form

  //tambah data
  $("#Createdata").on('click',function(e){
                e.preventDefault();
            
                let tgl = $("#tanggal").val();
                let tanggal = myformat(tgl);
                let activity = $("#activity").val();
                let categori = $("#kategori").find(":selected").val();
                let noted = $("#noted").val();
                let st = $("#status").find(":selected").val();
                let dt = $("#dateline").val();
                let dateline = myformat(dt);
                let pic = $("#pic").val();

                let formData = new FormData();
                formData.append('tanggal', tanggal);                
                formData.append('activity', activity);
                formData.append('categori', categori);
                formData.append('noted', noted);
                formData.append('status', st);
                formData.append('dateline', dateline);
                formData.append('pic', pic);

                $.ajax({
                  url:'<?= base_url; ?>/newactivity/tambahactivity',
                  method:'POST',
                  data:formData,
                  cache: false,
                  processData: false,
                  contentType: false,
                  dataType:'json',
                  success:function(result){
                    let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                          // showConfirmButton: false,
                          // timer: 500000
                          }).then(
                            location.reload()

                          ); 
                        }   
                })
              });
              //end tambah data

      });

          function myformat(date){
            let d = date.split('/')[0];
            let m = date.split('/')[1];
            let y = date.split('/')[2];
            let format = y + "-" + m + "-" + d;
          
            return format;
          } 
    </script>





