<?php

if ( isset( $_GET[ 'guild' ] ) && isset( $_GET[ 'region' ] ) && strlen( $_GET[ 'region' ] ) == '2' && isset( $_GET[ 'realm' ] ) ) {

	$guild = $_GET[ 'guild' ];
	$region = $_GET[ 'region' ];
	$realm = $_GET[ 'realm' ];

	$key = '';

	include( 'stream.php' );

	$guild = str_replace( ' ', '%20', $guild );

	$realm = mysqli_fetch_array( mysqli_query( $stream, "SELECT `short` FROM `000_ovw_realms` WHERE `name` = '" . addslashes( $realm ) . "'" ) );
	$realm = $realm[ 'short' ];

	$url = 'https://' . $region . '.api.battle.net/wow/guild/' . $realm . '/' . $guild . '?fields=members&locale=en_GB&apikey=' . $key . '';

	// ENABLE SSL
	$arrContextOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, ), );

	$data = @file_get_contents( $url, false, stream_context_create( $arrContextOptions ) );

	if ( $data != '' ) {
		$data = json_decode( $data, true );

		$chararray = array();

		foreach ( $data[ 'members' ] as $members ) {
			if ( $members[ 'character' ][ 'level' ] == '110' ) {
				if ( isset( $members[ 'character' ][ 'realm' ] ) ) {
					$chararray[ $members[ 'character' ][ 'name' ] ] = $members[ 'character' ][ 'realm' ];
				} else {
					$chararray[ $members[ 'character' ][ 'name' ] ] = $members[ 'character' ][ 'guildRealm' ];
				}
			}
		}

		echo '
		<table style="width: 100%;" id="guild_importer">
			<thead>
				<tr>
					<th></th>
					<th style="cursor: help;">AP</th>
					<th style="cursor: help;">AL</th>
					<th style="cursor: help;">Equip</th>
					<th style="cursor: help;">Mythics</th>
					<th style="cursor: help;">Raids</th>
					<th><a onclick="alert(\'Below the tables you will find a lengthy explanation of the Effort Quota!\');">EQ</a></th>
				</tr>
			</thead>
			<tbody>';

		ksort( $chararray );

		$i = 1;
		foreach ( $chararray as $character => $realm ) {

			$realm = str_replace( 'й', 'и', $realm );

			echo '
				<tr id="' . $i . '" style="opacity: 0.2; transition: 1s ease-in-out;">
					<td class="' . $cell_class . '"><a href="http://armory.gerritalex.de/?r=' . $region . '&s=' . $realm . '&c=' . $character . '">' . $character . '</a><br /><a class="region" onclick="left_table_region_filter(this.innerText);">' . $region . '</a> <a class="realm" onclick="left_table_realm_filter(US_\' + this.innerText + \');">' . $realm . '</a></td>
					<td style="background-color: #84724E;">0 B</td>
					<td style="background-color: #84724E;"> </td>
					<td style="background-color: #84724E;"> / </td>
					<td style="background-color: #84724E;"> </td>
					<td style="background-color: #84724E;"> </td>
					<td style="background-color: #84724E;"> </td>
				</tr>
				<script type="text/javascript">
				$(document).ready(function() {
					$.ajax({
						url: \'var/char_via_guild.php\',
						type: \'get\',
						dataType: \'html\',
						data: {
							character: \'' . $character . '\',
							region: \'' . $region . '\',
							realm: \'' . ucfirst( strtolower( addslashes( $realm ) ) ) . '\'
						},
						success: function (data) {
							$(\'#' . $i . '\').empty();
							$(\'#' . $i . '\').css(\'opacity\', \'1\');
							$(\'#' . $i . '\').html($(data).find(\'tbody\').find(\'tr\').find(\'td\'));
						},
						error: function () {
							$(\'#' . $i . '\').append(\'<span class="trash">Error!</span>\');
						}
					});			
				});
				</script>';
			$i++;
		}

		echo '</tbody>
		</table>
		<script type="text/javascript">
		$(document).ajaxStop(function () {
			 $("#guild_importer").tablesort();
		});
		</script>';

	} else {
		echo 'The server could not retrieve the data of ' . $guild . ' @ ' . $region . '-' . $realm . '.<br />This can have several reasons:<br />– incorrect information<br />– x-realm guilds need to be inserted from their original realm<br />– guild transfered<br />– Blizzard API unavailable.';
	}
}
?>