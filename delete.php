<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=anime', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$delete = $_POST['id'];

if(!$delete){
    header('Location:index.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM characters WHERE id = :id'); 
//'id' yg pertama adlah nama colum dlm db & ':id' yg kedua adalah name dlm form html
$statement->bindValue(':id', $delete);
$statement->execute();
header('Location:index.php');

?>