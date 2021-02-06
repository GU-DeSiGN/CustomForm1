<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "hello@bestchoicemedia.co.uk";
        
        # Sender Data
        $first_name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["first_name"])));
        $last_name = $_POST["last_name"];
        $property_type = $_POST["property_type"];
        $bedrooms_number = $_POST["bedrooms_number"];
        $need_packing = $_POST["need_packing"];
        $moving_date = $_POST["moving_date"];
        $moving_from = $_POST["moving_from"];
        $moving_to = $_POST["moving_to"];
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $subject = "New Quote Request from: $first_name $last_name";
        $message = trim($_POST["message"]);
        
        if ( empty($first_name) OR empty($last_name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($property_type) OR empty($bedrooms_number) OR empty($need_packing) OR empty($moving_date) OR empty($moving_from) OR empty($moving_to) OR empty($phone) OR empty($subject) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }
        
        # Mail Content
        $content = "First Name: $first_name\n\n";
        $content .= "Last Name: $last_name\n\n";
        $content .= "Property Type: $property_type\n\n";
        $content .= "Number of Bedrooms: $bedrooms_number\n\n";
        $content .= "Packing Nedded: $need_packing\n\n";
        $content .= "Moving Date: $moving_date\n\n";
        $content .= "Moving From: $moving_from\n\n";
        $content .= "Moving To: $moving_to\n\n";
        $content .= "Email: $email\n\n";
        $content .= "Phone: $phone\n\n";
        $content .= "Message:\n$message\n";

        # email headers.
        $headers = "From: $email";

        # Send the email.
        $success = mail($mail_to, $subject, $content, $headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong, we couldn't send your message.";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
