<?php 
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Выберите действие</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
	<?php  foreach($data as $id => $task): ?>
    	    <div class="row m-3">
		<div id=<?php echo '"' . $task['0'] . '"';?> class="col-md-1">
		    <div class="user_name"><?php echo $task['2']; ?></div>
		    <div class="user_email"><?php echo $task['3']; ?></div>
		    <div class="task_text"><?php echo $task['4']; ?></div>
		</div>
    	    </div>
	<?php endforeach; ?>
	<form class="m-3" action="/tasks?action=addTask" method="POST" role="form">
	    <div class="form-group">
		<label for="inputNickname">Input your nickname</label>
		<input type="text" class="form-control" id="inputNickname">
	    </div>
	    <div class="form-group">
		<label for="inputEmail">Input your email</label>
		<input type="email" class="form-control" id="inputEmail" area-describedby="emailHelp" placeholder="Enter email">
	    </div>
	    <div class="form-group">
		<label for="inputText">Input task text</label>
		<textarea class="form-control" id="inputText" rows="3"></textarea>
	    </div>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
        <footer></footer>
    </body>
</html>
