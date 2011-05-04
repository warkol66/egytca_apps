<?
if (isset($gid) AND isset($pos)){
	include('../dbcon.php');
	list($data)=mysql_fetch_row(mysql_query("SELECT imagen FROM mer_juicios WHERE gid='$gid' AND pos='$pos'"));
	header ("Content-type: image/png");
	print $data;
}
?>
