<?php 
	/**
	 * Script que llama la función de 
	 * show_moves.php (showMoves) para
	 * mostrar los movimientos del juego
	 * pasado por url (su id)
	 */
	
	// moves.php?game= -> el script que llama a show_moves (su función)
	// http://localhost/pages/bd/conecta4/moves.php?game=1
	header('Content-Type:text/xml');

	include_once("includes/show_moves.php");

	$game = $_GET['game'];
	showMoves($game);
 ?>