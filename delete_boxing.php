<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM boxing_sessions WHERE id = :id AND user_id = :uid");
$stmt->execute([':id' => $id, ':uid' => $_SESSION['user_id']]);

header("Location: boxing.php");
exit();
?>