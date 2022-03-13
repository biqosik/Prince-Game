<?php
include 'connection.php';
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$avatar = $_POST['avatar'];
	$score = $_POST['score'];
$query = "INSERT INTO `score_board`( `id`, `score`, `avatar`) VALUES ('$id', '$score', '$avatar')";
$result = $db->query($query);
 $query = "SELECT user.name,score_board.avatar, score_board.score FROM `score_board` NATURAL JOIN user ORDER BY score DESC LIMIT 10";
 $result = $db->query($query);
 if($result){
 	$output = [];
 	while ($row = $result->fetch_object()) {
 		$output[] = $row;
 	}
 	echo  json_encode($output);
 }
}
?>