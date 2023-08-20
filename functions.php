<?php
require_once('config.php');

//récuperer tous les articles
function selectAll(){

    global $conn;

    $results = $conn->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 0, 3');
    $posts = $results->fetchAll();
    return $posts;
} 
//récupérer un seul article
function selectOne($id){
    global $conn;
    $query = $conn->prepare('SELECT * FROM posts WHERE id = :id');
    $query ->execute(array('id' => $id));
    $post = $query->fetch();
    return $post;
}

//enregistrement d'un article
function create($title, $content, $author, $image){
    global $conn;

    $query =$conn->prepare('INSERT INTO posts(title, content, author,image, created_at) VALUES(:title, :content,:writer,:image,NOW())');
    $query->execute([
        'title' => $title,
        'content' => $content,
        'writer' => $author,
        'image' => $image,
    ]);
}
//validation de l'article
function validatePost($post){
    $errors= array();
    if(empty($post['author'])) {
        array_push($errors, 'Ecrivez votre nom');
    }
    if(empty($post['title'])) {
        array_push($errors, 'Le titre est nécessaire');
    }
    if(empty($post['content'])) {
        array_push($errors, 'Mettez le contenu');
    }
    return $errors;
}

//modification d'un article
function updatePost($id, $author, $title, $content, $image){
    global $conn;
    $query = $conn->prepare('UPDATE posts SET author = :auteur, title = :titre, content = :content, image = :image WHERE id = :id ');
    $query->execute([
        'id' => $id,
        'auteur' => $author,
        'titre' => $title,
        'content' => $content,
        'image' => $image
    ]);
}

//supprimer un article
function deletePost($id){
    global $conn;
    $query = $conn -> prepare('DELETE FROM posts where id= :id');
    $query->execute(['id' => $id]);

}

//sauvegarder un commentaire
function saveComment($auteur,$post_id, $comment){
    global $conn;
    $query = $conn -> prepare('INSERT INTO comments(post_id, auteur, comment,created_at) 
    VALUES(:post_id, :auteur, :comment, NOW())');
    $query->execute([
        'post_id' => $post_id,
        'auteur' => $auteur,
        'comment' => $comment
    ]);
}

//récuperation des commentaires dans la base de donnée
function findAllComments($post_id){
    global $conn;
    $query = $conn -> prepare('SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at DESC');
    $query ->execute(['post_id' => $post_id]);
    $comments = $query ->fetchAll();
    return $comments;
}

//pagination
function pagination(){
    global $conn;
    $query = $conn ->prepare('SELECT COUNT(*) as nbr_articles FROM posts');
    $query -> execute([]);
    $nombre = $query ->fetch();
    return $nombre['nbr_articles'];
}
?>
