<html>
<?php 
	if ( $_GET["auto_refresh"] == "on" ) {
echo <<<END
<head><meta http-equiv="refresh" content="1;url=http://3dscanner.lvl1.org?auto_refresh=on"/></head>
END;
	}
?>
<body><h1>3D Scanner</h1>
<?php 
if (file_exists("/tmp/scan")) {
	echo "<p><b>scan in progress!</b>";
} else {
	if ( $_POST["action"] ) {
		if ( $_POST["action"] == "takepic" ) {
			system('takepic', $retval);
			echo "<p>Updated picture";

		} elseif ( $_POST["action"] == "laser" ) {
			system('send f', $retval);
			echo "<p>Firing laser for 2 seconds...";

		} elseif ( $_POST["action"] == "spin" ) {
			system('send n', $retval);
			echo "<p>Spinning 3 degrees";

		} elseif ( $_POST["action"] == "start_scan" ) {
			system('touch /tmp/scan_nolaser', $retval);

		} elseif ( $_POST["action"] == "start_scan_laser" ) {
			system('touch /tmp/scan_laser', $retval);

		} elseif ( $_POST["action"] == "both" ) {
			system('send f', $retval);
			system('takepic', $retval);
			echo "<p>Taking picture with laser";
		}
	}
}
?></p>
<img width="400" src="/pic.jpg?<? echo rand(1,3000);?>" />
<form method="post" action="<?php echo $PHP_SELF;?>">
<input type="hidden" name="action" value="" />
<input type="hidden" name="auto_refresh" value="<?php echo $_POST['auto_refresh']; ?>" />
<input type="button" value="Update Pic" onClick="document.forms[0].action.value='takepic';this.form.submit();"/>
<input type="button" value="Fire teh laser!" onClick="document.forms[0].action.value='laser';this.form.submit();"/>
<input type="button" value="Do Both" onClick="document.forms[0].action.value='both';this.form.submit();"/>
<br>
<input type="button" value="Spin Turntable" onClick="document.forms[0].action.value='spin';this.form.submit();"/>
<br>
<input type="button" value="Start Scan" onClick="document.forms[0].action.value='start_scan';this.form.submit();"/>
<input type="button" value="Start Scan with Laser" onClick="document.forms[0].action.value='start_scan_laser';this.form.submit();"/>
<br>
<?php
	if ( $_GET["auto_refresh"] == "on" ) {
echo <<<END
<a href="/">Auto Refresh Off</a>
END;
	} else {
echo <<<END
<a href="/?auto_refresh=on">Auto Refresh On</a>
END;
	}
?>
</form>
<h1>Completed Scans</h1>
<?php
exec("ls /var/www/scans/", $scans);
foreach ($scans as &$scan) {
        echo "<a href='/scans/", $scan, "/", $scan, ".gif'><img src='/scans/", $scan, "/001.jpg' width='100' /></a>";
} 
?></p>

</body></html>
