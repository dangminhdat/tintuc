$_DOMAIN = 'http://datdangtin.byethost17.com/admin/';

// Trạng thái web
$('#formCaiDat button').on('click',function(){
	$status_web = $('#formCaiDat input[name="status"]:radio:checked').val();

	$.ajax({
		url : $_DOMAIN + 'setting.php',
		type : 'POST',
		data : {
			status_web : $status_web,
			action : 'status_web'
		},success : function(data){
			$('#formCaiDat .alert').attr('class','alert alert-success');
			$('#formCaiDat .alert').html('Thay đổi thành công');
			location.reload();
		},error : function(){
			$('#formCaiDat .alert').removeClass('hidden');
			$('#formCaiDat .alert').html('Error: Đã có lỗi xảy ra, hãy thử lại sau.');
		}
	});
});

// Chỉnh sửa web
$('#formThongTin button').on('click',function(){
	$title = $('#formThongTin #title_web').val();
	$decrip = $('#formThongTin #decrip_web').val();
	$keywords = $('#formThongTin #keywords_web').val();

	$.ajax({
		url : $_DOMAIN + 'setting.php',
		type : 'POST',
		data : {
			title : $title,
			decrip : $decrip,
			keywords : $keywords,
			action : 'edit_web'
		},success : function(data){
			$('#formThongTin .alert').attr('class','alert alert-success');
			$('#formThongTin .alert').html('Thay đổi thành công');
			location.reload();
		},error : function(){
			$('#formThongTin .alert').removeClass('hidden');
			$('#formThongTin .alert').html('Error: Đã có lỗi xảy ra, hãy thử lại sau.');
		}
	})
})