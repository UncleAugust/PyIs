<?php
    // Get the input from the user
    $user_input = $_POST["code"];

    // Save the code to a file
    file_put_contents("user_code.py", $user_input);

    // Define the input values
    $input_values = [1,2,3];

    // Define the expected 	output values
    $expected_output = [2,4,6];

    // Loop through the input values and execute the code
    for ($i=0; $i < count($input_values); $i++) { 
        $input_data = $input_values[$i];
        $expected_data = $expected_output[$i];

        // Execute the code and store the output
        $output = shell_exec('python3 -c "import io,sys; sys.stdin=io.StringIO(\''.$input_data.'\'); exec(open(\'user_code.py\').read())" ');

        // Compare the output with the expected output
        if($output == $expected_data)
        {
          echo "Test case $i: Passed\n";
        }
        else
        {
          echo "Test case $i: Failed\n";
        }
    }
    //remove the file after testing
    unlink("user_code.py");
?>
