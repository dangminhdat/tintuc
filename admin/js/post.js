$_DOMAIN = 'http://datdangtin.byethost17.com/admin/';
// Xử lý 
$('#formBaiViet button').on('click',function(){
	$this = $('#formBaiViet button:first-child');
	$this.html("Đang tải...");

	$title_add_post = $('#formBaiViet #title-add-post').val();
	$slug_add_post = $('#formBaiViet #slug-add-post').val();

	if($title_add_post == '' || $slug_add_post == '')
	{
		$('#formBaiViet .alert').removeClass('hidden');
		$('#formBaiViet .alert').html("Error: Vui lòng điền đầy đủ thông tin");
		$this.html("Tạo");		
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'post.php',
			type : 'POST',
			data : {
				title_add_post : $title_add_post,
				slug_add_post : $slug_add_post,
				action : 'add_post'
			},success : function(data){
				$('#formBaiViet .alert').removeClass('hidden');
				$('#formBaiViet .alert').html(data);
				$this.html("Đang tải...");
			},error : function(){
				$('#formBaiViet .alert').removeClass('hidden');
				$('#formBaiViet .alert').html("Error: Đã xảy ra lỗi, hãy thử lại sau.");
				$this.html("Đang tải...");
			}
		});
	}
});

//Slug
function changeSlug(id){
	var title = $('.title').val();
	var slug = title.toLowerCase();

	slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

    $(id).val(slug);    
}
$('.slug').on('click',function(){
	changeSlug('#slug-add-post');
	changeSlug('#url-add-cate');
	changeSlug('#url-edit-cate');
	changeSlug('#slug_edit_post');
})

//Xóa toàn bộ bài viết
$('#del_list_post').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xoá các bài viết đã chọn không?");
	if($confirm == true)
	{
		$id_post = [];

		$("#list_post input[type='checkbox']:checkbox:checked").each(function(index){
			$id_post[index] = $(this).val();
		});

		if($id_post.length === 0)
		{
			alert("Error: Vui lòng chọn ít nhất một bài viết");
			return false;
		}
		else
		{
			$.ajax({
				url : $_DOMAIN + 'post.php',
				type : 'POST',
				data : {
					id_post : $id_post,
					action : 'del_list_post'
				},success : function(data){
					location.reload();
				},error : function(){
					alert("Error: Đã xảy ra lỗi, hãy thử lại sau");
				}
			})
		}
	}
	else
	{
		return false;
	}
});	

//Xóa chỉ định bài viết
$('.del_post').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xoá bài viết đã chọn không?");
	if($confirm == true)
	{
		$id_post = $(this).attr("data-id");	
		
		$.ajax({
			url : $_DOMAIN + 'post.php',
			type : 'POST',
			data : {
				id_post : $id_post,
				action : 'del_post'
			},success : function(data){
				location.reload();
			},error : function(){
				alert("Error: Đã xảy ra lỗi, hãy thử lại sau");
			}
		});	
	}
	else
	{
		return false;
	}
});

//Xóa chỉ định bài viết trong edit
$('#del_edit_post').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xoá bài viết đã chọn không?");
	if($confirm == true)
	{
		$id_post = $(this).attr("data-id");	
		
		$.ajax({
			url : $_DOMAIN + 'post.php',
			type : 'POST',
			data : {
				id_post : $id_post,
				action : 'del_edit_post'
			},success : function(data){
				location.href = $_DOMAIN + 'post';
			},error : function(){
				alert("Error: Đã xảy ra lỗi, hãy thử lại sau");
			}
		});	
	}
	else
	{
		return false;
	}
});

//Tìm kiếm
$('#formTimKiem button').on('click',function(){
	$search_post = $('#formTimKiem #search_post').val();

	if($search_post == '')
	{
		alert("Nhập nội dung tìm kiếm");
	}
	else
	{
		$.ajax({
			url : $_DOMAIN + 'post.php',
			type : 'POST',
			data : {
				search_post : $search_post,
				action : 'search_post'
			},success : function(data){
				$('#list_post').html(data);//in bảng kết quả
				$('#pagination').hide();
			}
		})
	}
})	

//Load chuyên mục 2 trong edit
$('#edit_cate_post_1').on('change',function(){
	$parent_id = $(this).val();

	$.ajax({
		url : $_DOMAIN + 'post.php',
		type : 'POST',
		data : {
			parent_id : $parent_id,
			action : 'load_cate_2'
		},success : function(data){
			$('#edit_cate_post_2').html(data);

			
		}
	})
});



//Edit bài viết
$('#formEditPost button').on('click',function(){
	$this = $('#formEditPost button:first-child');
	$this.html("Đang tải...");

	$id_edit_post = $('#formEditPost').attr("data-id");
	$title_edit_post = $('#title_edit_post').val();
	$slug_edit_post = $('#slug_edit_post').val();
	$url_edit_post = $('#url_edit_post').val();
	$mieu_ta_post = $('#mieu_ta_post').val();
	$tu_khoa_post = $('#tu_khoa_post').val();
	$edit_cate_post_1 = $('#edit_cate_post_1').val();
	$edit_cate_post_2 = $('#edit_cate_post_2').val();
	$edit_cate_post_3 = $('#edit_cate_post_3').val();
	$status_edit_post = $('#formEditPost input[name="status"]:radio:checked').val()
	$body_edit_post = CKEDITOR.instances['body_edit_post'].getData();

	if($title_edit_post == '' || $slug_edit_post == '' || $url_edit_post == '' || $mieu_ta_post == '' || $body_edit_post == '')
	{
		$('#formEditPost .alert').removeClass('hidden');
		$('#formEditPost .alert').html("Error: Vui lòng điền đầy đủ thông tin");
		$this.html("Lưu thay đổi");
	} 	
	else
	{
		$.ajax({
			url : $_DOMAIN + 'post.php',
			type : 'POST',
			data : {
				id_edit_post : $id_edit_post,
				title_edit_post : $title_edit_post,
				slug_edit_post : $slug_edit_post,
				url_edit_post : $url_edit_post,
				mieu_ta_post : $mieu_ta_post,
				tu_khoa_post : $tu_khoa_post,
				edit_cate_post_1 : $edit_cate_post_1,
				edit_cate_post_2 : $edit_cate_post_2,
				edit_cate_post_3 : $edit_cate_post_3,
				status_edit_post : $status_edit_post,
				body_edit_post : $body_edit_post,
				action : 'edit_post' 
			},success : function(data){
				$('#formEditPost .alert').removeClass('hidden');
				$('#formEditPost .alert').html(data);
				$this.html("Lưu thay đổi");
			},error : function(){
				$('#formEditPost .alert').removeClass('hidden');
				$('#formEditPost .alert').html("Error: Đã xảy ra lỗi, hãy thử lại sau.");
				$this.html("Lưu thay đổi");
			}
		})
	}
})