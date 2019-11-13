<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Выберите действие</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<script>
	function onSortChange(event) {		
		console.log(event.srcElement.value);
		var params = window.location.search.split("&");
		var newParams = "";
		let url = "";
		if (window.location.search == ""){
			url = window.location.href + "?sortBy=" + event.srcElement.value;
		} else {
			params.forEach(function(param) {
				console.log(param);
				if (param.indexOf('sortBy')+1){
					if (newParams == "") newParams = "?sortBy=" + event.srcElement.value;
					else newParams += "&sortBy=" + event.srcElement.value;
				} else{
					newParams += param;
				}
			});
			console.log('newParams = ' + newParams);
			url = window.location.origin + window.location.pathname + newParams;
		}
		window.location.href = url;
	}
</script>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		<h4 class="modal-title">Введите логин и пароль</h4>	
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
	  <form class="m-3" action="/tasks/?action=signUp" method="POST" role="form">
      <div class="modal-body">
			<div class="form-group">
				<input type="text" class="form-control" id="userLogin" name="user_name" placeholder="Введите ваше имя">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="userPassword" name="user_password" placeholder="Введите пароль">
			</div>
      </div>
      <div class="modal-footer">
		<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Войти</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-sm-2 col-md-2 m-3">
		<select id="sort-element" class="browser-default custom-select" onchange="onSortChange(event)">
			<option selected>Сортировка</option>
			<option value="user_name">По имени пользователя</option>
			<option value="mail">По email</option>
			<option value="status">По статусу</option>
		</select>
	</div>
	<div class="col-sm-8"></div>
    <div class="col-sm-1 m-3">
		<?php if (Auth::getAuth()): ?>
			<form action="/tasks/?action=signOut" method="POST" role="form">
				<button type="submit" class="btn btn-primary">Выйти</button>
			</form>			
		<?php else: ?>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Войти</button>
		<?php endif; ?>
	</div>
	<?php if (Auth::getAuth()): ?>
		<?php  foreach($data as $id => $task): ?>
		<div class="col-sm-10">
			<?php 
			echo '<pre>';
			print_r($task);
			echo '</pre>';		
			?>		
			<form class="m-3" action="/tasks/?action=updateTask&id=<?php echo $task[0];?>" method="POST" role="form">
				<div class="form-group">
					<input type="text" class="form-control" id="inputNickname" name="user_name" placeholder="Введите ваше имя" value=<?php echo $task[2]; ?> readonly>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" id="inputEmail" name="mail" area-describedby="emailHelp" placeholder="Введите вашу почту" value=<?php echo $task[3]; ?> readonly>
				</div>
				<div class="form-group">
					<label for="inputText">Текст задачи:</label>
					<textarea class="form-control" id="inputText" name="text" rows="3"><?php echo $task[4]; ?></textarea>
				</div>
				<?php if($task['6'] == 1): ?>
					<div class="form-group">
						<label for="inputText">Задача изменена администратором</label>
					</div>
				<?php endif; ?>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="TaskDone" name='status'>
					<label class="form-check-label" for="TaskDone" >Задача выполнена</label>
				</div>
				<button type="submit" class="btn btn-primary">Обновить задачу</button>
			</form>
		</div>
		<?php endforeach; ?>
	<?php else: ?>
		<?php  foreach($data as $id => $task): ?>
		<div class="col-sm-10">
			<?php 
			echo '<pre>';
			print_r($task);
			echo '</pre>';		
			?>		
			<div id=<?php echo '"' . $task['0'] . '"';?> class="col-md">
				<div class="user_name"><?php echo $task['2']; ?></div>
				<div class="user_email"><?php echo $task['3']; ?></div>
				<div class="task_text"><?php echo $task['4']; ?></div>
				<div class="task_complete"><?php echo $task['5']; ?></div>
				<div class="task_modified"><?php echo $task['6']; ?></div>
			</div>
		</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
<form class="m-3" action="/tasks/?action=addTask" method="POST" role="form">
    <div class="form-group">
        <input type="text" class="form-control" id="inputNickname" name="user_name" placeholder="Введите ваше имя">
    </div>
    <div class="form-group">
        <input type="email" class="form-control" id="inputEmail" name="mail" area-describedby="emailHelp" placeholder="Введите вашу почту">
    </div>
    <div class="form-group">
        <label for="inputText">Текст задачи:</label>
        <textarea class="form-control" id="inputText" name="text" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Создать задачу</button>
</form>
<footer></footer>
</body>
</html>
