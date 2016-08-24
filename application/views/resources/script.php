<?php 
$js_script = array('jquery.2.2','jquery.dataTables','dataTables.responsive.min','materialize.min','script','jquery.validate.min','jquery.fancybox.pack');
$css_script = array('jquery.dataTables','responsive.dataTables.min','materialize.min','style','jquery.fancybox');

// for css
foreach ($css_script as $css_script) {?>
<link rel="stylesheet" type="text/css" href="<?php echo $script_url.'css/'.$css_script.'.css';?>">
<?php }
?>

<?php
// for js
foreach ($js_script as $js_script) {?>
<script src="<?php echo $script_url.'js/'.$js_script.'.js'?>"type="text/javascript"></script>
<?php }
?>