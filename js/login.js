$(document).ready(function(){
	$("#login").click(function(){
		var username=$('#username').val();
		var password=$("#password").val();
		//console.log(username,password);
		$.ajax({
			type:"POST",
			dataType:'json',
			url:'index.php?controller=login_ajax',
			data:{username:username,password:password},
			success:function(response){
				if(response.data==true){
					$("#message").html(response.message);
					window.location='index.php?controller=users';
				}else{
					$("#message").html(response.message);
				}
			},error:function(){
				alert('Sistema com erro!!');
			}
		});
	});
});
