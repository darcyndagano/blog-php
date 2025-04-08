<?php 
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit();
}

require_once('../functions.php'); 
?>

<?php
$errors = array();
$title = '';
$content = '';
$author = '';

// Générer un token CSRF
$csrf_token = generate_csrf_token();

if(isset($_POST['add-post']))
{
    // Vérifier le token CSRF
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        die('CSRF token validation failed');
    }
    
    // La gestion des erreurs sur le formulaire d'insertion d'article
    $errors = validatePost($_POST);
    
    // Traitement de l'image
    if (!empty($_FILES['image']['name']))
    {
        // Valider le fichier image
        $file_errors = validateFileUpload($_FILES['image']);
        if (count($file_errors) > 0) {
            $errors = array_merge($errors, $file_errors);
        } else {
            // Générer un nom sécurisé pour le fichier
            $image_name = time() . '_' . basename($_FILES['image']['name']);
            $destination = "../img/$image_name";

            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if ($result)
            {
                $_POST['image'] = $image_name;
            } else {
                array_push($errors, "L'enregistrement de l'image a échoué");
            }
        }
    } else {
        array_push($errors, 'Une image est requise');
    }
    
    if (count($errors) == 0) {
        // Sanitisation du HTML avec htmlspecialchars avant nl2br
        $_POST['content'] = nl2br(htmlspecialchars($_POST['content']));
        
        create($_POST['title'], $_POST['content'], $_POST['author'], $_POST['image']);
        
        // Générer un nouveau token CSRF pour la prochaine requête
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        header('location: index.php');
        exit();
    } else {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
    } 
}   
?>

<?php include('header.php'); ?>
<?php include(ROOT_PATH . '/includes/navbar.php'); ?>
<title>Admin Section | Add article</title>
<div class="admin-container">
    <!-- Admin Content -->
    <div class="admin-content">
        <div class="button-group">
            <a href="create.php" class="btn btn-big">Add Articles</a>
            <a href="index.php" class="btn btn-big">Manage Articles</a>
        </div>

        <div class="container">
            <h2 class="page-title">Manage Articles</h2>
            <?php include('formErrors.php'); ?>
            <form action="create.php" enctype="multipart/form-data" method="post">
                <!-- Token CSRF -->
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                
                <div>
                    <label>Author : </label>
                    <input type="text" name="author" value="<?= htmlspecialchars($author); ?>" class="text-input">
                </div>
                <div>
                    <label>Title :</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($title); ?>" class="text-input">
                </div>
                <div>
                    <label>Contenu : </label>
                    <textarea cols="130", rows="10" name="content" id="body"><?= htmlspecialchars($content); ?></textarea>
                </div>
                <div>
                    <label>Image</label>
                    <input type="file" name="image" class="text-input">
                </div>
                
                <div>
                    <button type="submit" name="add-post" class="btn btn-big">Add Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include(ROOT_PATH . '/includes/footer.php') ?>