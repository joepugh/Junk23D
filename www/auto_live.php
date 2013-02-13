<html>
<head><meta http-equiv="refresh" content="1"/></head>
<body><h1>3D Scanner Live View</h1>
<?php 
if (file_exists("/tmp/scan")) {
	echo "scan in progress, not refreshing pic";
} else {
	echo "no scan, refreshed pic";
	system('takepic', $retval);
} 
?>
<br>
<img src="/pic.jpg?<? echo rand(1,3000);?>" width="400" />
</body></html>
