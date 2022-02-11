<?php use App\Services\Page; 

if($_SESSION["user"]){
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
	<h2 class="mt-4">Log In</h2>
	<form  class="mt-4" action="/auth/login" method="post">
 		<div class="mb-3">
 		  <label for="email" >Email address</label>
 		  <input type="email" class="form-control" name="email" id="email">
 		</div>
 		<div class="mb-3">
 		  <label for="password" >Password</label>
 		  <input type="password" class="form-control" name="password" id="password">
 		</div>
 		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>

</body>
</html>