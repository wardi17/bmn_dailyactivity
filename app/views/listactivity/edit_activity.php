
<?php $kategori = $data['kategori'];
      $status = $data['status'];
      $datas = $data['activity'];
        // echo "<pre>";
		// print_r($datas);
		// echo "</pre>";
        $tgl_edit = "";
        $activity_edit = "";
        $category_edit="";
        $noted_edit="";
        $status_edit="";
        $dateline_edit="";
        $pic_edit ="";
        $id ="";
        foreach($datas as $items){
            $tgl_edit = $items['tanggal'];
            $activity_edit = $items['activity'];
            $category_edit = $items['category'];
            $noted_edit = $items['noted'];
            $status_edit = $items['status'];
            $dateline_edit = $items['dateline'];
            $pic_edit=$items['pic'];
            $id_edit = $items['id'];
        }

?>
<style>
option{
  font-family: Helvetica !important;
  line-height: 1.0 !important;
  /* margin-bottom: 0;
  padding-bottom: calc(.375rem + 1px);
  padding-top: calc(.375rem + 1px); */
}

</style>
    <!-- Main content -->
    <div class ="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
            <button onclick="goBack()" type="button" class="btn btn-lg mb-4"><i class="fa-solid fa-chevron-left"></i></button>
            <h5 class="mt-2">Edit Daily Activity</h5>
            </div>
            <div class="card-content">
            <div class="card-body">
        <input type="hidden" id="id_trs" class="form-control" value="<?=$id_edit?>">
        <input type="hidden" id="id_ktg" class="form-control" value="<?=$category_edit?>"> 
        <input type="hidden" id="id_st" class="form-control" value="<?=$status_edit?>">
            <form  id ="formtambah" class ="form form-horizontal"  enctype="multipart/form-data">
                <div class="row col-md-12-col-12">
                        <div class =" row col-md-12 mb-3">
                            <label for="tanggal" class="col-sm-2 col-form-label" >Tgl/Input</label>
                                <div class = "col-md-2">
                                <input disabled type="text" id="tanggal" value="<?=$tgl_edit?>" class="datepicker_input form-control"required>
                                </div>
                            </div>
                            <div class="row col-md-12 mb-3">
                                        <label for="activity" class="col-sm-2 col-form-label">Activity</label>
                                        <div class="col-sm-6">
                                        <textarea style="height:100px;"  class="form-control" name ="activity" id="activity"  required><?= htmlspecialchars($activity_edit); ?></textarea>
                                        </div>
                                </div>
                                <div class="row col-md-12 mb-4">
                                        <label for="categori" class="col-sm-2 col-form-label">Categori</label>
                                    <div class="col-sm-3">
                                    
                                    <select class ="form-control" id="kategori">
                                            <?php  foreach($kategori as $file):
                                                $kode = $file['kode_Kategori'];
                                                $nama = $file['nama_Kategori'];

                                            ?>
                                                <option value="<?= $kode ?>"><?= $nama ?></option>
                                        <?php endforeach;?>  
                                    </select> 
                                    
                                    </div> 
                                </div>
                                <div class="row col-md-12 mb-3">
                                        <label for="noted" class="col-sm-2 col-form-label">Noted</label>
                                        <div class="col-sm-6">
                                        <textarea style="height:100px;"  class="form-control" name ="noted" id="noted" value="" required><?= htmlspecialchars($noted_edit); ?></textarea>
                                        </div>
                                </div>
                                <div class="row col-md-12 mb-3">
                                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-2">
                                    <select disabled class ="form-control" id="status">
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
                                    <input disabled type="text" id="dateline"  value="<?=$dateline_edit ?>" class="datepicker_input form-control"required>
                                    </div>
                            </div>
                            <div class =" row col-md-12 mb-3">
                            <label for="pic" class="col-sm-2 col-form-label" >PIC</label>
                                <div class = "col-md-3">
                                <input disabled type="text" id="pic" value="<?=$pic_edit?>" class="form-control"required>
                                
                                </div>
                            </div>

                    </div>
            
                                    </div>
                                    <div class="col-sm-11 d-flex justify-content-end">
                                            <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Updatedata">Save</button>
                                            <button type="button" class="btn btn-secondary me-1 mb-3" id="clear">Batal</button>
                                        </div>
                </form>
            </div>
            </div>
        </div>


 <script>
$(document).ready(function(){
        let ktg = $("#id_ktg").val();
        let st = $("#id_st").val();
        $("#kategori").val(ktg);
        $("#status").val(st);

        //untuk tanggal

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
  $("#Updatedata").on('click',function(e){
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
                let id = $("#id_trs").val();

                let formData = new FormData();
                formData.append('tanggal', tanggal);                
                formData.append('activity', activity);
                formData.append('categori', categori);
                formData.append('noted', noted);
                formData.append('status', st);
                formData.append('dateline', dateline);
                formData.append('pic', pic);
                formData.append('id',id);
                console.log(formData);
                $.ajax({
                  url:'<?= base_url; ?>/listactivity/updateactivity',
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
          function goBack(){
                window.location.replace("<?= base_url; ?>/listactivity/index");
            } 
    </script>





