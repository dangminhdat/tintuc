$_DOMAIN = 'http://datdangtin.byethost17.com/admin/';

//Slug
// function changeSlug(){
// 	var title = $('.title').val();
// 	var slug = title.toLowerCase();

// 	slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
//     slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
//     slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
//     slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
//     slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
//     slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
//     slug = slug.replace(/đ/gi, 'd');
//     slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
//     slug = slug.replace(/ /gi, "-");
//     slug = slug.replace(/\-\-\-\-\-/gi, '-');
//     slug = slug.replace(/\-\-\-\-/gi, '-');
//     slug = slug.replace(/\-\-\-/gi, '-');
//     slug = slug.replace(/\-\-/gi, '-');
//     slug = '@' + slug + '@';
//     slug = slug.replace(/\@\-|\-\@|\@/gi, '');

//     $(id).val(slug);    
// }
// $('.slug').on('click',function(){
// 	changeSlug('#url-add-cate');
// 	changeSlug('#url-edit-cate');
// })

// Load chuyên mục
$('#formChuyenMuc input[type="radio"]').on('click',function(){
	if($('#formChuyenMuc .type-add-cate-1:checked').prop('checked') == true )
	{
		$('#formChuyenMuc .parent-add-cate').addClass('hidden');
		$('#formChuyenMuc .parent-add-cate select').html('');
	}
	else if($('#formChuyenMuc .type-add-cate-2:checked').prop('checked') == true)
	{
		$type_add_cate = $('#formChuyenMuc .type-add-cate-2').val();
		$.ajax({
			url : $_DOMAIN + 'catogories.php',
			type : 'POST',
			data : {
				type_add_cate : $type_add_cate,
				action : 'load_parent_add_cate' 
			},success : function(data){
				$('#formChuyenMuc .parent-add-cate').removeClass('hidden');
				$('#formChuyenMuc .parent-add-cate select').html(data);
			},error : function(){
				$('#formChuyenMuc .parent-add-cate').removeClass('hidden');
				$('#formChuyenMuc .parent-add-cate select').html("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
			}
		})
	}
	else if($('#formChuyenMuc .type-add-cate-3:checked').prop('checked') == true)
	{
		$('#formChuyenMuc .parent-add-cate').addClass('hidden');
		$('#formChuyenMuc .parent-add-cate select').html('');
	}	
});

// Thêm chuyên mục
$('#formChuyenMuc button').on('click',function(){
	$this = $('#formChuyenMuc button:first-child');
	$this.html('Đang tải...');

	$label_add_cate = $('#formChuyenMuc #label-add-cate').val();
	$url_add_cate = $('#formChuyenMuc #url-add-cate').val();
	$type_add_cate = $('#formChuyenMuc input[name="type-add-cate"]:radio:checked').val();
	$parent_add_cate = $('#formChuyenMuc #parent-add-cate').val();
	$sort_add_cate = $('#formChuyenMuc #sort-add-cate').val();

	if($label_add_cate == '' || $url_add_cate == '' || $type_add_cate == '' || $sort_add_cate == '')
	{
		$('#formChuyenMuc .alert').removeClass('hidden');
		$('#formChuyenMuc .alert').html('Error: Vui lòng điền đầy đủ thông tin');
		$this.html('Tạo');
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'catogories.php',
			type : 'POST',
			data : {
				label_add_cate : $label_add_cate,
				url_add_cate : $url_add_cate,
				type_add_cate : $type_add_cate,
				sort_add_cate : $sort_add_cate,
				parent_add_cate : $parent_add_cate,
				action : 'add_cate'
			},success : function(data){
				$('#formChuyenMuc .alert').removeClass('hidden');
				$('#formChuyenMuc .alert').html(data);
				$this.html('Tạo');
			},error : function(){
				$('#formChuyenMuc .alert').removeClass('hidden');
				$('#formChuyenMuc .alert').html("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
				$this.html('Tạo');
			}
		})
	}	

});

//Load edit chuyên mục
$('#formSuaChuyenMuc input[type="radio"]').on('click',function(){
	$id_edit_cate = $('#formSuaChuyenMuc').attr('data-id');
	if($('#formSuaChuyenMuc .type-edit-cate-1').prop('checked') == true)
	{
		$('#formSuaChuyenMuc .parent-edit-cate').addClass('hidden');
		$('#formSuaChuyenMuc .parent-edit-cate select').html('');
	}
	else if($('#formSuaChuyenMuc .type-edit-cate-2').prop('checked') == true)
	{
		$type_edit_cate = $('#formSuaChuyenMuc .type-edit-cate-2').val();
		$.ajax({
			url : $_DOMAIN + 'catogories.php',
			type : 'POST',
			data : {
				type_edit_cate : $type_edit_cate,
				id_edit_cate : $id_edit_cate,
				action : 'load_parent_edit_cate'
			},success : function(data){
				$('#formSuaChuyenMuc .parent-edit-cate').removeClass('hidden');
				$('#formSuaChuyenMuc .parent-edit-cate select').html(data);
			},error : function(){
				$('#formSuaChuyenMuc .parent-edit-cate').removeClass('hidden');
				$('#formSuaChuyenMuc .parent-edit-cate select').html('Error: Đã có lỗi xảy ra, hãy thử lại sau.');
			}
		});
	}
	else if($('#formSuaChuyenMuc .type-edit-cate-3').prop('checked') == true)
	{
		$('#formSuaChuyenMuc .parent-edit-cate').addClass('hidden');
		$('#formSuaChuyenMuc .parent-edit-cate select').html('');
	}	
});

//Update chuyên mục
$('#formSuaChuyenMuc button').on('click',function(){
	$this = $('#formSuaChuyenMuc button');
	$this.html('Đang tải...');

	$label_edit_cate = $('#formSuaChuyenMuc #label-edit-cate').val();
	$url_edit_cate = $('#formSuaChuyenMuc #url-edit-cate').val();
	$type_edit_cate = $('#formSuaChuyenMuc input[name="type-edit-cate"]:radio:checked').val();
	$parent_edit_cate = $('#formSuaChuyenMuc #parent-edit-cate').val();
	$sort_edit_cate = $('#formSuaChuyenMuc #sort-edit-cate').val();
	$id_edit_cate = $('#formSuaChuyenMuc').attr('data-id');

	if($label_edit_cate == '' || $url_edit_cate == '' || $type_edit_cate == '' || $sort_edit_cate == '')
	{
		$('#formSuaChuyenMuc .alert').removeClass('hidden');
		$('#formSuaChuyenMuc .alert').html('Error: Vui lòng điền đầy đủ thông tin');
		$this.html('Lưu thay đổi');
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'catogories.php',
			type : "POST",
			data : {
				label_edit_cate : $label_edit_cate,
				url_edit_cate : $url_edit_cate,
				type_edit_cate : $type_edit_cate,
				parent_edit_cate : $parent_edit_cate, 
				sort_edit_cate : $sort_edit_cate,
				id_edit_cate : $id_edit_cate,
				action : 'edit_cate'
			},success : function(data){
				$('#formSuaChuyenMuc .alert').removeClass('hidden');
				$('#formSuaChuyenMuc .alert').html(data);
				$this.html('Lưu thay đổi');
			},error : function(){
				$('#formSuaChuyenMuc .alert').removeClass('hidden');
				$('#formSuaChuyenMuc .alert').html('Error: Đã có lỗi xảy ra, hãy thử lại sau.');
				$this.html('Lưu thay đổi');
			}	
		});
	}	
});

//Xóa nhiều chuyên muc
$('.list input[type="checkbox"]:eq(0)').change(function(){
	$('.list input[type="checkbox"]').prop("checked",$(this).prop("checked"));
});
//Xóa nhiều
$('#del_list_cate').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xoá các chuyên mục đã chọn không?");
	if($confirm == true)
	{
		$id_cate = [];

		$('#list_cate input[type="checkbox"]:checkbox:checked').each(function(index){
			$id_cate[index] = $(this).val();
		})

		if($id_cate.length === 0)
		{
			alert("Vui lòng chọn ít nhất một chuyên mục.");
			return false;
		}
		else
		{
			$.ajax({
				url : $_DOMAIN + 'catogories.php',
				type : 'POST',
				data : {
					id_cate : $id_cate,
					action : 'del_list_cate'
				},success : function(data){
					location.reload();
				},error : function(){
					alert('Error: Đã có lỗi xảy ra, hãy thử lại sau.');
				}
			});
		}	
	}
	else
	{
		return false;
	}	
});

//Xóa chỉ định chuyên mục
$('.del_cate').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xoá các chuyên mục đã chọn không?');
	if($confirm == true)
	{
		$id_cate = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'catogories.php',
			type : 'POST',
			data : {
				id_cate : $id_cate,
				action : 'del_cate'
			},success : function(data){
				location.reload()
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

//Xóa chỉ định chuyên mục ở edit
$('#del_cate').on('click',function(){
	$confirm = confirm('Bạn có chắc chắn muốn xoá các chuyên mục đã chọn không?');
	if($confirm == true)
	{
		$id_cate = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'catogories.php',
			type : "POST",
			data : {
				id_cate : $id_cate,
				action : 'del_cate'
			},success : function(data){
				location.href = $_DOMAIN + 'catogories';
			},error : function(){
				alert("Error: Đã có lỗi xảy ra, hãy thử lại sau.");
			}
		})
	}
	else
	{
		return false;
	}	
});