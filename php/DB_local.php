<?php

// Method ophalen, wat routing voorzien en eventuele input lezen
$method = $_SERVER['REQUEST_METHOD'];

// als er geen table in de url is opgegeven, geven we een fout
if ( ! array_key_exists( 'PATH_INFO', $_SERVER ) ) {
	http_response_code( 400 );// 400 = bad request
	echo "Bad request, your url is not correct";
	exit;
}
// de url opsplitsen in delen om zo onze routing uit te voeren
$request = explode( '/', trim( $_SERVER['PATH_INFO'], '/' ) );
// als er data meegekomen is met de request, willen we dit als json parsen
$input = json_decode( file_get_contents( 'php://input' ), true );

// verbinding maken met de database
$link = mysqli_connect( 'localhost', 'root', 'usbw', 'drinkz' );
mysqli_set_charset( $link, 'utf8' );

// het eerste element in $request is de table
// array_shift haalt (en verwijdert) het eerste element van een array
$table = preg_replace( '/[^a-z0-9_]+/i', '', array_shift( $request ) );
// als er geen table geselecteerd is, dan kunnen we hier stoppen en geven we een fout
if ( empty( $table ) ) {
	http_response_code( 400 );// 400 = bad request
	echo "Bad request, no table selected";
	exit;
}

// het tweede (nu het eerste in de array) is de eventuele key
$key = array_shift( $request );
// filter onze key tegen injection, meestal wordt enkel een numerische key toegelaten
if ( ! empty( $key ) ) {
	$key = mysqli_real_escape_string( $link, $key );
}
// enkel bij post of put mag er input zijn
if ( $method === "POST" || $method === "PUT" ) {
	// als er geen input is bij deze method is de request verkeerd
	if ( empty( $input ) ) {
		// POST van een lege input is verboden!
		http_response_code( 400 ); // 400 = bad request
		echo "Bad request";
		exit;
	}
	// escape & filter van de input (onze ontvangen json)
	$columns = preg_replace( '/[^a-z0-9_]+/i', '', array_keys( $input ) );

	// elke value excapen op basis van onze verbinding
	$values = array_map( function ( $value ) use ( $link ) {
		if ( $value === null ) {
			return null;
		}

		return mysqli_real_escape_string( $link, (string) $value );
	}, array_values( $input ) );

	// Bouw het set gedeelte adhv de gefilterde columns
	$set = '';
	for ( $i = 0; $i < count( $columns ); $i ++ ) {
		$set .= ( $i > 0 ? ',' : '' ) . '`' . $columns[ $i ] . '`=';
		$set .= ( $values[ $i ] === null ? 'NULL' : '"' . $values[ $i ] . '"' );
	}
}

if ( $method !== "POST" && ! empty( $key ) ) {
	// get the primary key column for the where clause
	$keyQuery = "SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'";
// uitvoeren van onze query
	$result = mysqli_query( $link, $keyQuery );

// als er geen resultaat is, 500 internal server error
	if ( ! $result ) {
		http_response_code( 500 );
		die( mysqli_error( $link ) );
	}
	$pkData = mysqli_fetch_array( $result );

// geen pk gevonden
	if ( empty( $pkData ) || ! is_array( $pkData ) || ! array_key_exists( "Column_name", $pkData ) || empty( $pkData['Column_name'] ) ) {
		http_response_code( 500 );
		exit;
	}
	$pk = $pkData['Column_name'];
}


// create SQL based on HTTP method
switch ( $method ) {
	case 'GET':
		$sql = "select * from `$table`" . ( $key ? " WHERE $pk=$key" : '' );
		break;
	case 'PUT':
		$sql = "update `$table` set $set where $pk=$key";
		break;
	case 'POST':
		$sql = "insert into `$table` set $set";
		break;
	case 'DELETE':
		$sql = "delete from `$table` where $pk=$key";
		break;
}

// uitvoeren van onze query
$result = mysqli_query( $link, $sql );

// als er geen resultaat is, 404 not found
if ( ! $result ) {
	http_response_code( 404 );
	die( mysqli_error( $link ) );
}

// We geven JSON terug wanneer het een GET is
if ( $method == 'GET' ) {
	header( 'Content-Type: application/json' );
	if ( ! $key ) {
		echo '[';
	}
	for ( $i = 0; $i < mysqli_num_rows( $result ); $i ++ ) {
		echo ( $i > 0 ? ',' : '' ) . json_encode( mysqli_fetch_object( $result ) );
	}
	if ( ! $key ) {
		echo ']';
	}
} elseif ( $method == 'POST' ) {
	// de id wanneer het een post was
	echo mysqli_insert_id( $link );
} else {
	// alle andere geven het aantal betrokken records terug.
	echo mysqli_affected_rows( $link );
}

// sluit de verbinding
mysqli_close( $link );