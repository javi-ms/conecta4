<?php 
	/**
	 * Muestra los juegos activos
	 */

	header('Content-Type:text/xml');
	
	require_once("includes/clases/ConectaDB.php");
	//conexion a la base de datos
	$dd = new ConectaDB();
	//consulta para  ver cuales son los juegos con estado 0 
	$sql = "SELECT * FROM games WHERE estado=0";
	$resultado = $dd->query($sql, array());

	// Creamos documento XML
	$doc = new DOMDocument();
	$r = $doc->createElement("games");
	$doc->appendChild($r);

	foreach ($resultado as $columna) {
		$e = $doc->createElement("game");
		$e->setAttribute('id', $columna['id']);
		$r->appendChild($e);
	}
	print $doc->saveXML();
 ?>