<?php 

include_once('config.php');
$postdata = $_POST;

if(!isset($postdata['email']) || !isset($postdata['message']))
{
	echo ("il faut un email et un message pour nous contacter");
	return;
}

$email = $postdata['email'];
$message = $postdata['message'];

$sqlQuery = 'INSERT into contact(email, ubutumwa) VALUES(:email, :ubutumwa)';
$insertMessage = $conn -> prepare($sqlQuery);
$insertMessage -> execute([
	'email' => $email,
	'ubutumwa' => $message,
]);
?>

<?php include_once(ROOT_PATH . '/includes/header.php'); ?>

<title>DUKORE Tech | Sent</title>
<?php include_once(ROOT_PATH . '/includes/navbar.php'); ?>
<h1>Message bien reçu !</h1>
        
        <div class="card">
            <div class="card-body">
                <b class="card-title">Rappel de vos informations</b>
                <p class="card-text"><b>Email</b> : <?php echo($email); ?></p>
                <p class="card-text"><b>Message</b> : <?php echo strip_tags($message); ?></p>
            </div>
        </div>
<?php include_once(ROOT_PATH . '/includes/footer.php') ?>
	

