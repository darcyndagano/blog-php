<?php 

include_once('functions.php');

$perpage = 3;
$nombreTotal = pagination() ;
$noPage = 1;
$page = ceil($nombreTotal/$perpage);


$posts = selectAll();
 ?>

<?php include_once(ROOT_PATH . '/includes/header.php') ?>

		<title>DUKORE Tech | Home </title>
<body>
	<div class="container">
		<?php include(ROOT_PATH . '/includes/navbar.php') ?>

		<?php include(ROOT_PATH . '/includes/banner.php') ?>

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Recent Articles</h2>
			<hr>
			<!-- more content still to come here ... -->
			<?php foreach($posts as $post): ?>
			<div class="content">
                <div class="card-content">
                    <h2> <?= $post['title']?></h2>
					<img src="<?= 'img/' . $post['image']; ?>" alt="" class="slider-image">
                    <h3>Le <?= date("d/m/Y à H:i",strtotime($post['created_at'])); ?> par <?= $post['author'] ?></h3>
                </div>
                <div class="card-reveal">
                    <p><?= substr(nl2br($post['content']),0,1000); ?>...</p>
				</div>
				<div class="card-content">
                    <h4><a href="post.php?page=post&id=<?= $post['id'] ?>">Voir l'article complet</a></h4>
                </div>
            </div> 
			<?php endforeach; ?>
		</div>
		
		<!-- // Page content -->

		<!-- footer -->
		<?php include(ROOT_PATH . '/includes/footer.php') ?>
	