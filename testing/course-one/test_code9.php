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
    $input_values = [7, 47, 466, 160, 502, 970, 226, 310, 370, 481, 659, 448, 632, 453, 148, 905, 355, 698, 768, 28, 287, 649, 359, 576, 247, 238, 615, 246, 488, 368, 344, 373, 165, 568, 539, 840, 558, 821, 499, 379, 792, 184, 142, 699, 285, 558, 60, 780, 102, 15, 298, 773, 750, 890, 653, 598, 365, 142, 245, 820, 392, 14, 539, 488, 303, 52, 707, 219, 736, 96, 150, 220, 867, 901, 562, 199, 995, 776, 413, 533, 980, 404, 905, 271, 522, 192, 987, 510, 820, 257, 462, 499, 769, 561, 965, 213, 921, 727, 479, 190, 369];

    // Define the expected 	output values
    $expected_output = ['7 программистов', '47 программистов', '466 программистов', '160 программистов', '502 программиста', '970 программистов', '226 программистов', '310 программистов', '370 программистов', '481 программист', '659 программистов', '448 программистов', '632 программиста', '453 программиста', '148 программистов', '905 программистов', '355 программистов', '698 программистов', '768 программистов', '28 программистов', '287 программистов', '649 программистов', '359 программистов', '576 программистов', '247 программистов', '238 программистов', '615 программистов', '246 программистов', '488 программистов', '368 программистов', '344 программиста', '373 программиста', '165 программистов', '568 программистов', '539 программистов', '840 программистов', '558 программистов', '821 программист', '499 программистов', '379 программистов', '792 программиста', '184 программиста', '142 программиста', '699 программистов', '285 программистов', '558 программистов', '60 программистов', '780 программистов', '102 программиста', '15 программистов', '298 программистов', '773 программиста', '750 программистов', '890 программистов', '653 программиста', '598 программистов', '365 программистов', '142 программиста', '245 программистов', '820 программистов', '392 программиста', '14 программистов', '539 программистов', '488 программистов', '303 программиста', '52 программиста', '707 программистов', '219 программистов', '736 программистов', '96 программистов', '150 программистов', '220 программистов', '867 программистов', '901 программист', '562 программиста', '199 программистов', '995 программистов', '776 программистов', '413 программистов', '533 программиста', '980 программистов', '404 программиста', '905 программистов', '271 программист', '522 программиста', '192 программиста', '987 программистов', '510 программистов', '820 программистов', '257 программистов', '462 программиста', '499 программистов', '769 программистов', '561 программист', '965 программистов', '213 программистов', '921 программист', '727 программистов', '479 программистов', '190 программистов', '369 программистов'];

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
	if($user_score==101) {
		// insert new
        $stmt = $conn->prepare("INSERT INTO compleatetasks (vkid, course, task) VALUES (?, 1, 9)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
	}
	$conn->close();
    //remove the file after testing
    unlink("user_code_".$user_id.".py");
	header('Location: https://pyis.fun/testing/course-one');
	exit;
?>
