<?php
$myfile = fopen("webdirectory.txt", "r") or die("unable to open file");
echo fread($myfile,filesize("webdirectory.txt"));
fclose($myfile);
?>