<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit();
}

require_once('../functions.php');

$errors = array();
$id = '';
$author = '';
$title = '';
$content = '';

// Générer un token CSRF
$csrf_token = generate_csrf_token();

if (isset($_GET['id'])) {
    // Valider et sanitiser l'ID
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($id === false) {
        header('Location: index.php');
        exit();
    }
    
    $post = selectOne($id);
    if (!$post) {
        header('Location: index.php');
        exit();
    }
    
    $author = $post['author'];
    $title = $post['title'];
    $content = html_entity_decode(strip_tags($post['content'], '<br>')); // Conversion des <br> en retours à la ligne
}

if (isset($_POST['update-post'])) {
    // Vérifier le token CSRF
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        die('CSRF token validation failed');
    }
    
    $errors = validatePost($_POST);
    
    // Traitement de l'image
    if (!empty($_FILES['image']['name'])) {
        // Valider le fichier image
        $file_errors = validateFileUpload($_FILES['image']);
        if (count($file_errors) > 0) {
            $errors = array_merge($errors, $file_errors);
        } else {
            // Générer un nom sécurisé pour le fichier
            $image_name = time() . '_' . basename($_FILES['image']['name']);
            $destination = "../img/$image_name";

            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if ($result) {
                $_POST['image'] = $image_name;
            } else {
                array_push($errors, "L'enregistrement de l'image a échoué");
            }
        }
    } else {
        array_push($errors, 'Une image est requise');
    }
    
    if (count($errors) == 0) {
        // Valider et sanitiser l'ID
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: index.php');
            exit();
        }
        
        // Sanitisation du HTML avec htmlspecialchars avant nl2br
        $_POST['content'] = nl2br(htmlspecialchars($_POST['content']));

        updatePost($id, $_POST['author'], $_POST['title'], $_POST['content'], $_POST['image']);
        
        // Générer un nouveau token CSRF pour la prochaine requête
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        header('Location: index.php');
        exit();
    } else {
        $author = $_POST['author'];
        $title = $_POST['title'];
        $content = $_POST['content'];
    }
}

if (isset($_GET['delete_id'])) {
    // Valider et sanitiser l'ID
    $delete_id = filter_var($_GET['delete_id'], FILTER_VALIDATE_INT);
    if ($delete_id === false) {
        header('Location: index.php');
        exit();
    }
    
    deletePost($delete_id);
    header('Location: index.php');
    exit();
}
?>