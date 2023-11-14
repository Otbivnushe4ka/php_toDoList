<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>To-Do-List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="container">
		<div class="main-form">

			<h1>Your Lists</h1>
			<form method="post" action="addList.php">
				<input type="text" name="name" placeholder="List's name">
				<button type="submit">Add</button>
			</form>
		</div>
		<div class="lists">
			<?php
			session_start();
			if (!isset($_SESSION['user_id'])) {
				header("Location: login.php");
			}
			$id = $_SESSION['user_id'];

			include 'dbConn.php';

			$sql_profile = "SELECT users.fname, users.sname, users.email, genders.name AS 'gender'
							FROM users
							INNER JOIN genders
							ON genders.id = users.gender_id
							WHERE users.id = '$id'";
			$profile_result = mysqli_query($conn, $sql_profile);
			$profile = mysqli_fetch_assoc($profile_result);

			echo '<div class="profile">';
			if ($profile['gender'] == "male") {
				echo '<img src="image/male.png" height="150" width="150">';
			} else {
				echo '<img src="image/female.png" height="150" width="150">';
			}
			echo '<p>' . $profile['email'] . '</p>';
			echo '<p>' . $profile['fname'] . ' ' . $profile['sname'] . '</p>';
			echo '<p>' . $profile['gender'] . '</p>';
			echo '<form action="logout.php" method="post">';
			echo '<button type="submit">logout</button>';
			echo '</form>';
			echo '</div>';

			// get all lists
			$sql = "SELECT * FROM lists WHERE user_id='$id'";
			$result = mysqli_query($conn, $sql);

			// all lists output
			while ($list_row = mysqli_fetch_assoc($result)) {
				echo '<div class="list">';
				echo '<div class="list-header">';
				// list name
				echo '<h2 class="list-name" id="' . $list_row['id'] . '">' . $list_row['name'] . '</h2>';

				// drop down element
				echo '<div class="dropdown">';
				// drop down button
				echo '<button class="dropbtn">Menu</button>';
				echo '<div class="dropdown-content">';
				// delete list button
				echo '<a href="#" class="delete-list-btn" id="' . $list_row['id'] . '">Delete List</a>';
				// label with list made datetime
				echo '<a class="list-made-datetime">list made: ' . $list_row['made_datetime'] . '</a>';
				// input with list reaminig time
				echo ' <a><label for="date">Do it to:</label>';
				echo '<input value="' . $list_row['to_datetime'] . '" class="list-to-datetime" id="' . $list_row['id'] . '" name="date" type="datetime-local"/></a>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				// add task button
				echo '<h5 class="add-task-list" id="' . $list_row['id'] . '">Add Task</h5>';

				// get all tasks for that list
				echo '<div class="tasks" id="' . $list_row['id'] . '">';
				$tasks_result = mysqli_query($conn, "SELECT * FROM tasks WHERE lists_id=" . $list_row['id']);

				// output for every task
				while ($task_row = mysqli_fetch_assoc($tasks_result)) {
					echo '<div class="task-box">';
					// checkbox
					echo '<input type="checkbox" id="' . $task_row['id'] . '"';
					if ($task_row['completed'] == 1) {
						echo 'checked';
					}
					// task
					echo '>' . '<p class="task" title="made: ' . $task_row['made_datetime'] . '" id="' . $task_row['id'] . '">' . $task_row['item'] . '</p>';
					// delete task button
					echo '<button class="delete-task-btn" id="' . $task_row['id'] . '">Delete Task</button>';
					echo '</div>';
				}
				echo '</div>';
				echo '<div class="list-footer">';
				echo '<h5 class="time-remaining">Remainig: </h5>';
				echo '</div>';
				echo '</div>';
			}
			mysqli_close($conn);
			?>
		</div>
	</div>

	<script src="script.js"></script>
</body>

</html>