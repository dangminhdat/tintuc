$_DOMAIN = 'http://datdangtin.byethost17.com/admin/';

// Thêm tài khoản
$('#formTaiKhoan button').on('click',function(){
	$this = $('#formTaiKhoan button');
	$this.html("Đang tải...");

	$user_add_acc = $('#formTaiKhoan #user-add-acc').val();
	$pass_add_acc = $('#formTaiKhoan #pass-add-acc').val();
	$re_pass_add_acc = $('#formTaiKhoan #re-pass-add-acc').val();

	if($user_add_acc == '' || $pass_add_acc == '' || $re_pass_add_acc == '')
	{
		$('#formTaiKhoan .alert').removeClass('hidden');
		$('#formTaiKhoan .alert').html('Error: Vui lòng điền đầy đủ thông tin');
		$this.html("Thêm");
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'account.php',
			type : 'POST',
			data : {
				user_add_acc : $user_add_acc,
				pass_add_acc : $pass_add_acc,
				re_pass_add_acc : $re_pass_add_acc,
				action : 'add_acc'
			},success : function(data){
				$('#formTaiKhoan .alert').removeClass('hidden');
				$('#formTaiKhoan .alert').html(data);
				$this.html("Thêm");
			},error : function(){
				$('#formTaiKhoan .alert').removeClass('hidden');
				$('#formTaiKhoan .alert').html('Error: Đã có lỗi xảy ra, hãy thử lại sau.');
				$this.html("Thêm");
			}
		});
	}	
});

// Khóa nhiều tài khoản
$('#lock_list_acc').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn khóa các tài khoản đã chọn không?");
	if($confirm == true)
	{
		$id_acc = [];

		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(index){
			$id_acc[index] = $(this).val();
		});
	
		if($id_acc.length === 0)
		{
			alert("Vui lòng chọn ít nhất một tài khoản.")
			return false;
		}
		else
		{
			$.ajax({
				url : $_DOMAIN + 'account.php',
				type : "POST",
				data : {
					id_acc : $id_acc,
					action : 'lock_list_acc'
				},success : function(data){
					location.reload();
				},error : function(){
					alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
				}	
			});
		}
	}
	else
	{
		return false;
	}
});

// Mở khóa nhiều tài khoản
$('#unlock_list_acc').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn mở khóa các tài khoản đã chọn không?");
	if($confirm == true)
	{
		$id_acc = [];

		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(index){
			$id_acc[index] = $(this).val();
		})
	
		if($id_acc.length === 0)
		{
			alert("Vui lòng chọn ít nhất một tài khoản.")
			return false;
		}
		else
		{
			$.ajax({
				url : $_DOMAIN + 'account.php',
				type : "POST",
				data : {
					id_acc : $id_acc,
					action : 'unlock_list_acc'
				},success : function(data){
					location.reload();
				},error : function(){
					alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
				}	
			});
		}
	}
	else
	{
		return false;
	}
});

// Xóa nhiều tài khoản
$('#del_list_acc').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xóa các tài khoản đã chọn không?");
	if($confirm == true)
	{
		$id_acc = [];

		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(index){
			$id_acc[index] = $(this).val();
		})
	
		if($id_acc.length === 0)
		{
			alert("Vui lòng chọn ít nhất một tài khoản.")
			return false;
		}
		else
		{
			$.ajax({
				url : $_DOMAIN + 'account.php',
				type : "POST",
				data : {
					id_acc : $id_acc,
					action : 'del_list_acc'
				},success : function(data){
					location.reload();
				},error : function(){
					alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
				}	
			});
		}
	}
	else
	{
		return false;
	}
});

// Khóa tài khoản chỉ định
$('.lock_acc').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn khóa tài khoản đã chọn không?")
	if($confirm == true)
	{
		$id_acc = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'account.php',
			type : 'POST',
			data : {
				id_acc : $id_acc,
				action : 'lock_acc'
			},success : function(data){
				location.reload();
			},error : function(){
				alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
			}
		});
	}
	else
	{
		return false;
	}
});

// Mở khóa tài khoản chỉ định
$('.unlock_acc').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn mở khóa tài khoản đã chọn không?")
	if($confirm == true)
	{
		$id_acc = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'account.php',
			type : 'POST',
			data : {
				id_acc : $id_acc,
				action : 'unlock_acc'
			},success : function(data){
				location.reload();
			},error : function(){
				alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
			}
		});
	}
	else
	{
		return false;
	}
});

// Xóa tài khoản chỉ định
$('.del_acc').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xóa tài khoản đã chọn không?")
	if($confirm == true)
	{
		$id_acc = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'account.php',
			type : 'POST',
			data : {
				id_acc : $id_acc,
				action : 'del_acc'
			},success : function(data){
				location.reload();
			},error : function(){
				alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
			}
		});
	}
	else
	{
		return false;
	}
});