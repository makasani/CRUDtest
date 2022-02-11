<?php use App\Services\Page; ?>
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
	<h2 class="mt-4">Sign Up</h2>
	<form  class="mt-4" action ="/auth/register" method ="POST">

 		<div class="mb-3">
 		  <label for="email" class="form-label">Email address</label>
 		  <input type="email" class="form-control" name="email" id="email" >
 		</div>

 		<div class="mb-3">
 		  <label for="firstname" class="form-label">First Name</label>
 		  <input type="text" class="form-control" name="firstname" id="firstname">
 		</div>

		 <div class="mb-3">
 		  <label for="lastname" class="form-label">Last Name</label>
 		  <input type="text" class="form-control" name="lastname" id="lastname">
 		</div>

		 <div class="mb-3">
 		  <label for="password" class="form-label">Password</label>
 		  <input type="password" class="form-control" name="password" id="password">
 		</div>

		 <div class="mb-3">
 		  <label for="password_confirm" class="form-label">Password confirm</label>
 		  <input type="password" class="form-control" name="password_confirm" id="password_confirm">
 		</div>

 		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>

</body>
</html>