
<?php 
    $divisi = $data['divisi'];
      $jabatan = $data['jabatan'];
      $user = $data['user'];
  
        $nama ='';
        $email ='';
        $pass = '';
        $div = '';
        $jab ='';
      foreach ($user as $item){
        $nama = $item['nama'];
        $email = $item['email'];
        $pass = $item['password'];
        $div = $item['divisi'];
        $jab = $item['jabatan'];
      }
?>

  <div class="card">
    <div class="card-header">
    <button onclick="goBack()" type="button" class="btn btn-lg mb-4"><i class="fa-solid fa-chevron-left"></i></button>
    <h5>Edit Data</h5>
    </div>
    <div class="card-content">
      <div class="card-body">
      <input   type="hidden"  class="form-control" id="checkjabatan" value="<?=$jab?>">
      <input  type="hidden"  class="form-control" id="checkdivisi" value="<?=$div?>">

      <form class ="form form-horizontal"  enctype="multipart/form-data">
        <div class="row col-md-12-col-12">
                      <div class="row col-md-12 mb-3">
                                <label for="nama_user" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-3">
                                  <input type="text"  class="form-control" name ="nama_user" id="nama_user" value="<?=$nama?>" placeholder="Nama" required>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                               <div class="col-sm-3">
                               <input type="email" class="form-control" id="Email" name ="Email" value="<?=$email?>" caria-describedby="emailHelp" placeholder="Enter email">
                               <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                               </div> 
                        </div>

                        <div class="row col-md-12 mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-3">
                                <span toggle="#password"  style="float: right;"  class="fa fa-fw fa-eye field-icon toggle-password fa-4"></span>
                                  <input type="password"  class="form-control" name ="password" id="password" value="<?=$pass?>" placeholder="Password" required>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Ulangi Password</label>
                                <div class="col-sm-3">
                                <span toggle="#ulangi_password"  style="float: right;" class="fa fa-fw fa-eye field-icon toggle-password fa-4"></span>
                                  <input type="password"  class="form-control" name ="ulangi_password" id="ulangi_password"value="<?=$pass?>"required>
                                </div>
                        </div>
                  <div class ="row col-md-12 mb-4">
                        <label for="direksi" class="col-sm-2 col-form-label" >Divisi</label>
                                <div id="divisi" class ="col-md-6">
                                <?php  foreach($divisi as $file):
                                  $id = $file['kode_divisi'];
                                  $nama = $file['nama_divisi'];
                               ?>
                               <div class="form-check form-check-inline col-md-5">
                                          <input class="form-check-input checkNamaDivisi_edit" for ="<?=$id?>" type="checkbox" id="<?=$id?>"name="divisi_edit" value="<?=$id?>">
                                          <label class="form-check-label" for ="<?=$id?>"><?=$nama?></label>
                              </div>
                                <?php endforeach;?>  
                                </div>
                  </div>
                  <div class ="row col-md-12 mb-2">
                        <label for="direksi" class="col-sm-2 col-form-label" >Jabatan</label>
                                <div id="divisi" class ="col-md-6">
                                <?php  foreach($jabatan as $file):
                                  $id = $file['kode_jabatan'];
                                  $nama = $file['nama_jabatan'];
                               ?>
                               <div class="form-check form-check-inline col-md-5">
                                          <input   class="form-check-input checkNamaJabatan_edit" for ="<?=$id?>" type="checkbox" id="<?=$id?>"name="jabatan_edit" value="<?=$id?>">
                                          <label class="form-check-label" for ="<?=$id?>"><?=$nama?></label>
                              </div>
                                <?php endforeach;?> 
 
                                </div>

                  </div>
        

        </div>
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Updatedata">Update</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" onclick="goBack()">Batal</button>
                                  </div>
          </form>
      </div>
    </div>
  </div>
  </div>
</div>




 <script>
       $(document).ready(function(){
        $(document).on("click",".toggle-password",function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(document).on("click",".checkNamaDivisi_edit",function(){
          $('.checkNamaDivisi_edit').not(this).prop('checked', false); 
        });

        $(document).on("click",".checkNamaJabatan_edit",function(){
          $('.checkNamaJabatan_edit').not(this).prop('checked', false); 
        });

        let div = $("#checkdivisi").val();
        if(div !==''){
          let id_div = "#"+div;
          $(id_div).prop("checked",true);
        }
        let jab = $("#checkjabatan").val();
        if(jab !==''){
          let id_jab = "#"+jab;
          $(id_jab).prop("checked",true);
        }
      
        $("#Updatedata").on("click",function(e){
      
                    e.preventDefault();
                  
                    let  nama_user = $("#nama_user").val();
                    let  email = $("#Email").val();
                    let  pass = $("#password").val();
                    let  pass_ulang = $("#ulangi_password").val();
                    let div_edit = $("input[type=checkbox][name=divisi_edit]:checked").val();
                    let jab_edit = $("input[type=checkbox][name=jabatan_edit]:checked").val();

                    $.ajax({
                        url:"<?= base_url; ?>/user/updateuser",
                        type:'POST',
                        dataType:'json',
                        data :{nama_user:nama_user,email:email,password:pass,divisi:div_edit,jabatan:jab_edit,ulangi_password:pass_ulang},
                        success:function(result){
                        
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: result,
                          // showConfirmButton: false,
                          // timer: 500000
                          }); 
                          goBack();
                      
                        }
                    });
                });
            //end edit

      });



      function goBack(){
        window.location.replace("<?= base_url; ?>/user/index");
     
      } 
    </script>