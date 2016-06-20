<?php
//ONLY PROCESS $_POST REQUESTS
if($_SERVER["REQUEST_METHOD"] == "POST"):
    $filtered_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $filtered_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);  
    $filtered_phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $filtered_message = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);

    //CHECK FOR CAPTCHA ERROR
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        $secret = '6Lfe9SITAAAAAOeJScxSxJ1fdkVMKIM3IX_nBiax';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        //VERIFY CAPTCHA
        if($responseData->success):
            //VERIFY FORM DATA
            if(!empty($filtered_name) || !filter_var($filtered_email, FILTER_VALIDATE_EMAIL) || !empty($filtered_phone) || !empty($filtered_message)):
                $to = 'Resume Website <dino@mastrianni.biz>';
                $subject = 'Message from mastrianni.me';
                $message = '
                <html>
                <head>
                  <title>'.$filtered_name.'</title>
                </head>
                <body>
                  <p>You have received a message from your contact form on mastrianni.me:</p>
                  <p><strong>Name:</strong> '.$filtered_name.'</p>
                  <p><strong>E-Mail:</strong> '.$filtered_email.'</p>
                  <p><strong>Phone:</strong> '.$filtered_phone.'</p>
                  <br>
                  <p><strong>Message:</strong></p>
                  <p>'.$filtered_message.'</p>
                </body>
                </html>
                ';

                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Additional headers
                $headers .= 'From: Resume Website <resume@mastrianni.me>' . "\r\n";

                // Mail it
                if (mail($to, $subject, $message, $headers)) {
                    // Set a 200 (okay) response code.
                    http_response_code(200);
                    echo "Thank You! Your message has been sent.";
                } else {
                    // Set a 500 (internal server error) response code.
                    http_response_code(500);
                    echo "Something went wrong and we couldn't send your message.";
                }
            else:
                http_response_code(400);
                echo 'There was a problem with your submission. Please complete the form and try again.';
            endif;
        else:
            // If it's not successful, then one or more error codes will be returned.
            http_response_code(400);
            echo 'Robot verification failed, please try again.';
        endif;
    else:
        http_response_code(400);
        echo 'Please click on the reCAPTCHA box.';
    endif;
else:
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
endif;
?>