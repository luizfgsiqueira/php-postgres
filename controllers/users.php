<?php
locked();
include_once('models/users.php');

//mostra a lista de usuarios
if ( !isset($_GET['edit']) && !isset($_GET['del'])&& !isset($_GET['add']) ){
	$countPerPage = 3;
	$totalResultCount  = count_users($conn);

	// função para contagem de paginas.
	$numberOfPages = ceil($totalResultCount / $countPerPage);

	// verifica o numero de paginas _GET parametro
	if(!empty($_GET) && isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	}else{
	    $page = 1;
	}

	// verifica o numero de paginas
	if($page < 0){
	    $page = 1;
	}elseif($page > $numberOfPages){
	    $page = $numberOfPages;
	}

	$users = get_users_paging($conn,$page,$countPerPage);
	include('views/list_users.php');
} 
//função exclusão
elseif (isset($_GET['del'])){
	$where = array("id" => $_GET['del']);
	del_user($conn,$where);	
	header("Location: index.php?controller=users"); 
	exit();
}

//função editar
elseif (isset($_GET['edit']) && is_numeric($_GET['edit'])){
	//quando grava as informações no formulario 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$where_condition = array("id" => $_GET['edit']);		
    		$msg = "";
		$class_stat = 'class="alert alert-info"';
		if(trim($_POST['password']) != trim($_POST['confirm_password'])){
			$msg = "Não digitada não confere.";
			$class_stat = 'class="alert alert-warning"';
		}else{
			$_POST['password'] = md5($_POST['password']);
			unset($_POST['confirm_password']);
			$data = $_POST;		
			$is_updated = update_user($conn,$data,$where_condition);
			if($is_updated){
				$msg = "Informações atualizadas.";
				$class_stat = 'class="alert alert-info"';
			}else{
				$msg = "Erro de inserção.";
				$class_stat = 'class="alert alert-warning"';
			}
		}		
	}
	// obter informações de registro do usuário.
	$user = get_user($conn,$_GET['edit']);
	include('views/edit_user.php');
	
}
elseif(isset($_GET['add'])){
	//quando as informações são gravadas
	if($_SERVER['REQUEST_METHOD'] == 'POST'){		
    		$msg = "";
		$class_stat = 'class="alert alert-info"';
		if(trim($_POST['password']) != trim($_POST['confirm_password'])){
			$msg = "Senha digitada não confere.";
			$class_stat = 'class="alert alert-warning"';
		}else{
			$_POST['password'] = md5($_POST['password']);
			unset($_POST['confirm_password']);
			$data[] = $_POST;
			//print_r($data);exit;		
			$is_inserted = insert_user($conn,$data);
			if($is_inserted){
				$msg = "Informações atualizadas.";
				$class_stat = 'class="alert alert-info"';
			}else{
				$msg = "Erro de inserção.";
				$class_stat = 'class="alert alert-warning"';
			}
		}		
	    //redireciona a o usuario a lista de usuarios
		//header("Location: index.php?controller=users"); 
		//exit();		
	}
	include('views/add_user.php');
}



?>
