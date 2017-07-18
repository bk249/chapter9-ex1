<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        $name = trim($name);
        $email = trim($email);
        $phone = trim($phone);

        $name = strtolower($name);
        $name = ucwords($name);

        $i = strpos($name, ' ');
        if ($i === false) {
            $first_name = $name;
        } else {
            $first_name = substr($name, 0, $i);
        }
        
        /*************************************************
         * validate and process the email address
         ************************************************/
        if (empty($email)) {
            $message = 'Please enter an email address.';
            break;
        } else if(strpos($email, '@') === false) {
            $message = 'Please include @ sign.';
            break;
        } else if(strpos($email, '.') === false) {
            $message = 'Please include a dot character.';
            break;
        }

        /*************************************************
         * validate and process the phone number
         ************************************************/
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace(' ', '', $phone);

        if (strlen($phone) < 7) {
            $message = 'The phone number should be at least seven digits.';
            break;
        }

        /*************************************************
         * Display the validation message
         ************************************************/
        $message = 
            "Hello $first_name, \n\n" .
            "Thank you for entering this data:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n";

        break;
}
include 'string_tester.php';
?>