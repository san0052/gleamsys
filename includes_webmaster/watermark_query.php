<?
	$sql="SELECT * FROM ".$cfg['DB_WATERMARK']."";
	$res=$heart->sql_query($sql);
	$row=$heart->sql_fetchrow($res);
	print_r($row);

?>