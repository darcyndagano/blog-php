<?php

include_once('config.php'); 


$postdata = $_POST;

if( !isset($postdata['fullname']) || !isset($postdata['email']) || !isset($postdata['password']))
{
    echo("il faut un nom , un email et un mot de passe pour s'enregistrer");
    return;
}

$fullname = $postdata['fullname'];
$email = $postdata['email'];
$password = $postdata['password'];

$sqlQuery = 'INSERT into users(full_name, email, mot_de_passe) VALUES(:full_name, :email, :mot_de_passe)';
$insertUsers = $conn -> prepare($sqlQuery);
$insertUsers ->execute([
        'full_name' => $fullname,
        'email' => $email,
        'mot_de_passe' => $password,
]);
    

?>
<?php include_once(ROOT_PATH . '/includes/header.php'); ?>
<title>DUKORE Tech | Success</title>
<?php include_once(ROOT_PATH . '/includes/navbar.php'); ?>
<h4><?php  echo('utilisateur ' . $fullname . ' enregistré avec succès'); ?></h4>
<?php include_once(ROOT_PATH . '/includes/footer.php'); ?>
