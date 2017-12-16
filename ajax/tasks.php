 <?php 
  //include conn file
  require_once('../connections/conn.php');

  $action=$_POST['action'];

  if($action=='insert_task'){
    $name=$_POST['name'];
    $user_id=$_POST['user_id'];


    $stmt = $db->prepare("INSERT INTO tasks(user_id,name,checked,create_date,update_date) VALUES(:userID,:name,0,NOW(),NOW())");
    $stmt->execute(array(':userID' => $user_id,':name' => $name));
    
  }
  elseif($action=='update_task'){
    $task_id=$_POST['task_id'];
    $checked=$_POST['checked'];
    
    
    $stmt = $db->prepare("UPDATE tasks set checked = :checked, update_date= NOW() where  id=:taskID");
    $stmt->execute(array(':checked' => $checked,':taskID' => $task_id));

 }elseif($action=='delete_task'){
    $task_id=$_POST['task_id'];
    
    $stmt = $db->prepare("DELETE FROM tasks where id=:taskID");
    $stmt->execute(array(':taskID' => $task_id));
 }
    $stmt=null;

?>