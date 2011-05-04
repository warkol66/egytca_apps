<?
if (isset($gid)){
	include('../dbcon.php');
	list($data)=mysql_fetch_row(mysql_query("SELECT data FROM mer_graficos WHERE id='$gid'"));

	header ("Content-type: image/png");
	print $data;
}
?>
