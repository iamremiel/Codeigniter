<html>
<head>   
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
include ('calendar.php');
$calendar = new Calendar();
echo $calendar->show();
?>
<script>
	function clicked(){
		alert('<?php echo "asdasd";?>');
	}
</script>
</body>
</html>       