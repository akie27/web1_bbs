<?php
require_once '../classes/PostLogic.php';

$id = $_GET['id'];
// 投稿を削除する処理
$res = postlogic\PostLogic::deletePost($id);
header('Location:mypage.php');

?>