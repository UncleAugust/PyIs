<?php
	session_start();
    // Get the input from the user
    $user_input = $_POST["code"];
	$user_id = $_SESSION['user_id'];
	$user_score = 0;
	$conn = new mysqli("localhost", "pyis", "9wAxegZQ8h!", "PyIs");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Save the code to a file
    file_put_contents("user_code_".$user_id.".py", $user_input);
    // Define the input values
    $input_values = [233,202,235,102,211,153];

    // Define the expected 	output values
    $expected_output = ['3 3 8', '2 0 4','5 3 10','2 0 3','1 1 4','3 5 9'];

    // Loop through the input values and execute the code
    for ($i=0; $i < count($input_values); $i++) { 
        $input_data = $input_values[$i];
        $expected_data = $expected_output[$i];

        // Execute the code and store the output
        $output = shell_exec('python3 -c "import io,sys; sys.stdin=io.StringIO(\''.$input_data.'\'); exec(open(\'user_code_'.$user_id.'.py\').read())"');
		
        // Compare the output with the expected output
        if(trim($output) == trim($expected_data))
        {
          echo "Test case $i: Passed\n";
		  $user_score++;
        }
        else
        {
          echo "Test case $i: Failed\n";
		  break;
        }
    }
	if($user_score==6) {
		// insert new
        $stmt = $conn->prepare("INSERT INTO compleatetasks (vkid, course, task) VALUES (?, 1, 3)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
	}
	$conn->close();
    //remove the file after testing
    unlink("user_code_".$user_id.".py");
	header('Location: https://pyis.fun/testing/course-one');
	exit;
?>
