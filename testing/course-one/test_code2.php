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
    $input_values = ['100\n2351614\n23166\n13\n55','89\n6596636\n49018\n137\n17','40\n2617565\n11153\n38\n19','17\n2311132\n45873\n55\n19','60\n9486710\n19958\n130\n93'];

    // Define the expected 	output values
    $expected_output = [0.4382018993118867,0.1650157896302476,0.15555100670651564,0.009174959822933435,0.1906322766467567];

    // Loop through the input values and execute the code
    for ($i=0; $i < count($input_values); $i++) { 
        $input_data = $input_values[$i];
        $expected_data = $expected_output[$i];

        // Execute the code and store the output
        $output = shell_exec('python3 -c "import io,sys; sys.stdin=io.StringIO(\''.$input_data.'\'); exec(open(\'user_code_'.$user_id.'.py\').read())"');

        // Compare the output with the expected output
        if($output == $expected_data)
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
	if($user_score==5) {
		// insert new
        $stmt = $conn->prepare("INSERT INTO compleatetasks (vkid, course, task) VALUES (?, 1, 2)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
	}
	$conn->close();
    //remove the file after testing
    unlink("user_code_".$user_id.".py");
	header('Location: https://pyis.fun/testing/course-one');
	exit;
?>
