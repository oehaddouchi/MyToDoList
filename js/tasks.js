

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

// Create a new list item when clicking on the "Add" button
function newElement_test(task_id) {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  li.className="task-item";
  li.dataset.id = task_id;
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

function newElement(task_id,name,date) {
  return '<li class="task-item" data-id="'+task_id+'">'+name+'<div style="font-size:x-small;"><span class="">Updated: '+date+'</span></div><span class="close">×</span></li>';
}

function add_task(){
    var user_id=$('#user_id').val(); 
    var name=$('#myInput').val();

    var data ={'action':'insert_task','user_id':user_id,'name':name};
    
     $.ajax({
        url: "ajax/tasks.php",
        type: "post",
        data: data ,
        success: function (response) {
           var response_arr = $.parseJSON(response);
           var new_li = newElement(response_arr['id'],name,response_arr['date']);           
          $("#myUL").append(new_li);
          $('#myInput').val('');
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


 $(document).on('click', '.close', function(){
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