<?php


    /* PHPMailer files
    ========================================================================== */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';


    /* Main email address
    ========================================================================== */
    $email_address = 'example@example.com';
    $your_name     = 'Your name';


    /* SMTP email username and password
    ========================================================================== */
    $SMTP_Server   = 'false';
    $SMTP_Username = 'example@gmail.com';
    $SMTP_Password = 'example@gmail.com password';


    /* reCaptcha
    ========================================================================== */
    $secretKey = '6LebZIAUAAAAADiZCqcJjea4l7OCog7_-0VoSPZc';

    if ( isset( $_POST['g-recaptcha-response'] ) ) {
        $captcha = $_POST['g-recaptcha-response'];
    } else {
        echo '<div class="error-message">Please check the the captcha keys.</div>';
        exit;
    }

    $url          = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode( $secretKey ) .  '&response=' . urlencode( $captcha );
    $response     = file_get_contents( $url );
    $responseKeys = json_decode( $response, true );

    if ( $responseKeys['success'] === false ) {
        echo '<div class="error-message">' . $responseKeys['error-codes'][0] . '</div>';
        exit;
    }


    /* Form variables
    ========================================================================== */
    $form_name             = $_POST['form_name'];
    $form_email            = $_POST['form_email'];
    $form_phone            = $_POST['form_phone'];
    $form_choose_car       = $_POST['form_choose_car'];
    $form_pickup_location  = $_POST['form_pickup_location'];
    $form_dropoff_location = $_POST['form_dropoff_location'];
    $form_pickup_date      = $_POST['form_pickup_date'];
    $form_dropoff_date     = $_POST['form_dropoff_date'];
    $form_notes            = $_POST['form_notes'];
    $form_domain           = $_POST['form_domain'];


    /* Message
    ========================================================================== */
    $email_subject = 'Car reservation';
    $email_body    =
"You have been contacted by <b>$form_name</b> with regards to <b>car reservation</b> and the details as follows:
<br><br>
Name: $form_name
<br><br>
Email address: $form_email
<br><br>
Phone number: $form_phone
<br><br>
Car: $form_choose_car
<br><br>
Pickup location: $form_pickup_location
<br><br>
Dropoff location: $form_dropoff_location
<br><br>
Pickup date: $form_pickup_date
<br><br>
Dropoff date: $form_dropoff_date
<br><br>
Notes: $form_notes
<br><br>
This e-mail was sent via a contact form from $form_domain
";


    /* Send
    ========================================================================== */
    $mail          = new PHPMailer;
    $mail->CharSet = 'UTF-8';

    // SMTP server
    if ( $SMTP_Server === 'true' ) {
        $mail->isSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $SMTP_Username;
        $mail->Password   = $SMTP_Password;
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    }

    $mail->isHTML(true);
    $mail->SetFrom( $form_email, $form_name );
    $mail->addAddress( $email_address, $your_name );
    $mail->addReplyTo( $form_email, $form_name );

    $mail->Subject = $email_subject;
    $mail->Body    = $email_body;

    if ( !$mail->send() ) {
        echo '<div class="error-message">Message could not be sent: ' . $mail->ErrorInfo . '</div>';
    } else {
        echo '<div class="success-message">Thank you ' . $form_name . ', we have received your message and will get back to you asap.</div>';
    }


?>