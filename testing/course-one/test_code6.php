<?php
	session_start();
    // Get the input from the user
    $user_input = $_POST["code"];
	$user_id = $_SESSION['user_id'];
	$conn = new mysqli("localhost", "pyis", "9wAxegZQ8h!", "PyIs");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $output = "True";

    // Compare the output with the expected output
    if(trim($output) == trim($user_input))
    {
       echo "Good work!\n";
		// insert new
        $stmt = $conn->prepare("INSERT INTO compleatetasks (vkid, course, task) VALUES (?, 1, 6)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
	
	   
    }
    else{
		echo "NOPE";
	}
	$conn->close();
	header('Location: https://pyis.fun/testing/course-one');
	exit;
?>
