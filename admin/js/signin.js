$_DOMAIN = 'http://datdangtin.byethost17.com/admin/';

// Đăng nhập
$('#formDangNhap #signin_submit').on('click',function(){
	$this = $('#formDangNhap #signin_submit:first-child');
	$this.html('Đang tải...');

	// Lấy giá trị
	$username = $('#formDangNhap #username').val();
	$password = $('#formDangNhap #password').val();

	// Nếu giá trị rỗng
	if($username == '' || $password == '')
	{
		$('#formDangNhap .alert').removeClass('hidden');
		$('#formDangNhap .alert').html('Error: Vui lòng điền đầy đủ thông tin');
		$this.html("Đăng nhập");
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'signin.php',
			type : 'POST',
			data : {
				username : $username,
				password : $password
			},success : function(data) {
				$('#formDangNhap .alert').removeClass('hidden');
				$('#formDangNhap .alert').html(data);
				$this.html("Đăng nhập");
			},error : function(){
				$('#formDangNhap .alert').removeClass('hidden');
				$('#formDangNhap .alert').html("Error: Không thể đăng nhập vào lúc này, hãy thử lại sau.");
				$this.html('Đăng nhập');
			}
		});
	}	
});