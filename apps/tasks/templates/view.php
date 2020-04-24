<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Список задач</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	<div class="container">
		<div align="right"><? if($_SESSION['user']) { ?>Добро пожаловать, <?= $_SESSION['user']['name'] ?><br><a href="/logout">Выйти из системы</a><? } else { ?><a href="/auth">Войти в систему</a><? } ?></div>
		<h1 align="center">Список задач</h1>
		<? if($success_add_task){ ?>
		<div class="alert alert-success" role="alert">
			Задача <?= htmlspecialchars($success_add_task) ?> успешно добавлена.
		</div>
		<? } ?>
		<? if($errors){ 
			foreach($errors as $error){ ?>
		<div class="alert alert-danger" role="alert">
			<?= $error ?>
		</div>
		<? } 
		} ?>
		<table class="table">
			<thead>
				<tr>
					<th>
						<a style="color: black" href="<?php 
						if($sort=="user"){
							if($order=="asc"){
								echo create_href(["sort"=>"user", "order"=>"desc"]);
							} else {
								echo create_href(["sort"=>"", "order"=>"asc"]);
							}				
						} else {
							echo create_href(["sort"=>"user", "order"=>"asc"]);
						} ?>">Автор<? if($sort=="user"){ ?><img src="/static/<?=$order=="asc"?"expand_less-24px.svg":"expand_more-24px.svg"?>"><? } ?></a>
					</th>
					<th>
						<a style="color: black" href="<?php 
						if($sort=="email"){
							if($order=="asc"){
								echo create_href(["sort"=>"email", "order"=>"desc"]);
							} else {
								echo create_href(["sort"=>"", "order"=>"asc"]);
							}				
						} else {
							echo create_href(["sort"=>"email", "order"=>"asc"]);
						} ?>">Email<? if($sort=="email"){ ?><img src="/static/<?=$order=="asc"?"expand_less-24px.svg":"expand_more-24px.svg"?>"><? } ?></a>
					</th>
					<th>Задача</th>
					<th>
						<a style="color: black" href="<?php 
						if($sort=="completed"){
							if($order=="asc"){
								echo create_href(["sort"=>"completed", "order"=>"desc"]);
							} else {
								echo create_href(["sort"=>"", "order"=>"asc"]);
							}				
						} else {
							echo create_href(["sort"=>"completed", "order"=>"asc"]);
						} ?>">Статус<? if($sort=="completed"){ ?><img src="/static/<?=$order=="asc"?"expand_less-24px.svg":"expand_more-24px.svg"?>"><? } ?></a>
					</th>
					<th>
						<a style="color: black" href="<?php 
						if($sort=="modified"){
							if($order=="asc"){
								echo create_href(["sort"=>"modified", "order"=>"desc"]);
							} else {
								echo create_href(["sort"=>"", "order"=>"asc"]);
							}				
						} else {
							echo create_href(["sort"=>"modified", "order"=>"asc"]);
						} ?>">Изменено<? if($sort=="modified"){ ?><img src="/static/<?=$order=="asc"?"expand_less-24px.svg":"expand_more-24px.svg"?>"><? } ?></a>
					</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($tasks as $task) { ?>
				<tr>
					<td><?= htmlspecialchars($task->user) ?></td>
					<td><?= htmlspecialchars($task->email) ?></td>
					<td><? if($_SESSION['user']){ ?><a href="/edit?id=<?= $task->id ?>"><? } ?><?= htmlspecialchars($task->text) ?><? if($_SESSION['user']){ ?></a><? } ?></td>
					<td><? if($_SESSION['user']){ ?><a href="/edit?id=<?= $task->id ?>&completed=<?= $task->completed?"0":"1" ?>"><? } ?><img src="/static/<?= $task->completed?"check-24px.svg":"close-24px.svg" ?>"><? if($_SESSION['user']){ ?></a><? } ?></td>
					<td><img src="/static/<?= $task->modified?"check-24px.svg":"close-24px.svg" ?>"></td>
				</tr>
				<? } ?>
			</tbody>
		</table>
		<? if($pages>1){ ?>
		<div class="btn-group" style="margin: 0 0 8px 0" role="group">
			<? if($page>0) { ?><a href="<?= create_href(['page'=>$page-1]) ?>" class="btn btn-secondary" role="button">Предыдущая</a><? } ?>
			<? for($i=0; $i<$pages; $i++) { ?>
			<a href="<?= create_href(['page'=>$i]) ?>" class="btn btn-secondary <? if($i==$page) echo "disabled"; ?>" role="button"><?= $i + 1 ?></a>
			<? } ?>
			<? if($page<$pages - 1) { ?><a href="<?= create_href(['page'=>$page+1]) ?>" class="btn btn-secondary" role="button">Следущая</a><? } ?>
		</div>
		<? } ?>
		<div>
			<form action="/add" method="POST">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><img src="/static/person-24px.svg"></div>
					</div>
					<input class="form-control" name="user" placeholder="Имя пользователя" required>
				</div>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><img src="/static/mail_outline-24px.svg"></div>
					</div>
					<input class="form-control" type="email" name="email" placeholder="Email" required>
				</div>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><img src="/static/post_add-24px.svg"></div>
					</div>
					<textarea class="form-control" type="text" name="text" placeholder="Текст задачи" required></textarea>
				</div>
				<input class="btn btn-success btn-block" type="submit" value="Добавить">
			</form>
		</div>
	</div>
</body>
</html>