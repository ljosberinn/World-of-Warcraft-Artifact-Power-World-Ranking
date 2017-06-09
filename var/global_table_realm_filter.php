<?php

if ( isset( $_GET[ 'realm' ] ) && strlen( $_GET[ 'realm' ] ) <= '4' && is_numeric( $_GET[ 'realm' ] ) ) {

	function timeconversion() {
		global $global_top;

		$global_top[ 'update' ] = time( 'now' ) - $global_top[ 'update' ];

		if ( $global_top[ 'update' ] < '60' ) {
			$global_top[ 'update' ] = '<span class="perfect" style="cursor: pointer;"><1 minute</span>';
		} elseif ( $global_top[ 'update' ] >= '60' && $global_top[ 'update' ] < '3600' ) {
			if ( $global_top[ 'update' ] < '90' ) {
				$global_top[ 'update' ] = '<span class="perfect" style="cursor: pointer;">' . round( $global_top[ 'update' ] / 60, 0 ) . ' minute</span>';
			} elseif ( $global_top[ 'update' ] >= '90' ) {
				$global_top[ 'update' ] = '<span class="perfect" style="cursor: pointer;">' . round( $global_top[ 'update' ] / 60, 0 ) . ' minutes</span>';
			}
		}
		elseif ( $global_top[ 'update' ] >= '3600' && $global_top[ 'update' ] < '86400' ) {
			if ( $global_top[ 'update' ] < '5400' ) {
				$global_top[ 'update' ] = '<span class="mediocre" style="cursor: pointer;">' . round( $global_top[ 'update' ] / 3600, 0 ) . ' hour</span>';
			} elseif ( $global_top[ 'update' ] >= '5400' ) {
				$global_top[ 'update' ] = '<span class="mediocre" style="cursor: pointer;">' . round( $global_top[ 'update' ] / 3600, 0 ) . ' hours</span>';
			}
		}
		elseif ( $global_top[ 'update' ] >= '86400' && $global_top[ 'update' ] < '604800' ) {
			if ( $global_top[ 'update' ] < '129600' ) {
				$global_top[ 'update' ] = '<span class="trash" style="cursor: pointer;">' . round( $global_top[ 'update' ] / 86400, 0 ) . ' day</span>';
			} elseif ( $global_top[ 'update' ] >= '129600' ) {
				$global_top[ 'update' ] = '<span class="trash" style="cursor: pointer;">' . round( $global_top[ 'update' ] / 86400, 0 ) . ' days</span>';
			}
		}
		elseif ( $global_top[ 'update' ] >= '604800' ) {
			$global_top[ 'update' ] = '<span class="trash" style="cursor: pointer;">> 1 week</span>';
		}
	}

	$realms = array( 'EU', 'US', 'KR', 'TW', 'global' );

	$selector = '<select onchange="left_table_realm_filter(this.value);">';

	include( 'stream.php' );

	$realms = mysqli_query( $stream, "SELECT * FROM `000_ovw_realms` ORDER BY `region` ASC" );

	while ( $realm_selector = mysqli_fetch_array( $realms ) ) {
		if ( $realm_selector[ 'id' ] == $_GET[ 'realm' ] ) {
			$selector .= '<option disabled selected>' . $realm_selector[ 'region' ] . '-' . $realm_selector[ 'name' ] . '</option>';
		} else {
			$selector .= '<option value="' . $realm_selector[ 'id' ] . '">' . $realm_selector[ 'region' ] . '-' . $realm_selector[ 'name' ] . '</option>';
		}
	}

	$selector .= '</select>';

	echo '
	<div>
		<span class="RBold">Top 50 ' . $selector . '</span>
	</div>
			
	<table id="left">
		<thead>
			<tr>
				<th></th>
				<th></th>
				<th>AP</th>
				<th>AL</th>
				<th>Equip</th>
				<th>Mythics</th>
				<th>Raids</th>
				<th><a onclick="alert(\'Below the tables you will find a lengthy explanation of the Effort Quota!\');">EQ</a></th>
				<th>Data age</th>
			</tr>
		</thead>
		<tbody>';

	$region = mysqli_fetch_array( mysqli_query( $stream, "SELECT `region` FROM `000_ovw_realms` WHERE `id` = '" . $_GET[ 'realm' ] . "'" ) );
	$region = $region[ 'region' ];

	if ( $_GET[ 'region' ] != 'global' ) {
		$global_table = mysqli_query( $stream, "SELECT * FROM `" . $region . "_" . $_GET[ 'realm' ] . "` ORDER BY `ap` DESC LIMIT 50" );
	} else {
		$global_table = mysqli_query( $stream, "SELECT * FROM `000_top1000_global` ORDER BY `ap` DESC LIMIT 50" );
	}

	$i = 1;

	while ( $global_top = mysqli_fetch_array( $global_table ) ) {

		if ( $i == 1 ) {
			$rank_color = 'artifact RBold';
		} elseif ( $i > 1 && $i <= 3 ) {
			$rank_color = 'legendary RBold-medium';
		} elseif ( $i > 3 && $i <= 10 ) {
			$rank_color = 'epic RBold-small';
		} elseif ( $i > 10 && $i <= 20 ) {
			$rank_color = 'rare';
		} elseif ( $i > 20 && $i <= 30 ) {
			$rank_color = 'uncommon';
		} elseif ( $i > 30 && $i <= 50 ) {
			$rank_color = 'common';
		}

		$realm_name = mysqli_fetch_array( mysqli_query( $stream, "SELECT `name`, `region`, `short` FROM `000_ovw_realms` WHERE `id` = '" . $_GET[ 'realm' ] . "'" ) );

		switch ( $global_top[ 'class' ] ) {
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

		if ( $global_top[ 'raid1' ] == 7 ) {
			$raid1 = '<span class="perfect">7/7M</span>';
		} elseif ( $global_top[ 'raid1' ] < 7 && $global_top[ 'raid1' ] > 0 ) {
			$raid1 = '<span class="mediocre">' . $global_top[ 'raid1' ] . '/7M</span>';
		}
		elseif ( $global_top[ 'raid1' ] == 0 ) {
			$raid1 = '<span class="trash">0/7M</span>';
		}

		if ( $global_top[ 'raid2' ] == 3 ) {
			$raid2 = '<span class="perfect">3/3M</span>';
		} elseif ( $global_top[ 'raid2' ] < 3 && $global_top[ 'raid2' ] > 0 ) {
			$raid2 = '<span class="mediocre">' . $global_top[ 'raid2' ] . '/3M</span>';
		}
		elseif ( $global_top[ 'raid2' ] == 0 ) {
			$raid2 = '<span class="trash">0/3M</span>';
		}

		if ( $global_top[ 'raid3' ] == 10 ) {
			$raid3 = '<span class="perfect">10/10M</span>';
		} elseif ( $global_top[ 'raid3' ] < 10 && $global_top[ 'raid3' ] > 0 ) {
			$raid3 = '<span class="mediocre">' . $global_top[ 'raid3' ] . '/10M</span>';
		}
		elseif ( $global_top[ 'raid3' ] == 0 ) {
			$raid3 = '<span class="trash">0/10M</span>';
		}

		if ( $global_top[ 'raid4' ] == 9 ) {
			$raid4 = '<span class="perfect">7/7M</span>';
		} elseif ( $global_top[ 'raid4' ] < 9 && $global_top[ 'raid4' ] > 0 ) {
			$raid4 = '<span class="mediocre">' . $global_top[ 'raid4' ] . '/9M</span>';
		}
		elseif ( $global_top[ 'raid4' ] == 0 ) {
			$raid4 = '<span class="trash">0/9M</span>';
		}

		timeconversion();

		$ap_1000_threshold = mysqli_fetch_array( mysqli_query( $stream, "SELECT `ap` FROM `000_top1000_global` ORDER BY `ap` DESC LIMIT 50, 1" ) );

		if ( $global_top[ 'ap' ] <= $ap_1000_threshold[ 'ap' ] ) {
			$onclick_id = '' . $_GET[ 'realm' ] . '-' . $global_top[ 'id' ] . '';
		} else {
			$top1000_id = mysqli_fetch_array(mysqli_query($stream, "SELECT `id` FROM `000_top1000_global` WHERE `name` = '" .$global_top['name']. "' AND `realm` = '" .$_GET['realm']. "'"));
			
			$onclick_id = $top1000_id[ 'id' ];
		}
		
		$realm_name['name'] = str_replace('й', 'и', $realm_name['name']);

		echo '
			<tr>
				<td class="' . $rank_color . '">' . $i . '</td>
				<td class="' . $cell_class . '"><a href="http://armory.gerritalex.de/?r=' . $realm_name[ 'region' ] . '&s=' . $realm_name[ 'name' ] . '&c=' . $global_top[ 'name' ] . '">' . $global_top[ 'name' ] . '</a><br /><a class="region" onclick="left_table_region_filter(this.innerText);">' . $realm_name[ 'region' ] . '</a> <a class="realm" onclick="left_table_realm_filter(' . $global_top[ 'realm' ] . ');">' . $realm_name[ 'name' ] . '</a></td>
				<td data-sort-value="' . $global_top[ 'ap' ] . '">' . number_format( ( $global_top[ 'ap' ] / 1000000000 ), 3 ) . ' B</td>
				<td data-sort-value="' . $global_top[ 'al' ] . '">' . $global_top[ 'al' ] . '</td>
				<td data-sort-value="' . $global_top[ 'eq_on' ] . '">' . $global_top[ 'eq_on' ] . '/' . $global_top[ 'eq_off' ] . '</td>
				<td data-sort-value="' . $global_top[ 'mythics' ] . '">' . $global_top[ 'mythics' ] . '</td>
				<td class="raids" data-sort-value="' . ( $global_top[ 'raid1' ] + $global_top[ 'raid2' ] + $global_top[ 'raid3' ] + $global_top[ 'raid4' ] ) . '">' . $raid1 . ' ' . $raid2 . ' ' . $raid3 . '</td>
				<td data-sort-value="' . $global_top[ 'eq' ] . '">' . $global_top[ 'eq' ] . '</td>
				<td id="' . $onclick_id . '" onclick="left_table_update(this.id);">' . $global_top[ 'update' ] . '</td>
			</tr>';
		$i++;
	}

	echo '
		</tbody>
	</table>';

}

?>