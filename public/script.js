 $(function(){
 	
 	$('.dropdown').hover(function(){
 		$(this).find('.dropdown-menu').slideDown(3);
 	},function(){
 		$(this).find('.dropdown-menu').slideUp(1);
 	})

 	$('.noidung1 > a > img').hover(function(){
 		$(this).animate({padding: '2px'})
 	},function(){
 		$(this).animate({padding: '0'})
 	})

 	$('.scroll').on('click',function(){
           $('html,body').animate({scrollTop: 0}, 500);
 	});
 	
 	$('.fa.fa-close.float-xs-right').on('click',function(){
 		$('.messenger').hide(1000);
 		$('.nut-messenger').show(500);
                $('.scroll').show(500);
 	});
 	$('.nut-messenger').on('click',function(){
 		$('.messenger').show(1000);
 		$('.nut-messenger').hide();
                $('.scroll').hide();
 	});

 	$(window).scroll(function(){
 		if($(this).scrollTop() > 165)
 		{
 			$('.menu2').addClass("navbar-fixed-top");
 		}
 		else
 		{
 			$('.menu2').removeClass("navbar-fixed-top");
 		}
 	})

 	$('#AddComment button').on('click',function(){
		$this = $('#AddComment button');
		$this.html("Đang gửi");
		$('#AddComment .alert').addClass('hidden-xs-up');

		$noidung = $('#AddComment #nd_cmt').val();
		$name = $('#AddComment #name_cmt').val();
		$email = $('#AddComment #mail_cmt').val();
		$id_post =$('#AddComment').attr('data-id');

		if($noidung == '')
		{
			$('#AddComment .alert:eq(0)').removeClass('hidden-xs-up');
			$('#AddComment .alert:eq(0)').html('Nhập nội dung bình luận');
			$this.html("Gửi");
		}
		if($name == '')
		{
			$('#AddComment .alert:eq(1)').removeClass('hidden-xs-up');
			$('#AddComment .alert:eq(1)').html('Bắt buộc: Nhập tên');
			$this.html("Gửi");
		}
		if($email == '')
		{
			$('#AddComment .alert:eq(2)').removeClass('hidden-xs-up');
			$('#AddComment .alert:eq(2)').html('Bắt buộc: Nhập email');
			$this.html("Gửi");
		}
		if($noidung != '' && $noidung != '' && $email != '')
		{
			$.ajax({
				url : 'controller/xuly.php',
				type : 'POST',
				data : {
					noidung : $noidung,
					name : $name,
					email : $email,
					id_post : $id_post,
					action : 'comment' 
				},success: function(data){
					$this.html("Gửi");
					$('#AddComment .alert:eq(3)').removeClass("hidden-xs-up");	
					$('#AddComment .alert:eq(3)').html(data);
				}
			})
		}
	})
	function sendMsg(){
		$mes = $('#messenger input[type="text"]').val();
		$user = $('#messenger').attr('data-id');
		$.ajax({
			url : 'controller/xuly.php',
			type : 'POST',
			data : {
				mes : $mes,
				user_id : $user,
				action : 'send_mes'
			},success : function(data){
				$('#messenger input[type="text"]').val('');
			}
		})
	}
	$('#messenger input[type="text"]').keypress(function(event){
		var keycode = (event.keyCode) ? event.keyCode : event.which;
		if(keycode == '13')
		{
			sendMsg();
		}

	})

	$.ajaxSetup({cache:false});

	setInterval(function(){
		$user = $('#messenger').attr('data-id');
		$.ajax({
			url : 'controller/auto.php',
			type : 'POST',
			data : {
				user : $user
			},success : function(data){
				$('.messenger .main-chat').html(data);
			}
		})
	},500);

	$('#dn').on('click',function(){
		$user = $('#DangNhap #usern').val();
		$pass = $('#DangNhap #passw').val();

		if($user == '' || $pass == '')
		{
			$('#DangNhap .alert').removeClass('hidden');
			$('#DangNhap .alert').html('Error: Vui lòng điền đầy đủ thông tin');
			$this.html("Đăng nhập");
		}
		else
		{
			$.ajax({
				url : 'controller/xuly.php',
				type : 'POST',
				data : {
					username : $user,
					password : $pass,
					action : 'signin'
				},success : function(data) {
					$('#DangNhap .alert').removeClass('hidden-xs-up');
					$('#DangNhap .alert').html(data);
					$this.html("Đăng nhập");	
				},error : function(){
					$('#DangNhap .alert').removeClass('hidden-xs-up');
					$('#DangNhap .alert').html("Error: Không thể đăng nhập vào lúc này, hãy thử lại sau.");
					$this.html('Đăng nhập');
				}
			});
		}
	})

$('.messenger').click(function() {
    // Kéo hết thanh cuộn trình duyệt đến cuối
  	$('.messenger .main-chat').animate({scrollTop:500000});
});
	$('.comment > .col-xs-12 > button').on('click',function(){
		$id_post = $(this).attr('data-id');
		$.ajax({
			url : 'controller/xuly.php',
			type : 'POST',
			data : {
				id_post : $id_post,
				action : 'add_comment'
			},success : function(data){
				$('.comment > .col-xs-12 > button').addClass('hidden-xs-up');	
				$('.comment .col-xs-12 .media:last').after(data);
			}
		})
 	})
 	$('#TimKiem button').on('click',function(){
 		$search = $('#TimKiem #search').val();
 		if($search == '')
 		{
 			return false;
 		}
 		else
 		{
 			$.ajax({
 				url : 'controller/xuly.php',
 				type : 'POST',
 				data : {
 					search : $search,
 					action : 'search'
 				},success : function(data){
 					$('.hide')
 					$('#show_timkiem').html(data);
 				}
 			})
 		}
 	})

 	if(window.Notification && Notification.permission !== 'granted'){
 		Notification.requestPermission(function (p){
 			if(Notification.permission !== p){
 				Notification.permission = p;
 			}
 		})
 	}
}) 
