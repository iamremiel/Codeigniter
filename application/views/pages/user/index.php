<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


 <?php 
switch ($page) {
	case 'members_area':
		echo "string";
		break;
		default:?>
		<form style="border:5px solid #c0c0c0;padding:20px;max-width:700px;"class="container"method="post" action="<?php echo base_url('vuser/login_ctrl');?>">
		   <?php if ($message=='error') {
            ?>
      <div class="alert alert-danger " role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Warning!</strong><br> Invalid or not yet validated!
            </div>  
        <?php } ?>
		<label>Email:</label>
		<p><input type="text" class="form-control" required name="email" placeholder="Email"></p>
		<label>Password:</label>
		<p><input type="text" class="form-control" required name="pass" placeholder="Password"></p>
		<p><button class="btn btn-primary btn-sm">Submit</button></p>
		</form>

<?php break;
}
	?>

      
</body>
</html>