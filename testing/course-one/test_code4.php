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
    $input_values = ['Козерог\n30\n1000\nХодынский бульвар\n5\n5000000\n3','Близнецы\n15\n15295810\nПроспект ебеней\n9\n5105910582\n27','Кальмар\n28\n5678945677\nНовая улица\n808\n67898765\n99','Скорпион\n10\n90\nМосковский бульвар\n666\n987675436\n33','Водолей\n25\n3000\nНогиская улица\n77\n98701846910\n99','Рыбы\n31\n2159\nСтупино\n66\n9761764818\n101'];

    // Define the expected 	output values
    $expected_output = [0.008166666666666666, -3.235363121758641,86942.14145487771,-0.00013746563255768627,0.0,0.0002382727621523679];

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
	if($user_score==6) {
		// insert new
        $stmt = $conn->prepare("INSERT INTO compleatetasks (vkid, course, task) VALUES (?, 1, 4)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
	}
	$conn->close();
    //remove the file after testing
    unlink("user_code_".$user_id.".py");
	header('Location: https://pyis.fun/testing/course-one');
	exit;
?>
