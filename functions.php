<?php
require_once('config.php');

// Fonction pour sanitiser les entrées utilisateur
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

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
    
    // Protection contre injection SQL en forçant le type entier
    $id = (int)$id;
    
    $query = $conn->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute(array('id' => $id));
    $post = $query->fetch();
    return $post;
}

//enregistrement d'un article avec sanitisation
function create($title, $content, $author, $image){
    global $conn;

    $query = $conn->prepare('INSERT INTO posts(title, content, author, image, created_at) VALUES(:title, :content, :writer, :image, NOW())');
    $query->execute([
        'title' => sanitize_input($title),
        'content' => $content, // Le contenu est déjà sanitisé lors de l'appel à cette fonction
        'writer' => sanitize_input($author),
        'image' => sanitize_input($image),
    ]);
}

//validation de l'article
function validatePost($post){
    $errors = array();
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

// Validation des fichiers téléchargés
function validateFileUpload($file) {
    $errors = array();
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $max_size = 2 * 1024 * 1024; // 2MB
    
    if ($file['size'] > $max_size) {
        array_push($errors, "L'image est trop volumineuse. Taille maximum: 2MB");
    }
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        array_push($errors, 'Format de fichier non supporté. Formats acceptés: ' . implode(', ', $allowed_extensions));
    }
    
    return $errors;
}

//modification d'un article avec sanitisation
function updatePost($id, $author, $title, $content, $image){
    global $conn;
    
    // Forcer le type entier pour éviter l'injection SQL
    $id = (int)$id;
    
    $query = $conn->prepare('UPDATE posts SET author = :auteur, title = :titre, content = :content, image = :image WHERE id = :id');
    $query->execute([
        'id' => $id,
        'auteur' => sanitize_input($author),
        'titre' => sanitize_input($title),
        'content' => $content, // Le contenu est déjà sanitisé lors de l'appel à cette fonction
        'image' => sanitize_input($image)
    ]);
}

//supprimer un article
function deletePost($id){
    global $conn;
    
    // Forcer le type entier pour éviter l'injection SQL
    $id = (int)$id;
    
    $query = $conn->prepare('DELETE FROM posts where id = :id');
    $query->execute(['id' => $id]);
}

//sauvegarder un commentaire avec sanitisation
function saveComment($auteur, $post_id, $comment){
    global $conn;
    
    // Forcer le type entier pour éviter l'injection SQL
    $post_id = (int)$post_id;
    
    $query = $conn->prepare('INSERT INTO comments(post_id, auteur, comment, created_at) 
    VALUES(:post_id, :auteur, :comment, NOW())');
    $query->execute([
        'post_id' => $post_id,
        'auteur' => sanitize_input($auteur),
        'comment' => sanitize_input($comment)
    ]);
}

//récuperation des commentaires dans la base de donnée
function findAllComments($post_id){
    global $conn;
    
    // Forcer le type entier pour éviter l'injection SQL
    $post_id = (int)$post_id;
    
    $query = $conn->prepare('SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at DESC');
    $query->execute(['post_id' => $post_id]);
    $comments = $query->fetchAll();
    return $comments;
}

//pagination
function pagination(){
    global $conn;
    $query = $conn->prepare('SELECT COUNT(*) as nbr_articles FROM posts');
    $query->execute([]);
    $nombre = $query->fetch();
    return $nombre['nbr_articles'];
}

// Fonction pour générer un jeton CSRF
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Fonction pour vérifier un jeton CSRF
function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}
?>