<html>
    <head>
        <meta charset='UTF-8'name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@400;600&display=swap" rel="stylesheet">  
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="/css/index.css">
        <link rel="stylesheet" type="text/css" href="/css/contactus.css">
        <link rel="stylesheet" type="text/css" href="/css/form.css">
        <title>
            Pet Mate
        </title>
    </head>
<body>
    <?php include('navbar.php') ?>
    <div class="info">        
        <form id="feedback-form" action="contactus.php" method="POST">
            <div class="form-control"> 
              <h2 class=form-item>FEEDBACK AND QUERIES</h2>
              <p class="form-item reqmail">We will reply to your queries if any through this mail address</p>
              <input type="email" id="yourmail" name="yourmail" placeholder="enter your mail here">
              <p class="form-item reqmail">We will send this mail to you and reply on that same mail so you can just view your inbox</p>
              <textarea rows=10 cols=20 name="feedbody" id="feedbody"></textarea>
              <p class="form-item reqmail">Select atleast one contact mail *</p>
              <label for="contact1">somemailone@gmail.com</label>
              <div class="radiostyle"><input type="checkbox" id="contact1" name="con1" value="somemailone@gmail.com" checked></div>
              <label for="contact2">somemailtwo@gmail.com</label>
              <div class=radiostyle><input type="checkbox" id="contact2" name="con2" value="somemailtwo@gmail.com"></div>
              <button type="button" id="opener" name="feedbtn" value="givenfeedback">DONE</button> 
            </div>
        </form>
    </div>
    <div id="dialog">some message</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/contactus.js"></script>
    <script type="text/javascript" src="/js/back_animations.js"></script>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer\src\PHPMailer.php';
    require 'PHPMailer\src\SMTP.php';
    require 'PHPMailer\src\Exception.php';

    if(isset($_POST['yourmail'])){
        $mail = new PHPMailer();
        $mail->isSMTP();                                           
        $mail->Host = 'smtp.gmail.com';    
        $mail->SMTPAuth=true;                                   
        $mail->SMTPSecure ='ssl';      
        $mail->Port = 465;
        $mail->isHTML();
        $mail->addAddress($_POST['yourmail']);
        $mail->Subject = "PETMATE FEEDBACK from {$_POST['yourmail']}";
        $mail->Body = $_POST['feedbody'];
        if(isset($_POST['con1'])){
            $mail->Username   = 'somemailone@gmail.com';//any other mail of your choice                     
            $mail->Password   = '**********';//password for the same                               
            $mail->setFrom('somemailone@gmail.com', 'User Name1');
            $mail->Send();

        }
        if(isset($_POST['con2'])){
            $mail->Username   = 'somemailtwo@gmail.com';//any other mail of your choice                     
            $mail->Password   = '**********';//password for the same                               
            $mail->setFrom('somemailtwo@gmail.com', 'User Name2');
            $mail->Send();
        }
    }
?>
</body>
</html>
