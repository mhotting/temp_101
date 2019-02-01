<?php

/* Connects to DB as root, returns connection var if ok, NULL else */
function ft_db_connect($name)
{
	$username = "root";
	$passwd = "rootpwd";
	$host = $_SERVER['REMOTE_ADDR'];
	if ($name === "")
		$link = mysqli_connect($host, $username, $passwd);
	else
		$link = mysqli_connect($host, $username, $passwd, $name);
	if (mysqli_connect_errno($link))
	{
		echo("Erreur - Connexion à la base de données impossible\n");
		return (NULL);
	}
	return ($link);
}

?>
