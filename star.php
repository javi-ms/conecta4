<?php 
	/**
	 * Comienza un juego, insertándolo
	 * en la tabla games
	 */
	
	header('Content-Type:text/xml');

	require_once("includes/clases/ConectaDB.php");
	//conexion base de datos
	$dd = new ConectaDB();
	//consulta de insercion de datos en games(cero valores)
	$sql = "INSERT INTO games VALUES (0,0,0)";
	//ejecuta la consulta y la devuelve
	$dd->query($sql, array());
	//me da la ultima id insertada
	$qid = $dd->get_mngDB()->lastInsertId();
	//usamos query para obtener el turno
	$turno = $dd->query("SELECT turno FROM games WHERE id=:id", array(":id" => $qid));
	//obtener el estado del juego
	$estado = $dd->query("SELECT estado FROM games WHERE id=:id", array(":id" => $qid));
	//crear XML
	$doc = new DOMDocument();
	//crear elemento game
	$r = $doc->createElement("game");
	//crear atributos
	$r->setAttribute('id', $qid);
	//añadir atributos a game
	$doc->appendChild($r);
	//repetir	
	$r->setAttribute('turno', $turno[0]['turno']);
	$doc->appendChild($r);
	$r->setAttribute('estado', $estado[0]['estado']);
	$doc->appendChild($r);
	//guardar y mostrar
	print $doc->saveXML();
 ?>