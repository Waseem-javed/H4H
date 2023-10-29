<?php
require_once '../php/user.class.php';
require_once '../php/session.class.php';
require_once '../php/database.class.php';
require_once '../php/query.class.php';
require_once '../php/general.class.php';
$user = Session::getUser();
if (!$user || $user->getRole() != 1) {
    header('Location: ../');
    exit();
}

$errorMessages = array(
    'global' => ''
);
$data = Query::select('SELECT `users`.`id`, `users`.`username`, `users`.`password`, `users`.`email`, `users`.`date_created`, `users`.`activated`, `users`.`sign_in_count`, `users`.`banned`, `roles`.`id` AS `role_id`, `roles`.`name` AS `role` FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id`');
if ($data === false) {
    $errorMessages['global'] = 'Database error';
} else if (sizeof($data) === 0) {
    $errorMessages['global'] = 'Table is empty';
} else {
    foreach ($data as $row => $values) {
        $data[$row] = General::outputArray($values);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Users | Secure Website</title>
		<meta name="description" content="View users table.">
		<meta name="keywords" content="HTML, CSS, PHP, JavaScript, jQuery, secure, website">
		<meta name="author" content="Ivan Šincek">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="../img/favicon.ico">
		<link rel="stylesheet" href="../css/main.css" hreflang="en" type="text/css" media="all">
		<script src="../js/jquery.js"></script>
		<script src="../js/main.js" defer></script>
	</head>
	<body>
		<?php require_once '../components/navigation.php'; ?>
		<div class="crud-list">
			<header>
				<h1 class="title">Users</h1>
			</header>
			<a href="./add.php" class="add-new">Add new</a>
			<p class="error-global"><?php echo $errorMessages['global']; ?></p>
			<div class="crud-table">
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Password</th>
							<th>Email</th>
							<th>Date created</th>
							<th>Activated</th>
							<th>Sign in count</th>
							<th>Banned</th>
							<th>Role</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php if ($data): ?>
							<?php foreach ($data as $d): ?>
								<tr>
									<td class="right"><?php echo $d['id']; ?></td>
									<td><?php echo $d['username']; ?></td>
									<td><?php echo $d['password']; ?></td>
									<td><?php echo $d['email']; ?></td>
									<td class="center"><?php echo $d['date_created']; ?></td>
									<td class="center"><?php echo $d['activated']; ?></td>
									<td class="center"><?php echo $d['sign_in_count']; ?></td>
									<td class="center"><?php echo $d['banned']; ?></td>
									<td><a href="../roles/view.php?id=<?php echo $d['role_id']; ?>" class="foreign-key"><?php echo $d['role']; ?></a></td>
									<td class="center"><a href="./view.php?id=<?php echo $d['id']; ?>" class="control">View</a></td>
									<td class="center"><a href="./edit.php?id=<?php echo $d['id']; ?>" class="control">Edit</a></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php require_once '../components/footer.php'; ?>
	</body>
</html>
