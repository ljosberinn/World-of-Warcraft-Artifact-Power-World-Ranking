<?php

if ( isset( $_GET[ 'entry' ] ) && is_numeric( $_GET[ 'entry' ] ) ) {

	include( 'stream.php' );

	$information = mysqli_fetch_array( mysqli_query( $stream, "SELECT `name`, `region`, `realm` FROM `000_top1000_global` WHERE `id` = '" . $_GET[ 'entry' ] . "'" ) );

	$key = '';

	$character = $information[ 'name' ];
	$region = $information[ 'region' ];
	$realm = $information[ 'realm' ];

	$realm = mysqli_fetch_array( mysqli_query( $stream, "SELECT `short` FROM `000_ovw_realms` WHERE `id` = '" . $realm . "'" ) );
	$realm = $realm[ 'short' ];

	$url = 'https://' . $region . '.api.battle.net/wow/character/' . $realm . '/' . $character . '?fields=guild,items,statistics,achievements,talents&locale=en_GB&apikey=' . $key . '';
	// ENABLE SSL
	$arrContextOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, ), );

	$data = @file_get_contents( $url, false, stream_context_create( $arrContextOptions ) );

	if ( $data != '' ) {
		$data = json_decode( $data, true );

		if ( $data[ 'level' ] == '110' ) {

			// LAST LOGOUT
			$logout = substr( $data[ 'lastModified' ], '0', '10' );

			// CURRENTLY SELECTED TALENTS
			for ( $i = '0'; $i <= '4'; $i++ ) {
				if ( $data[ 'talents' ][ $i ][ 'selected' ] == '1' ) {

					$class_tcalc_conversion = array( '1' => 'Z', '2' => 'b', '3' => 'Y', '4' => 'c', '5' => 'X', '6' => 'd', '7' => 'W', '8' => 'e', '9' => 'V', '10' => 'f', '11' => 'U', '12' => 'g' );

					if ( !isset( $talent_calc_var ) ) {
						foreach ( $class_tcalc_conversion as $class => $prefix ) {
							if ( $data[ 'class' ] == $class ) {
								for ( $k = '0'; $k <= '6'; $k++ ) {
									if ( isset( $data[ 'talents' ][ $i ][ 'talents' ][ $k ][ 'spec' ][ 'name' ] ) ) {
										$spec = $data[ 'talents' ][ $i ][ 'talents' ][ $k ][ 'spec' ][ 'name' ];
									}
								}
							}
						}
					}
				}
			}

			// CLASS
			$class = $data[ 'class' ];

			// FETCH INTERNAL SPEC ID
			$fetch_spec_var = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `000_ovw_weapons` WHERE `spec` = '" . $spec . "' AND `class` = '" . $class . "'" ) );
			$spec = $fetch_spec_var[ 'id' ];

			// FETCH REALM ID
			$realm = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `000_ovw_realms` WHERE `region` = '" . $region . "' AND `short` = '" . $realm . "'" ) );
			$realm = $realm[ 'id' ];

			// EQUIPPED ITEMLEVEL						
			$ilvlaverage = $data[ 'items' ][ 'averageItemLevelEquipped' ];

			// BAG ITEMLEVEL						
			$ilvlaveragebags = $data[ 'items' ][ 'averageItemLevel' ];

			// FETCH WEAPON ID OF SUPPOSEDLY EQUIPPED WEAPON (always assuming here that you have your artifact weapon equipped)
			$weapon = mysqli_fetch_array( mysqli_query( $stream, "SELECT `weapon_id` FROM `000_ovw_weapons` WHERE `id` = '" . $spec . "'" ) );

			// IF MAINHAND IS ARTIFACT WEAPON
			if ( $data[ 'items' ][ 'mainHand' ][ 'id' ] == $weapon[ 'weapon_id' ] ) {

				$traits = '0';
				foreach ( $data[ 'items' ][ 'mainHand' ][ 'artifactTraits' ] as $trait ) {
					$traits = $traits + $trait[ 'rank' ];
				}
			}
			// IF OFFHAND IS ARTIFACT WEAPON
			elseif ( $data[ 'items' ][ 'offHand' ][ 'id' ] == $weapon[ 'weapon_id' ] ) {

				$traits = '0';
				foreach ( $data[ 'items' ][ 'offHand' ][ 'artifactTraits' ] as $trait ) {
					$traits = $traits + $trait[ 'rank' ];
				}
			}

			// DUNGEON PROGRESS
			$eoa_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '2' ][ 'quantity' ];
			$dht_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '5' ][ 'quantity' ];
			$nl_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '8' ][ 'quantity' ];
			$hov_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '11' ][ 'quantity' ];
			$vh_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '16' ][ 'quantity' ] + $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '17' ][ 'quantity' ];
			$votw_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '20' ][ 'quantity' ];
			$brh_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '23' ][ 'quantity' ];
			$mos_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '26' ][ 'quantity' ];
			$arc_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '27' ][ 'quantity' ];
			$cos_mythic = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '28' ][ 'quantity' ];

			#$cen_mythic = '';
			#$ukz_mythic = '';
			#$lkz_mythic = '';

			// LFR EMERALD NIGHTMARE
			$en_lfr_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '30' ][ 'quantity' ];
			$en_lfr_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '34' ][ 'quantity' ];
			$en_lfr_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '38' ][ 'quantity' ];
			$en_lfr_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '42' ][ 'quantity' ];
			$en_lfr_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '46' ][ 'quantity' ];
			$en_lfr_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '50' ][ 'quantity' ];
			$en_lfr_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '54' ][ 'quantity' ];

			// NORMAL EMERALD NIGHTMARE					
			$en_normal_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '31' ][ 'quantity' ];
			$en_normal_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '35' ][ 'quantity' ];
			$en_normal_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '39' ][ 'quantity' ];
			$en_normal_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '43' ][ 'quantity' ];
			$en_normal_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '47' ][ 'quantity' ];
			$en_normal_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '51' ][ 'quantity' ];
			$en_normal_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '55' ][ 'quantity' ];

			// HEROIC EMERALD NIGHTMARE					
			$en_heroic_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '32' ][ 'quantity' ];
			$en_heroic_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '36' ][ 'quantity' ];
			$en_heroic_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '40' ][ 'quantity' ];
			$en_heroic_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '44' ][ 'quantity' ];
			$en_heroic_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '48' ][ 'quantity' ];
			$en_heroic_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '52' ][ 'quantity' ];
			$en_heroic_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '56' ][ 'quantity' ];

			// MYTHIC EMERALD NIGHTMARE					
			$en_mythic_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '33' ][ 'quantity' ];
			$en_mythic_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '37' ][ 'quantity' ];
			$en_mythic_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '41' ][ 'quantity' ];
			$en_mythic_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '45' ][ 'quantity' ];
			$en_mythic_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '49' ][ 'quantity' ];
			$en_mythic_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '53' ][ 'quantity' ];
			$en_mythic_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '57' ][ 'quantity' ];

			$en_m_progress = 0;
			$en_m_progress_array = array( $en_mythic_1, $en_mythic_2, $en_mythic_3, $en_mythic_4, $en_mythic_5, $en_mythic_6, $en_mythic_7 );
			foreach ( $en_m_progress_array as $boss ) {
				if ( $boss >= 1 ) {
					$en_m_progress = $en_m_progress + 1;
				}
			}

			//////////

			////////// TRIAL OF VALOR
			// LFR TRIAL OF VALOR
			$tov_lfr_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '58' ][ 'quantity' ];
			$tov_lfr_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '62' ][ 'quantity' ];
			$tov_lfr_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '66' ][ 'quantity' ];

			// NORMAL TRIAL OF VALOR
			$tov_normal_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '59' ][ 'quantity' ];
			$tov_normal_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '63' ][ 'quantity' ];
			$tov_normal_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '67' ][ 'quantity' ];

			// HEROIC TRIAL OF VALOR
			$tov_heroic_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '60' ][ 'quantity' ];
			$tov_heroic_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '64' ][ 'quantity' ];
			$tov_heroic_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '68' ][ 'quantity' ];

			// MYTHIC TRIAL OF VALOR
			$tov_mythic_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '61' ][ 'quantity' ];
			$tov_mythic_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '65' ][ 'quantity' ];
			$tov_mythic_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '69' ][ 'quantity' ];

			$tov_m_progress = 0;
			$tov_m_progress_array = array( $tov_mythic_1, $tov_mythic_2, $tov_mythic_3 );
			foreach ( $tov_m_progress_array as $boss ) {
				if ( $boss >= 1 ) {
					$tov_m_progress = $tov_m_progress + 1;
				}
			}

			//////////

			////////// THE NIGHTHOLD
			// LFR THE NIGHTHOLD
			$nh_lfr_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '70' ][ 'quantity' ];
			$nh_lfr_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '74' ][ 'quantity' ];
			$nh_lfr_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '78' ][ 'quantity' ];
			$nh_lfr_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '82' ][ 'quantity' ];
			$nh_lfr_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '86' ][ 'quantity' ];
			$nh_lfr_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '90' ][ 'quantity' ];
			$nh_lfr_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '94' ][ 'quantity' ];
			$nh_lfr_8 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '98' ][ 'quantity' ];
			$nh_lfr_9 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '102' ][ 'quantity' ];
			$nh_lfr_10 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '106' ][ 'quantity' ];

			// NORMAL THE NIGHTHOLD
			$nh_normal_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '71' ][ 'quantity' ];
			$nh_normal_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '75' ][ 'quantity' ];
			$nh_normal_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '79' ][ 'quantity' ];
			$nh_normal_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '83' ][ 'quantity' ];
			$nh_normal_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '87' ][ 'quantity' ];
			$nh_normal_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '91' ][ 'quantity' ];
			$nh_normal_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '95' ][ 'quantity' ];
			$nh_normal_8 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '99' ][ 'quantity' ];
			$nh_normal_9 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '103' ][ 'quantity' ];
			$nh_normal_10 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '107' ][ 'quantity' ];

			// HEROIC THE NIGHTHOLD
			$nh_heroic_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '72' ][ 'quantity' ];
			$nh_heroic_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '76' ][ 'quantity' ];
			$nh_heroic_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '80' ][ 'quantity' ];
			$nh_heroic_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '84' ][ 'quantity' ];
			$nh_heroic_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '88' ][ 'quantity' ];
			$nh_heroic_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '92' ][ 'quantity' ];
			$nh_heroic_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '96' ][ 'quantity' ];
			$nh_heroic_8 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '100' ][ 'quantity' ];
			$nh_heroic_9 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '104' ][ 'quantity' ];
			$nh_heroic_10 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '108' ][ 'quantity' ];

			// MYTHIC THE NIGHTHOLD
			$nh_mythic_1 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '73' ][ 'quantity' ];
			$nh_mythic_2 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '77' ][ 'quantity' ];
			$nh_mythic_3 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '81' ][ 'quantity' ];
			$nh_mythic_4 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '85' ][ 'quantity' ];
			$nh_mythic_5 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '89' ][ 'quantity' ];
			$nh_mythic_6 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '93' ][ 'quantity' ];
			$nh_mythic_7 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '97' ][ 'quantity' ];
			$nh_mythic_8 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '101' ][ 'quantity' ];
			$nh_mythic_9 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '105' ][ 'quantity' ];
			$nh_mythic_10 = $data[ 'statistics' ][ 'subCategories' ][ '5' ][ 'subCategories' ][ '6' ][ 'statistics' ][ '109' ][ 'quantity' ];

			$nh_m_progress = 0;
			$nh_m_progress_array = array( $nh_mythic_1, $nh_mythic_2, $nh_mythic_3, $nh_mythic_4, $nh_mythic_5, $nh_mythic_6, $nh_mythic_7, $nh_mythic_8, $nh_mythic_9, $nh_mythic_10 );
			foreach ( $nh_m_progress_array as $boss ) {
				if ( $boss >= 1 ) {
					$nh_m_progress = $nh_m_progress + 1;
				}
			}

			//////////
			// LFR TOMB OF SARGERAS
			$tos_lfr_1 = 0;
			$tos_lfr_2 = 0;
			$tos_lfr_3 = 0;
			$tos_lfr_4 = 0;
			$tos_lfr_5 = 0;
			$tos_lfr_6 = 0;
			$tos_lfr_7 = 0;
			$tos_lfr_8 = 0;
			$tos_lfr_9 = 0;

			// NORMAL TOMB OF SARGERAS
			$tos_normal_1 = 0;
			$tos_normal_2 = 0;
			$tos_normal_3 = 0;
			$tos_normal_5 = 0;
			$tos_normal_6 = 0;
			$tos_normal_7 = 0;
			$tos_normal_8 = 0;
			$tos_normal_9 = 0;

			// HEROIC TOMB OF SARGERAS
			$tos_heroic_1 = 0;
			$tos_heroic_2 = 0;
			$tos_heroic_3 = 0;
			$tos_heroic_4 = 0;
			$tos_heroic_5 = 0;
			$tos_heroic_6 = 0;
			$tos_heroic_7 = 0;
			$tos_heroic_8 = 0;
			$tos_heroic_9 = 0;

			// MYTHIC TOMB OF SARGERAS
			$tos_mythic_1 = 0;
			$tos_mythic_2 = 0;
			$tos_mythic_3 = 0;
			$tos_mythic_4 = 0;
			$tos_mythic_5 = 0;
			$tos_mythic_6 = 0;
			$tos_mythic_7 = 0;
			$tos_mythic_8 = 0;
			$tos_mythic_9 = 0;

			$tos_m_progress = 0;
			$tos_m_progress_array = array( $tos_mythic_1, $tos_mythic_2, $tos_mythic_3, $tos_mythic_4, $tos_mythic_5, $tos_mythic_6, $tos_mythic_7, $tos_mythic_8, $tos_mythic_9 );
			foreach ( $tos_m_progress_array as $boss ) {
				if ( $boss >= 1 ) {
					$tos_m_progress = $tos_m_progress + 1;
				}
			}

			//////////
			// LFR ARGUS
			$argus_lfr_1 = 0;

			// NORMAL ARGUS
			$argus_normal_1 = 0;

			// HEROIC ARGUS
			$argus_heroic_1 = 0;

			// MYTHIC ARGUS
			$argus_mythic_1 = 0;

			$argus_m_progress = 0;
			$argus_m_progress_array = array( $argus_mythic_1 );
			foreach ( $argus_m_progress_array as $boss ) {
				if ( $boss >= 1 ) {
					$argus_m_progress = $argus_m_progress + 1;
				}
			}

			$key_cen_mythic = array_search( '36216', $data[ 'achievements' ][ 'criteria' ] );

			$key_artifactpower = array_search( '30103', $data[ 'achievements' ][ 'criteria' ] );
			$key_artifactlevel = array_search( '29395', $data[ 'achievements' ][ 'criteria' ] );
			$key_artifactknowledge = array_search( '31466', $data[ 'achievements' ][ 'criteria' ] );
			$key_worldquests = array_search( '33094', $data[ 'achievements' ][ 'criteria' ] );

			// MYTHIC PLUS NUMBERS
			$key_mythicplus2 = array_search( '33096', $data[ 'achievements' ][ 'criteria' ] );
			$key_mythicplus5 = array_search( '33097', $data[ 'achievements' ][ 'criteria' ] );
			$key_mythicplus10 = array_search( '33098', $data[ 'achievements' ][ 'criteria' ] );
			$key_mythicplus15 = array_search( '32028', $data[ 'achievements' ][ 'criteria' ] );

			$criterias = array();
			array_push( $criterias, $data[ 'achievements' ][ 'criteriaQuantity' ] );
			$criterias = $criterias[ '0' ];

			$mythic_plus2 = $criterias[ $key_mythicplus2 ];
			$mythic_plus5 = $criterias[ $key_mythicplus5 ];
			$mythic_plus10 = $criterias[ $key_mythicplus10 ];
			$mythic_plus15 = $criterias[ $key_mythicplus15 ];
			$artifact_power = $criterias[ $key_artifactpower ];
			$artifact_level = $traits - 3;

			if ( $artifact_level < 0 ) {
				$artifact_level = 0;
			}

			$artifact_knowledge = $criterias[ $key_artifactknowledge ];
			$world_quests = $criterias[ $key_worldquests ];

			if ( $key_cen_mythic != '' ) {
				$cen_mythic = $criterias[ $key_cen_mythic ];
			} else {
				$cen_mythic = '0';
			}

			// EQ CALCULATION

			$threshold = '2228766330';

			$artifact_knowledge_levels = array(1.25, 1.5, 1.9, 2.4, 3, 3.75, 4.75, 6, 7.5, 9.5, 12, 15, 18.75, 23.5, 29.5, 37, 46.5, 58, 73, 91, 114, 143, 179, 224, 250, 1000, 1300, 1700, 2200, 2900, 3800, 4900, 6400, 8300, 10800, 14000, 18200, 23700, 30800, 40000, 52000, 67600, 87900, 114300, 148600, 193200, 251200, 326600, 424500, 552000);
			
			$ap_per_10_or_higher_key = 600*2*$artifact_knowledge_levels[$artifact_knowledge];

			$worth = ( ( $threshold / $ap_per_10_or_higher_key ) * 1466 ) / 150;

			if ( $data[ 'class' ] == '11' ) {
				$eq_ap = ( ( ( ( $artifact_power / $threshold ) * $worth ) / 4 ) * 3 ) / 2.5;
			} elseif ( $data[ 'class' ] == '12' ) {
				$eq_ap = ( ( ( ( $artifact_power / $threshold ) * $worth ) / 2 ) * 3 ) / 2.5;
			}
			elseif ( $data[ 'class' ] != '11' && $data[ 'class' ] != '12' ) {
				$eq_ap = ( ( $artifact_power / $threshold ) * $worth ) / 2.5;
			}

			$sum = $brh_mythic + $cen_mythic + $cos_mythic + $dht_mythic + $eoa_mythic + $hov_mythic + $lkz_mythic + $mos_mythic + $nl_mythic + $arc_mythic + $vh_mythic + $ukz_mythic + $votw_mythic;
			$m0 = $sum - $mythic_plus2;
			$m2_to_m5 = $mythic_plus2 - $mythic_plus5;
			$m5_to_m10 = $mythic_plus5 - $mythic_plus10;
			$m10_to_m15 = $mythic_plus10 - $mythic_plus15;
			$m15p = $mythic_plus15;

			if ( $m2_to_m5 < '0' ) {
				$m2_to_m5 = '0';
				$m5_to_m10 = '0';
				$m10_to_m15 = '0';
				$m15p = '0';
			}
			if ( $m5_to_m10 < '0' ) {
				$m5_to_m10 = '0';
				$m10_to_m15 = '0';
				$m15p = '0';
			}
			if ( $m10_to_m15 < '0' ) {
				$m10_to_m15 = '0';
				$m15p = '0';
			}

			// EN BOSSKILLS
			$en_lfr_bosskills = $en_lfr_1 + $en_lfr_2 + $en_lfr_3 + $en_lfr_4 + $en_lfr_5 + $en_lfr_6 + $en_lfr_7;
			$en_n_bosskills = $en_normal_1 + $en_normal_2 + $en_normal_3 + $en_normal_4 + $en_normal_5 + $en_normal_6 + $en_normal_7;
			$en_hc_bosskills = $en_heroic_1 + $en_heroic_2 + $en_heroic_3 + $en_heroic_4 + $en_heroic_5 + $en_heroic_6 + $en_heroic_7;
			$en_m_bosskills = $en_mythic_1 + $en_mythic_2 + $en_mythic_3 + $en_mythic_4 + $en_mythic_5 + $en_mythic_6 + $en_mythic_7;
			// TOV BOSSKILLS
			$tov_lfr_bosskills = $tov_lfr_1 + $tov_lfr_2 + $tov_lfr_3;
			$tov_n_bosskills = $tov_normal_1 + $tov_normal_2 + $tov_normal_3;
			$tov_hc_bosskills = $tov_heroic_1 + $tov_heroic_2 + $tov_heroic_3;
			$tov_m_bosskills = $tov_mythic_1 + $tov_mythic_3 + $tov_mythic_3;
			// NH BOSSKILLS
			$nh_lfr_bosskills = $nh_lfr_1 + $nh_lfr_2 + $nh_lfr_3 + $nh_lfr_4 + $nh_lfr_5 + $nh_lfr_6 + $nh_lfr_7 + $nh_lfr_8 + $nh_lfr_9 + $nh_lfr_10;
			$nh_n_bosskills = $nh_normal_1 + $nh_normal_2 + $nh_normal_3 + $nh_normal_4 + $nh_normal_5 + $nh_normal_6 + $nh_normal_7 + $nh_normal_8 + $nh_normal_9 + $nh_normal_10;
			$nh_hc_bosskills = $nh_heroic_1 + $nh_heroic_2 + $nh_heroic_3 + $nh_heroic_4 + $nh_heroic_5 + $nh_heroic_6 + $nh_heroic_7 + $nh_heroic_8 + $nh_heroic_9 + $nh_heroic_10;
			$nh_m_bosskills = $nh_mythic_1 + $nh_mythic_2 + $nh_mythic_3 + $nh_mythic_4 + $nh_mythic_5 + $nh_mythic_6 + $nh_mythic_7 + $nh_mythic_8 + $nh_mythic_9 + $nh_mythic_10;
			// TOS BOSSKILLS
			$tos_lfr_bosskills = $tos_lfr_1 + $tos_lfr_2 + $tos_lfr_3 + $tos_lfr_4 + $tos_lfr_5 + $tos_lfr_6 + $tos_lfr_7 + $tos_lfr_8 + $tos_lfr_9;
			$tos_n_bosskills = $tos_normal_1 + $tos_normal_2 + $tos_normal_3 + $tos_normal_4 + $tos_normal_5 + $tos_normal_6 + $tos_normal_7 + $tos_normal_8 + $tos_normal_9;
			$tos_hc_bosskills = $tos_heroic_1 + $tos_heroic_2 + $tos_heroic_3 + $tos_heroic_4 + $tos_heroic_5 + $tos_heroic_6 + $tos_heroic_7 + $tos_heroic_8 + $tos_heroic_9;
			$tos_m_bosskills = $tos_mythic_1 + $tos_mythic_2 + $tos_mythic_3 + $tos_mythic_4 + $tos_mythic_5 + $tos_mythic_6 + $tos_mythic_7 + $tos_mythic_8 + $tos_mythic_9;

			$eq_weights = mysqli_fetch_array( mysqli_query( $stream, "SELECT * FROM `000_ovw_eq` WHERE `id` = '1'" ) );

			$eq = $world_quests * 1 + ( $m0 * $eq_weights[ 'm0' ] ) +
				( $m2_to_m5 * $eq_weights[ 'm2_5' ] ) +
				( $m5_to_m10 * $eq_weights[ 'm5_10' ] ) +
				( $m10_to_m15 * $eq_weights[ 'm10_15' ] ) +
				( $m15p * $eq_weights[ 'm15p' ] ) +
				( $en_lfr_bosskills * $eq_weights[ 'en_lfr' ] ) +
				( $en_n_bosskills * $eq_weights[ 'en_n' ] ) +
				( $en_hc_bosskills * $eq_weights[ 'en_hc' ] ) +
				( $en_m_bosskills * $eq_weights[ 'en_m' ] ) +
				( $tov_lfr_bosskills * $eq_weights[ 'tov_lfr' ] ) +
				( $tov_n_bosskills * $eq_weights[ 'tov_n' ] ) +
				( $tov_hc_bosskills * $eq_weights[ 'tov_hc' ] ) +
				( $tov_m_bosskills * $eq_weights[ 'tov_m' ] ) +
				( $nh_lfr_bosskills * $eq_weights[ 'nh_lfr' ] ) +
				( $nh_n_bosskills * $eq_weights[ 'nh_n' ] ) +
				( $nh_hc_bosskills * $eq_weights[ 'nh_hc' ] ) +
				( $nh_m_bosskills * $eq_weights[ 'nh_m' ] ) +
				( $tos_lfr_bosskills * $eq_weights[ 'tos_lfr' ] ) +
				( $tos_n_bosskills * $eq_weights[ 'tos_n' ] ) +
				( $tos_hc_bosskills * $eq_weights[ 'tos_hc' ] ) +
				( $tos_m_bosskills * $eq_weights[ 'tos_m' ] ) +
				$eq_ap +
				( ( $ilvlaverage - 850 ) * $eq_weights[ 'itemlevel' ] );

			if ( $eq < '0' ) {
				$eq = '0';
			}

			// REALM TABLE NAME
			$table_name = '' . $region . '_' . $realm . '';

			// CHECK IF ALREADY EXISTS IN REALM TABLE
			$query = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `" . $table_name . "` WHERE `name` = '" . $character . "'" ) );

			if ( $query[ 'id' ] == '' ) {

				$insert = mysqli_query( $stream, "INSERT INTO `" . $table_name . "` (`name`, `class`, `spec`, `ap`, `al`, `eq_on`, `eq_off`, `mythics`, `raid1`, `raid2`, `raid3`, `raid4`, `raid5`, `eq`, `logout`, `update`) VALUES ('" . $character . "', '" . $class . "', '" . $spec . "', '" . $artifact_power . "', '" . $artifact_level . "', '" . $ilvlaverage . "', '" . $ilvlaveragebags . "', '" . $sum . "', '" . $en_m_progress . "', '" . $tov_m_progress . "', '" . $nh_m_progress . "', '" . $tos_m_progress . "', '" . $argus_m_progress . "', '" . $eq . "', '" . $logout . "', '" . time( 'now' ) . "')" );

			} else {

				$update = mysqli_query( $stream, "UPDATE `" . $table_name . "` SET `spec` = '" . $spec . "', `ap` = '" . $artifact_power . "', `al` = '" . $artifact_level . "', `eq_on` = '" . $ilvlaverage . "', `eq_off` = '" . $ilvlaveragebags . "', `mythics` = '" . $sum . "', `raid1` = '" . $en_m_progress . "', `raid2` = '" . $tov_m_progress . "', `raid3` = '" . $nh_m_progress . "', `raid4` = '" . $tos_m_progress . "', `raid5` = '" . $argus_m_progress . "', `eq` = '" . $eq . "',  `logout` = '" . $logout . "', `update` = '" . time( 'now' ) . "' WHERE `id` = '" . $query[ 'id' ] . "'" );

			}

			// CHECK FOR TOP 1000 ENTRY

			// CHECK AMOUNT OF ENTRIES
			$count = mysqli_num_rows( mysqli_query( $stream, "SELECT `id` FROM `000_top1000_global`" ) );

			// IF AMOUNT OF ENTRIES < 1000
			if ( $count >= 1000 ) {

				$query = mysqli_fetch_array( mysqli_query( $stream, "SELECT `ap` FROM `000_top1000_global` ORDER BY `ap` ASC LIMIT 1" ) );

				if ( $query[ 'ap' ] < $artifact_power ) {

					// CHECK IF ALREADY IN TOP 1000
					$prevent = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `000_top1000_global` WHERE `name` = '" . $character . "' AND `region` = '" . $region . "' AND `realm` = '" . $realm . "'" ) );

					if ( $prevent[ 'id' ] == '' ) {

						$insert = mysqli_query( $stream, "INSERT INTO `000_top1000_global` (`name`, `region`, `realm`, `class`, `spec`, `ap`, `al`, `eq_on`, `eq_off`, `mythics`, `raid1`, `raid2`, `raid3`, `raid4`, `raid5`, `eq`, `logout`, `update`) VALUES ('" . $character . "', '" . $region . "', '" . $realm . "', '" . $class . "', '" . $spec . "', '" . $artifact_power . "', '" . $artifact_level . "', '" . $ilvlaverage . "', '" . $ilvlaveragebags . "', '" . $sum . "', '" . $en_m_progress . "', '" . $tov_m_progress . "', '" . $nh_m_progress . "', '" . $tos_m_progress . "', '" . $argus_m_progress . "', '" . $eq . "', '" . $logout . "', '" . time( 'now' ) . "')" );

						// KILL ALL ENTRYS BEYOND 1000
						$threshold = mysqli_fetch_array( mysqli_query( $stream, "SELECT `ap` FROM `000_top1000_global` ORDER BY `ap` DESC LIMIT 1000,1" ) );
						$delete = mysqli_query( $stream, "DELETE FROM `000_top1000_global` WHERE `ap` < '" . $threshold[ 'ap' ] . "'" );

					} else {

						$update = mysqli_query( $stream, "UPDATE `000_top1000_global` SET `spec` = '" . $spec . "', `ap` = '" . $artifact_power . "', `al` = '" . $artifact_level . "', `eq_on` = '" . $ilvlaverage . "', `eq_off` = '" . $ilvlaveragebags . "', `mythics` = '" . $sum . "', `raid1` = '" . $en_m_progress . "', `raid2` = '" . $tov_m_progress . "', `raid3` = '" . $nh_m_progress . "', `raid4` = '" . $tos_m_progress . "', `raid5` = '" . $argus_m_progress . "', `eq` = '" . $eq . "', `logout` = '" . $logout . "', `update` = '" . time( 'now' ) . "' WHERE `id` = '" . $prevent[ 'id' ] . "'" );

					}
				}
			} elseif ( $count < 1000 ) {
				// CHECK IF ALREADY IN TOP 1000
				$prevent = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `000_top1000_global` WHERE `name` = '" . $character . "' AND `region` = '" . $region . "' AND `realm` = '" . $realm . "'" ) );

				if ( $prevent[ 'id' ] == '' ) {

					$insert = mysqli_query( $stream, "INSERT INTO `000_top1000_global` (`name`, `region`, `realm`, `class`, `spec`, `ap`, `al`, `eq_on`, `eq_off`, `mythics`, `raid1`, `raid2`, `raid3`, `raid4`, `raid5`, `eq`, `logout`, `update`) VALUES ('" . $character . "', '" . $region . "', '" . $realm . "', '" . $class . "', '" . $spec . "', '" . $artifact_power . "', '" . $artifact_level . "', '" . $ilvlaverage . "', '" . $ilvlaveragebags . "', '" . $sum . "', '" . $en_m_progress . "', '" . $tov_m_progress . "', '" . $nh_m_progress . "', '" . $tos_m_progress . "', '" . $argus_m_progress . "', '" . $eq . "', '" . $logout . "', '" . time( 'now' ) . "')" );

				} else {

					$update = mysqli_query( $stream, "UPDATE `000_top1000_global` SET `spec` = '" . $spec . "', `ap` = '" . $artifact_power . "', `al` = '" . $artifact_level . "', `eq_on` = '" . $ilvlaverage . "', `eq_off` = '" . $ilvlaveragebags . "', `mythics` = '" . $sum . "', `raid1` = '" . $en_m_progress . "', `raid2` = '" . $tov_m_progress . "', `raid3` = '" . $nh_m_progress . "', `raid4` = '" . $tos_m_progress . "', `raid5` = '" . $argus_m_progress . "', `eq` = '" . $eq . "', `logout` = '" . $logout . "', `update` = '" . time( 'now' ) . "' WHERE `id` = '" . $prevent[ 'id' ] . "'" );

				}
			}

			// CHECK FOR TOP 1000 CLASS ENTRY

			switch ( $class ) {
				case 1:
					$global_class_table = '000_top1000_warrior';
					break;
				case 2:
					$global_class_table = '000_top1000_paladin';
					break;
				case 3:
					$global_class_table = '000_top1000_hunter';
					break;
				case 4:
					$global_class_table = '000_top1000_rogue';
					break;
				case 5:
					$global_class_table = '000_top1000_priest';
					break;
				case 6:
					$global_class_table = '000_top1000_deathknight';
					break;
				case 7:
					$global_class_table = '000_top1000_shaman';
					break;
				case 8:
					$global_class_table = '000_top1000_mage';
					break;
				case 9:
					$global_class_table = '000_top1000_warlock';
					break;
				case 10:
					$global_class_table = '000_top1000_monk';
					break;
				case 11:
					$global_class_table = '000_top1000_druid';
					break;
				case 12:
					$global_class_table = '000_top1000_demonhunter';
					break;
			}

			// CHECK AMOUNT OF ENTRIES
			$count = mysqli_num_rows( mysqli_query( $stream, "SELECT `id` FROM `" . $global_class_table . "`" ) );

			// IF AMOUNT OF ENTRIES < 1000
			if ( $count >= 1000 ) {

				$query = mysqli_fetch_array( mysqli_query( $stream, "SELECT `ap` FROM `" . $global_class_table . "` ORDER BY `ap` ASC LIMIT 1" ) );

				if ( $query[ 'ap' ] < $artifact_power ) {

					// CHECK IF ALREADY IN TOP 1000 CLASS
					$prevent = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `" . $global_class_table . "` WHERE `name` = '" . $character . "' AND `region` = '" . $region . "' AND `realm` = '" . $realm . "'" ) );

					if ( $prevent[ 'id' ] == '' ) {

						$insert = mysqli_query( $stream, "INSERT INTO `" . $global_class_table . "` (`name`, `region`, `realm`, `spec`, `ap`, `al`, `eq_on`, `eq_off`, `mythics`, `raid1`, `raid2`, `raid3`, `raid4`, `raid5`, `eq`, `logout`, `update`) VALUES ('" . $character . "', '" . $region . "', '" . $realm . "', '" . $spec . "', '" . $artifact_power . "', '" . $artifact_level . "', '" . $ilvlaverage . "', '" . $ilvlaveragebags . "', '" . $sum . "', '" . $en_m_progress . "', '" . $tov_m_progress . "', '" . $nh_m_progress . "', '" . $tos_m_progress . "', '" . $argus_m_progress . "', '" . $eq . "', '" . $logout . "', '" . time( 'now' ) . "')" );

						// KILL ALL ENTRYS BEYOND 1000
						$threshold = mysqli_fetch_array( mysqli_query( $stream, "SELECT `ap` FROM `" . $global_class_table . "` ORDER BY `ap` DESC LIMIT 1000,1" ) );
						$delete = mysqli_query( $stream, "DELETE FROM `" . $global_class_table . "` WHERE `ap` < '" . $threshold[ 'ap' ] . "'" );


					} else {

						$update = mysqli_query( $stream, "UPDATE `" . $global_class_table . "` SET `spec` = '" . $spec . "', `ap` = '" . $artifact_power . "', `al` = '" . $artifact_level . "', `eq_on` = '" . $ilvlaverage . "', `eq_off` = '" . $ilvlaveragebags . "', `mythics` = '" . $sum . "', `raid1` = '" . $en_m_progress . "', `raid2` = '" . $tov_m_progress . "', `raid3` = '" . $nh_m_progress . "', `raid4` = '" . $tos_m_progress . "', `raid5` = '" . $argus_m_progress . "', `eq` = '" . $eq . "', `logout` = '" . $logout . "', `update` = '" . time( 'now' ) . "' WHERE `id` = '" . $prevent[ 'id' ] . "'" );

					}

				}

			} elseif ( $count < 1000 ) {
				// CHECK IF ALREADY IN TOP 1000 CLASS
				$prevent = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `" . $global_class_table . "` WHERE `name` = '" . $character . "' AND `region` = '" . $region . "' AND `realm` = '" . $realm . "'" ) );

				if ( $prevent[ 'id' ] == '' ) {

					$insert = mysqli_query( $stream, "INSERT INTO `" . $global_class_table . "` (`name`, `region`, `realm`, `spec`, `ap`, `al`, `eq_on`, `eq_off`, `mythics`, `raid1`, `raid2`, `raid3`, `raid4`, `raid5`, `eq`, `logout`, `update`) VALUES ('" . $character . "', '" . $region . "', '" . $realm . "', '" . $spec . "', '" . $artifact_power . "', '" . $artifact_level . "', '" . $ilvlaverage . "', '" . $ilvlaveragebags . "', '" . $sum . "', '" . $en_m_progress . "', '" . $tov_m_progress . "', '" . $nh_m_progress . "', '" . $tos_m_progress . "', '" . $argus_m_progress . "', '" . $eq . "', '" . $logout . "', '" . time( 'now' ) . "')" );

				} else {

					$update = mysqli_query( $stream, "UPDATE `" . $global_class_table . "` SET `spec` = '" . $spec . "', `ap` = '" . $artifact_power . "', `al` = '" . $artifact_level . "', `eq_on` = '" . $ilvlaverage . "', `eq_off` = '" . $ilvlaveragebags . "', `mythics` = '" . $sum . "', `raid1` = '" . $en_m_progress . "', `raid2` = '" . $tov_m_progress . "', `raid3` = '" . $nh_m_progress . "', `raid4` = '" . $tos_m_progress . "', `raid5` = '" . $argus_m_progress . "', `eq` = '" . $eq . "', `logout` = '" . $logout . "', `update` = '" . time( 'now' ) . "' WHERE `id` = '" . $prevent[ 'id' ] . "'" );


				}
			}

			switch ( $data[ 'class' ] ) {
				case 1:
					$cell_class = 'warrior-cell';
					break;
				case 2:
					$cell_class = 'paladin-cell';
					break;
				case 3:
					$cell_class = 'hunter-cell';
					break;
				case 4:
					$cell_class = 'rogue-cell';
					break;
				case 5:
					$cell_class = 'priest-cell';
					break;
				case 6:
					$cell_class = 'death_knight-cell';
					break;
				case 7:
					$cell_class = 'shaman-cell';
					break;
				case 8:
					$cell_class = 'mage-cell';
					break;
				case 9:
					$cell_class = 'warlock-cell';
					break;
				case 10:
					$cell_class = 'monk-cell';
					break;
				case 11:
					$cell_class = 'druid-cell';
					break;
				case 12:
					$cell_class = 'demon_hunter-cell';
					break;
			}

			if ( $en_m_progress == 7 ) {
				$raid1 = '<span class="perfect">7/7M</span>';
			} elseif ( $en_m_progress < 7 && $en_m_progress > 0 ) {
				$raid1 = '<span class="mediocre">' . $en_m_progress . '/7M</span>';
			}
			elseif ( $en_m_progress == 0 ) {
				$raid1 = '<span class="trash">0/7M</span>';
			}

			if ( $tov_m_progress == 3 ) {
				$raid2 = '<span class="perfect">3/3M</span>';
			} elseif ( $tov_m_progress < 3 && $tov_m_progress > 0 ) {
				$raid2 = '<span class="mediocre">' . $tov_m_progress . '/3M</span>';
			}
			elseif ( $tov_m_progress == 0 ) {
				$raid2 = '<span class="trash">0/3M</span>';
			}

			if ( $nh_m_progress == 10 ) {
				$raid3 = '<span class="perfect">10/10M</span>';
			} elseif ( $nh_m_progress < 10 && $nh_m_progress > 0 ) {
				$raid3 = '<span class="mediocre">' . $nh_m_progress . '/10M</span>';
			}
			elseif ( $nh_m_progress == 0 ) {
				$raid3 = '<span class="trash">0/10M</span>';
			}

			if ( $tos_m_progress == 9 ) {
				$raid4 = '<span class="perfect">7/7M</span>';
			} elseif ( $tos_m_progress < 9 && $tos_m_progress > 0 ) {
				$raid4 = '<span class="mediocre">' . $tos_m_progress . '/9M</span>';
			}
			elseif ( $tos_m_progress == 0 ) {
				$raid4 = '<span class="trash">0/9M</span>';
			}

			$realm = mysqli_fetch_array( mysqli_query( $stream, "SELECT `name` FROM `000_ovw_realms` WHERE `id` = '" . $realm . "'" ) );
			$realm = $realm[ 'name' ];

			echo '
			<table>
				<thead>
					<tr>
						<th></th>
						<th>AP</th>
						<th>AL</th>
						<th>Equip</th>
						<th>Mythics</th>
						<th>Raids</th>
						<th><a href="http://ags.gerritalex.de/?eq" target="_blank">EQ</a></th>
					</tr>
				</thead>
				<tbody>
					<td class="' . $cell_class . '"><a href="http://armory.gerritalex.de/?r=' . $region . '&s=' . $realm . '&c=' . $character . '">' . $character . '</a><br /><a class="region" onclick="left_table_region_filter(this.innerText);">' . $region . '</a> <a class="realm" onclick="left_table_realm_filter(US_\' + this.innerText + \');">' . $realm . '</a></td>
					<td style="background-color: #84724E;">' . number_format( ( $artifact_power / 1000000000 ), 3 ) . ' B</td>
					<td style="background-color: #84724E;">' . $artifact_level . '</td>
					<td style="background-color: #84724E;">' . $ilvlaverage . '/' . $ilvlaveragebags . '</td>
					<td style="background-color: #84724E;">' . $sum . '</td>
					<td style="background-color: #84724E;">' . $raid1 . ' ' . $raid2 . ' ' . $raid3 . ' ' . $raid4 . '</td>
					<td style="background-color: #84724E;">' . round( $eq ) . '</td>
				</tbody>
			</table>';
			
			// REMOVE FROM QUEUE IF ENTRY EXISTS
			$query = mysqli_fetch_array(mysqli_query($stream, "SELECT `id` FROM `000_import` WHERE `c` = '" .$character. "' AND `r` = '" .$region. "' AND `s` = '" .$realm. "'"));
			if($query['id'] != '') {
				$delete = mysqli_query($stream, "DELETE FROM `000_import` WHERE `id` = '" .$query['id']. "'");
			}
			
			// QUEUE GUILD
			if ( $data[ 'guild' ][ 'name' ] != '' ) {
				if ( strpos( $data[ 'guild' ][ 'name' ], ' ' ) !== false ) {
					$data[ 'guild' ][ 'name' ] = str_replace( ' ', '%20', $data[ 'guild' ][ 'name' ] );
				}

				$realm = mysqli_fetch_array( mysqli_query( $stream, "SELECT `short` FROM `000_ovw_realms` WHERE `name` = '" . $realm . "'" ) );
				$realm = $realm[ 'short' ];

				$url = 'https://' . $region . '.api.battle.net/wow/guild/' . $realm . '/' . $data[ 'guild' ][ 'name' ] . '?fields=members&locale=en_GB&apikey=' . $key . '';

				$data = @file_get_contents( $url, false, stream_context_create( $arrContextOptions ) );

				if ( $data != '' ) {
					$data = json_decode( $data, true );
					$chararray = array();

					foreach ( $data[ 'members' ] as $members ) {
						if ( $members[ 'character' ][ 'level' ] == '110' ) {
							$chararray[ $members[ 'character' ][ 'name' ] ] = $members[ 'character' ][ 'realm' ];
						}
					}

					foreach ( $chararray as $character => $realm ) {
						$queue_insert = mysqli_query( $stream, "INSERT INTO `000_import` (`c`, `r`, `s`) VALUES ('" . $character . "', '" . $region . "', '" . $realm . "')" );
					}

				}
			}

		} else {
			echo '<table width="100"><tbody><tr><td><span class="trash">The character in question is not level 110.</span></td></tr></tbody></table>';
		}

	} else {
		echo '<table width="100"><tbody><tr><td><span class="trash">The server could not retrieve the data of ' . $character . ' @ ' . $region . '-' . $realm . '.<br />This can have several reasons:<br />– incorrect information<br />– character too low level (only accepting level 110)<br />– character transfered<br />– Blizzard API unavailable.</span></td></tr></tbody></table>';
	}
}

mysqli_close( $stream );

?>