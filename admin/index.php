<?php
require_once('../functions.php');
$posts = get_posts();


?>

<?php 
include_once( 'header.php');
include_once(ROOT_PATH . '/includes/navbar.php');

?>
<head>
</head>

<title>DUKORE Tech | Admin</title>

<div class="admin-container">
            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Add article</a>
                    <a href="index.php" class="btn btn-big">Manage articles</a>
                </div>
                <div class="container">
                    <h2 class="page-title">Articles</h2>
                    <table>
                        <thead>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th colspan="3">Action</th>
                        </thead>
                        <tbody>
                        <?php foreach($posts as $key=>$post) : ?>
                                <tr>
                                    <td><?= $key +1; ?></td>
                                    <td><?= $post->title; ?></td>
                                    <td><?= $post->author; ?></td>
                                    <td><a href="edit.php?id=<?= $post->id ?>" class="edit">Edit</a></td>
                                    <td><a href="edit.php?delete_id=<?= $post->id ?>" class="delete">Delete</a></td>  
                                </tr>
                         <?php endforeach ; ?>
                        </tbody>
                    </table>
                </div>
            </div>

<?php include(ROOT_PATH . '/includes/footer.php') ?>
