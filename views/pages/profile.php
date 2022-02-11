<?php use App\Services\Page; 

session_start();

if(!$_SESSION["user"]){
    \App\Services\Router::redirect('/login');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php 
	Page::part('head');
?>
<body>
<?php 
	Page::part('navbar');
?>

<div class="container">
<div class="jumbotron mt-4">
  <h1 class="display-4">Hello, <?= $_SESSION["user"]["firstname"] .'  '.   $_SESSION["user"]["lastname"] ?> </h1>
  
  </p>
</div>
</div>
</body>
</html>