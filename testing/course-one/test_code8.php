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
    $input_values = ['8\n2\n14','20\n5\n15', '6\n6\n6', '1\n10\n20', '12\n12\n12','30\n20\n10','15\n5\n30','40\n15\n20','25\n25\n25','30\n10\n15','20\n20\n20','25\n30\n35','20\n25\n30','15\n20\n25','10\n15\n20'];

    // Define the expected 	output values
    $expected_output = ['14 2 8','20 5 15','6 6 6','20 1 10','12 12 12','30 10 20','30 5 15','40 15 20','25 25 25','30 10 15','20 20 20','35 25 30','30 20 25','25 15 20','20 10 15'];

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
	if($user_score==15) {
		// insert new
        $stmt = $conn->prepare("INSERT INTO compleatetasks (vkid, course, task) VALUES (?, 1, 8)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
	}
	$conn->close();
    //remove the file after testing
    unlink("user_code_".$user_id.".py");
	header('Location: https://pyis.fun/testing/course-one');
	exit;
?>
