<?php

//sleep(2);
mysql_connect("localhost", "root", "");
mysql_select_db("agenda");


$usuario = $_GET["usuario"];
$password = $_GET["password"];

$query = "SELECT id_Usuario FROM usuario WHERE usuario = '$usuario' and password = '$password' ";

$res = mysql_query($query);
if($row = mysql_fetch_row($res))
{
	$id_Usuario = trim($row[0]);

	if($id_Usuario > 0)
	{
		echo "$id_Usuario";
	}
}
else
{
	echo "-1";
}
?>