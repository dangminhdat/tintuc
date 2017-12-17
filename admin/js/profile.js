$_DOMAIN = 'http://datdangtin.byethost17.com/admin/';

function pre_avatar() {
	avatar_img = $('#avatar_img').val();
	$('#formUploadAvatar .box_pre_img').removeClass("hidden");
	$('#formUploadAvatar .box_pre_img').html('<p><label>Ảnh xem trước</label></p>');

	if(avatar_img != '')
	{
		$('#formUploadAvatar .box_pre_img').append('<img src="' + URL.createObjectURL(event.target.files[0]) + '" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom: 5px;"/>');
	}
	else
	{
		$('#formUploadAvatar .box_pre_img').addClass("hidden");
		$('#formUploadAvatar .box_pre_img').html('');
	}
}
$('#formUploadAvatar').submit(function(e){
	$this = $('#formUploadAvatar button[type="submit"]');
	$this.html("Đang tải...");

	avatar_img = $('#avatar_img').val();

	if(avatar_img != '')
	{	
		e.preventDefault();

		size_avatar = $('#avatar_img')[0].files[0].size;
		type_avatar = $('#avatar_img')[0].files[0].type;

		if(size_avatar > 5242880)	
		{
			$('#formUploadAvatar .alert').removeClass('hidden');
			$('#formUploadAvatar .alert').html('Tệp đã chọn có dung lượng lớn hơn mức cho phép');
			$this.html('Upload');
		}
		else if(type_avatar != 'image/jpeg' && type_avatar != 'image/png' && type_avatar != 'image/gif')
		{
			$('#formUploadAvatar .alert').removeClass('hidden');
			$('#formUploadAvatar .alert').html('File ảnh không đúng định dạng cho phép.');
			$this.html('Upload');
		}
		else
		{
			$(this).ajaxSubmit({
				beforeSubmit : function(){
					$('#formUploadAvatar .box_progress').removeClass('hidden');
					$('#formUploadAvatar .progress-bar').width('0%');
				},
				uploadProgress : function (event, position, total, percentComplete){ 
	                $("#formUploadAvatar .progress-bar").animate({width: percentComplete + '%'});
	         	    $("#formUploadAvatar .progress-bar").html(percentComplete + '%');
	            },
	            success : function(data){
	            	$('#formUploadAvatar .alert:eq(1)').attr('class','alert alert-success');
	            	$('#formUploadAvatar .alert:eq(1)').html(data);
	            	$this.html('Upload');
	            },
	            error : function(){
	            	$('#formUploadAvatar .alert').removeClass('hidden');
	            	$('#formUploadAvatar .alert').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.')
	            	$this.html('Upload');
	            },
	            resetForm : true
			});
			return false;
		}
	}
	else
	{
		$('#formUploadAvatar .alert').removeClass('hidden');
		$('#formUploadAvatar .alert').html('Vui lòng chọn tệp hình ảnh.');
		$this.html('Upload');
	}	
});

$('#del_avatar').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xoá ảnh đại diện này không?");
	if($confirm == true)
	{	
		$.ajax({
			url : $_DOMAIN + 'profile.php',
			type : 'POST',
			data : {
				action : 'del_avatar'
			},
			success : function(data){
				location.href = $_DOMAIN + 'profile';
			},error : function(data){
				alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
			}
		});
	}
	else
	{
		return false;
	}
})

$('#formUser button').on('click',function(){
	$this = $('#formUser button:first-child');
	$this.html('Đang tải...');

	$name_display = $('#name_display').val();
	$email_display = $('#email_display').val();
	$facebook = $('#facebook').val();
	$google = $('#google').val();
	$twitter = $('#twitter').val();
	$phone = $('#phone').val();
	$mieu_ta = $('#introduce').val();

	if($name_display == '' || $email_display == '')
	{
		$("#formUser .alert").removeClass('hidden');
		$('#formUser .alert').html("Vui lòng nhập đầy đủ thông tin");
		$this.html("Lưu thay đổi");
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'profile.php',
			type : 'POST',
			data : {
				name_display : $name_display,
				email_display : $email_display,
				facebook : $facebook,
				google : $google,
				twitter : $twitter,
				phone : $phone,
				mieu_ta : $mieu_ta,
				action : 'update_user'
			},success : function(data){
				$('#formUser .alert').removeClass('hidden');
				$("#formUser .alert").html(data);
				$this.html("Lưu thay đổi");
			},error : function(){
				$('#formUser .alert').removeClass('hidden');
				$("#formUser .alert").html('Đã xảy ra lỗi, hãy thử lại sau');
				$this.html("Lưu thay đổi");
			}	
		})
	}
})

$('#formPass button').on('click',function(){
	$this = $('#formPass button:first-child');
	$this.html("Đang tải...");

	$pass_old = $('#pass_old').val();
	$pass_new = $('#pass_new').val();
	$re_pass_new = $('#re_pass_new').val();

	if($pass_old == '' || $pass_new == '' || $re_pass_new == '')
	{
		$('#formPass .alert').removeClass('hidden');
		$('#formPass .alert').html("Vui lòng điền đầy đủ thông tin");
		$this.html("Lưu thay đổi");
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'profile.php',
			type : "POST",
			data : {
				pass_old : $pass_old,
				pass_new : $pass_new,
				re_pass_new : $re_pass_new,
				action : 'change_pass'
			},success : function(data){
				$('#formPass .alert').removeClass('hidden');
				$('#formPass .alert').html(data);
				$this.html("Lưu thay đổi");
			},error : function(){
				$('#formPass .alert').removeClass('hidden');
				$('#formPass .alert').html('Đã xảy ra lỗi, hãy thử lại sau');
				$this.html("Lưu thay đổi");
			}
		});
	}
})