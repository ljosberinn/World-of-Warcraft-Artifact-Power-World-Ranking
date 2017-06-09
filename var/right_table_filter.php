<?php

if (
	isset( $_GET[ 'region' ] ) && ( $_GET[ 'region' ] == 'EU' || $_GET[ 'region' ] == 'TW' || $_GET[ 'region' ] == 'KR' || $_GET[ 'region' ] == 'US' || $_GET[ 'region' ] == 0 ) &&
	isset( $_GET[ 'spec' ] ) && is_numeric( $_GET[ 'spec' ] ) && $_GET[ 'spec' ] >= 0 && $_GET[ 'spec' ] <= 36 &&
	isset( $_GET[ 'cl' ] ) && $_GET[ 'cl' ] >= 0 && $_GET[ 'cl' ] <= 12 && is_numeric( $_GET[ 'cl' ] ) &&
	isset( $_GET[ 'realm' ] ) && is_numeric( $_GET[ 'realm' ] ) && strlen( $_GET[ 'realm' ] ) <= 4 && $_GET[ 'realm' ] >= 0 && $_GET[ 'realm' ] <= 1200 ) {

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

	switch ( $_GET[ 'cl' ] ) {
		case 1:
			$middle_right_class_name = 'Warriors';
			$middle_right_class = 'warrior';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-2">Arms</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-1">Fury</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-3">Protection</option>';
			$middle_right_table_name = '000_top1000_warrior';
			break;
		case 2:
			$middle_right_class_name = 'Paladins';
			$middle_right_class = 'paladin';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-4">Holy</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-5">Protection</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-6">Retribution</option>';
			$middle_right_table_name = '000_top1000_paladin';
			break;
		case 3:
			$middle_right_class_name = 'Hunters';
			$middle_right_class = 'hunter';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-7">Beast Mastery</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-8">Marksmanship</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-9">Survival</option>';
			$middle_right_table_name = '000_top1000_hunter';
			break;
		case 4:
			$middle_right_class_name = 'Rogues';
			$middle_right_class = 'rogue';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-10">Assassination</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-11">Outlaw</option>
		<option value=' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-"' . $_GET[ 'cl' ] . '-12">Subtlety</option>';
			$middle_right_table_name = '000_top1000_rogue';
			break;
		case 5:
			$middle_right_class_name = 'Priests';
			$middle_right_class = 'priest';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-13">Discipline</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-14">Holy</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-15">Shadow</option>';
			$middle_right_table_name = '000_top1000_priest';
			break;
		case 6:
			$middle_right_class_name = 'Death Knights';
			$middle_right_class = 'death_knight';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-16">Blood</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-17">Frost</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-18">Unholy</option>';
			$middle_right_table_name = '000_top1000_deathknight';
			break;
		case 7:
			$middle_right_class_name = 'Shamans';
			$middle_right_class = 'shaman';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-19">Elemental</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-20">Enhancement</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-21">Restoration</option>';
			$middle_right_table_name = '000_top1000_shaman';
			break;
		case 8:
			$middle_right_class_name = 'Mages';
			$middle_right_class = 'mage';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-22">Arcane</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-23">Fire</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-24">Frost</option>';
			$middle_right_table_name = '000_top1000_mage';
			break;
		case 9:
			$middle_right_class_name = 'Warlocks';
			$middle_right_class = 'warlock';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-25">Affliction</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-26">Demonology</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-27">Destruction</option>';
			$middle_right_table_name = '000_top1000_warlock';
			break;
		case 10:
			$middle_right_class_name = 'Monks';
			$middle_right_class = 'monk';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-28">Brewmaster</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-29">Mistweaver</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-30">Windwalker</option>';
			$middle_right_table_name = '000_top1000_monk';
			break;
		case 11:
			$middle_right_class_name = 'Druids';
			$middle_right_class = 'druid';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-31">Balance</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-32">Feral</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-33">Guardian</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-34">Restoration</option>';
			$middle_right_table_name = '000_top1000_druid';
			break;
		case 12:
			$middle_right_class_name = 'Demon Hunter';
			$middle_right_class = 'demon_hunter';
			$middle_right_filter = '
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-35">Havoc</option>
		<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $_GET[ 'cl' ] . '-36">Vengeance</option>';
			$middle_right_table_name = '000_top1000_demonhunter';
			break;
	}

	include( 'stream.php' );

	if ( $_GET[ 'spec' ] != 0 ) {
		$resetter = '<sup style="color: white; cursor: pointer;" onclick="javascript:location.href=\'http://apinfo.gerritalex.de/\'">(reset)</sup>';
		$spec_name = mysqli_fetch_array( mysqli_query( $stream, "SELECT `spec` FROM `000_ovw_weapons` WHERE `class` = '" . $_GET[ 'cl' ] . "' AND `id` = '" . $_GET[ 'spec' ] . "'" ) );
		$spec_name = $spec_name[ 'spec' ];

		if ( is_numeric( $_GET[ 'region' ] ) ) {
			$head = '<span class="RBold">Top 50 ' . $spec_name . ' ' . $middle_right_class_name . '</span>';
		} else {
			if($_GET['realm'] != 0) {
				
				$realm_name = mysqli_fetch_array(mysqli_query($stream, "SELECT `name` FROM `000_ovw_realms` WHERE `id` = '" .$_GET['realm']. "'"));
				
				$head = '<span class="RBold">Top 50 ' . $_GET[ 'region' ] . '-' . $realm_name[ 'name' ] . ' ' . $spec_name . ' ' . $middle_right_class_name . '</span>';
			}
			else {
				$head = '<span class="RBold">Top 50 ' . $_GET[ 'region' ] . ' ' . $spec_name . ' ' . $middle_right_class_name . '</span>';
			}
		}
	} elseif ( $_GET[ 'spec' ] == 0 ) {
		$spec_name = 'filter class by spec';
		if ( !is_numeric( $_GET[ 'region' ] ) ) {
			
			$resetter = '<sup style="color: white; cursor: pointer;" onclick="javascript:location.href=\'http://apinfo.gerritalex.de/\';">(reset)</sup>';
			
			if($_GET['realm'] != 0) {
				$realm_name = mysqli_fetch_array(mysqli_query($stream, "SELECT `name` FROM `000_ovw_realms` WHERE `id` = '" .$_GET['realm']. "'"));
				
				$head = '<span class="RBold">Top 50 ' . $_GET[ 'region' ] . '-' . $realm_name[ 'name' ] . ' ' . $middle_right_class_name . '</span>';
			}
			else {
				$head = '<span class="RBold">Top 50 ' . $_GET[ 'region' ] . ' ' . $middle_right_class_name . '</span>';
			}
		} elseif ( $_GET[ 'region' ] == 0 ) {
			$head = '<span class="RBold">Top 50 ' . $middle_right_class_name . '</span>';
		}
	}

	echo '
	<div class="middle-right-top">
		<div class="' . $middle_right_class . '">' . $head . '' .$resetter. '
			<p><select onchange="right_table_filter(this.value);">
				<option disabled selected>select region to filter</option>';

				$region_array = array( 'EU', 'US', 'KR', 'TW' );

				if ( is_numeric( $_GET[ 'region' ] ) ) {
					foreach ( $region_array as $region ) {
						echo '
						<option value="' . $region . '-0-' . $_GET[ 'cl' ] . '-' . $_GET[ 'spec' ] . '">' . $region . '</option>';
					}
				} else {
					
					foreach ( $region_array as $region ) {
						if($_GET['region'] == $region) {
							$selected = 'selected';
						}
						else {
							$selected = '';
						}
						echo '<option ' .$selected. ' value="' . $region . '-0-' . $_GET[ 'cl' ] . '-' . $_GET[ 'spec' ] . '">' . $region . '</option>';
						}
					}

				echo '
				</select>
				<select onchange="right_table_filter(this.value);">';
				if($_GET['realm'] == 0) {
					if(is_numeric($_GET['region'])) {
						echo '<option disabled selected>select region first</option>';
					}
					else {
						echo '<option disabled selected>select realm to filter</option>';
					}
				}
	
				if(!is_numeric($GET['region'])) {
					$realms = mysqli_query($stream, "SELECT `id`, `region`, `name` FROM `000_ovw_realms` WHERE `region` = '" .$_GET['region'] . "' ORDER BY `region` ASC, `name` ASC");
				}
				else {
					$realms = mysqli_query($stream, "SELECT `id`, `region`, `name` FROM `000_ovw_realms` ORDER BY `region` ASC, `name` ASC");
				}				
				while ($realm = mysqli_fetch_array($realms)) {					
					if($realm['id'] == $_GET['realm']) {
						echo '<option selected>' .$realm['name']. '</option>';
					}
					else {
						echo '<option value="' .$realm['region']. '-' .$realm['id']. '-' .$_GET['cl']. '-' .$_GET['spec']. '">' .$realm['name']. ' (' .$realm['region']. ')</option>';
					}
				}
				
				echo '
				</select>
				<select onchange="right_table_filter(this.value);">
					<option disabled>select class to filter</option>
					<option disabled selected>' . $middle_right_class_name . '</option>';

					$classes = array( '1' => 'Warrior', '2' => 'Paladin', '3' => 'Hunter', '4' => 'Rogue', '5' => 'Priest', '6' => 'Death Knight', '7' => 'Shaman', '8' => 'Mage', '9' => 'Warlock', '10' => 'Monk', '11' => 'Druid', '12' => 'Demon Hunter' );

					unset( $classes[ $_GET[ 'cl' ] ] );

					foreach ( $classes as $value => $class ) {
						echo '
						<option value="' . $_GET[ 'region' ] . '-' . $_GET[ 'realm' ] . '-' . $value . '-0">' . $class . '</option>';
					}
			echo '
			</select>
			<select onchange="right_table_filter(this.value);">
				<option disabled>filter selected class</option>
				<option disabled selected>' . $spec_name . '</option>
				' . $middle_right_filter . '				
			</select></p>
		</div>
	</div>
	
	<table id="right">
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
	
	// IF REGION = 0
	if(is_numeric($_GET['region'])) {
		$global_table = 'true';
		
		// REGION = 0, REALM = 0, SPEC = 1
		if($_GET['spec'] != 0) {
			$class_table = mysqli_query( $stream, "SELECT * FROM `" . $middle_right_table_name . "` WHERE `spec` = '" .$_GET['spec']. "' ORDER BY `ap` DESC LIMIT 50" );
		}
		// REGION = 0, REALM = 0, SPEC = 0
		else {		
			$class_table = mysqli_query( $stream, "SELECT * FROM `" . $middle_right_table_name . "` ORDER BY `ap` DESC LIMIT 50" );
		}
	}
	// REGION = EU...
	else {
		// REGION = EU, REALM = 0
		if($_GET['realm'] == 0) {
			
			$global_table = 'true';
			// REGION = EU, REALM = 0, SPEC = 0
			if($_GET['spec'] == 0) {
				$class_table = mysqli_query( $stream, "SELECT * FROM `" . $middle_right_table_name . "` WHERE `region` = '" .$_GET['region']. "' ORDER BY `ap` DESC LIMIT 50" );
			}
			// REGION = EU, REALM = 0, SPEC = 1
			else {
				$class_table = mysqli_query( $stream, "SELECT * FROM `" . $middle_right_table_name . "` WHERE `region` = '" .$_GET['region']. "' AND `spec` = '" .$_GET['spec']. "' ORDER BY `ap` DESC LIMIT 50" );
			}
		}
		// REGION = EU, REALM = 281
		else {
			// REGION = EU, REALM = 281, SPEC = 0
			if($_GET['spec'] == 0) {
				$class_table = mysqli_query( $stream, "SELECT * FROM `" . $_GET['region'] . "_" . $_GET['realm'] . "` WHERE `class` = '" .$_GET[ 'cl' ]. "' ORDER BY `ap` DESC LIMIT 50" );
			}
			// REGION = EU, REALM = 281, SPEC = 1
			else {
				$class_table = mysqli_query( $stream, "SELECT * FROM `" . $_GET['region'] . "_" . $_GET['realm'] . "` WHERE `class` = '" .$_GET['cl']. "' AND `spec` = '" .$_GET['spec']. "' ORDER BY `ap` DESC LIMIT 50" );
			}
		}
	}

	$i = 1;

	while ( $class_top = mysqli_fetch_array( $class_table ) ) {

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
		
		switch ( $_GET[ 'cl' ] ) {
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

		if ( $class_top[ 'raid1' ] == 7 ) {
			$raid1 = '<span class="perfect">7/7M</span>';
		} elseif ( $class_top[ 'raid1' ] < 7 && $class_top[ 'raid1' ] > 0 ) {
			$raid1 = '<span class="mediocre">' . $class_top[ 'raid1' ] . '/7M</span>';
		}
		elseif ( $class_top[ 'raid1' ] == 0 ) {
			$raid1 = '<span class="trash">0/7M</span>';
		}

		if ( $class_top[ 'raid2' ] == 3 ) {
			$raid2 = '<span class="perfect">3/3M</span>';
		} elseif ( $class_top[ 'raid2' ] < 3 && $class_top[ 'raid2' ] > 0 ) {
			$raid2 = '<span class="mediocre">' . $class_top[ 'raid2' ] . '/3M</span>';
		}
		elseif ( $class_top[ 'raid2' ] == 0 ) {
			$raid2 = '<span class="trash">0/3M</span>';
		}

		if ( $class_top[ 'raid3' ] == 10 ) {
			$raid3 = '<span class="perfect">10/10M</span>';
		} elseif ( $class_top[ 'raid3' ] < 10 && $class_top[ 'raid3' ] > 0 ) {
			$raid3 = '<span class="mediocre">' . $class_top[ 'raid3' ] . '/10M</span>';
		}
		elseif ( $class_top[ 'raid3' ] == 0 ) {
			$raid3 = '<span class="trash">0/10M</span>';
		}

		if ( $class_top[ 'raid4' ] == 9 ) {
			$raid4 = '<span class="perfect">7/7M</span>';
		} elseif ( $class_top[ 'raid4' ] < 9 && $class_top[ 'raid4' ] > 0 ) {
			$raid4 = '<span class="mediocre">' . $class_top[ 'raid4' ] . '/9M</span>';
		}
		elseif ( $class_top[ 'raid4' ] == 0 ) {
			$raid4 = '<span class="trash">0/9M</span>';
		}

		$global_top[ 'update' ] = $class_top[ 'update' ];
		
		if($global_table == 'true') {
			$realm_id = mysqli_fetch_array(mysqli_query($stream, "SELECT `realm` FROM `" .$middle_right_table_name. "` WHERE `name` = '" .$class_top['name']. "' AND `region` = '" .$class_top['region']. "'"));
			$realm_id = $realm_id['realm'];
						
			$char_id_fetcher = mysqli_fetch_array(mysqli_query($stream, "SELECT `id` FROM `" .$class_top['region']. "_" .$realm_id. "` WHERE `name` = '" .$class_top['name']. "'"));
			$class_top['id'] = $char_id_fetcher['id'];
			
			$realm_name = mysqli_fetch_array(mysqli_query($stream, "SELECT `name` FROM `000_ovw_realms` WHERE `id` = '" .$realm_id. "'"));
			
		}
		else {
			$realm_id = $_GET['realm'];
		}
		
		timeconversion();
		
		if($class_top[ 'region' ] == '') {
			$class_top['region'] = $_GET['region'];
		}
		
		echo '
			<tr>
				<td class="' . $rank_color . '">' . $i . '</td>
				<td class="' . $cell_class . '"><a href="http://armory.gerritalex.de/?r=' . $class_top[ 'region' ] . '&s=' . $realm_name[ 'name' ] . '&c=' . $class_top[ 'name' ] . '">' . $class_top[ 'name' ] . '</a><br /><a class="region" onclick="right_table_filter(\'' .$class_top['region']. '-0-' .$_GET['cl']. '-0\');">' . $class_top[ 'region' ] . '</a> <a class="realm" onclick="right_table_filter(\'' .$class_top['region']. '-' .$class_top['realm']. '-' .$_GET['cl']. '-0\');">' . $realm_name[ 'name' ] . '</a></td>
				<td data-sort-value="' . $class_top[ 'ap' ] . '">' . number_format( ( $class_top[ 'ap' ] / 1000000000 ), 3 ) . ' B</td>
				<td data-sort-value="' . $class_top[ 'al' ] . '">' . $class_top[ 'al' ] . '</td>
				<td data-sort-value="' . $class_top[ 'eq_on' ] . '">' . $class_top[ 'eq_on' ] . '/' . $class_top[ 'eq_off' ] . '</td>
				<td data-sort-value="' . $class_top[ 'mythics' ] . '">' . $class_top[ 'mythics' ] . '</td>
				<td class="raids" data-sort-value="' . ( $global_top[ 'raid1' ] + $global_top[ 'raid2' ] + $global_top[ 'raid3' ] + $global_top[ 'raid4' ] ) . '">' . $raid1 . ' ' . $raid2 . ' ' . $raid3 . '</td>
				<td data-sort-value="' . $class_top[ 'eq' ] . '">' . $class_top[ 'eq' ] . '</td>
				<td id="' . $realm_id . '-' . $class_top[ 'id' ] . '" onclick="right_table_update(this.id);">' . $global_top[ 'update' ] . '</td>
			</tr>';

		$i++;

	}

	echo '
		</tbody>
	</table>
	<script type="text/javascript">
		$("#right").tablesort();
	</script>';

}

?>