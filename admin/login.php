<?php
include('header.php');
?>



<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="static/style.css">
	<meta charset="UTF-8">
</head>

<form action="index.php" method="post">
  <div class="imgcontainer">
    <img src="../img/admin.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button class="registerbtn" type="submit">Log in</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="btn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>