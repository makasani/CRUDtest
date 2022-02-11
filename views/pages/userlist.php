<?php use App\Services\Page; 
session_start();
if ($_SESSION["user"] && $_SESSION["user"]["status"] != 1) {
    \App\Services\Router::redirect('/profile');
    
}
$users = \R::findAll('users');
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

<div style="display: none; background: green; color: #fff; padding: 12px 20px; border-radius: 12px; margin: 20px 0px;" id="message">
  Удаление успешно
</div>

<table class="table">
  <tr>
    <th scope="col" >id</th>
    <th scope="col" >Имя</th>
    <th scope="col" >Фамилия</th>
    <th scope="col" >Почта</th>
    <th scope="col" >Cтатус</th>
    <th scope="col" >&#9998;</th>
    <th scope="col" >Удалить</th>
  </tr>
  <?php foreach ($users as $user):?>
  <tr id="<?= $user->id ?>" >
    <td><?=$user-> id;?></td>
    <td data-target="firstname"><?=$user-> firstname;?></td>
    <td data-target="lastname"><?=$user-> lastname;?></td>
    <td data-target="email"><?=$user-> email;?></td>
    <td data-target="status"> <?php if ($user -> status == 1) {
     echo 'Администратор';  } else echo 'Пользователь';  ?>
</td>
    <td><a href="#" data-id=<?= $user->id ?> data-role="update" class="link-info">Изменить</a></td>
    <!-- <td>< href="" class="delete-button" name="<?= $user->id ?>" class="link-danger">Удалить</></td> -->
    <td><div class="delete-button" name="<?= $user->id ?>">Удалить</div></td>
  </tr>
  

  <?php endforeach;?>



<!-- Модальное окно -->
<div  id="modal" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Обновить</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modall" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" id="firstname" class="form-control">
          <label>Last Name</label>
          <input type="text" id="lastname" class="form-control">
          <label>Email</label>
          <input type="text" id="email" class="form-control">
          <label>Status</label>
          <input type="text" id="status" class="form-control">
          <input type="hidden" id="userid" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <a href="#" id="save"  class="btn btn-primary" data-toggle="modal">Сохранить изменения</a>
      </div>
    </div>
  </div>
</div>
      

  <style>
    .delete-button {
      text-decoration: underline;
      color: red;
      cursor: pointer;
    }
    .delete-button:hover {
      opacity: 0.8;
      text-decoration: none;
    }
  </style>

  <script>
    $( document ).ready(function() {
        
        $(".delete-button").click( function() {
         
         
              let id = $(this).attr('name');

              // console.log(id);


              $.ajax({
                method: "POST",
                url: "/userlist/delete",
                data: { 
                  userid: id
                  }
              })
                .done(function(data) {
                  // console.log(data);
                  if(data == 'true') {


                    $('#message').fadeIn('slow');

                    setTimeout(function(){
                      location.reload();
                    }, 2000);

                    
                    
                  }
                });
        });    
    });
</script>

<script>
    $(document).ready(function() {
      $(document).on('click', 'a[data-role=update]', function() {
        var id = $(this).data('id');
        var firstname = $('#'+id).children('td[data-target=firstname]').text();
        var lastname = $('#'+id).children('td[data-target=lastname]').text();
        var email = $('#'+id).children('td[data-target=email]').text();
        var status = $('#'+id).children('td[data-target=status]').text();


        $('#firstname').val(firstname);
        $('#lastname').val(lastname);
        $('#email').val(email);
        $('#status').val(0);
        $('#userid').val(id);
        $('#modal').modal('show');
        
      });

      
      $('#save').click(function() {
        var id = $('#userid').val();
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();
      var email = $('#email').val();
      var status = $('#status').val();
       

      $.ajax({
                method: "POST",
                url: "/userlist/update",
                data: { 
                  id: id,
                  firstname: firstname,
                  lastname: lastname,
                  email: email,
                  status: status
                },
                success : function(response) {
                  
                  $('#'+id).children('td[data-target=firstname]').text(firstname);
                  $('#'+id).children('td[data-target=lastname]').text(lastname);
                  $('#'+id).children('td[data-target=email]').text(email);
                  // $('#'+id).children('td[data-target=status]').text(status);

                  $('#modal').modal('toggle');

              

                  
                }
                
              });
              
      });
      
    });

  </script>
 
</table>
<!-- Кнопка-триггер модального окна -->
<!-- <button id = "modal" type="button" class="btn btn-primary" data-bs-toggle="smodal" data-bs-target="#exampleModal">
Обновить
</button> -->
<a href="#" id="create"   data-role="create" class="btn btn-primary">Создать</a>

<div  id="modal2" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Создать</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modall2" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" id="firstname1" class="form-control">
          <label>Last Name</label>
          <input type="text" id="lastname1" class="form-control">
          <label>Email</label>
          <input type="text" id="email1" class="form-control">
          <label>password</label>
          <input type="text" id="password1" class="form-control">
          <label>password confirm</label>
          <input type="text" id="password_confirm1" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <a href="#" id="save2"  class="btn btn-primary" data-toggle="modal2">Сохранить изменения</a>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
      $(document).on('click', 'a[data-role=create]', function() {
       
        $('#modal2').modal('toggle');
        
      });

      
      $('#save2').click(function() {
      var firstname = $('#firstname1').val();
      var lastname = $('#lastname1').val();
      var email = $('#email1').val();
      var password = $('#password1').val();
      var password_confirm = $('#password_confirm1').val();
       

      $.ajax({
                method: "POST",
                url: "/userlist/create",
                data: { 
                  firstname: firstname,
                  lastname: lastname,
                  email: email,
                  password: password,
                  password_confirm: password_confirm
                },
                success : function(response) {
                  
                  // $('#'+id).children('td[data-target=firstname]').text(firstname);
                  // $('#'+id).children('td[data-target=lastname]').text(lastname);
                  // $('#'+id).children('td[data-target=email]').text(email);
                  // $('#'+id).children('td[data-target=status]').text(status);

                  $('#modal2').modal('toggle');

              

                  
                }
                
              });
              
      });
      
    });

  </script>
</div>
</body>
</html>