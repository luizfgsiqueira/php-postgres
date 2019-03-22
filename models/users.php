<?php
function count_users($conn){
	//Obtem o numero total de resultado
	$result = pg_query($conn, "SELECT count(*) FROM user_tbl"); 
	return (int)pg_fetch_result($result, 0, 0);
}

function get_users_paging($conn,$page,$count_per_page) {
	$offset = ($page - 1) * $count_per_page;
	$sql = "SELECT * from user_tbl ORDER  BY username LIMIT  $count_per_page offset $offset";
	
	$result = pg_query($conn,$sql);
	if (!$result) {
	    echo "Ocorreu um erro.\n";
	    exit;
	}
	$users = pg_fetch_all($result);	
	return $users;

}

function get_users($conn) {
	$result = pg_query($conn, "SELECT * FROM user_tbl");
	if (!$result) {
	    echo "Ocorreu um erro.\n";
	    exit;
	}
	$users = pg_fetch_all($result);	
	return $users;

}

function get_user($conn,$id) {
	$result = pg_query($conn, "SELECT * FROM user_tbl where id=".$id);
	if (!$result) {
	    echo "Ocorreu um erro.\n";
	    exit;
	}
	$user = pg_fetch_array($result);	
	return $user;
}

function del_user($conn,$where){	
	//$where = array("id" => $id);
	$res = pg_delete($conn, 'user_tbl', $where);	
	if ($res) {
	  //echo "Excluido com sucesso.";
	  $is_deleted = true;
	} else {
	  //echo "Erro na entrada..";
	  $is_deleted = false;
	}	
	return $is_deleted ;
}

function update_user($conn,$data,$where_condition){	
	$res = pg_update($conn, 'user_tbl', $data, $where_condition);
	if ($res) {
	  	//echo "Dados atualizado: $res";
		$is_updated = true;
	} else {
		 //echo "Erro na entrada.. <br />";
		 //echo pg_last_error($conn);
		$is_updated = false;
	}
	return $is_updated;
}

function qdel_user($conn){
	$sql = "delete from user_tbl where id = 3";

	 $result = pg_query($conn, $sql);
	if(!$result){
	  //echo pg_last_error($conn);
	  $is_deleted = true;
	} else {
	  //echo "Excluido com sucesso!!\n";
	  $is_deleted = false;
	}
	return is_deleted;
}
function insert_user($conn, $users){	
	// Inserir um por linha
	foreach ($users as $key => $user) {
	    $res = pg_insert($conn, 'user_tbl' , $user);
	    if ($res) {
	      //echo "Usuário inserido: ".$user['name']." <br />";
	      $is_inserted = true;		
	    } else {
	      echo pg_last_error($conn) . " <br />";
	      $is_inserted = false;	
	    }
	}
	return $is_inserted;
}
?>
