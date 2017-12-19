<?php 
  session_start();
  require_once('include/header.php');
  require_once('connections/conn.php');
?>
<link href="../css/login.css" rel="stylesheet">
<div class="container">
	<form id="form" action="http://ouafaehaddouchi.tk/tasks.php"  method="post">
   <input type="hidden" name="user_id" id="user_id" value="<?php if(isset($_POST['user_id'])){ echo $_POST['user_id']; } ?>">
    		<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">My ToDo List</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
           <div id="formAlert" class="alert alert-warning" style="display:none;">  
            <a class="close">×</a>  
            <strong>Warning!</strong> <span>Make sure all fields are filled and try again.</span>
           </div>
            <div id="formError" class="alert alert-danger" style="display:none;">  
            <a class="close">×</a>  
            <strong>Error!</strong> <span id="error_msg"></span>
           </div>
					<form class="form-horizontal" method="post" action="#">
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<button id="sign_in" type="button"  class="btn btn-primary btn-lg btn-block login-button">Sign in</button>
						</div>
						<div class="login-register">
				            <a href="create_account.php">Create account</a> or <a href="reset_password.php">reset password</a>
				         </div>
					</form>
				</div>
			</div>
			</form>
		</div>


<?php 
  require_once('include/footer.php');
?>