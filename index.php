
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/icon.ico">

    <title>Ouafae Haddouchi</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="../css/starter-template.css" rel="stylesheet">
  </head>

  <body>

  <?php 
  //include conn file
  require_once('connections/conn.php');
  ?>
    <div class="container">
    <input type="hidden" id="user_id" value="1">
    <div id="myDIV" class="header">
  <h2 style="margin:5px">My To Do List</h2>
  <input type="text" id="myInput" placeholder="Title...">
  <span id="add_a_task" class="addBtn">Add</span>
</div>
<ul id="myUL">
<?php
//get all tasks from DB for admin
//$statement = $db->prepare("SELECT * FROM tasks where user_id =1");
$user_id=1;
$stmt = $db->prepare("SELECT * FROM tasks where user_id =:userID");
$stmt->execute(array(':userID' => $user_id));
    // output data of each row
    while ($row = $stmt->fetch()) {
   
        if($row["checked"]>0){
          $checked=' checked';
        }
        else{
           $checked="";
        }
        echo '<li class="task-item'.$checked.'" data-id="'.$row["id"].'">' . $row["name"];
        echo '<div style="font-size:x-small;"><span class="">Updated: ' . $row["update_date"].'</span></div>';
        echo '<span class="close">×</span></li>';
    }

?>
 
</ul>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
    <script>
        $(document).ready(function() {
            $("img[src$='https://cdn.rawgit.com/000webhost/logo/e9bd13f7/footer-powered-by-000webhost-white2.png']").parent().parent().remove();
        });
    </script>
    <script>
// Create a "close" button and append it to each list item
/*
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  //var task_id = myNodelist.data("id");
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  //span.setAttribute('data', "id: '"+task_id+"'");
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}*/

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

// Create a new list item when clicking on the "Add" button
function newElement() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("myInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}

function add_task(){
    var user_id=$('#user_id').val(); 
    var name=$('#myInput').val();
    newElement();

    var data ={'action':'insert_task','user_id':user_id,'name':name};
    
     $.ajax({
        url: "ajax/tasks.php",
        type: "post",
        data: data ,
        success: function (response) {
           //alert(response);                

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}

$('#myInput').keypress(function(event) {
        if (event.keyCode == 13) {
            add_task();
        }
});

$("#add_a_task").click(function() {
   add_task();

});

$(".task-item").click(function() {
    var task_id=$(this).data("id");
    var checked = $(this).hasClass("checked")? 0 : 1;
    
    var data ={'action':'update_task','task_id':task_id,'checked':checked};
    
     $.ajax({
        url: "ajax/tasks.php",
        type: "post",
        data: data ,
        success: function (response) {
           //alert(response);                

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

});

$(".close").click(function() { 
   var task_id=$(this).parent().data("id");
    
    var data ={'action':'delete_task','task_id':task_id};
    
     $.ajax({
        url: "ajax/tasks.php",
        type: "post",
        data: data ,
        success: function (response) {
           //alert(response);                

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

   $(this).parent().hide();
});
</script>
  </body>
</html>
