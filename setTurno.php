<?php 
	/**
	 * Modifica el turno del jugador
	 * pasándole por url los valores
	 * del juego y el color
	 */

	// http://localhost/pages/bd/conecta4/setTurno.php?game=1&color=1
	header('Content-Type:text/xml');

	require_once("includes/clases/ConectaDB.php");

	// Variables
	$game = $_GET['game'];
	$color = $_GET['color'];

	// Conexión a la BBDD
	$dd = new ConectaDB();

	// Obtener turno siguiente
	if ($color == 1) {
		$turno = 2;
	}else{
		$turno = 1;
	}

	// Actualizar Turno de ese juego y jugador (color)
	$sql = "UPDATE `games` SET `turno`=:turno WHERE `game`=:game";
	$dd->query($sql, array(":game" => $game, ":turno" => $turno));
 ?>