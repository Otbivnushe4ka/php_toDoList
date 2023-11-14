// checkbox updating
const checkboxes = document.querySelectorAll('input[type="checkbox"]');

checkboxes.forEach(function (checkbox) {
	checkbox.addEventListener('click', function () {
		const xhr = new XMLHttpRequest();
		xhr.open('POST', 'checkUpdate.php');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('id=' + this.id + '&completed=' + this.checked);
	});
});


// task deleting
const deleteTaskBtn = document.querySelectorAll('.delete-task-btn');

deleteTaskBtn.forEach(function (button) {
	button.addEventListener('click', function () {
		const xhr = new XMLHttpRequest();
		xhr.open('POST', 'deleteTask.php');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('id=' + this.id);
		// delete this task
		button.parentNode.remove();
	});
});


// task updating
const taskList = document.querySelectorAll('.task');

taskList.forEach(function (p) {
	p.addEventListener('click', function (event) {
		// task replacing with input
		const task = event.target;
		const input = document.createElement('input');
		input.value = task.innerText;
		task.replaceWith(input);

		input.addEventListener('keyup', function (event) {
			// when user click a enter, function update data in db and replacing input with p
			if (event.key === 'Enter') {
				const taskid = task.id;
				const taskvalue = input.value;
				const taskTitle = task.title;
				const newTask = document.createElement('p');
				newTask.classList.add('task');
				newTask.id = taskid;
				newTask.title = taskTitle;
				newTask.innerText = taskvalue;
				input.replaceWith(newTask);

				const xhr = new XMLHttpRequest();
				xhr.open('POST', 'taskUpdate.php');
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhr.send('id=' + taskid + '&item=' + taskvalue);
			}
		});
	});
});


// list names updating
const listNames = document.querySelectorAll('.list-name');

listNames.forEach(function (h2) {
	h2.addEventListener('click', function (event) {
		// list name replacing with input
		const list = event.target;
		const input = document.createElement('input');
		input.value = list.innerText;
		list.replaceWith(input);

		input.addEventListener('keyup', function (event) {
			if (event.key === 'Enter') {
				const listid = list.id;
				const listName = input.value;

				const newName = document.createElement('h2');
				newName.classList.add('list-name');
				newName.id = listid;
				newName.innerText = listName;
				input.replaceWith(newName);

				const xhr = new XMLHttpRequest();
				xhr.open('POST', 'listNameUpdate.php');
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhr.send('id=' + listid + '&name=' + listName);
			}
		});
	});
});


// task adding
const taskAdder = document.querySelectorAll('.add-task-list');

taskAdder.forEach(function (a) {
	a.addEventListener('click', function (event) {
		// link replacing with input
		const tag = event.target;
		const input = document.createElement('input');
		tag.replaceWith(input);

		input.addEventListener('keyup', function (event) {
			if (event.key === 'Enter') {
				const listsid = tag.id;
				const taskvalue = input.value;

				const xhr = new XMLHttpRequest();
				xhr.open('POST', 'addTask.php');
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhr.send('lists_id=' + listsid + '&item=' + taskvalue);
				window.location.reload();
			}
		});
	});
});


// list deleting
const deleteListBtn = document.querySelectorAll('.delete-list-btn');

deleteListBtn.forEach(function (a) {
	a.addEventListener('click', function () {
		const text = `You wanna delete ${this.id} list?`;
		const userInput = confirm(text);
		if (userInput) {

			const xhr = new XMLHttpRequest();
			xhr.open('POST', 'deleteList.php');
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.send('id=' + this.id);

			// list deleting in the frontend
			this.parentNode.parentNode.parentNode.parentNode.remove();
		}
	});
});


// time updating
const listToDatetime = document.querySelectorAll('.list-to-datetime');

listToDatetime.forEach(function (input) {
	input.addEventListener('input', function (event) {
		const listsid = input.id;
		const datetime = input.value;

		const xhr = new XMLHttpRequest();
		xhr.open('POST', 'DatatimeUpdate.php');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('id=' + listsid + '&made_datetime=' + datetime);

		remainTime();
	});
});


// time counter
remainTime();
function remainTime() {
	const listElements = document.querySelectorAll('.list');
	listElements.forEach(listElement => {
		// get a real time
		const nowDatetime = new Date();

		// get a time from button if its not empty
		const toDatetime = ((listElement.querySelector('.list-to-datetime').value == '') ? null : new Date(listElement.querySelector('.list-to-datetime').value));
		let timeRemaining = '';
		if (toDatetime != null) {
			// This difference is then used to calculate the remaining time or overdue time for the task.
			const diffInMs = toDatetime.getTime() - nowDatetime.getTime();

			if (diffInMs > 0) {
				timeRemaining = `Remainig: ${dateDiff(diffInMs)}`
				listElement.style.background = "#A5C9CA";
			}
			else {
				timeRemaining = `Overdue by: ${dateDiff(Math.abs(diffInMs))}`;
				listElement.style.background = "#caa5a5";
			}
		}
		// timediff output
		listElement.querySelector('.time-remaining').innerText = timeRemaining;
	});

	// counter function
	function dateDiff(diffInMs) {
		const diffInMinutes = Math.floor(diffInMs / (1000 * 60));
		const diffInHours = Math.floor(diffInMs / (1000 * 60 * 60));
		const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));
		
		if (diffInMinutes < 60) {
			return `${diffInMinutes} minutes`;
		} else if (diffInHours < 24) {
			return `${diffInHours} hours`;
		} else {
			return `${diffInDays} days`;
		}
	}
}