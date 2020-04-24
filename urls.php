<?php
	require_once "apps/tasks/views.php";
	require_once "apps/admin/views.php";
	$urlpatterns = [
		['/', 'view'],
		['/auth', 'auth'],
		['/add', 'add'],
		['/edit', 'edit']
		];