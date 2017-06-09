<?php

function timeconversion() {
	global $global_top;

	$global_top['update'] = time('now')-$global_top['update'];
				
	if($global_top['update'] < '60') {
		$global_top['update'] = '<span class="perfect" style="cursor: pointer;"><1 minute</span>';
	}
	elseif($global_top['update'] >= '60' && $global_top['update'] < '3600') {
		if($global_top['update'] < '90') {
			$global_top['update'] = '<span class="perfect" style="cursor: pointer;">' .round($global_top['update']/60, 0). ' minute</span>';
		}
		elseif($global_top['update'] >= '90') {
			$global_top['update'] = '<span class="perfect" style="cursor: pointer;">' .round($global_top['update']/60, 0). ' minutes</span>';
		}
	}
	elseif($global_top['update'] >= '3600' && $global_top['update'] < '86400') {
		if($global_top['update'] < '5400') {
			$global_top['update'] = '<span class="mediocre" style="cursor: pointer;">' .round($global_top['update']/3600, 0). ' hour</span>';
		}
		elseif($global_top['update'] >= '5400') {
			$global_top['update'] = '<span class="mediocre" style="cursor: pointer;">' .round($global_top['update']/3600, 0). ' hours</span>';
		}
	}
	elseif($global_top['update'] >= '86400' && $global_top['update'] < '604800') {
		if( $global_top['update'] < '129600') {
			$global_top['update'] = '<span class="trash" style="cursor: pointer;">' .round($global_top['update']/86400, 0). ' day</span>';
		}
		elseif($global_top['update'] >= '129600') {
			$global_top['update'] = '<span class="trash" style="cursor: pointer;">' .round($global_top['update']/86400, 0). ' days</span>';
		}
	}
	elseif($global_top['update'] >= '604800') {
		$global_top['update'] = '<span class="trash" style="cursor: pointer;">> 1 week</span>';
	}
}

$middle_right_rng = rand( 1, 12 );

switch ( $middle_right_rng ) {
	case 1:
		$middle_right_class_name = 'Warriors';
		$middle_right_class = 'warrior';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-1">Arms</option>
		<option value="0-0-' .$middle_right_rng. '-2">Fury</option>
		<option value="0-0-' .$middle_right_rng. '-3">Protection</option>';
		$middle_right_table_name = '000_top1000_warrior';
		break;
	case 2:
		$middle_right_class_name = 'Paladins';
		$middle_right_class = 'paladin';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-4">Holy</option>
		<option value="0-0-' .$middle_right_rng. '-5">Protection</option>
		<option value="0-0-' .$middle_right_rng. '-6">Retribution</option>';
		$middle_right_table_name = '000_top1000_paladin';
		break;
	case 3:
		$middle_right_class_name = 'Hunters';
		$middle_right_class = 'hunter';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-7">Beast Mastery</option>
		<option value="0-0-' .$middle_right_rng. '-8">Marksmanship</option>
		<option value="0-0-' .$middle_right_rng. '-9">Survival</option>';
		$middle_right_table_name = '000_top1000_hunter';
		break;
	case 4:
		$middle_right_class_name = 'Rogues';
		$middle_right_class = 'rogue';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-10">Assassination</option>
		<option value="0-0-' .$middle_right_rng. '-11">Outlaw</option>
		<option value="0-0-' .$middle_right_rng. '-12">Subtlety</option>';
		$middle_right_table_name = '000_top1000_rogue';
		break;
	case 5:
		$middle_right_class_name = 'Priests';
		$middle_right_class = 'priest';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-13">Discipline</option>
		<option value="0-0-' .$middle_right_rng. '-14">Holy</option>
		<option value="0-0-' .$middle_right_rng. '-15">Shadow</option>';
		$middle_right_table_name = '000_top1000_priest';
		break;
	case 6:
		$middle_right_class_name = 'Death Knights';
		$middle_right_class = 'death_knight';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-16">Blood</option>
		<option value="0-0-' .$middle_right_rng. '-17">Frost</option>
		<option value="0-0-' .$middle_right_rng. '-18">Unholy</option>';
		$middle_right_table_name = '000_top1000_deathknight';
		break;
	case 7:
		$middle_right_class_name = 'Shamans';
		$middle_right_class = 'shaman';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-19">Elemental</option>
		<option value="0-0-' .$middle_right_rng. '-20">Enhancement</option>
		<option value="0-0-' .$middle_right_rng. '-21">Restoration</option>';
		$middle_right_table_name = '000_top1000_shaman';
		break;
	case 8:
		$middle_right_class_name = 'Mages';
		$middle_right_class = 'mage';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-22">Arcane</option>
		<option value="0-0-' .$middle_right_rng. '-23">Fire</option>
		<option value="0-0-' .$middle_right_rng. '-24">Frost</option>';
		$middle_right_table_name = '000_top1000_mage';
		break;
	case 9:
		$middle_right_class_name = 'Warlocks';
		$middle_right_class = 'warlock';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-25">Affliction</option>
		<option value="0-0-' .$middle_right_rng. '-26">Demonology</option>
		<option value="0-0-' .$middle_right_rng. '-27">Destruction</option>';
		$middle_right_table_name = '000_top1000_warlock';
		break;
	case 10:
		$middle_right_class_name = 'Monks';
		$middle_right_class = 'monk';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-28">Brewmaster</option>
		<option value="0-0-' .$middle_right_rng. '-29">Mistweaver</option>
		<option value="0-0-' .$middle_right_rng. '-30">Windwalker</option>';
		$middle_right_table_name = '000_top1000_monk';
		break;
	case 11:
		$middle_right_class_name = 'Druids';
		$middle_right_class = 'druid';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-31">Balance</option>
		<option value="0-0-' .$middle_right_rng. '-32">Feral</option>
		<option value="0-0-' .$middle_right_rng. '-33">Guardian</option>
		<option value="0-0-' .$middle_right_rng. '-34">Restoration</option>';
		$middle_right_table_name = '000_top1000_druid';
		break;
	case 12:
		$middle_right_class_name = 'Demon Hunter';
		$middle_right_class = 'demon_hunter';
		$middle_right_filter = '
		<option value="0-0-' .$middle_right_rng. '-35">Havoc</option>
		<option value="0-0-' .$middle_right_rng. '-36">Vengeance</option>';
		$middle_right_table_name = '000_top1000_demonhunter';
		break;
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="artifact power ranking">
<meta name="keywords" lang="en" content="artifact power, world of warcraft, legion, wow, 2016, expansion, addon, tool, calc, ap, toplist" />
<meta name="robots" content="index, follow" />
<meta name="language" content="en" />
<meta name="distribution" content="global" />
<meta name="reply-to" content="ags@gerritalex.de" />
<meta name="revisit-after" content="3 days" />
<meta name="page-topic" content="artifact power tool" />
<meta name="copyright" content="MIT License" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Artifact Power Ranking</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesort.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/req-min.js"></script>
<link rel="stylesheet" href="css/core.css">
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#left").tablesort();
		$("#right").tablesort();
    } 
); 
</script>
</head>
<body>

<div class="wrap">

	<div class="top">
		<a href="https://apinfo.gerritalex.de"><p class="RBold" style="text-align: center; color: orange;">Artifact Power World Ranking<sup>v3.0</sup></p></a>
		<a href="https://apinfo.gerritalex.de/">apinfo.gerritalex.de</a> is a daughter page of <a href="http://ags.gerritalex.de/">Advanced Guild Statistics</a> and <a href="https://armory.gerritalex.de/">Advanced Armory Access</a><br />
		You\'re a competitive player looking for resources? Head to <a href="http://reddit.com/r/CompetitiveWoW">the Competitive WoW subreddit</a>
	</div>
	
	<div class="middle">
		<div class="middle-top-left">
			Fetch a character
			<input id="character" required type="text" placeholder="name" maxlength="16" onfocus="focus_listener();" />
			<input id="region_character" required type="text" placeholder="region (EU, US, KR, TW)" maxlength="2" />
			<input id="realm_character" required type="text" placeholder="realm, autofills" oninput="realmpop_character();" onfocus="focus_listener();" autocomplete="on" />
			<button onclick="import_character();">Fetch</button>
		</div>
		
		<div class="middle-top-right">
			Fetch a guild
			<input id="guild" required type="text" placeholder="guild name" maxlength="30" onfocus="focus_listener();" />
			<input id="region_guild" required type="text" placeholder="region (EU, US, KR, TW)" maxlength="2" />
			<input id="realm_guild" required type="text" placeholder="realm, autofills" oninput="realmpop_guild();" onfocus="focus_listener();" autocomplete="on" />
			<button onclick="import_guild();">Fetch</button>
		</div>
		
		<div class="middle-import"></div>
	
		<div class="middle-left">
			<div>
				<span class="RBold">Top 50 worldwide</span>
			</div>
			
			<table id="left">
				<thead>
					<tr>
						<th style="cursor: help;"></th>
						<th style="cursor: help;"></th>
						<th style="cursor: help;">AP</th>
						<th style="cursor: help;">AL</th>
						<th style="cursor: help;">Equip</th>
						<th style="cursor: help;">Mythics</th>
						<th style="cursor: help;">Raids</th>
						<th><a onclick="alert(\'Below the tables you will find a lengthy explanation of the Effort Quota!\');">EQ</a></th>
						<th style="cursor: help;">Click to update</th>
					</tr>
				</thead>
				<tbody>';

				include('var/stream.php');

				$global_table = mysqli_query($stream, "SELECT * FROM `000_top1000_global` ORDER BY `ap` DESC LIMIT 50");
				
				$i = 1;

				while($global_top = mysqli_fetch_array($global_table)) {
					
					if($i == 1) { $rank_color = 'artifact RBold'; } elseif($i > 1 && $i <= 3) { $rank_color = 'legendary RBold-medium'; } elseif($i > 3 && $i <= 10) { $rank_color = 'epic RBold-small'; } elseif($i > 10 && $i <= 20) { $rank_color = 'rare'; } elseif($i > 20 && $i <= 30) { $rank_color = 'uncommon'; } elseif($i > 30 && $i <= 50) { $rank_color = 'common'; }					
					
					$realm_name = mysqli_fetch_array(mysqli_query($stream, "SELECT `name` FROM `000_ovw_realms` WHERE `id` = '" .$global_top['realm']. "'"));
					
					switch ($global_top['class']) {
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
					
					if($global_top['raid1'] == 7) {
						$raid1 = '<span class="perfect">7/7M</span>';
					}
					elseif($global_top['raid1'] < 7 && $global_top['raid1'] > 0) {
						$raid1 = '<span class="mediocre">' .$global_top['raid1']. '/7M</span>';
					}
					elseif($global_top['raid1'] == 0) {
						$raid1 = '<span class="trash">0/7M</span>';
					}
					
					if($global_top['raid2'] == 3) {
						$raid2 = '<span class="perfect">3/3M</span>';
					}
					elseif($global_top['raid2'] < 3 && $global_top['raid2'] > 0) {
						$raid2 = '<span class="mediocre">' .$global_top['raid2']. '/3M</span>';
					}
					elseif($global_top['raid2'] == 0) {
						$raid2 = '<span class="trash">0/3M</span>';
					}
					
					if($global_top['raid3'] == 10) {
						$raid3 = '<span class="perfect">10/10M</span>';
					}
					elseif($global_top['raid3'] < 10 && $global_top['raid3'] > 0) {
						$raid3 = '<span class="mediocre">' .$global_top['raid3']. '/10M</span>';
					}
					elseif($global_top['raid3'] == 0) {
						$raid3 = '<span class="trash">0/10M</span>';
					}
					
					if($global_top['raid4'] == 9) {
						$raid4 = '<span class="perfect">7/7M</span>';
					}
					elseif($global_top['raid4'] < 9 && $global_top['raid4'] > 0) {
						$raid4 = '<span class="mediocre">' .$global_top['raid4']. '/9M</span>';
					}
					elseif($global_top['raid4'] == 0) {
						$raid4 = '<span class="trash">0/9M</span>';
					}
					
					timeconversion();
										
					echo '
					<tr>
						<td class="' .$rank_color. '">' .$i. '</td>
						<td class="' .$cell_class. '"><a href="http://armory.gerritalex.de/?r=' .$global_top['region']. '&s=' .$realm_name['name']. '&c=' .$global_top['name']. '">' .$global_top['name']. '</a><br /><a class="region" onclick="left_table_region_filter(this.innerText);">' .$global_top['region']. '</a> <a class="realm" onclick="left_table_realm_filter(\'' .$global_top['realm']. '\');">' .$realm_name['name']. '</a></td>
						<td data-sort-value="' .$global_top['ap']. '">' .number_format(($global_top['ap']/1000000000), 3). ' B</td>
						<td data-sort-value="' .$global_top['al']. '">' .$global_top['al']. '</td>
						<td data-sort-value="' .$global_top['eq_on']. '">' .$global_top['eq_on']. '/' .$global_top['eq_off']. '</td>
						<td data-sort-value="' .$global_top['mythics']. '">' .$global_top['mythics']. '</td>
						<td class="raids" data-sort-value="' .($global_top['raid1']+$global_top['raid2']+$global_top['raid3']+$global_top['raid4']). '">' .$raid1. ' ' .$raid2. ' ' .$raid3. '</td>
						<td data-sort-value="' .$global_top['eq']. '">' .$global_top['eq']. '</td>
						<td id="' .$global_top['id']. '" onclick="left_table_update(this.id);">' .$global_top['update']. '</td>
					</tr>';
					
					$i++;
					
				}

				echo '	
				
				</tbody>
			</table>
		</div>
		
		<div class="middle-right">
			<div class="middle-right-top">
				<div class="' . $middle_right_class . '"><span class="RBold">Top 50 ' .$middle_right_class_name. '</span>				
			
					<p><select onchange="right_table_filter(this.value);">
						<option disabled selected>select region to filter</option>';

						$region_array = array( 'EU', 'US', 'KR', 'TW' );

						foreach ( $region_array as $region ) {
							echo '<option value="' . $region . '-0-' . $middle_right_rng . '-0">' . $region . '</option>';
						}

						echo '
						</select>
						<select onchange="right_table_filter(this.value);">
						<option disabled>select class to filter</option>
						<option disabled selected>' .$middle_right_class_name. '</option>';
						$classes = array('1' => 'Warrior', '2' => 'Paladin', '3' => 'Hunter', '4' => 'Rogue', '5' => 'Priest', '6' => 'Death Knight', '7' => 'Shaman', '8' => 'Mage', '9' => 'Warlock', '10' => 'Monk', '11' => 'Druid', '12' => 'Demon Hunter');

						unset($classes[$middle_right_rng]);

						foreach($classes as $value => $class) {
							echo '
							<option value="0-0-' .$value. '-0">' .$class. '</option>';
						}
					echo '
					</select>
					<select onchange="right_table_filter(this.value);">
						<option selected disabled>filter selected class</option>
						' .$middle_right_filter. '				
					</select></p>
				</div>
			</div>
			
			<table id="right">
				<thead>
					<tr>
						<th style="cursor: help;"></th>
						<th style="cursor: help;"></th>
						<th style="cursor: help;">AP</th>
						<th style="cursor: help;">AL</th>
						<th style="cursor: help;">Equip</th>
						<th style="cursor: help;">Mythics</th>
						<th style="cursor: help;">Raids</th>
						<th><a onclick="alert(\'Below the tables you will find a lengthy explanation of the Effort Quota!\');">EQ</a></th>
						<th style="cursor: help;">Data age</th>
					</tr>
				</thead>
				<tbody>';

				$class_table = mysqli_query($stream, "SELECT * FROM `" .$middle_right_table_name. "` ORDER BY `ap` DESC LIMIT 50");

				$i = 1;

				while($class_top = mysqli_fetch_array($class_table)) {
					
					if($i == 1) { $rank_color = 'artifact RBold'; } elseif($i > 1 && $i <= 3) { $rank_color = 'legendary RBold-medium'; } elseif($i > 3 && $i <= 10) { $rank_color = 'epic RBold-small'; } elseif($i > 10 && $i <= 20) { $rank_color = 'rare'; } elseif($i > 20 && $i <= 30) { $rank_color = 'uncommon'; } elseif($i > 30 && $i <= 50) { $rank_color = 'common'; }
					
					$realm_name = mysqli_fetch_array(mysqli_query($stream, "SELECT `name` FROM `000_ovw_realms` WHERE `id` = '" .$class_top['realm']. "'"));
					
					$realm_internal_id = mysqli_fetch_array(mysqli_query($stream, "SELECT `id` FROM `" .$class_top['region']. "_" .$class_top['realm']. "` WHERE `name` = '" .$class_top['name']. "'"));
					
					switch ($middle_right_rng) {
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
					
					if($class_top['raid1'] == 7) {
						$raid1 = '<span class="perfect">7/7M</span>';
					}
					elseif($class_top['raid1'] < 7 && $class_top['raid1'] > 0) {
						$raid1 = '<span class="mediocre">' .$class_top['raid1']. '/7M</span>';
					}
					elseif($class_top['raid1'] == 0) {
						$raid1 = '<span class="trash">0/7M</span>';
					}
					
					if($class_top['raid2'] == 3) {
						$raid2 = '<span class="perfect">3/3M</span>';
					}
					elseif($class_top['raid2'] < 3 && $class_top['raid2'] > 0) {
						$raid2 = '<span class="mediocre">' .$class_top['raid2']. '/3M</span>';
					}
					elseif($class_top['raid2'] == 0) {
						$raid2 = '<span class="trash">0/3M</span>';
					}
					
					if($class_top['raid3'] == 10) {
						$raid3 = '<span class="perfect">10/10M</span>';
					}
					elseif($class_top['raid3'] < 10 && $class_top['raid3'] > 0) {
						$raid3 = '<span class="mediocre">' .$class_top['raid3']. '/10M</span>';
					}
					elseif($class_top['raid3'] == 0) {
						$raid3 = '<span class="trash">0/10M</span>';
					}
					
					if($class_top['raid4'] == 9) {
						$raid4 = '<span class="perfect">7/7M</span>';
					}
					elseif($class_top['raid4'] < 9 && $class_top['raid4'] > 0) {
						$raid4 = '<span class="mediocre">' .$class_top['raid4']. '/9M</span>';
					}
					elseif($class_top['raid4'] == 0) {
						$raid4 = '<span class="trash">0/9M</span>';
					}
					
					$global_top['update'] = $class_top['update'];
					timeconversion();
					
					echo '
					<tr>
						<td class="' .$rank_color. '">' .$i. '</td>
						<td class="' .$cell_class. '"><a href="http://armory.gerritalex.de/?r=' .$class_top['region']. '&s=' .$realm_name['name']. '&c=' .$class_top['name']. '">' .$class_top['name']. '</a><br /><a class="region" onclick="right_table_filter(\'' .$class_top['region']. '-0-' .$middle_right_rng. '-0\');">' .$class_top['region']. '</a> <a class="realm" onclick="right_table_filter(\'' .$class_top['region']. '-' .$class_top['realm']. '-' .$middle_right_rng. '-0\');">' .$realm_name['name']. '</a></td>
						<td data-sort-value="' .$class_top['ap']. '">' .number_format(($class_top['ap']/1000000000), 3). ' B</td>
						<td data-sort-value="' .$class_top['al']. '">' .$class_top['al']. '</td>
						<td data-sort-value="' .$class_top['eq_on']. '">' .$class_top['eq_on']. '/' .$class_top['eq_off']. '</td>
						<td data-sort-value="' .$class_top['mythics']. '">' .$class_top['mythics']. '</td>
						<td class="raids" data-sort-value="' .($global_top['raid1']+$global_top['raid2']+$global_top['raid3']+$global_top['raid4']). '">' .$raid1. ' ' .$raid2. ' ' .$raid3. '</td>
						<td data-sort-value="' .$class_top['eq']. '">' .$class_top['eq']. '</td>
						<td id="' .$class_top['realm']. '-' .$realm_internal_id['id']. '" onclick="right_table_update(this.id);">' .$global_top['update']. '</td>
					</tr>';
					
					$i++;
					
				}

				echo '	
				
				</tbody>
			</table>
		</div>';

		$yes = '<span style="color: yellowgreen;">yes</span>';
		$no = '<span style="color: coral;">no</span>';

		echo'		
		<div class="middle-bottom">
			<p>What is EQ?</p>
			<p>The <span style="color: white;">E</span>ffort <span style="color: white;">Q</span>uota is an attempt of a all-unifying metric for World of Warcraft: Legion characters, mathematically based on many different stats such as world quests, artifact power, mythic+ dungeons and more, relative to the time needed to complete it.<br /><span style="color: white; cursor: help;" onclick="eq_explanation();">Learn more.</span></p>
			<div class="eq_explanation">
			What follows is a table to demonstrate individual weighting of each relevant stat.
			<table style="width: 100%;">
				<thead>
					<tr>
						<th>category</th>
						<th>factored in</th>
						<th>average time/unit</th>
						<th>normalized worth/point</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>World Quests</td><td>' .$yes. '</td>
						<td>150 seconds</td>
						<td>1</td>
					</tr>
					<tr>
						<td>Mythic 0</td>
						<td>' .$yes. '</td>
						<td>1275 seconds<br /><span style="font-size: small;">average time of 3-chesting all dungeons (Patch 7.2)</span></td>
						<td>8,5005555555</td>
					</tr>
					<tr>
						<td>Mythic 2 to 5</td>
						<td>' .$yes. '</td>
						<td>1338 seconds<br /><span style="font-size: small;">5% longer than M0</span></td>
						<td>8,9255833333</td>
					</tr>
					<tr>
						<td>Mythic 5 to 10</td>
						<td>' .$yes. '</td>
						<td>1403 seconds<br /><span style="font-size: small;">10% longer than M0</span></td>
						<td>9,3506111113</td>
					</tr>
					<tr>
						<td>Mythic 10 to 15</td>
						<td>' .$yes. '</td>
						<td>1466 seconds<br /><span style="font-size: small;">15% longer than M0</span></td>
						<td>9,7756388887</td>
					</tr>
					<tr>
						<td>Mythic 15+</td>
						<td>' .$yes. '</td>
						<td>1530 seconds<br /><span style="font-size: small;">20% longer than M0</span></td>
						<td>10,200666667</td>
					</tr>
					<tr>
						<td>Artifact Power</td>
						<td>' .$yes. '</td>
						<td><span style="cursor: help;" onclick="formula();">individual, click for formula</span></td>
						<td>individual, based on progress and Artifact Knowledge</td>
					</tr>
					<tr>
						<td>Artifact Knowledge</td>
						<td><span style="color: orange;">indirectly</span></td>
						<td>necessary to determine relative worth of AP</td>
						<td></td>
					</tr>
					<tr>
						<td>Artifact Level</td>
						<td>' .$no. '</td>
						<td>would only be connected to currently equipped artifact</td>
						<td></td>
					</tr>
					<tr>
						<td>Itemlevel</td><td>' .$yes. '</td>
						<td><span style="cursor: help;" title="(m10+ time + m15+ time)/2+progress heroic+progress mythic">7798 seconds</span><br /><span style="font-size: small;">assuming that most gear upgrades come from mythics higher than 10 & heroic and mythic raids</span></td>
						<td>51,986666667</td>
					</tr>
					<tr>
						<td>LFR boss kills – EN </td>
						<td>' .$yes. '</td>
						<td>450 seconds<br /><span style="font-size: small;">900 seconds * progression time (0.5)</span></td>
						<td>4,2857142857<br /><span style="font-size: small;">normalized by highest amount of bosses in any current raid (10)</span></td>
					</tr>
					<tr>
						<td>Normal boss kills – EN</td>
						<td>' .$yes. '</td>
						<td>900 seconds<br /><span style="font-size: small;">900 seconds * progression time (1)</span></td>
						<td>8,5714285713</td>
					</tr>
					<tr>
						<td>Heroic boss kills – EN</td>
						<td>' .$yes. '</td>
						<td>1800 seconds<br /><span style="font-size: small;">900 seconds * progression time (2)</span></td>
						<td>17,142857143</td>
					</tr>
					<tr>
						<td>Mythic boss kills – EN</td>
						<td>' .$yes. '</td>
						<td>4500 seconds<br /><span style="font-size: small;">900 seconds * progression time (5)</span></td>
						<td>42,857142857</td>
					</tr>
					
					<tr>
						<td>LFR boss kills – ToV</td>
						<td>' .$yes. '</td>
						<td>450 seconds</td>
						<td>10</td>
					</tr>
					<tr>
						<td>Normal boss kills – ToV</td>
						<td>' .$yes. '</td>
						<td>900 seconds</td>
						<td>20</td>
					</tr>
					<tr>
						<td>Heroic boss kills – ToV</td>
						<td>' .$yes. '</td>
						<td>1800 seconds</td>
						<td>40</td>
					</tr>
					<tr>
						<td>Mythic boss kills – ToV</td>
						<td>' .$yes. '</td>
						<td>4500 seconds</td>
						<td>100</td>
					</tr>					
					<tr>
						<td>LFR boss kills – NH</td>
						<td>' .$yes. '</td>
						<td>450 seconds</td>
						<td>3</td>
					</tr>
					<tr>
						<td>Normal boss kills – NH</td>
						<td>' .$yes. '</td>
						<td>900 seconds</td>
						<td>6</td>
					</tr>
					<tr>
						<td>Heroic boss kills – NH</td>
						<td>' .$yes. '</td>
						<td>1800 seconds</td>
						<td>12</td>
					</tr>
					<tr>
						<td>Mythic boss kills – NH</td>
						<td>' .$yes. '</td>
						<td>4500 seconds</td>
						<td>30</td>
					</tr>					
					<tr>
						<td>LFR boss kills – ToS</td>
						<td>' .$yes. '</td>
						<td>450 seconds</td>
						<td>3,3333333334</td>
					</tr>
					<tr>
						<td>Normal boss kills – ToS</td>
						<td>' .$yes. '</td>
						<td>900 seconds</td>
						<td>6,6666666667</td>
					</tr>
					<tr>
						<td>Heroic boss kills – ToS</td>
						<td>' .$yes. '</td>
						<td>1800 seconds</td>
						<td>13,333333333</td>
					</tr>
					<tr>
						<td>Mythic boss kills – ToS</td>
						<td>' .$yes. '</td>
						<td>4500 seconds</td>
						<td>33,333333334</td>
					</tr>					
				</tbody>
			</table>			
			</div>
		</div>
	</div>	
	
	<div class="bot">
		<p>realized by <a href="http://armory.gerritalex.de/?r=EU&s=Blackmoore&c=Xepheris">Xepheris @ EU-Blackmoore</a><br />
		written with PHP, MySQL, JS, HTML, CSS, Blizzard API<sup>(World of Warcraft and Warcraft are trademarks of Blizzard Entertainment)</sup></p>
	</div>

</div>';

if(isset($_GET['lt']) && $_GET['lt'] == 'true' && isset($_GET['r']) && strlen($_GET['r']) == '2') {
	if(isset($_GET['s']) && is_numeric($_GET['s'])) {		
		echo '<script type="text/javascript">left_table_realm_filter("' .$_GET['s']. '");</script>';
	}
	else {
		echo '<script type="text/javascript">left_table_region_filter("' .$_GET['r']. '");</script>';
	}
}
if(isset($_GET['rt']) && $_GET['rt'] == 'true') {
	echo '<script type="text/javascript">right_table_filter(\'' .$_GET['region']. '-' .$_GET['realm']. '-' .$_GET['class']. '-' .$_GET['spec']. '\');</script>';
}


echo '
<script>
		( function ( i, s, o, g, r, a, m ) {
			i[ "GoogleAnalyticsObject" ] = r;
			i[ r ] = i[ r ] || function () {
				( i[ r ].q = i[ r ].q || [] ).push( arguments )
			}, i[ r ].l = 1 * new Date();
			a = s.createElement( o ),
				m = s.getElementsByTagName( o )[ 0 ];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore( a, m )
		} )( window, document, "script", "https://www.google-analytics.com/analytics.js", "ga" );

		ga( "create", "UA-96406935-1", "auto" );
		ga( "send", "pageview" );
	</script>
</html>';



?>