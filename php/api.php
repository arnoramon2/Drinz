<?php
function CallAPI( $method, $url, $data = false ) {
	$curl = curl_init();

	switch ( $method ) {
		case "POST":
			// voor het maken van een object gebruiken we POST, hiermee laten we dit ook aan cURL weten
			curl_setopt( $curl, CURLOPT_POST, 1 );

			// als er data nodig is voor het maken van een object, voegen we dit hier toe
			if ( $data ) {
				curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
			}
			break;
		case "PUT":
			// voor het updaten van een object gebruiken we PUT, hiermee laten we dit ook aan cURL weten
			curl_setopt( $curl, CURLOPT_PUT, 1 );
			break;
		case "DELETE":
			//AANVULLING DRB
			// voor het DELETE van een object gebruiken we DELETE, hiermee laten we dit ook aan cURL weten
			curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
			break;
		default:
			// als er data aanwezig is vormen we een nieuwe URL door de data url parameters door te geven bv: http://api.be/index.php?param=value
			if ( $data ) {
				$url = sprintf( "%s?%s", $url, http_build_query( $data ) );
			}
	}

	// Optional Authentication:
	/*
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	*/

	// defineer de te halen URL
	curl_setopt( $curl, CURLOPT_URL, $url );
	// we willen het resultaat opvangen en niet gewoon weergeven in $result
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	// als het meer of 3s duurt om data op te halen gaan we uit van een verkeerde verbinding of server timeout
	curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 3 );
	curl_setopt( $curl, CURLOPT_TIMEOUT, 3 );

	$result = curl_exec( $curl );

	// Wanneer de API geen succesvol antwoord geeft kunnen we dat hier opvangen
	if ( ! curl_errno( $curl ) ) {
		switch ( $http_code = curl_getinfo( $curl, CURLINFO_HTTP_CODE ) ) {
			case 200:  # OK
				break;
			default:
				//gebruik dit om te debuggen wanneer je problemen tegen komt
				echo 'Unexpected HTTP code: ', $http_code, "\n";
				print_r( $result );
		}
	}

	curl_close( $curl );

	//normaal gaan we het resultaat nog aftasten of casten naar een bepaald object om zo zeker te zijn van het resultaat
	return json_decode( $result, true );
}