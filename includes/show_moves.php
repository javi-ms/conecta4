<?php 
	/**
	 * Aquí se recoge la función que muestra los
	 * movimientos de un juego.
	 *
	 * moves.php es el script que llama a esta 
	 * función
	 */
	
	// funciones -> solo función y moves.php es el script
	require_once("includes/clases/ConectaDB.php");

	/**
	 * Muestra los movimientos 
	 * de un juego
	 *
	 * @param $game id del juego
	 */
	function showMoves($game)
	{
		$dd = new ConectaDB();
		$sql = "SELECT * FROM moves WHERE game=:game";
		$resultado = $dd->query($sql, array(":game" => $game));

		// Creamos documento XML
		$doc = new DOMDocument();
		$r = $doc->createElement("moves");
		$doc->appendChild($r);
		
		foreach ($resultado as $columna) {
			$e = $doc->createElement("move");
			$e->setAttribute('id', $columna['id']);
			$r->appendChild($e);
			$e->setAttribute('x', $columna['x']);
			$r->appendChild($e);
			$e->setAttribute('y', $columna['y']);
			$r->appendChild($e);
			$e->setAttribute('color', $columna['color']);
			$r->appendChild($e);
		}
		print $doc->saveXML();		
	}
 ?>