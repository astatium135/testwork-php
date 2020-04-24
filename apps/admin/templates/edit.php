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
		<h1>Редактирование задачи</h1>
		<form action="/edit" method="POST">
			<input type="hidden" name="id" value="<?=$task->id ?>">
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><img src="/static/post_add-24px.svg"></div>
				</div>
				<textarea class="form-control" type="text" name="text" placeholder="Текст задачи" required><?=htmlspecialchars($task->text) ?></textarea>
			</div>
			<input class="btn btn-success btn-block" type="submit" value="Сохранить">
		</form>
</div>
</body>
</html>