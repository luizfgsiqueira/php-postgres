<?php
	$message_ok=false;
	$message_error='Sistema não está disponivel';
	if(isset($_POST['username'],$_POST['password'])):
		if($_POST['username']!=""):
			if($_POST['password']!=""):
				$username=$_POST['username'];
				$password=md5($_POST['password']);
				$res=pg_query($conn,("Select * from user_tbl where username='$username' and password='$password'"));
				if(pg_num_rows($res)>0):
					$message_ok=true;
					$user_list=pg_fetch_array($res);
					$_SESSION['id']=$user_list[0];
					$_SESSION['username']=$user_list[1];
					$message_error='Usuário logado';
				else:
					$message_error='Login ou Senha correto, tente novamente!';
				endif;
			else:
				$message_error='Erro na senha.';
			endif;
		else:
			$message_error='Usuário não cadastrado.';
		endif;
	else:
		$message_error='Todos os campos são obrigatórios.';
	endif;
	$json=array('data' => $message_ok, 'message' =>$message_error);
	echo json_encode($json);
?>
