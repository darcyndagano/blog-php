<?php
//traitement de post.php
$id = '';
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
}
if(empty($_GET['id'])){
    die("l'article n'existe pas!");
}
//sauvegarde du commentaire
if(isset($_POST['add-comment'])){
   if(!empty($_POST['author']) && !empty($_POST['comment'])){
    $author = $_POST['author'];
    $comment = $_POST['comment'];
    $id = $_POST['id'];
    saveComment($author, $id, $comment);
    header('Location:post.php?id='. $_POST['id']);
    exit();
   } 
}