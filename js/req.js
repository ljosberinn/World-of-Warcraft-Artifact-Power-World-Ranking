function eq_explanation() {
	if ($('.eq_explanation').css('display') == 'none') {
		$('.eq_explanation').fadeIn('slow');
	} else {
		$('.eq_explanation').fadeOut('slow');
	}
}

function formula() {
	window.alert("$ap = current character AP value\n$threshold = AP needed for 52 traits(2228766330)\n\n$ap_per_run = AP you recieve per mythic + 10 run, which is the most efficient way to farm AP, with your current AK(600 * 2 * AK % increase)\n$time_per_run = time needed	for one mythic + 10 run(1466 seconds)\n$ap_per_run = 2*600*(AK % increase);\n\n$worth = ($threshold / $ap_per_run) * $time_per_run / 150\nformula = (($ap / $threshold) * $worth) / 2.5\nThe division by 2.5 is a extra penalty on top of the already inflationary high value of AP to balance AP contribution towards EQ in comparison to other values\n\ne.g.:\nat the time of writing this, the current world #1 of AP has: 4301623130 AP at AK 33 => 8300% increased AP \n=> $ap_per_run = 2*600*8300 = 9960000\n\n=> $worth = (2228766330/9960000)*1466/150 = 2186,9956089\n\n=> formula = ((4301623130/2228766330) * 2186,9956089) / 2,5\n\n=> 1.688,4014748 AP points counting towards EQ\n\nDruids and Demon Hunters still need to be normalized due to their different maximum AP possibilities (druids /4*3, demon hunters /2*3)");
}

function class_table_swap(str) {

	$.ajax({
		url: 'var/class_table_swap.php',
		type: 'get',
		dataType: 'html',
		data: {
			cl: str
		},
		success: function (data) {
			$('.middle-right').empty();
			$('.middle-right').append(data);

			if (str === 1) {
				var class_name = 'Warrior';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/wr.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 2) {
				var class_name = 'Paladin';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/pl.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 3) {
				var class_name = 'Hunter';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/hu.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 4) {
				var class_name = 'Rogue';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/ro.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 5) {
				var class_name = 'Priest';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/pr.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 6) {
				var class_name = 'Death Knight';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/dk.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 7) {
				var class_name = 'Shaman';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/sh.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 8) {
				var class_name = 'Mage';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/ma.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 9) {
				var class_name = 'Warlock';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/wl.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 10) {
				var class_name = 'Monk';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/mo.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 11) {
				var class_name = 'Druid';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/dr.png" rel="shortcut icon" type="image/x-icon" />');
			}
			if (str === 12) {
				var class_name = 'Demon Hunter';
				$('head').append('<link href="http://apinfo.gerritalex.de/img/dh.png" rel="shortcut icon" type="image/x-icon" />');
			}

			window.history.pushState('AP INFO - ' + class_name + '', 'AP INFO - ' + class_name + '', '/?class=' + str + '');

			document.title = 'AP INFO - ' + class_name + '';
		},
		error: function () {
			$('.middle-right').empty();
			$('.middle-right').append('<table style="width: 100%;"><tbody><tr><td><span class="trash">The server encountered an error when trying to fetch required data. Please try again after refreshing.</span></td></tr></tbody></table>');
		}
	});

}

function left_table_region_filter(elementText) {

	$.ajax({
		url: 'var/global_table_region_filter.php',
		type: 'get',
		dataType: 'html',
		data: {
			region: elementText
		},
		success: function (data) {
			$('.middle-left').empty();
			$('.middle-left').append(data);

			if (elementText == 'EU') {
				var region = 'EU';
			}
			if (elementText == 'US') {
				var region = 'US';
			}
			if (elementText == 'KR') {
				var region = 'KR';
			}
			if (elementText == 'TW') {
				var region = 'TW';
			}

			window.history.pushState('AP INFO – ' + region + '', 'AP INFO – ' + region + '', '/?lt=true&r=' + elementText + '');

			document.title = 'AP INFO – ' + region + '';
		},
		error: function () {
			$('.middle-left').find('div').append('<table style="width: 100%;"><tbody><tr><td><span class="trash">The server encountered an error when trying to fetch required data. Please try again now or at a later point.</span></td></tr></tbody></table>');
		}
	});

}

function left_table_realm_filter(str) {

	$.ajax({
		url: 'var/global_table_realm_filter.php',
		type: 'get',
		dataType: 'html',
		data: {
			realm: str
		},
		success: function (data) {
			$('.middle-left').empty();
			$('.middle-left').append(data);

			if (str >= 1 && str <= 246) {
				var region = 'US';
			}
			if ((str >= 247 && str <= 563) || (str >= 1001 && str <= 1200)) {
				var region = 'EU';
			}
			if (str >= 949 && str <= 966) {
				var region = 'KR';
			}
			if (str >= 923 && str <= 947) {
				var region = 'TW';
			}

			var realm_id_name_conversion = {
				1: 'Aegwynn',
				2: 'Aerie Peak',
				3: 'Agamaggan',
				4: 'Aggramar',
				5: 'Akama',
				6: 'Alexstrasza',
				7: 'Alleria',
				8: 'Altar of Storms',
				9: 'Alterac Mountains',
				10: 'Aman\'Thul',
				11: 'Andorhal',
				12: 'Anetheron',
				13: 'Antonidas',
				14: 'Anub\'arak',
				512: 'Anvilmar',
				15: 'Arathor',
				16: 'Archimonde',
				17: 'Area 52',
				18: 'Argent Dawn',
				19: 'Arthas',
				20: 'Arygos',
				21: 'Auchindoun',
				22: 'Azgalor',
				23: 'Azjol-Nerub',
				24: 'Azralon',
				25: 'Azshara',
				26: 'Azuremyst',
				27: 'Baelgun',
				28: 'Balnazzar',
				29: 'Barthilas',
				30: 'Black Dragonflight',
				31: 'Blackhand',
				514: 'Blackmoore',
				32: 'Blackrock',
				33: 'Blackwater Raiders',
				34: 'Blackwing Lair',
				35: 'Blade\'s Edge',
				36: 'Bladefist',
				37: 'Bleeding Hollow',
				38: 'Blood Furnace',
				39: 'Bloodhoof',
				40: 'Bloodscalp',
				41: 'Bonechewer',
				42: 'Borean Tundra',
				43: 'Boulderfist',
				44: 'Bronzebeard',
				45: 'Burning Blade',
				46: 'Burning Legion',
				47: 'Caelestrasz',
				48: 'Cairne',
				49: 'Cenarion Circle',
				50: 'Cenarius',
				51: 'Cho\'gall',
				52: 'Chromaggus',
				53: 'Coilfang',
				54: 'Crushridge',
				55: 'Daggerspine',
				56: 'Dalaran',
				57: 'Dalvengyr',
				58: 'Dark Iron',
				59: 'Darkspear',
				60: 'Darrowmere',
				61: 'Dath\'Remar',
				62: 'Dawnbringer',
				63: 'Deathwing',
				64: 'Demon Soul',
				65: 'Dentarg',
				66: 'Destromath',
				67: 'Dethecus',
				68: 'Detheroc',
				69: 'Doomhammer',
				70: 'Draenor',
				71: 'Dragonblight',
				72: 'Dragonmaw',
				73: 'Drak\'Tharon',
				74: 'Drak\'thul',
				75: 'Draka',
				76: 'Drakkari',
				77: 'Dreadmaul',
				78: 'Drenden',
				79: 'Dunemaul',
				80: 'Durotan',
				81: 'Duskwood',
				82: 'Earthen Ring',
				83: 'Echo Isles',
				84: 'Eitrigg',
				85: 'Eldre\'Thalas',
				86: 'Elune',
				87: 'Emerald Dream',
				88: 'Eonar',
				89: 'Eredar',
				90: 'Executus',
				91: 'Exodar',
				92: 'Farstriders',
				93: 'Feathermoon',
				94: 'Fenris',
				95: 'Firetree',
				96: 'Fizzcrank',
				97: 'Frostmane',
				98: 'Frostmourne',
				99: 'Frostwolf',
				100: 'Galakrond',
				101: 'Gallywix',
				102: 'Garithos',
				103: 'Garona',
				104: 'Garrosh',
				105: 'Ghostlands',
				106: 'Gilneas',
				107: 'Gnomeregan',
				108: 'Goldrinn',
				109: 'Gorefiend',
				110: 'Gorgonnash',
				111: 'Greymane',
				112: 'Grizzly Hills',
				113: 'Gul\'dan',
				114: 'Gundrak',
				115: 'Gurubashi',
				116: 'Hakkar',
				117: 'Haomarush',
				118: 'Hellscream',
				119: 'Hydraxis',
				120: 'Hyjal',
				121: 'Icecrown',
				122: 'Illidan',
				123: 'Jaedenar',
				124: 'Jubei\'Thos',
				125: 'Kael\'thas',
				126: 'Kalecgos',
				127: 'Kargath',
				128: 'Kel\'Thuzad',
				129: 'Khadgar',
				130: 'Khaz Modan',
				131: 'Khaz\'goroth',
				132: 'Kil\'jaeden',
				133: 'Kilrogg',
				134: 'Kirin Tor',
				135: 'Korgath',
				136: 'Korialstrasz',
				137: 'Kul Tiras',
				138: 'Laughing Skull',
				139: 'Lethon',
				140: 'Lightbringer',
				141: 'Lightning\'s Blade',
				142: 'Lightninghoof',
				143: 'Llane',
				144: 'Lothar',
				145: 'Madoran',
				146: 'Maelstrom',
				147: 'Magtheridon',
				148: 'Maiev',
				149: 'Mal\'Ganis',
				150: 'Malfurion',
				151: 'Malorne',
				152: 'Malygos',
				153: 'Mannoroth',
				154: 'Medivh',
				155: 'Misha',
				156: 'Mok\'Nathal',
				157: 'Moon Guard',
				158: 'Moonrunner',
				159: 'Mug\'thol',
				160: 'Muradin',
				161: 'Nagrand',
				162: 'Nathrezim',
				526: 'Naxxramas',
				163: 'Nazgrel',
				164: 'Nazjatar',
				165: 'Nemesis',
				166: 'Ner\'zhul',
				167: 'Nesingwary',
				168: 'Nordrassil',
				169: 'Norgannon',
				170: 'Onyxia',
				171: 'Perenolde',
				172: 'Proudmoore',
				174: 'Quel\'dorei',
				173: 'Quel\'Thalas',
				175: 'Ragnaros',
				176: 'Ravencrest',
				177: 'Ravenholdt',
				178: 'Rexxar',
				179: 'Rivendare',
				180: 'Runetotem',
				181: 'Sargeras',
				182: 'Saurfang',
				183: 'Scarlet Crusade',
				184: 'Scilla',
				185: 'Sen\'jin',
				186: 'Sentinels',
				187: 'Shadow Council',
				188: 'Shadowmoon',
				189: 'Shadowsong',
				190: 'Shandris',
				191: 'Shattered Halls',
				192: 'Shattered Hand',
				193: 'Shu\'halo',
				194: 'Silver Hand',
				195: 'Silvermoon',
				196: 'Sisters of Elune',
				197: 'Skullcrusher',
				198: 'Skywall',
				199: 'Smolderthorn',
				200: 'Spinebreaker',
				201: 'Spirestone',
				202: 'Staghelm',
				203: 'Steamwheedle Cartel',
				204: 'Stonemaul',
				205: 'Stormrage',
				206: 'Stormreaver',
				207: 'Stormscale',
				208: 'Suramar',
				209: 'Tanaris',
				210: 'Terenas',
				211: 'Terokkar',
				212: 'Thaurissan',
				213: 'The Forgotten Coast',
				214: 'The Scryers',
				215: 'The Underbog',
				216: 'The Venture Co',
				527: 'Theradras',
				217: 'Thorium Brotherhood',
				218: 'Thrall',
				219: 'Thunderhorn',
				220: 'Thunderlord',
				221: 'Tichondrius',
				222: 'Tol Barad',
				223: 'Tortheldrin',
				224: 'Trollbane',
				225: 'Turalyon',
				226: 'Twisting Nether',
				227: 'Uldaman',
				528: 'Ulduar',
				228: 'Uldum',
				229: 'Undermine',
				230: 'Ursin',
				231: 'Uther',
				232: 'Vashj',
				233: 'Vek\'nilash',
				234: 'Velen',
				235: 'Warsong',
				236: 'Whisperwind',
				237: 'Wildhammer',
				238: 'Windrunner',
				239: 'Winterhoof',
				240: 'Wyrmrest Accord',
				241: 'Xavius',
				242: 'Ysera',
				243: 'Ysondre',
				244: 'Zangarmarsh',
				245: 'Zul\'jin',
				246: 'Zuluhed',
				247: 'Aegwynn',
				248: 'Aerie Peak',
				249: 'Agamaggan',
				250: 'Aggra(Português)',
				251: 'Aggramar',
				252: 'Ahn\'Qiraj',
				253: 'Al\'Akir',
				254: 'Alexstrasza',
				255: 'Alleria',
				256: 'Alonsus',
				257: 'Aman\'Thul',
				258: 'Ambossar',
				259: 'Anachronos',
				260: 'Anetheron',
				261: 'Antonidas',
				262: 'Anub\'arak',
				263: 'Arak - arahm',
				264: 'Arathi',
				265: 'Arathor',
				266: 'Archimonde',
				267: 'Area 52',
				268: 'Argent Dawn',
				269: 'Arthas',
				270: 'Arygos',
				271: 'Ashenvale',
				272: 'Aszune',
				273: 'Auchindoun',
				274: 'Azjol - Nerub',
				275: 'Azshara',
				276: 'Azuregos',
				277: 'Azuremyst',
				278: 'Baelgun',
				279: 'Balnazzar',
				280: 'Blackhand',
				281: 'Blackmoore',
				282: 'Blackrock',
				283: 'Blackscar',
				284: 'Blade\'s Edge',
				285: 'Bladefist',
				286: 'Bloodfeather',
				287: 'Bloodhoof',
				288: 'Bloodscalp',
				289: 'Blutkessel',
				290: 'Booty Bay',
				291: 'Borean Tundra',
				292: 'Boulderfist',
				293: 'Bronze Dragonflight',
				294: 'Bronzebeard',
				295: 'Burning Blade',
				531: 'Burning Legion',
				296: 'Burning Steppes',
				297: 'C\'Thun',
				532: 'Caduta dei Draghi',
				533: 'Cerchio del Sangue',
				298: 'Chamber of Aspects',
				299: 'Chants éternels',
				300: 'Cho\'gall',
				301: 'Chromaggus',
				302: 'Colinas Pardas',
				303: 'Confrérie du Thorium',
				304: 'Conseil des Ombres',
				305: 'Crushridge',
				306: 'Culte de la Rive noire',
				307: 'Daggerspine',
				308: 'Dalaran',
				309: 'Dalvengyr',
				310: 'Darkmoon Faire',
				311: 'Darksorrow',
				312: 'Darkspear',
				313: 'Das Konsortium',
				314: 'Das Syndikat',
				315: 'Deathguard',
				316: 'Deathweaver',
				317: 'Deathwing',
				318: 'Deepholm',
				319: 'Defias Brotherhood',
				320: 'Dentarg',
				323: 'Der abyssische Rat',
				321: 'Der Mithrilorden',
				322: 'Der Rat von Dalaran',
				324: 'Destromath',
				325: 'Dethecus',
				326: 'Die Aldor',
				327: 'Die Arguswacht',
				331: 'Die ewige Wacht',
				328: 'Die Nachtwache',
				329: 'Die Silberne Hand',
				330: 'Die Todeskrallen',
				332: 'Doomhammer',
				333: 'Draenor',
				334: 'Dragonblight',
				335: 'Dragonmaw',
				336: 'Drak\'thul',
				337: 'Drek\'Thar',
				338: 'Dun Modr',
				339: 'Dun Morogh',
				340: 'Dunemaul',
				341: 'Durotan',
				342: 'Earthen Ring',
				343: 'Echsenkessel',
				344: 'Eitrigg',
				345: 'Eldre\'Thalas',
				346: 'Elune',
				347: 'Emerald Dream',
				348: 'Emeriss',
				349: 'Eonar',
				350: 'Eredar',
				534: 'Euskal Encounter',
				351: 'Eversong',
				352: 'Executus',
				353: 'Exodar',
				354: 'Festung der Stürme',
				355: 'Fordragon',
				356: 'Forscherliga',
				357: 'Frostmane',
				358: 'Frostmourne',
				359: 'Frostwhisper',
				360: 'Frostwolf',
				361: 'Galakrond',
				362: 'Garona',
				363: 'Garrosh',
				364: 'Genjuros',
				365: 'Ghostlands',
				366: 'Gilneas',
				536: 'Gnomeregan',
				367: 'Goldrinn',
				368: 'Gordunni',
				369: 'Gorgonnash',
				370: 'Greymane',
				371: 'Grim Batol',
				537: 'Grizzlyhügel',
				372: 'Grom',
				373: 'Gul\'dan',
				374: 'Hakkar',
				375: 'Haomarush',
				376: 'Hellfire',
				377: 'Hellscream',
				378: 'Howling Fjord',
				379: 'Hyjal',
				380: 'Illidan',
				381: 'Jaedenar',
				382: 'Kael\'thas',
				383: 'Karazhan',
				384: 'Kargath',
				385: 'Kazzak',
				386: 'Kel\'Thuzad',
				387: 'Khadgar',
				388: 'Khaz Modan',
				389: 'Khaz\'goroth',
				390: 'Kil\'jaeden',
				391: 'Kilrogg',
				392: 'Kirin Tor',
				393: 'Kor\'gall',
				394: 'Krag\'jin',
				395: 'Krasus',
				396: 'Kul Tiras',
				397: 'Kult der Verdammten',
				398: 'La Croisade écarlate',
				399: 'Laughing Skull',
				400: 'Les Clairvoyants',
				401: 'Les Sentinelles',
				402: 'Lich King',
				403: 'Lightbringer',
				404: 'Lightning\'s Blade',
				405: 'Lordaeron',
				406: 'Los Errantes',
				407: 'Lothar',
				408: 'Madmortem',
				409: 'Magtheridon',
				410: 'Mal\'Ganis',
				411: 'Malfurion',
				412: 'Malorne',
				413: 'Malygos',
				414: 'Mannoroth',
				415: 'Marécage de Zangar',
				416: 'Mazrigos',
				417: 'Medivh',
				557: 'Menethil',
				418: 'Minahonda',
				558: 'Molten Core',
				419: 'Moonglade',
				420: 'Mug\'thol',
				559: 'Muradin',
				421: 'Nagrand',
				422: 'Nathrezim',
				423: 'Naxxramas',
				424: 'Nazjatar',
				425: 'Nefarian',
				426: 'Nemesis',
				427: 'Neptulon',
				428: 'Ner\'zhul',
				429: 'Nera\'thor',
				430: 'Nethersturm',
				431: 'Nordrassil',
				432: 'Norgannon',
				433: 'Nozdormu',
				434: 'Onyxia',
				435: 'Outland',
				436: 'Perenolde',
				437: 'Pozzo dell\'Eternità',
				438: 'Proudmoore',
				439: 'Quel\'Thalas',
				440: 'Ragnaros',
				441: 'Rajaxx',
				442: 'Rashgarroth',
				443: 'Ravencrest',
				444: 'Ravenholdt',
				445: 'Razuvious',
				446: 'Rexxar',
				447: 'Runetotem',
				448: 'Sanguino',
				449: 'Sargeras',
				450: 'Saurfang',
				451: 'Scarshield Legion',
				560: 'Schwarznarbe',
				452: 'Sen\'jin',
				453: 'Shadowsong',
				454: 'Shattered Halls',
				455: 'Shattered Hand',
				456: 'Shattrath',
				457: 'Shen\'dralar',
				458: 'Silvermoon',
				459: 'Sinstralis',
				460: 'Skullcrusher',
				461: 'Soulflayer',
				462: 'Spinebreaker',
				463: 'Sporeggar',
				464: 'Steamwheedle Cartel',
				561: 'Stonemaul',
				465: 'Stormrage',
				466: 'Stormreaver',
				467: 'Stormscale',
				468: 'Sunstrider',
				562: 'Suramar',
				469: 'Sylvanas',
				470: 'Taerar',
				471: 'Talnivarr',
				472: 'Tarren Mill',
				473: 'Teldrassil',
				474: 'Temple noir',
				475: 'Terenas',
				476: 'Terokkar',
				477: 'Terrordar',
				478: 'The Maelstrom',
				479: 'The Sha\'tar',
				480: 'The Venture Co',
				481: 'Theradras',
				482: 'Thermaplugg',
				483: 'Thrall',
				484: 'Throk\'Feroth',
				485: 'Thunderhorn',
				486: 'Tichondrius',
				487: 'Tirion',
				488: 'Todeswache',
				489: 'Trollbane',
				490: 'Turalyon',
				491: 'Twilight\'s Hammer',
				492: 'Twisting Nether',
				493: 'Tyrande',
				494: 'Uldaman',
				495: 'Ulduar',
				496: 'Uldum',
				497: 'Un\'Goro',
				498: 'Varimathras',
				499: 'Vashj',
				500: 'Vek\'lor',
				501: 'Vek\'nilash',
				502: 'Vol\'jin',
				503: 'Wildhammer',
				563: 'Winterhuf',
				504: 'Wrathbringer',
				505: 'Xavius',
				506: 'Ysera',
				507: 'Ysondre',
				508: 'Zenedar',
				509: 'Zirkel des Cenarius',
				510: 'Zul\'jin',
				511: 'Zuluhed',
				1008: 'Азурегос',
				1009: 'Борейская - тундра',
				1010: 'Вечная Песня',
				1015: 'Галакронд',
				1012: 'Голдринн',
				1001: 'Гордунни',
				1014: 'Гром',
				1006: 'Дракономор',
				1013: 'Король - лич',
				1011: 'Пиратская Бухта',
				1004: 'Разувий',
				1016: 'Ревущий фьорд',
				1002: 'Свежеватель Душ',
				1007: 'Страж смерти',
				1005: 'Черный Шрам',
				1003: 'Ясеневый лес',
				923: '世界之樹',
				924: '亞雷戈斯',
				925: '冰霜之刺',
				926: '冰風崗哨',
				927: '地獄吼',
				928: '夜空之歌',
				929: '天空之牆',
				930: '寒冰皇冠',
				931: '尖石',
				932: '屠魔山谷',
				933: '巨龍之喉',
				934: '憤怒使者',
				935: '日落沼澤',
				936: '暗影之月',
				937: '水晶之刺',
				938: '狂熱之刃',
				939: '眾星之子',
				940: '米奈希爾',
				941: '聖光之願',
				942: '血之谷',
				943: '語風',
				944: '銀翼要塞',
				945: '阿薩斯',
				946: '雲蛟衛',
				947: '雷鱗',
				960: '가로나',
				961: '굴단',
				963: '노르간논',
				959: '달라란',
				949: '데스윙',
				950: '듀로탄',
				964: '렉사르',
				962: '말퓨리온',
				951: '불타는 군단',
				952: '세나리우스',
				965: '스톰레이지',
				953: '아즈샤라',
				958: '알렉스트라자',
				966: '와일드해머',
				954: '윈드러너',
				955: '줄진',
				956: '하이잘',
				957: '헬스크림 '
			};

			var realm_name = realm_id_name_conversion[str];

			window.history.pushState('AP INFO - ' + realm_name + '', 'AP INFO - ' + region + '–' + realm_name + '', '/?lt=true&r=' + region + '&s=' + str + '');

			document.title = 'AP INFO - ' + region + '–' + realm_name + '';

		},
		error: function () {
			$('.middle-left').find('div').append('<table style="width: 100%;"><tbody><tr><td><span class="trash">The server encountered an error when trying to fetch required data. Please try again now or at a later point.</span></td></tr></tbody></table>');
		}
	});

}

function right_table_filter(str) {

	var str = str.split('-');
	var region = str[0];
	var realm = str[1];
	var cl = str[2];
	var spec = str[3];

	$.ajax({
		url: 'var/right_table_filter.php',
		type: 'get',
		dataType: 'html',
		data: {
			region: region,
			realm: realm,
			cl: cl,
			spec: spec
		},
		success: function (data) {
			$('.middle-right').empty();
			$('.middle-right').append(data);

			if (cl == 1) {
				var class_name = 'Warrior';
				var shortcut = 'wr';
				if (spec == 1) {
					var spec_name = 'Fury';
				}
				if (spec == 2) {
					var spec_name = 'Arms';
				}
				if (spec == 3) {
					var spec_name = 'Protection';
				}
			}
			if (cl == 2) {
				var class_name = 'Paladin';
				var shortcut = 'pl';
				if (spec == 4) {
					var spec_name = 'Holy';
				}
				if (spec == 5) {
					var spec_name = 'Protection';
				}
				if (spec == 6) {
					var spec_name = 'Retribution';
				}
			}
			if (cl == 3) {
				var class_name = 'Hunter';
				var shortcut = 'hu';
				if (spec == 7) {
					var spec_name = 'Beast Mastery';
				}
				if (spec == 8) {
					var spec_name = 'Marksmanship';
				}
				if (spec == 9) {
					var spec_name = 'Survival';
				}
			}
			if (cl == 4) {
				var class_name = 'Rogue';
				var shortcut = 'ro';
				if (spec == 10) {
					var spec_name = 'Assassination';
				}
				if (spec == 11) {
					var spec_name = 'Outlaw';
				}
				if (spec == 12) {
					var spec_name = 'Subtlety';
				}
			}
			if (cl == 5) {
				var class_name = 'Priest';
				var shortcut = 'pr';
				if (spec == 13) {
					var spec_name = 'Discipline';
				}
				if (spec == 14) {
					var spec_name = 'Holy';
				}
				if (spec == 15) {
					var spec_name = 'Shadow';
				}
			}
			if (cl == 6) {
				var class_name = 'Death Knight';
				var shortcut = 'dk';
				if (spec == 16) {
					var spec_name = 'Blood';
				}
				if (spec == 17) {
					var spec_name = 'Frost';
				}
				if (spec == 18) {
					var spec_name = 'Unholy';
				}
			}
			if (cl == 7) {
				var class_name = 'Shaman';
				var shortcut = 'sh';
				if (spec == 19) {
					var spec_name = 'Elemental';
				}
				if (spec == 20) {
					var spec_name = 'Enhancement';
				}
				if (spec == 21) {
					var spec_name = 'Restoration';
				}
			}
			if (cl == 8) {
				var class_name = 'Mage';
				var shortcut = 'ma';
				if (spec == 22) {
					var spec_name = 'Arcane';
				}
				if (spec == 23) {
					var spec_name = 'Fire';
				}
				if (spec == 24) {
					var spec_name = 'Frost';
				}
			}
			if (cl == 9) {
				var class_name = 'Warlock';
				var shortcut = 'wl';
				if (spec == 25) {
					var spec_name = 'Affliction';
				}
				if (spec == 26) {
					var spec_name = 'Demonology';
				}
				if (spec == 27) {
					var spec_name = 'Destruction';
				}
			}
			if (cl == 10) {
				var class_name = 'Monk';
				var shortcut = 'mo';
				if (spec == 28) {
					var spec_name = 'Brewmaster';
				}
				if (spec == 29) {
					var spec_name = 'Mistweaver';
				}
				if (spec == 30) {
					var spec_name = 'Windwalker';
				}
			}
			if (cl == 11) {
				var class_name = 'Druid';
				var shortcut = 'dr';
				if (spec == 31) {
					var spec_name = 'Balance';
				}
				if (spec == 32) {
					var spec_name = 'Feral';
				}
				if (spec == 33) {
					var spec_name = 'Guardian';
				}
				if (spec == 34) {
					var spec_name = 'Restoration';
				}
			}
			if (cl == 12) {
				var class_name = 'Demon Hunter';
				var shortcut = 'dh';
				if (spec == 35) {
					var spec_name = 'Havoc';
				}
				if (spec == 36) {
					var spec_name = 'Vengeance';
				}
			}

			var realm_id_name_conversion = {
				1: 'Aegwynn',
				2: 'Aerie Peak',
				3: 'Agamaggan',
				4: 'Aggramar',
				5: 'Akama',
				6: 'Alexstrasza',
				7: 'Alleria',
				8: 'Altar of Storms',
				9: 'Alterac Mountains',
				10: 'Aman\'Thul',
				11: 'Andorhal',
				12: 'Anetheron',
				13: 'Antonidas',
				14: 'Anub\'arak',
				512: 'Anvilmar',
				15: 'Arathor',
				16: 'Archimonde',
				17: 'Area 52',
				18: 'Argent Dawn',
				19: 'Arthas',
				20: 'Arygos',
				21: 'Auchindoun',
				22: 'Azgalor',
				23: 'Azjol-Nerub',
				24: 'Azralon',
				25: 'Azshara',
				26: 'Azuremyst',
				27: 'Baelgun',
				28: 'Balnazzar',
				29: 'Barthilas',
				30: 'Black Dragonflight',
				31: 'Blackhand',
				514: 'Blackmoore',
				32: 'Blackrock',
				33: 'Blackwater Raiders',
				34: 'Blackwing Lair',
				35: 'Blade\'s Edge',
				36: 'Bladefist',
				37: 'Bleeding Hollow',
				38: 'Blood Furnace',
				39: 'Bloodhoof',
				40: 'Bloodscalp',
				41: 'Bonechewer',
				42: 'Borean Tundra',
				43: 'Boulderfist',
				44: 'Bronzebeard',
				45: 'Burning Blade',
				46: 'Burning Legion',
				47: 'Caelestrasz',
				48: 'Cairne',
				49: 'Cenarion Circle',
				50: 'Cenarius',
				51: 'Cho\'gall',
				52: 'Chromaggus',
				53: 'Coilfang',
				54: 'Crushridge',
				55: 'Daggerspine',
				56: 'Dalaran',
				57: 'Dalvengyr',
				58: 'Dark Iron',
				59: 'Darkspear',
				60: 'Darrowmere',
				61: 'Dath\'Remar',
				62: 'Dawnbringer',
				63: 'Deathwing',
				64: 'Demon Soul',
				65: 'Dentarg',
				66: 'Destromath',
				67: 'Dethecus',
				68: 'Detheroc',
				69: 'Doomhammer',
				70: 'Draenor',
				71: 'Dragonblight',
				72: 'Dragonmaw',
				73: 'Drak\'Tharon',
				74: 'Drak\'thul',
				75: 'Draka',
				76: 'Drakkari',
				77: 'Dreadmaul',
				78: 'Drenden',
				79: 'Dunemaul',
				80: 'Durotan',
				81: 'Duskwood',
				82: 'Earthen Ring',
				83: 'Echo Isles',
				84: 'Eitrigg',
				85: 'Eldre\'Thalas',
				86: 'Elune',
				87: 'Emerald Dream',
				88: 'Eonar',
				89: 'Eredar',
				90: 'Executus',
				91: 'Exodar',
				92: 'Farstriders',
				93: 'Feathermoon',
				94: 'Fenris',
				95: 'Firetree',
				96: 'Fizzcrank',
				97: 'Frostmane',
				98: 'Frostmourne',
				99: 'Frostwolf',
				100: 'Galakrond',
				101: 'Gallywix',
				102: 'Garithos',
				103: 'Garona',
				104: 'Garrosh',
				105: 'Ghostlands',
				106: 'Gilneas',
				107: 'Gnomeregan',
				108: 'Goldrinn',
				109: 'Gorefiend',
				110: 'Gorgonnash',
				111: 'Greymane',
				112: 'Grizzly Hills',
				113: 'Gul\'dan',
				114: 'Gundrak',
				115: 'Gurubashi',
				116: 'Hakkar',
				117: 'Haomarush',
				118: 'Hellscream',
				119: 'Hydraxis',
				120: 'Hyjal',
				121: 'Icecrown',
				122: 'Illidan',
				123: 'Jaedenar',
				124: 'Jubei\'Thos',
				125: 'Kael\'thas',
				126: 'Kalecgos',
				127: 'Kargath',
				128: 'Kel\'Thuzad',
				129: 'Khadgar',
				130: 'Khaz Modan',
				131: 'Khaz\'goroth',
				132: 'Kil\'jaeden',
				133: 'Kilrogg',
				134: 'Kirin Tor',
				135: 'Korgath',
				136: 'Korialstrasz',
				137: 'Kul Tiras',
				138: 'Laughing Skull',
				139: 'Lethon',
				140: 'Lightbringer',
				141: 'Lightning\'s Blade',
				142: 'Lightninghoof',
				143: 'Llane',
				144: 'Lothar',
				145: 'Madoran',
				146: 'Maelstrom',
				147: 'Magtheridon',
				148: 'Maiev',
				149: 'Mal\'Ganis',
				150: 'Malfurion',
				151: 'Malorne',
				152: 'Malygos',
				153: 'Mannoroth',
				154: 'Medivh',
				155: 'Misha',
				156: 'Mok\'Nathal',
				157: 'Moon Guard',
				158: 'Moonrunner',
				159: 'Mug\'thol',
				160: 'Muradin',
				161: 'Nagrand',
				162: 'Nathrezim',
				526: 'Naxxramas',
				163: 'Nazgrel',
				164: 'Nazjatar',
				165: 'Nemesis',
				166: 'Ner\'zhul',
				167: 'Nesingwary',
				168: 'Nordrassil',
				169: 'Norgannon',
				170: 'Onyxia',
				171: 'Perenolde',
				172: 'Proudmoore',
				174: 'Quel\'dorei',
				173: 'Quel\'Thalas',
				175: 'Ragnaros',
				176: 'Ravencrest',
				177: 'Ravenholdt',
				178: 'Rexxar',
				179: 'Rivendare',
				180: 'Runetotem',
				181: 'Sargeras',
				182: 'Saurfang',
				183: 'Scarlet Crusade',
				184: 'Scilla',
				185: 'Sen\'jin',
				186: 'Sentinels',
				187: 'Shadow Council',
				188: 'Shadowmoon',
				189: 'Shadowsong',
				190: 'Shandris',
				191: 'Shattered Halls',
				192: 'Shattered Hand',
				193: 'Shu\'halo',
				194: 'Silver Hand',
				195: 'Silvermoon',
				196: 'Sisters of Elune',
				197: 'Skullcrusher',
				198: 'Skywall',
				199: 'Smolderthorn',
				200: 'Spinebreaker',
				201: 'Spirestone',
				202: 'Staghelm',
				203: 'Steamwheedle Cartel',
				204: 'Stonemaul',
				205: 'Stormrage',
				206: 'Stormreaver',
				207: 'Stormscale',
				208: 'Suramar',
				209: 'Tanaris',
				210: 'Terenas',
				211: 'Terokkar',
				212: 'Thaurissan',
				213: 'The Forgotten Coast',
				214: 'The Scryers',
				215: 'The Underbog',
				216: 'The Venture Co',
				527: 'Theradras',
				217: 'Thorium Brotherhood',
				218: 'Thrall',
				219: 'Thunderhorn',
				220: 'Thunderlord',
				221: 'Tichondrius',
				222: 'Tol Barad',
				223: 'Tortheldrin',
				224: 'Trollbane',
				225: 'Turalyon',
				226: 'Twisting Nether',
				227: 'Uldaman',
				528: 'Ulduar',
				228: 'Uldum',
				229: 'Undermine',
				230: 'Ursin',
				231: 'Uther',
				232: 'Vashj',
				233: 'Vek\'nilash',
				234: 'Velen',
				235: 'Warsong',
				236: 'Whisperwind',
				237: 'Wildhammer',
				238: 'Windrunner',
				239: 'Winterhoof',
				240: 'Wyrmrest Accord',
				241: 'Xavius',
				242: 'Ysera',
				243: 'Ysondre',
				244: 'Zangarmarsh',
				245: 'Zul\'jin',
				246: 'Zuluhed',
				247: 'Aegwynn',
				248: 'Aerie Peak',
				249: 'Agamaggan',
				250: 'Aggra(Português)',
				251: 'Aggramar',
				252: 'Ahn\'Qiraj',
				253: 'Al\'Akir',
				254: 'Alexstrasza',
				255: 'Alleria',
				256: 'Alonsus',
				257: 'Aman\'Thul',
				258: 'Ambossar',
				259: 'Anachronos',
				260: 'Anetheron',
				261: 'Antonidas',
				262: 'Anub\'arak',
				263: 'Arak - arahm',
				264: 'Arathi',
				265: 'Arathor',
				266: 'Archimonde',
				267: 'Area 52',
				268: 'Argent Dawn',
				269: 'Arthas',
				270: 'Arygos',
				271: 'Ashenvale',
				272: 'Aszune',
				273: 'Auchindoun',
				274: 'Azjol - Nerub',
				275: 'Azshara',
				276: 'Azuregos',
				277: 'Azuremyst',
				278: 'Baelgun',
				279: 'Balnazzar',
				280: 'Blackhand',
				281: 'Blackmoore',
				282: 'Blackrock',
				283: 'Blackscar',
				284: 'Blade\'s Edge',
				285: 'Bladefist',
				286: 'Bloodfeather',
				287: 'Bloodhoof',
				288: 'Bloodscalp',
				289: 'Blutkessel',
				290: 'Booty Bay',
				291: 'Borean Tundra',
				292: 'Boulderfist',
				293: 'Bronze Dragonflight',
				294: 'Bronzebeard',
				295: 'Burning Blade',
				531: 'Burning Legion',
				296: 'Burning Steppes',
				297: 'C\'Thun',
				532: 'Caduta dei Draghi',
				533: 'Cerchio del Sangue',
				298: 'Chamber of Aspects',
				299: 'Chants éternels',
				300: 'Cho\'gall',
				301: 'Chromaggus',
				302: 'Colinas Pardas',
				303: 'Confrérie du Thorium',
				304: 'Conseil des Ombres',
				305: 'Crushridge',
				306: 'Culte de la Rive noire',
				307: 'Daggerspine',
				308: 'Dalaran',
				309: 'Dalvengyr',
				310: 'Darkmoon Faire',
				311: 'Darksorrow',
				312: 'Darkspear',
				313: 'Das Konsortium',
				314: 'Das Syndikat',
				315: 'Deathguard',
				316: 'Deathweaver',
				317: 'Deathwing',
				318: 'Deepholm',
				319: 'Defias Brotherhood',
				320: 'Dentarg',
				323: 'Der abyssische Rat',
				321: 'Der Mithrilorden',
				322: 'Der Rat von Dalaran',
				324: 'Destromath',
				325: 'Dethecus',
				326: 'Die Aldor',
				327: 'Die Arguswacht',
				331: 'Die ewige Wacht',
				328: 'Die Nachtwache',
				329: 'Die Silberne Hand',
				330: 'Die Todeskrallen',
				332: 'Doomhammer',
				333: 'Draenor',
				334: 'Dragonblight',
				335: 'Dragonmaw',
				336: 'Drak\'thul',
				337: 'Drek\'Thar',
				338: 'Dun Modr',
				339: 'Dun Morogh',
				340: 'Dunemaul',
				341: 'Durotan',
				342: 'Earthen Ring',
				343: 'Echsenkessel',
				344: 'Eitrigg',
				345: 'Eldre\'Thalas',
				346: 'Elune',
				347: 'Emerald Dream',
				348: 'Emeriss',
				349: 'Eonar',
				350: 'Eredar',
				534: 'Euskal Encounter',
				351: 'Eversong',
				352: 'Executus',
				353: 'Exodar',
				354: 'Festung der Stürme',
				355: 'Fordragon',
				356: 'Forscherliga',
				357: 'Frostmane',
				358: 'Frostmourne',
				359: 'Frostwhisper',
				360: 'Frostwolf',
				361: 'Galakrond',
				362: 'Garona',
				363: 'Garrosh',
				364: 'Genjuros',
				365: 'Ghostlands',
				366: 'Gilneas',
				536: 'Gnomeregan',
				367: 'Goldrinn',
				368: 'Gordunni',
				369: 'Gorgonnash',
				370: 'Greymane',
				371: 'Grim Batol',
				537: 'Grizzlyhügel',
				372: 'Grom',
				373: 'Gul\'dan',
				374: 'Hakkar',
				375: 'Haomarush',
				376: 'Hellfire',
				377: 'Hellscream',
				378: 'Howling Fjord',
				379: 'Hyjal',
				380: 'Illidan',
				381: 'Jaedenar',
				382: 'Kael\'thas',
				383: 'Karazhan',
				384: 'Kargath',
				385: 'Kazzak',
				386: 'Kel\'Thuzad',
				387: 'Khadgar',
				388: 'Khaz Modan',
				389: 'Khaz\'goroth',
				390: 'Kil\'jaeden',
				391: 'Kilrogg',
				392: 'Kirin Tor',
				393: 'Kor\'gall',
				394: 'Krag\'jin',
				395: 'Krasus',
				396: 'Kul Tiras',
				397: 'Kult der Verdammten',
				398: 'La Croisade écarlate',
				399: 'Laughing Skull',
				400: 'Les Clairvoyants',
				401: 'Les Sentinelles',
				402: 'Lich King',
				403: 'Lightbringer',
				404: 'Lightning\'s Blade',
				405: 'Lordaeron',
				406: 'Los Errantes',
				407: 'Lothar',
				408: 'Madmortem',
				409: 'Magtheridon',
				410: 'Mal\'Ganis',
				411: 'Malfurion',
				412: 'Malorne',
				413: 'Malygos',
				414: 'Mannoroth',
				415: 'Marécage de Zangar',
				416: 'Mazrigos',
				417: 'Medivh',
				557: 'Menethil',
				418: 'Minahonda',
				558: 'Molten Core',
				419: 'Moonglade',
				420: 'Mug\'thol',
				559: 'Muradin',
				421: 'Nagrand',
				422: 'Nathrezim',
				423: 'Naxxramas',
				424: 'Nazjatar',
				425: 'Nefarian',
				426: 'Nemesis',
				427: 'Neptulon',
				428: 'Ner\'zhul',
				429: 'Nera\'thor',
				430: 'Nethersturm',
				431: 'Nordrassil',
				432: 'Norgannon',
				433: 'Nozdormu',
				434: 'Onyxia',
				435: 'Outland',
				436: 'Perenolde',
				437: 'Pozzo dell\'Eternità',
				438: 'Proudmoore',
				439: 'Quel\'Thalas',
				440: 'Ragnaros',
				441: 'Rajaxx',
				442: 'Rashgarroth',
				443: 'Ravencrest',
				444: 'Ravenholdt',
				445: 'Razuvious',
				446: 'Rexxar',
				447: 'Runetotem',
				448: 'Sanguino',
				449: 'Sargeras',
				450: 'Saurfang',
				451: 'Scarshield Legion',
				560: 'Schwarznarbe',
				452: 'Sen\'jin',
				453: 'Shadowsong',
				454: 'Shattered Halls',
				455: 'Shattered Hand',
				456: 'Shattrath',
				457: 'Shen\'dralar',
				458: 'Silvermoon',
				459: 'Sinstralis',
				460: 'Skullcrusher',
				461: 'Soulflayer',
				462: 'Spinebreaker',
				463: 'Sporeggar',
				464: 'Steamwheedle Cartel',
				561: 'Stonemaul',
				465: 'Stormrage',
				466: 'Stormreaver',
				467: 'Stormscale',
				468: 'Sunstrider',
				562: 'Suramar',
				469: 'Sylvanas',
				470: 'Taerar',
				471: 'Talnivarr',
				472: 'Tarren Mill',
				473: 'Teldrassil',
				474: 'Temple noir',
				475: 'Terenas',
				476: 'Terokkar',
				477: 'Terrordar',
				478: 'The Maelstrom',
				479: 'The Sha\'tar',
				480: 'The Venture Co',
				481: 'Theradras',
				482: 'Thermaplugg',
				483: 'Thrall',
				484: 'Throk\'Feroth',
				485: 'Thunderhorn',
				486: 'Tichondrius',
				487: 'Tirion',
				488: 'Todeswache',
				489: 'Trollbane',
				490: 'Turalyon',
				491: 'Twilight\'s Hammer',
				492: 'Twisting Nether',
				493: 'Tyrande',
				494: 'Uldaman',
				495: 'Ulduar',
				496: 'Uldum',
				497: 'Un\'Goro',
				498: 'Varimathras',
				499: 'Vashj',
				500: 'Vek\'lor',
				501: 'Vek\'nilash',
				502: 'Vol\'jin',
				503: 'Wildhammer',
				563: 'Winterhuf',
				504: 'Wrathbringer',
				505: 'Xavius',
				506: 'Ysera',
				507: 'Ysondre',
				508: 'Zenedar',
				509: 'Zirkel des Cenarius',
				510: 'Zul\'jin',
				511: 'Zuluhed',
				1008: 'Азурегос',
				1009: 'Борейская - тундра',
				1010: 'Вечная Песня',
				1015: 'Галакронд',
				1012: 'Голдринн',
				1001: 'Гордунни',
				1014: 'Гром',
				1006: 'Дракономор',
				1013: 'Король - лич',
				1011: 'Пиратская Бухта',
				1004: 'Разувий',
				1016: 'Ревущий фьорд',
				1002: 'Свежеватель Душ',
				1007: 'Страж смерти',
				1005: 'Черный Шрам',
				1003: 'Ясеневый лес',
				923: '世界之樹',
				924: '亞雷戈斯',
				925: '冰霜之刺',
				926: '冰風崗哨',
				927: '地獄吼',
				928: '夜空之歌',
				929: '天空之牆',
				930: '寒冰皇冠',
				931: '尖石',
				932: '屠魔山谷',
				933: '巨龍之喉',
				934: '憤怒使者',
				935: '日落沼澤',
				936: '暗影之月',
				937: '水晶之刺',
				938: '狂熱之刃',
				939: '眾星之子',
				940: '米奈希爾',
				941: '聖光之願',
				942: '血之谷',
				943: '語風',
				944: '銀翼要塞',
				945: '阿薩斯',
				946: '雲蛟衛',
				947: '雷鱗',
				960: '가로나',
				961: '굴단',
				963: '노르간논',
				959: '달라란',
				949: '데스윙',
				950: '듀로탄',
				964: '렉사르',
				962: '말퓨리온',
				951: '불타는 군단',
				952: '세나리우스',
				965: '스톰레이지',
				953: '아즈샤라',
				958: '알렉스트라자',
				966: '와일드해머',
				954: '윈드러너',
				955: '줄진',
				956: '하이잘',
				957: '헬스크림 '
			};

			var realm_name = realm_id_name_conversion[realm];

			$('head').append('<link href="http://apinfo.gerritalex.de/img/' + shortcut + '.png" rel="shortcut icon" type="image/x-icon" />');

			if (realm != 0) {

				if (spec == 0) {
					window.history.pushState('AP INFO – ' + region + '-' + realm_name + ' ' + class_name + 's', 'AP INFO – ' + region + '-' + realm_name + ' ' + class_name + 's', '/?rt=true&region=' + region + '&realm=' + realm + '&class=' + cl + '&spec=0');

					document.title = 'AP INFO – ' + region + '-' + realm_name + ' ' + class_name + 's';
				} else {
					window.history.pushState('AP INFO – ' + region + '-' + realm_name + ' ' + spec_name + ' ' + class_name + 's', 'AP INFO – ' + region + '-' + realm_name + ' ' + spec_name + ' ' + class_name + 's', '/?rt=true&region=' + region + '&realm=' + realm + '&class=' + cl + '&spec=' + spec + '');

					document.title = 'AP INFO – ' + region + '-' + realm_name + ' ' + spec_name + ' ' + class_name + 's';
				}
			} else {

				if (region == 0) {

					if (spec == 0) {
						window.history.pushState('AP INFO – ' + class_name + 's', 'AP INFO – ' + class_name + '', '/?rt=true&region=0&realm=0&class=' + cl + '&spec=0');

						document.title = 'AP INFO – ' + class_name + 's';
					} else {

						window.history.pushState('AP INFO – ' + spec_name + ' ' + class_name + 's', 'AP INFO – ' + spec_name + ' ' + class_name + 's', '/?rt=true&region=0&realm=0&class=' + cl + '&spec=' + spec + '');

						document.title = 'AP INFO – ' + spec_name + ' ' + class_name + 's';
					}
				} else {
					if (spec == 0) {
						window.history.pushState('AP INFO – ' + region + ' ' + class_name + 's', 'AP INFO – ' + region + ' ' + class_name + '', '/?rt=true&region=' + region + '&realm=0&class=' + cl + '&spec=0');

						document.title = 'AP INFO – ' + region + ' ' + class_name + 's';
					} else {

						window.history.pushState('AP INFO – ' + region + ' ' + spec_name + ' ' + class_name + 's', 'AP INFO – ' + region + ' ' + spec_name + ' ' + class_name + '', '/?rt=true&region=' + region + '&realm=0&class=' + cl + '&spec=' + spec + '');

						document.title = 'AP INFO – ' + region + ' ' + spec_name + ' ' + class_name + 's';
					}
				}
			}
		},
		error: function () {
			$('.middle-right').find('div').append('<table style="width: 100%;"><tbody><tr><td><span class="trash">The server encountered an error when trying to fetch required data. Please try again now or at a later point.</span></td></tr></tbody></table>');
		}
	});

}

function left_table_update(str) {

	var img = $('#' + str + '').find('img');
	img.remove();
	$('#' + str + '').append(' <img src="img/load.gif" />');
	$('#' + str + '').css('pointer-events', 'none');
	$('#' + str + '').find('span').css('color', 'white');

	var substring = '-';

	if (str.indexOf(substring) !== -1) {
		var splitter = str.split('-');
		var realm = splitter[0];
		var entry = splitter[1];

		$.ajax({
			url: 'var/global_table_update_filtered.php',
			type: 'get',
			dataType: 'html',
			data: {
				realm: realm,
				entry: entry
			},
			success: function (data) {
				var button = $('.middle-top-left').find('button');
				$('.middle-import').empty();
				$('.middle-import').append(data);
				var img = $('#' + str + '').find('img');
				img.remove();
				button.removeAttr('disabled');
				$('#' + str + '').find('span').css('color', 'yellowgreen');
				$('#' + str + '').find('span').empty();
				$('#' + str + '').find('span').append('Updated!');
			},
			error: function () {
				var button = $('.middle-top-left').find('button');
				$('.middle-import').empty();
				$('.middle-import').append('<table style="width: 100%;"><tbody><tr><td><span class="trash">The server encountered an error when trying to update. Please try again now or at a later point.</span></td></tr></tbody></table>');
				var img = $('#' + str + '').find('img');
				img.remove();
				button.removeAttr('disabled');
				$('#' + str + '').css('pointer-events', 'auto');
				$('#' + str + '').find('span').css('color', 'coral');
				$('#' + str + '').find('span').empty();
				$('#' + str + '').find('span').append('Error!');
			}
		});

	} else {
		var button = $('.middle-top-left').find('button');
		button.attr('disabled', 'true');

		$.ajax({
			url: 'var/global_table_update.php',
			type: 'get',
			dataType: 'html',
			data: {
				entry: str
			},
			success: function (data) {
				var button = $('.middle-top-left').find('button');
				$('.middle-import').empty();
				$('.middle-import').append(data);
				var img = $('#' + str + '').find('img');
				img.remove();
				button.removeAttr('disabled');
				$('#' + str + '').find('span').css('color', 'yellowgreen');
				$('#' + str + '').find('span').empty();
				$('#' + str + '').find('span').append('Updated!');
			},
			error: function () {
				var button = $('.middle-top-left').find('button');
				$('.middle-import').empty();
				$('.middle-import').append('<table style="width: 100%;"><tbody><tr><td><span class="trash">The server encountered an error when trying to update. Please try again now or at a later point.</span></td></tr></tbody></table>');
				var img = $('#' + str + '').find('img');
				img.remove();
				button.removeAttr('disabled');
				$('#' + str + '').css('pointer-events', 'auto');
				$('#' + str + '').find('span').css('color', 'coral');
				$('#' + str + '').find('span').empty();
				$('#' + str + '').find('span').append('Error!');
			}
		});
	}
}

function right_table_update(str) {

	var img = $('#' + str + '').find('img');
	img.remove();
	$('#' + str + '').append(' <img src="img/load.gif" />');
	$('#' + str + '').css('pointer-events', 'none');
	$('#' + str + '').find('span').css('color', 'white');

	var str = str.split('-');
	var realm = str[0];
	var id = str[1];

	$.ajax({
		url: 'var/class_table_update.php',
		type: 'get',
		dataType: 'html',
		data: {
			realm: realm,
			entry: id
		},
		success: function (data) {
			var button = $('.middle-top-left').find('button');
			$('.middle-import').empty();
			$('.middle-import').append(data);
			var img = $('#' + realm + '-' + id + '').find('img');
			img.remove();
			button.removeAttr('disabled');
			button.removeAttr('disabled');
			$('#' + realm + '-' + id + '').find('span').css('color', 'yellowgreen');
			$('#' + realm + '-' + id + '').find('span').empty();
			$('#' + realm + '-' + id + '').find('span').append('Updated!');
		},
		error: function () {
			var button = $('.middle-top-left').find('button');
			$('.middle-import').empty();
			$('.middle-import').append('<table style="width: 100%;"><tbody><tr><td><span class="trash">The server encountered an error when trying to update. Please try again now or at a later point.</span></td></tr></tbody></table>');
			var img = $('#' + realm + '-' + id + '').find('img');
			img.remove();
			button.removeAttr('disabled');
			$('#' + realm + '-' + id + '').css('pointer-events', 'auto');
			$('#' + realm + '-' + id + '').find('span').css('color', 'coral');
			$('#' + realm + '-' + id + '').find('span').empty();
			$('#' + realm + '-' + id + '').find('span').append('Error!');
		}
	});
}

function focus_listener() {

	if ($('#guild').is(':focus') || $('#region_guild').is(':focus') || $('#realm_guild').is(':focus')) {

		$(document).keypress(function (e) {
			if (e.which == 13) {
				import_guild().preventDefault();
			}
		});
	} else {

		if ($('#character').is(':focus') || $('#region_character').is(':focus') || $('#realm_character').is(':focus')) {

			$(document).keypress(function (e) {
				if (e.which == 13) {
					import_character().preventDefault();
				}
			});
		}
	}
}

function import_character() {
	var button = $('.middle-top-left').find('button');
	button.attr('disabled', 'true');
	$('.middle-top-left').append('<img src="img/load.gif" />');

	var character = $('#character').val();
	var region = $('#region_character').val();
	var realm = $('#realm_character').val();

	$.ajax({
		url: 'var/character.php',
		type: 'get',
		dataType: 'html',
		data: {
			character: character,
			region: region,
			realm: realm
		},
		success: function (data) {
			$('.middle-import').empty();
			var img = $('.middle-top-left').find('img');
			img.remove();
			$('.middle-import').append(data);
			button.removeAttr('disabled');
		},
		error: function () {
			var img = $('.middle-top-left').find('img');
			img.remove();
			$('.middle-top-left').append('<span class="trash">Error!</span>');
			button.removeAttr('disabled');
		}
	});
}

function import_guild() {
	var button = $('.middle-top-right').find('button');
	button.attr('disabled', 'true');
	$('.middle-top-right').append('<img src="img/load.gif" />');

	var guild = $('#guild').val();
	var region = $('#region_guild').val();
	var realm = $('#realm_guild').val();

	$.ajax({
		url: 'var/guild.php',
		type: 'get',
		dataType: 'html',
		data: {
			guild: guild,
			region: region,
			realm: realm
		},
		success: function (data) {
			$('.middle-import').empty();
			var img = $('.middle-top-right').find('img');
			img.remove();
			$('.middle-import').append(data);
			button.removeAttr('disabled');
		},
		error: function (data) {
			var img = $('.middle-top-right').find('img');
			img.remove();
			$('.middle-top-right').append('<span class="trash" >Error!</span>');
		}
	});
}

var sources = {
	EU: ["Aegwynn", "Aerie Peak", "Agamaggan", "Aggra (Português)", "Aggramar", "Ahn'Qiraj", "Al'Akir", "Alexstrasza", "Alleria", "Alonsus", "Aman'Thul", "Ambossar", "Anachronos", "Anetheron", "Antonidas", "Anub'arak", "Arak-arahm", "Arathi", "Arathor", "Archimonde", "Area 52", "Arena Pass", "Arena Pass 1", "Argent Dawn", "Arthas", "Arygos", "Ashenvale", "Aszune", "Auchindoun", "Azjol-Nerub", "Azshara", "Azuregos", "Azuremyst", "Baelgun", "Balnazzar", "Blackhand", "Blackmoore", "Blackrock", "Blackscar", "Bladefist", "Blade's Edge", "Bloodfeather", "Bloodhoof", "Bloodscalp", "Blutkessel", "Booty Bay", "Borean Tundra", "Boulderfist", "Bronze Dragonflight", "Bronzebeard", "Burning Blade", "Burning Legion", "Burning Steppes", "Caduta dei Draghi", "Cerchio del Sangue", "Chamber of Aspects", "Chants éternels", "Cho'gall", "Chromaggus", "Colinas Pardas", "Confrérie du Thorium", "Conseil des Ombres", "Crushridge", "C'Thun", "Culte de la Rive noire", "Daggerspine", "Dalaran", "Dalvengyr", "Darkmoon Faire", "Darksorrow", "Darkspear", "Das Konsortium", "Das Syndikat", "Deathguard", "Deathweaver", "Deathwing", "Deepholm", "Defias Brotherhood", "Dentarg", "Der abyssische Rat", "Der Mithrilorden", "Der Rat von Dalaran", "Destromath", "Dethecus", "Die Aldor", "Die Arguswacht", "Die ewige Wacht", "Die Nachtwache", "Die Silberne Hand", "Die Todeskrallen", "Doomhammer", "Draenor", "Dragonblight", "Dragonmaw", "Drak'thul", "Drek'Thar", "Dun Modr", "Dun Morogh", "Dunemaul", "Durotan", "Earthen Ring", "Echsenkessel", "Eitrigg", "Eldre'Thalas", "Elune", "Emerald Dream", "Emeriss", "Eonar", "Eredar", "Euskal Encounter", "Eversong", "Executus", "Exodar", "Festung der Stürme", "Fordragon", "Forscherliga", "Frostmane", "Frostmourne", "Frostwhisper", "Frostwolf", "Galakrond", "Garona", "Garrosh", "Genjuros", "Ghostlands", "Gilneas", "Gnomeregan", "Goldrinn", "Gordunni", "Gorgonnash", "Greymane", "Grim Batol", "Grizzlyhügel", "Grom", "Gul'dan", "Hakkar", "Haomarush", "Hellfire", "Hellscream", "Howling Fjord", "Hyjal", "Illidan", "Jaedenar", "Kael'thas", "Karazhan", "Kargath", "Kazzak", "Kel'Thuzad", "Khadgar", "Khaz Modan", "Khaz'goroth", "Kil'jaeden", "Kilrogg", "Kirin Tor", "Kor'gall", "Krag'jin", "Krasus", "Kul Tiras", "Kult der Verdammten", "La Croisade écarlate", "Laughing Skull", "Les Clairvoyants", "Les Sentinelles", "Lich King", "Lightbringer", "Lightning's Blade", "Lordaeron", "Los Errantes", "Lothar", "Madmortem", "Magtheridon", "Malfurion", "Mal'Ganis", "Malorne", "Malygos", "Mannoroth", "Marécage de Zangar", "Mazrigos", "Medivh", "Menethil", "Minahonda", "Molten Core", "Moonglade", "Mug'thol", "Muradin", "Nagrand", "Nathrezim", "Naxxramas", "Nazjatar", "Nefarian", "Nemesis", "Neptulon", "Nera'thor", "Ner'zhul", "Nethersturm", "Nordrassil", "Norgannon", "Nozdormu", "Onyxia", "Outland", "Perenolde", "Pozzo dell'Eternità", "Proudmoore", "Quel'Thalas", "Ragnaros", "Rajaxx", "Rashgarroth", "Ravencrest", "Ravenholdt", "Razuvious", "Rexxar", "Runetotem", "Sanguino", "Sargeras", "Saurfang", "Scarshield Legion", "Schwarznarbe", "Sen'jin", "Shadowsong", "Shattered Halls", "Shattered Hand", "Shattrath", "Shen'dralar", "Silvermoon", "Sinstralis", "Skullcrusher", "Soulflayer", "Spinebreaker", "Sporeggar", "Steamwheedle Cartel", "Stonemaul", "Stormrage", "Stormreaver", "Stormscale", "Sunstrider", "Suramar", "Sylvanas", "Taerar", "Talnivarr", "Tarren Mill", "Teldrassil", "Temple noir", "Terenas", "Terokkar", "Terrordar", "The Maelstrom", "The Sha'tar", "The Venture Co", "Theradras", "Thermaplugg", "Thrall", "Throk'Feroth", "Thunderhorn", "Tichondrius", "Tirion", "Todeswache", "Trollbane", "Turalyon", "Twilight's Hammer", "Twisting Nether", "Tyrande", "Uldaman", "Ulduar", "Uldum", "Un'Goro", "Varimathras", "Vashj", "Vek'lor", "Vek'nilash", "Vol'jin", "Wildhammer", "Winterhuf", "Wrathbringer", "Xavius", "Ysera", "Ysondre", "Zenedar", "Zirkel des Cenarius", "Zul'jin", "Zuluhed", "Азурегос", "Борейская-тундра", "Вечная Песня", "Галакронд", "Голдринн", "Гордунни", "Гром", "Дракономор", "Король-лич", "Пиратская Бухта", "Разувий", "Ревущий фьорд", "Свежеватель Душ", "Страж смерти", "Черный Шрам", "Ясеневый лес"],
	US: ["Aegwynn", "Aerie Peak", "Agamaggan", "Aggramar", "Akama", "Alexstrasza", "Alleria", "Altar of Storms", "Alterac Mountains", "Aman'Thul", "Andorhal", "Anetheron", "Antonidas", "Anub'arak", "Anvilmar", "Arathor", "Archimonde", "Area 52", "Argent Dawn", "Arthas", "Arygos", "Auchindoun", "Azgalor", "Azjol-Nerub", "Azralon", "Azshara", "Azuremyst", "Baelgun", "Balnazzar", "Barthilas", "Black Dragonflight", "Blackhand", "Blackmoore", "Blackrock", "Blackwater Raiders", "Blackwing Lair", "Bladefist", "Blade's Edge", "Bleeding Hollow", "Blood Furnace", "Bloodhoof", "Bloodscalp", "Bonechewer", "Borean Tundra", "Boulderfist", "Bronzebeard", "Burning Blade", "Burning Legion", "Caelestrasz", "Cairne", "Cenarion Circle", "Cenarius", "Cho'gall", "Chromaggus", "Coilfang", "Crushridge", "Daggerspine", "Dalaran", "Dalvengyr", "Dark Iron", "Darkspear", "Darrowmere", "Dath'Remar", "Dawnbringer", "Deathwing", "Demon Soul", "Dentarg", "Destromath", "Dethecus", "Detheroc", "Doomhammer", "Draenor", "Dragonblight", "Dragonmaw", "Draka", "Drakkari", "Drak'Tharon", "Drak'thul", "Dreadmaul", "Drenden", "Dunemaul", "Durotan", "Duskwood", "Earthen Ring", "Echo Isles", "Eitrigg", "Eldre'Thalas", "Elune", "Emerald Dream", "Eonar", "Eredar", "Executus", "Exodar", "Farstriders", "Feathermoon", "Fenris", "Firetree", "Fizzcrank", "Frostmane", "Frostmourne", "Frostwolf", "Galakrond", "Gallywix", "Garithos", "Garona", "Garrosh", "Ghostlands", "Gilneas", "Gnomeregan", "Goldrinn", "Gorefiend", "Gorgonnash", "Greymane", "Grizzly Hills", "Gul'dan", "Gundrak", "Gurubashi", "Hakkar", "Haomarush", "Hellscream", "Hydraxis", "Hyjal", "Icecrown", "Illidan", "Jaedenar", "Jubei'Thos", "Kael'thas", "Kalecgos", "Kargath", "Kel'Thuzad", "Khadgar", "Khaz Modan", "Khaz'goroth", "Kil'jaeden", "Kilrogg", "Kirin Tor", "Korgath", "Korialstrasz", "Kul Tiras", "Laughing Skull", "Lethon", "Lightbringer", "Lightninghoof", "Lightning's Blade", "Llane", "Lothar", "Madoran", "Maelstrom", "Magtheridon", "Maiev", "Malfurion", "Mal'Ganis", "Malorne", "Malygos", "Mannoroth", "Medivh", "Misha", "Mok'Nathal", "Moon Guard", "Moonrunner", "Mug'thol", "Muradin", "Nagrand", "Nathrezim", "Naxxramas", "Nazgrel", "Nazjatar", "Nemesis", "Ner'zhul", "Nesingwary", "Nordrassil", "Norgannon", "Onyxia", "Perenolde", "Proudmoore", "Quel'dorei", "Quel'Thalas", "Ragnaros", "Ravencrest", "Ravenholdt", "Rexxar", "Rivendare", "Runetotem", "Sargeras", "Saurfang", "Scarlet Crusade", "Scilla", "Sen'jin", "Sentinels", "Shadow Council", "Shadowmoon", "Shadowsong", "Shandris", "Shattered Halls", "Shattered Hand", "Shu'halo", "Silver Hand", "Silvermoon", "Sisters of Elune", "Skullcrusher", "Skywall", "Smolderthorn", "Spinebreaker", "Spirestone", "Staghelm", "Steamwheedle Cartel", "Stonemaul", "Stormrage", "Stormreaver", "Stormscale", "Suramar", "Tanaris", "Terenas", "Terokkar", "Thaurissan", "The Forgotten Coast", "The Scryers", "The Underbog", "The Venture Co", "Theradras", "Thorium Brotherhood", "Thrall", "Thunderhorn", "Thunderlord", "Tichondrius", "Tol Barad", "Tortheldrin", "Trollbane", "Turalyon", "Twisting Nether", "Uldaman", "Ulduar", "Uldum", "Undermine", "Ursin", "Uther", "Vashj", "Vek'nilash", "Velen", "Warsong", "Whisperwind", "Wildhammer", "Windrunner", "Winterhoof", "Wyrmrest Accord", "Xavius", "Ysera", "Ysondre", "Zangarmarsh", "Zul'jin", "Zuluhed"],
	KR: ["알렉스트라자", "아즈샤라", "불타는 군단", "세나리우스", "달라란", "데스윙", "듀로탄", "가로나", "굴단", "헬스크림", "하이잘", "스톰레이지", "말퓨리온", "노르간논", "렉사르", "와일드해머", "윈드러너", "줄진"],
	TW: ["阿薩斯", "亞雷戈斯", "血之谷", "冰風崗哨", "水晶之刺", "屠魔山谷", "巨龍之喉", "冰霜之刺", "地獄吼", "寒冰皇冠", "聖光之願", "米奈希爾", "夜空之歌", "雲蛟衛", "眾星之子", "暗影之月", "銀翼要塞", "天空之牆", "尖石", "雷鱗", "日落沼澤", "語風", "世界之樹", "憤怒使者", "狂熱之刃"]
};

function realmpop_character() {
	$("#realm_character").on('input change keyup autocompletechange', function () {
		if ($("#region_character").val() != -1) {
			var src = $('#region_character').val().toUpperCase();
			$("#realm_character").autocomplete({
				source: sources[src]
			});
		}
	});
}

function realmpop_guild() {
	$("#realm_guild").on('input change keyup autocompletechange', function () {
		if ($("#region_guild").val() != -1) {
			var src = $('#region_guild').val().toUpperCase();
			$("#realm_guild").autocomplete({
				source: sources[src]
			});
		}
	});
}
