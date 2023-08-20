<?php 
include('../functions.php');
include('update.php');


?>

<?php include('header.php') ?>
<?php include(ROOT_PATH . '/includes/navbar.php') ?>

<title>Admin Section - Edit Post</title>

<div class="admin-container">

            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Add article</a>
                    <a href="index.php" class="btn btn-big">Manage articles</a>
                </div>
                <div class="container">

                    <h2 class="page-title">Edit Post</h2>
                    <?php include('formErrors.php'); ?>
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div>
                            <label>Author</label>
                            <input type="text" name="author" value="<?= $author ?>" class="text-input">
                        </div>
                        <div>
                            <label>Title</label>
                            <input type="text" name="title" value="<?= $title ?>" class="text-input">
                        </div>
                        <div>
                            <label>Contenu</label>
                            <textarea cols="130", rows="10" name="content" id="body"><?= $content ?></textarea>
                        </div>
                        <div>
                            <label>Image</label>
                            <input type="file" name="image"  class="text-input">
                        </div>
                        <div>
                            <button type="submit" name="update-post" class="btn btn-big">Mettre à jour</button>
                        </div>
                    </form>

                </div>

            </div>
<?php include(ROOT_PATH . '/includes/footer.php') ?>