<?php require_once('../functions.php'); ?>

<?php
$errors = array();
$title = '';
$content = '';
$author = '';
 if(isset($_POST['add-post']))
 {
    //la gestion des erreurs sur le formulaire d'insertion d'article
    $errors = validatePost($_POST);
    //traitement de l'image
        if (!empty($_FILES['image']['name']))
        {
                $image_name = time(). '_' .$_FILES['image']['name'];
                $destination = "../img/$image_name";

                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                if ($result)
                {
                    $_POST['image'] = $image_name;
                }else {
                    array_push($errors, 'L\'enregistrement de l\'image a echoué');
                }
        } else {
                array_push($errors, 'une image est requise');
            }
            if (count($errors) == 0){
                $_POST['content'] = nl2br(htmlentities($_POST['content']));
                create($_POST['title'], $_POST['content'], $_POST['author'], $_POST['image']);
                header('location: index.php');
                exit();
            } 
            else{
                $title = $_POST['title'];
                $content = $_POST['content'];
                $author = $_POST['author'];
            } 
 }   

 
?>

<?php include('header.php'); ?>
<?php include(ROOT_PATH . '/includes/navbar.php') ;?>
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
                        <div>
                            <label>Author : </label>
                            <input type="text" name="author" value="<?= $author; ?>" class="text-input" >
                        </div>
                        <div>
                            <label>Title :</label>
                            <input type="text" name="title" value="<?= $title; ?>" class="text-input" >
                        </div>
                        <div>
                            <label>Contenu : </label>
                            <textarea cols="130", rows="10" name="content"  id="body" ><?= $content; ?></textarea>
                        </div>
                        <div>
                            <label>Image</label>
                            <input type="file" name="image"  class="text-input">
                        </div>
                        
                        <div>
                            <button type="submit" name="add-post" class="btn btn-big">Add Post</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

<?php include(ROOT_PATH . '/includes/footer.php') ?>