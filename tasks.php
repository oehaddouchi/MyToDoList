<?php 
  require_once('include/header.php');
  require_once('connections/conn.php');
?>
 <link href="../css/tasks.css" rel="stylesheet">
<div class="container">
    <input type="hidden" id="user_id" value="1">
    <div id="myDIV" class="list-header">
    <h2 style="margin:5px">My To Do List</h2>
    <input type="text" id="myInput" class="task-name" placeholder="Title...">
    <span id="add_a_task" class="addBtn">Add</span>
</div>
<ul class="task-list" id="myUL">
<?php
//get all tasks from DB for admin
$user_id=1;
$stmt = $db->prepare("SELECT * FROM tasks where user_id =:userID");
$stmt->execute(array(':userID' => $user_id));

    // output data of each row
    while ($task = $stmt->fetch()) {
   
        if($task["checked"]>0){
          $checked=' checked';
        }
        else{
           $checked="";
        }
        echo '<li class="task-item'.$checked.'" data-id="'.$task["id"].'">' . $task["name"];
        echo '<div style="font-size:x-small;"><span class="">Updated: ' . $task["update_date"].'</span></div>';
        echo '<span class="close">×</span></li>';
    }

?>
 
</ul>

    </div><!-- /.container -->

<?php 
  require_once('include/footer.php');
  ?>