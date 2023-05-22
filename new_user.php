<?php
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_user">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Tên</label>
							<input type="text" name="ten" class="form-control form-control-sm" required requiredmsg="Vui lòng nhập đầy đủ thông tin" value="<?php echo isset($ten) ? $ten: '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Số điện thoại</label>
							<input type="text" name="soDT" class="form-control form-control-sm" required requiredmsg="Số điện thoại không hợp lệ" value="<?php echo isset($so_dt) ? '0'.$so_dt : '' ?>" pattern="[0][0-9]{9}" ">
								<small id="nbp"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required requiredmsg="Vui lòng nhập đầy đủ thông tin" value="<?php echo isset($email) ? $email : '' ?>">
							<small id="msg"></small>
						</div>
						<div class="form-group">
                            <label for="" class="control-label">Giới tính</label>
                            <select type="type" name="gioiTinh" class="custom-select custom-select-sm">
                                <option value="1" <?php echo isset($gioi_tinh) && $gioi_tinh == 1 ? 'selected' : '' ?>>Nam</option>
                                <option value="0" <?php echo isset($gioi_tinh) && $gioi_tinh == 0 ? 'selected' : '' ?>>Nữ</option>
                            </select>
                		 </div>	
						 <?php if($_SESSION['login_chuc_vu'] == 1): ?>
						<div class="form-group">
							<label for="" class="control-label">Loại tài khoản</label>
							<select name="chuc_vu" id="chuc_vu" class="custom-select custom-select-sm" onchange="showHideCode()">
								<option value="1" <?php echo isset($chuc_vu) && $chuc_vu == 1 ? 'selected' : '' ?>>Admin</option>
								<option value="2" <?php echo isset($chuc_vu) && $chuc_vu == 2 ? 'selected' : '' ?>>Giảng viên</option>
								<option value="3" <?php echo isset($chuc_vu) && $chuc_vu == 3 ? 'selected' : '' ?>>Sinh viên</option>
								<option value="4" <?php echo isset($chuc_vu) && $chuc_vu == 4 ? 'selected' : '' ?>>Doanh nghiệp</option>
                                <option value="5" <?php echo isset($chuc_vu) && $chuc_vu == 5 ? 'selected' : '' ?>>Cựu sinh viên</option>
							</select>
						</div>
						<div id="khoa">
                            <div class="form-group">
                                <label for="" class="control-label">Khoa</label>
                                <input type="text" name="khoa" class="form-control form-control-sm"  value="<?php echo isset($khoa) ? $khoa : '' ?>">
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
						<?php else: ?>
							<input type="hidden" name="chu_vu" value="3">
						<?php endif; ?>
						<div id="load">
    					    <div class="form-group">
    						    <label for="" class="control-label">Lớp</label>
    						    <input type="text" name="lop" class="form-control form-control-sm" value="<?php echo isset($lop) ? $lop : '' ?>">
    					    </div>
                            <div class="form-group">
                                <label for="" class="control-label">Năm học</label>
                                <input type="text" name="nam" class="form-control form-control-sm"  value="<?php echo isset($nam) ? $nam : '' ?>">
                            </div>
                        </div>
						<div class="form-group">
							<label class="control-label">Địa chỉ</label>
							<textarea name="diaChi" id="" cols="30" rows="4" class="form-control" required requiredmsg="Vui lòng nhập đầy đủ thông tin"><?php echo isset($dia_chi) ? $dia_chi : '' ?></textarea>
						</div>
						<div class="form-group" style="margin-bottom: 0px;>
							<label class="control-label">Mật khẩu</label>
							<input type="password" class="form-control form-control-sm" name="password" 
							requiredmsg="Mật khẩu không hợp lệ" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,16}$">
							<small><i><?php echo isset($id) ? "Để trống nếu bạn không muốn đổi mật khẩu":'' ?></i></small>
							<i class="text-succes" style="font-size: 12px; color: #28a745">Mật khẩu phải từ 8->16 kí tự,1 kí tự hoa,không chứa dấu cách</i>
						</div>
						<div class="form-group">
							<label class="label control-label">Xác nhận mật khẩu</label>
							<input type="password" class="form-control form-control-sm" name="cpass" 
							<?php echo isset($id) ? '' : 'required requiredmsg="Vui lòng nhập đầy đủ thông tin"' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2 check">Lưu</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Thoát</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
</style>
<script>
    const luu = document.querySelector(".check");
    const span = document.querySelector(".text-succes");
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success ">Mật khẩu hợp lệ</i>')
			} else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Mật khẩu xác nhận không đúng</i>')
			} 
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_user').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if ($("[name='cpass']").val() !='' && $("[name='password']").val() =='') {
		    $('[name="password"],[name="cpass"]').addClass("border-danger")
		    $('#pass_match').attr('data-status','2').html('<i class="text-danger">Mật khẩu xác nhận không đúng</i>')
		    end_load();
		    return false;
		}
		if($('#pass_match').attr('data-status') != 1){
			if($("[name='password']").val() !=''){
				$('[name="password"],[name="cpass"]').addClass("border-danger")
				end_load()
				return false;
			}
		}
		$.ajax({
			url:'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
                if(resp == 0 ){
					alert_toast('Sửa người dùng thành công',"success");
					span.style.color = "#28a745";
					setTimeout(function(){
						location.replace('index.php?page=user_list')
					},750)
				}
				if(resp == 3){
					alert_toast('Mật khẩu không hợp lệ',"warning");
					span.style.color = "red";
					end_load();
				}
				if(resp == 1){
					alert_toast('Thêm người dùng thành công',"success");
					span.style.color = "#28a745";
					setTimeout(function(){
						location.replace('index.php?page=user_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email đã tồn tại</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}else if(resp == 4){
					$('#nbp').html("<div class='alert alert-danger'>Số điện thoại không hợp lệ</div>");
					$('[name="soDT"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?~]/;
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

function showHideCode() {
    var select = document.getElementById("chuc_vu");
    var khoa = document.getElementById("khoa");
    var load = document.getElementById("load");
    var req = load.getElementsByTagName("input");
    var req_k = khoa.getElementsByTagName("input");
    console.log(req);
    if (select.value != "4") {
        load.style.display = "block";
        khoa.style.display = "block";
        req_k[0].removeAtrribute('require', '');
        for (var i = 0; i < req.length; i++) {
            req[i].setAttribute('required', '');
        }
    }
     else {
        load.style.display = "none";
        khoa.style.display = "none";
        req_k[0].removeAtrribute('require', '');
        for (var i = 0; i < req.length; i++) {
            req[i].removeAttribute('required');
        }
    }
}
showHideCode()
</script>