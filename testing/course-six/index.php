<?php 

session_start();
// check if the user is authorized
if(session_status() == PHP_SESSION_ACTIVE) {
    if (isset($_SESSION['user_id'])) {
        echo $_SESSION['user_id']; 
    } else {
        // user is not logged in, redirect to login page
        header('Location: https://pyis.fun/');
		exit;
    }
}
else{
	header('Location: https://pyis.fun/');
	exit;
}
?>
<html>
<head>
    <title>Testing</title>
</head>
<body>
    <h1>Enter your Python code here:</h1>
    <form action="test_code.php" method="post">
        <textarea name="code" rows="10" cols="50"></textarea>
        <br>
        <input type="submit" value="Test Code">
    </form>
</body>
</html>