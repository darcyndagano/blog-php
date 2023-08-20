<?php 

include_once('functions.php') ;
include('traitement.php');
//selection d'un article et de ses commentaires grâce à son identifiant
$post =selectOne($id);
$comments = findAllComments($id);
?>

<?php include_once(ROOT_PATH . '/includes/header.php') ?>

		<title><?= $post['title'] ?></title>
<body>
	<div class="container">
		<?php include(ROOT_PATH . '/includes/navbar.php') ?>
        <div class="container">
            <div class="card">
                <h1><?= $post['title'] ?></h1>
            </div> 
            <div class="post-image">
            <img src="<?= 'img/' . $post['image']; ?>" alt=""> 
            </div>  
            <div class="container">
                <?= $post['content']; ?>
            </div>
            <h5><strong><?= $post['author']; ?></strong> : publié le <?= $post['created_at']; ?></h5>
        </div>
        <h2>Les commentaires</h2>
        <div class="comments">
          <?php foreach ($comments as $comment): ?>
            <div class="comment">
              <h3 class="auteur">Ecrit par <?= $comment['auteur']; ?> : </h3>
              <p class="contenu" ><?= $comment['comment']; ?><br>
              <i class="far fa-calendar"> <?= date('d F, Y', strtotime($comment['created_at'])); ?></i>
              <a class="sup" href="post.php?id=<?= $id ?>&amp;id_comment_delete=<?= $comment['id']; ?>">Supprimer</a>
              </p>
              <br>
            </div>
          <?php endforeach; ?>
        </div>
        <br>
        <form action="post.php?id=<?=$id ;?>"  method="post">
          <input type="hidden" name="id" value="<?= $id ?>">
          <div>
            <label>Votre Prenom : </label>
            <input type="text" name="author" class="text-input">
          </div>
          <div>
            <label>Body : </label>
            <textarea name="comment" id="body" cols="130" rows="15"></textarea>
          </div><br>
          <div>
              <button type="submit" name="add-comment" class="btn btn-big">Commentez</button>
          </div>
        </form>
        
      </div> 

		<?php include(ROOT_PATH . '/includes/footer.php') ?>