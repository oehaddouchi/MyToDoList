<?php
//include conn file
  require_once('../connections/conn.php');

  $action=$_POST['action'];

  if($action =="sign_in"){
    $username=$_POST['username'];
    $password=$_POST['password'];


    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username or password = :password");
    $stmt->execute(array(':username' => $username,':password' => $password));
    $row = $stmt->fetch();


    if(isset($row['id'])){
        //found a match
        if($row['username']==$username && $row['password']==$password){
            $arr = array('id' => $row['id'], 'logged_in' => true);
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
  $stmt=null;
?>