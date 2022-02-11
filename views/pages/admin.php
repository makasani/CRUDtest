<?php use App\Services\Page; 

if ($_SESSION["user"] && $_SESSION["user"]["status"] != 1) {
    \App\Services\Router::redirect('/profile');
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
  <h1 class="display-4">Hi Admin</h1>
 
  </p>
</div>
</div>
</body>
</html>