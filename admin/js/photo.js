// Xem ảnh trước
function pre_img(){
	// value file ảnh
	img_up = $("#img_up").val();
	// Tổng số ảnh
	count_img_up = $('#img_up').get(0).files.length;

	$('#formUpload .box_pre_img').html('<label>Ảnh xem trước</label><br>');
	$('#formUpload .box_pre_img').removeClass('hidden');

	if(img_up != '')
	{
		for (var i = 0; i <= count_img_up - 1; i++) {
			$('#formUpload .box_pre_img').append('<img src="'+ URL.createObjectURL(event.target.files[i]) +'" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom: 5px;">');
		}
	}
	else
	{
		$('#formUpload .box_pre_img').addClass('hidden');
		$('#formUpload .box_pre_img').html('');
	}
}

//Reset
$('#formUpload button[type="reset"]').on('click',function(){
	$('#formUpload .box_pre_img').html('');
	$('#formUpload .box_pre_img').addClass('hidden');
	$('#formUpload .box_progress').addClass('hidden');
	$('#formUpload .alert').addClass('hidden');
})

$('#formUpload').submit(function(e){
	$this = $('#formUpload button:first-child');
	$this.html("Đang tải...");

	type_error = 0;	// số lỗi loại ảnh
	size_error = 0;	// số lỗi size ảnh

	img_up = $('#img_up').val();
	count_img_up = $('#img_up').get(0).files.length;

	if(!img_up)
	{
		$('#formUpload .alert').removeClass('hidden');
		$('#formUpload .alert').html("Error: Vui lòng chọn tệp hình ảnh.");
		$this.html('Upload');
	}
	else
	{
		e.preventDefault();

		for (var i = 0; i <= count_img_up - 1; i++) {
			size_img = $('#img_up').get(0).files[i].size;
			if(size_img > 5242880) //5MB
			{
				size_error += 1;
			}
			else
			{
				size_error += 0;
			}	
		}
		for (var i = 0; i <= count_img_up - 1; i++) {
			type_img = $('#img_up').get(0).files[i].type;
			if(type_img == 'image/gif' || type_img == 'image/jpeg' || type_img == 'image/png') //5MB
			{
				type_error += 0;
			}
			else
			{
				type_error += 1;
			}	
		}

		if(size_error >= 1)
		{
			$('#formUpload .alert').removeClass('hidden');
			$('#formUpload .alert').html('Error: Một trong các tệp đã chọn có dung lượng lớn hơn mức cho phép.');
			$this.html('Upload');
		}
		else if(type_error >= 1)
		{
			$('#formUpload .alert').removeClass('hidden');
			$('#formUpload .alert').html('Error: Một trong những file ảnh không đúng định dạng cho phép.');
			$this.html('Upload');
		}
		else if(count_img_up > 20)
		{
			$('#formUpload .alert').removeClass('hidden');
			$('#formUpload .alert').html('Error: Số file upload cho mỗi lần vượt quá mức cho phép.');
			$this.html('Upload');
		}
		else
		{
			$(this).ajaxSubmit({
				beforeSubmit : function(){
					target : '#formUpload .alert',
					$('#formUpload .box_progress').removeClass('hidden');
					$('#formUpload .progress-bar').width('0%');
				},
				uploadProgress : function (event, position, total, percentComplete){ 
                    $("#formUpload .progress-bar").animate({width: percentComplete + '%'});
                    $("#formUpload .progress-bar").html(percentComplete + '%');
                },
                success : function(data){
                	$('#formUpload .alert').attr('class','alert alert-success');
                	$('#formUpload .alert').html(data);
                	$this.html("Upload");
                },
                error : function(){
                	$('#formUpload .alert').removeClass('hidden');
                	$('#formUpload .alert').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.');
                	$this.html("Upload");
                },
                resetForm : true 
			});
			return false;
		}

	}	
})

$('#del_list_img').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xoá hình ảnh này không?");
	if($confirm == true)
	{
		$id_img = [];

		$('#list_img input[type="checkbox"]:checkbox:checked').each(function(index){
			$id_img[index] = $(this).val();
		});

		if($id_img.length === 0)
		{
			alert('Vui lòng chọn ít nhất một hình ảnh.');
			return false;
		}
		else
		{
			$.ajax({
				url : $_DOMAIN + 'photo.php',
				type : 'POST',
				data : {
					id_img : $id_img,
					action : 'del_list_img'
				},success : function(data){
					alert(data)
					location.reload();
				},error : function(){
					alert("Error: Đã xảy ra lỗi, hãy thử lại sau");
				}
			});
		}
	}
	else
	{
		return false;
	}
});

$('.del_img').on('click',function(){
	$confirm = confirm("Bạn có chắc chắn muốn xoá hình ảnh này không?");
	if($confirm == true)
	{
		$id_img = $(this).attr("data-id");
		$.ajax({
				url : $_DOMAIN + 'photo.php',
				type : 'POST',
				data : {
					id_img : $id_img,
					action : 'del_img'
				},success : function(data){
					alert(data)
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