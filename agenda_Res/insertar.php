<?php
mysql_connect("localhost", "root", "");
mysql_select_db("agenda");

$nombre = $_GET["nombre"];
$email = $_GET["email"];
$usuario = $_GET["usuario"];
$password = $_GET["password"];

$query = "INSERT INTO usuario (id_Usuario, nombre, usuario, correo, password) VALUES (0, '$nombre', '$usuario', '$email', '$password')";

$res = mysql_query($query);

if($res == 1)
{
	echo "El usuario sea registrado de forma exitosa <br/><br/>";
}else
{
	echo "El Usuario no puede ser cargado $res <br/>";
}
?>