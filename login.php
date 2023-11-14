<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login and Registration</title>
    <style>
        body {
            margin: auto;
            background-color: #f0f0f0;
            display: block;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 250px;
        }

        .book {
            position: relative;
            width: 600px;
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .login-form,
        .registration-form {
            margin: 10px;
        }

        .radio-form {
            display: flex;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 70%;
            margin-bottom: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .book-cover {
            position: absolute;
            width: 50%;
            height: 100%;
            left: 0;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            box-shadow: 10px -10px 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
            transition: all 1s;
        }
    </style>
</head>

<body>
    <div class="book">

        <form action="logUser.php" method="post" class="login-form">
            <h2>Login</h2>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email"><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password"><br>

            <input type="submit" name="login-btn" value="Log in">
        </form>

        <form action="addUser.php" method="post" class="registration-form">
            <h2>Registration</h2>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email"><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password"><br>

            <label for="fname">Name:</label><br>
            <input type="text" name="fname" id="fname"><br>

            <label for="sname">Surname:</label><br>
            <input type="text" name="sname" id="sname"><br>

            <div class="radio-form">
                <label for="gender">Gender:</label>
                <input type="radio" name="gender" id="male" value="male"> Male
                <input type="radio" name="gender" id="female" value="female"> Female<br>
            </div>

            <input type="submit" name="registration-btn" value="Register">
        </form>

        <div class="book-cover">
            <input type="submit" id="btn-animation" onclick="transform(this)" value="I have account">

        </div>
    </div>
</body>
<script>
    let transformBool = true;
    function transform(btn) {
        if (transformBool) {
            btn.parentNode.style.transform = "translateX(100%)";
            btn.value = "I dont have account";
            transformBool = false;
        } else {
            btn.parentNode.style.transform = "translateX(0%)";
            btn.value = "I have account";
            transformBool = true;
        }
    }
</script>

</html>