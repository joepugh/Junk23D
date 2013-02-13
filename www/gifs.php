<html><body><h1>Completed Scans</h1>
<?php 
exec("ls /var/www/scans/", $scans);
foreach ($scans as &$scan) {
	echo "<a href='/scans/", $scan, "/", $scan, ".gif'><img src='/scans/", $scan, "/1.jpg' width='200' /></a>";
} 
?></p>
</body></html>
