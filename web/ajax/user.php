<?php
//include conn file
  require_once('../connections/conn.php');

  $action=$_POST['action'];

  if($action =="sign_in"){
    $username=$_POST['username'];
    $password=$_POST['password'];


    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(array(':username' => $username));
    $row = $stmt->fetch();


    if(isset($row['id'])){
        //found a match
        if($row['username']==$username && $row['password']==$password){
            $arr = array('user_id' => $row['id']);
        }elseif($row['username']==$username){
            $arr = array('error_msg' => 'wrong password!');
        }
        else{
             $arr = array('error_msg' => 'Username does not exist, please create an new account');
        }
    }
    else{
        $arr = array('error_msg' => 'Username does not exist, please create a new account');
    }


    echo json_encode($arr);

  }
  elseif($action =="register"){
    $name=$_POST['name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    //check if this username or email already exists
    $check_user_stmt = $db->prepare("SELECT * from users where username = :username or email = :email");
    $check_user_stmt->execute(array(':username' => $username,':email' => $email));
    $row= $check_user_stmt->fetch();

    if(isset($row['username'])){
      if($username==$row['username'] && $email==$row['email'] ){
            $arr = array('error_msg' => 'Username and email are already used. Choose another username and email or click <a href="http://ouafaehaddouchi.tk">here</a> to log in');
            echo json_encode($arr);
            exit;
        }
        elseif($username==$row['username']){
            $arr = array('error_msg' => 'Username is already used. Choose another username or click <a href="http://ouafaehaddouchi.tk">here</a> to log in');
            echo json_encode($arr);
            exit;
        }
        else{
            $arr = array('error_msg' => 'Email is already used. Choose another email or click <a href="http://ouafaehaddouchi.tk">here</a> to log in');
            echo json_encode($arr);
            exit;
        }  
    }
    

    $check_user_stmt=null;

    $insert_user_stmt = $db->prepare("INSERT INTO users(name,username,email,password,join_date) VALUES(:name,:username,:email,:password,NOW())");
    $insert_user_stmt->execute(array(':name' => $name, ':username' => $username,':email' => $email,':password' => $password));

    //return the user id
    $user_id= $db->lastInsertId();
    $arr = array('user_id' => $user_id);

    echo json_encode($arr);

    $insert_user_stmt = null;
  }
  elseif($action =="reset"){
        require_once('../lib/phpmailer/phpmailer.php');

        $mail = new PHPMailer;

        $mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server
        $mail->Port = 587;                                    // Set the SMTP port
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'MANDRILL_USERNAME';                // SMTP username
        $mail->Password = 'MANDRILL_APIKEY';                  // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

        $mail->From = 'oehaddouchi@gmail.com';
        $mail->FromName = 'Your From name';
        $mail->AddAddress('oehaddouchi@gmail.com', 'Josh Adams');  // Add a recipient
        $mail->AddAddress('oehaddouchi@gmail.com');               // Name is optional

        $mail->IsHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <strong>in bold!</strong>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->Send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
        }

        echo 'Message has been sent';
  }
  $stmt=null;
?>