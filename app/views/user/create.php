 <div id="main">
<?php $divisi = $data['divisi'];
      $jabatan = $data['jabatan'];
?>
    <!-- Main content -->
    <section id="basic-horizontal-layouts">
    <div class ="col-md-12 col-12">
  
  <div class="card">
    <div class="card-header">
    <h5>Tambah User</h5>
    </div>
    <div class="card-content">
      <div class="card-body">
   
      <form  id ="formtambah" class ="form form-horizontal" action="<?= base_url; ?>/user/simpanuser" method="POST" enctype="multipart/form-data">
        <div class="row col-md-12-col-12">
                      <div class="row col-md-12 mb-3">
                                <label for="nama_user" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-3">
                                  <input type="text"  class="form-control" name ="nama_user" id="nama_user" value="" placeholder="Nama" required>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                               <div class="col-sm-3">
                               <input type="email" class="form-control" id="Email" name ="Email" caria-describedby="emailHelp" placeholder="Enter email">
                               <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                               </div> 
                        </div>
                        <!-- <div class="row col-md-12 mb-3">
                                <label for="cabang" class="col-sm-2 col-form-label">Cabang</label>
                                <div class="col-sm-3">
                                  <input type="text"  class="form-control" name ="cabang" id="cabang" value="" placeholder="Cabang" required>
                                </div>
                        </div> -->
                        <div class="row col-md-12 mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-3">
                                <span toggle="#password" style="float: right;" class="fa fa-fw fa-eye field-icon toggle-password fa-4"></span>
                                  <input type="password"   class="form-control" name ="password" id="password" value="" placeholder="Password" required>
                                </div>
                        </div>
                        <div class="row col-md-12 mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Ulangi Password</label>
                                <div class="col-sm-3">
                                <span toggle="#ulangi_password" style="float: right;" class="fa fa-fw fa-eye field-icon toggle-password fa-4"></span>
                                  <input type="password"  class="form-control" name ="ulangi_password" id="ulangi_password" value="" required>
                                </div>
                        </div>
                  <div class ="row col-md-12 mb-2">
                        <label for="direksi" class="col-sm-2 col-form-label" >Divisi</label>
                                <div id="divisi" class ="col-md-6">
                                <?php  foreach($divisi as $file):
                                  $id = $file['kode_divisi'];
                                  $nama = $file['nama_divisi'];
                               ?>
                               <div class="form-check form-check-inline col-md-5">
                                          <input class="form-check-input checkNamaDivisi" for ="<?=$id?>" type="checkbox" id="<?=$nama?>"name="divisi" value="<?=$id?>">
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
                                          <input   class="form-check-input checkNamaJabatan" for ="<?=$id?>" type="checkbox" id="<?=$nama?>"name="jabatan" value="<?=$id?>">
                                          <label class="form-check-label" for ="<?=$id?>"><?=$nama?></label>
                              </div>
                                <?php endforeach;?>  
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


       
      }) 
    </script>