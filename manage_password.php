<?php 
include('db_connect.php');
session_start();
$utype = array('','admin','Sinh Viên','Giảng Viên', 'Doanh Nghiệp');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM nguoi_dung where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
    <div id="msgp"></div>
	<form action="" id="manage-password">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="password">Mật khẩu Cũ</label>
			<input type="password" name="oldPassword" id="oldPassword" class="form-control" value="" autocomplete="off" required requiredmsg="Vui lòng nhập đầy đủ thông tin">
		</div>
		<div class="form-group">
			<label for="password">Mật khẩu Mới</label>
			<input type="password" name="newPassword" id="newPassword" class="form-control" value="" autocomplete="off" required requiredmsg="Mật khẩu không hợp lệ" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,16}$" />
			 <small id="pass_check" data-check=''></small>
		</div>
		<div class="form-group">
			<label for="password">Xác Nhận Mật Khẩu Mới</label>
			<input type="password" name="cpass" id="cpass" class="form-control" value="" autocomplete="off" required requiredmsg="Vui lòng nhập đầy đủ thông tin">
            <small id="pass_match" data-status=''></small>
		</div>
        <div class="col-lg-12 text-right d-flex" style="justify-content: right;">
				<button class="btn btn-primary mr-2" style="width: 100px;" >Lưu</button>
				<button type="button" class="btn btn-secondary" style="width: 100px;" data-dismiss="modal">Hủy bỏ</button>
		</div>
	</form>
</div>
<script>
    $('[name="newPassword"],[name="cpass"]').keyup(function(){
        var pass = $('[name="newPassword"]').val()
        var cpass = $('[name="cpass"]').val()
        if(cpass == '' ||pass == ''){
            $('#pass_match').attr('data-status','')
        }else{
            if(cpass == pass){
                $('#pass_match').attr('data-status','1').html('<i class="text-success">Mật khẩu hợp lệ</i>')
            }else{
                $('#pass_match').attr('data-status','2').html('<i class="text-danger">Xác nhận mật khẩu không hợp lệ. Vui lòng nhập lại mật khẩu</i>')
            }
        }
    })
        $('[name="newPassword"],[name="oldPassword"]').keyup(function(){
        var pass = $('[name="newPassword"]').val()
        var oldpass = $('[name="oldPassword"]').val()
        if(oldPassword == '' ||pass == ''){
            $('#pass_check').attr('data-check','')
        }else{
            if(oldpass == pass){
                                $('#pass_check').attr('data-check','1').html('<i class="text-danger">Mật khẩu mới trùng với mật khẩu cũ. Vui lòng nhập lại mật khẩu</i>')
            }else{
                $('#pass_check').attr('data-check','2').html('<i class="text-danger"></i>')
                // $('#pass_match').attr('data-status','2').html('<i class="text-danger">Xác nhận mật khẩu không hợp lệ. Vui lòng nhập lại mật khẩu</i>')
            }
        }
    })
	
	$('#manage-password').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		//$('#msg').html('')
		if($('#pass_match').attr('data-status') != 1){
			if($("[name='newPassword']").val() !=''){
				$('[name="newPassword"],[name="cpass"]').addClass("border-danger")
				end_load()
				return false;
			}
		}
// 		if($('#pass_check').attr('data-check') != 1){
// 			if($("[name='oldPassword']").val() !=''){
// 				$('[name="oldPassword"],[name="newPassword"]').addClass("border-danger")
// 				end_load()
// 				return false;
// 			}
// 		}
		$.ajax({
			url:'ajax.php?action=update_password',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Thay đổi mật khẩu thành công",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else if(resp ==2) {
					$('#msgp').html('<div class="alert alert-danger">Mật khẩu cũ không đúng. Vui lòng nhập lại mật khẩu</div>')
					end_load()
				}
			}
		})
	})
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var elements = $("input, select");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                 e.target.setCustomValidity(e.target.getAttribute("requiredmsg"));
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
</script>