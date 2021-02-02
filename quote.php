<?php
  
if($_POST) {
    $first_name = "";
    $last_name = "";
    $email = "";
    $service = "";
    $additional_info = "";
    $email_body = "<div>";
      
    if(isset($_POST['first_name'])) {
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>First Name:</b></label>&nbsp;<span>".$first_name."</span>
                        </div>";
    }

    if(isset($_POST['last_name'])) {
        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Last Name:</b></label>&nbsp;<span>".$last_name."</span>
                        </div>";
    }
 
    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Email:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }
      
    if(isset($_POST['service'])) {
        $service = filter_var($_POST['service'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Service:</b></label>&nbsp;<span>".$service."</span>
                        </div>";
    }
      
    if(isset($_POST['additional_info'])) {
        $additional_info = htmlspecialchars($_POST['additional_info']);
        $email_body .= "<div>
                           <label><b>Additional Info:</b></label>
                           <div>".$additional_info."</div>
                        </div>";
    }
      
    $recipient = "hello@bestchoicemedia.co.uk";
    
    $subject = "Quote Request"

    $email_body .= "</div>";
 
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
    .'Subject: ' . $subject . "/r/n";
    
    if(mail($recipient, $email_title, $email_body, $headers)) {
        echo "<p>Thank you for contacting us, $first_name. You will get a reply within 24 hours.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
      
} else {
    echo '<p>Something went wrong</p>';
}
?>