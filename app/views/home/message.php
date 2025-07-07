<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- <input type="hidden" name="id_user" id="id_user" value="<?=$rows['id_user']?>">
        <input type="hidden" name="username" id="username" value="<?=$rows['nama']?>"> -->

        <textarea type="text" class="form-control" name="com_mesage" id="com_mesage"></textarea>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" id="kirim">Kirim</button>
        <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        
    $("#kirim").on("click",function(e){ 
     
     e.preventDefault();
     let kirim = $("#com_mesage").val();
     let user = $("#username").val();
     let id_user = $("#id_user").val();
     $.ajax({
         url:"<?=base_url ?>/home/simpancomment",
         type:'POST',
         dataType :'json',
         data :{user:user,kirim:kirim,user_id:id_user},
         success:function(result){
              window.location.href="<?=base_url?>/home/index"
         }
     });
 });
// and kirim
    })
</script>