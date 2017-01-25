<?php 
	/**
	 * Inserta un movimiento con los valores
	 * pasados por url (juego, posiciones y color)
	 */

	// http://localhost/pages/bd/conecta4/move.php?game=1&x=7&y=4&color=1
	header('Content-Type:text/xml');

	require_once("includes/clases/ConectaDB.php");
	//recibimos los datos atraves de la URL
	$game = $_GET['game'];
	$x = $_GET['x'];
	$y = $_GET['y'];
	$color = $_GET['color'];

	$dd = new ConectaDB();
	//consulta para introducir datos
	$sql = "INSERT INTO `moves`(`game`, `x`, `y`, `color`) VALUES (:game,:x,:y,:color)";
	$dd->query($sql, array(":game" => $game, ":x" => $x, ":y" => $y, ":color" => $color));
	$qid = $dd->get_mngDB()->lastInsertId();

	//creacion XML
	$doc = new DOMDocument();
	//crear elemento move
	$r = $doc->createElement("move");
	//crear atributos
	$r->setAttribute('id', $qid);
	//añadir atributos a move
	$doc->appendChild($r);
	//PREGUNTAR
	$r->setAttribute('game', $game);
	$doc->appendChild($r);
	$r->setAttribute('x', $x);
	$doc->appendChild($r);
	$r->setAttribute('y', $y);
	$doc->appendChild($r);
	$r->setAttribute('color', $color);
	$doc->appendChild($r);
	print $doc->saveXML();
 ?>