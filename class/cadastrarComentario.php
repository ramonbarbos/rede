<?php 

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST,  FILTER_DEFAULT);

$query = "INSERT INTO `tb_site.comentario` (id_noticia, id_user,img_user, comentario,data) VALUES(:id_noticia, :id_user, :img_user, :comentario, :data)";
$cad_coment = $conn->prepare($query);
$cad_coment->bindParam(':id_noticia', $dados['id_noticia']);
$cad_coment->bindParam(':id_user', $dados['id_user']);
$cad_coment->bindParam(':img_user', $dados['img_user']);
$cad_coment->bindParam(':comentario', $dados['comentario']);
$cad_coment->bindParam(':data', $dados['data']);
$cad_coment->execute();

if($cad_coment->rowCount()){
    $retorna = ['erro' => false, 'msg' => 'Comentario cadastrado'];
}else{
    $retorna = ['erro' => true, 'msg' => 'Erro ao cadastrar'];
}



echo json_encode($retorna);
