<?php

define('WEB_ROOT_DIR',__DIR__);
define('TIMEZONE', 'Europe/Prague');

// General settings
define('DEBUG_MODE', true);
define('VPN_NAME', 'Vpn03');

// Path to logs:
// true = use remote (REMOTE_PATH)
// false = use local (LOCAL_PATH)
define('USE_REMOTE_FILES', true);
define('REMOTE_PATH', 'http://vpn03.nadhera.name/');
define('LOCAL_PATH', WEB_ROOT_DIR.'/vpn03/');

// HTML document header meta tags
define('META_TITLE', 'Vpn 03');
define('META_DESCRIPTION', 'OpenVPN status');
define('META_RATING', 'safe for kids');
define('META_DISCTRIBUTION', 'global');
define('META_COMPANY', 'APPLIC s.r.o.');

// Name that will be assigned to user:
// true = this defined custom names will be used
// false = names from journal will be used (notice: in that case users without journal events wont have names)
define('USE_CUSTOM_NAMES', true);
define('USER_NAMES', [
    'rna-vpn03c010' => 'RPi3-RNA',
    'rna-vpn03c011' => 'NL-PCHO',
    'rna-vpn03c012' => 'NL-HEMA',
    'rna-vpn03c013' => 'RNA4-13(NB)',
    'rna-vpn03c014' => 'Magna-DELL',
    'rna-vpn03c015' => 'Magna-Maggi',
    'rna-vpn03c017' => 'Japaseky',
    'rna-vpn03c018' => 'Bohouš',
    'rna-vpn03c019' => 'Věrka 019',
    'rna-vpn03c020' => 'APPLIC-14',
    'rna-vpn03c021' => 'Magna-Velín',
    'rna-vpn03c022' => 'vpn03-022',
    'rna-vpn03c023' => 'JBC-DISP',
    'rna-vpn03c024' => 'NL-Appendix',
    'rna-vpn03c025' => 'Podlesí',
    'rna-vpn03c028' => 'RNA6',
    'rna-vpn03c030' => 'Petra_2',
    'rna-vpn03c033' => 'Pionýrů',    
    'rna-vpn03c035' => 'EMBA-Paseky',
    'rna-vpn03c036' => 'JSM',
    'rna-vpn03c037' => 'RNA5-LX37(NB)',
    'rna-vpn03c038' => 'Soňa-NB',
    'rna-vpn03c039' => 'LuNa',
    'rna-vpn03c040' => 'RPi3-DXB',
    'rna-vpn03c041' => 'Aréna-Applic-41',
    'rna-vpn03c042' => 'Aréna-Warmnis-42',
    'rna-vpn03c043' => 'Applic DHA',
    'rna-vpn03c044' => 'BRIX-710',
    'rna-vpn03c045' => 'RPi-DXB2',
    'rna-vpn03c046' => 'Aréna-Virtual-46',
    'rna-vpn03c047' => 'EvB-Virtual-047',
    'rna-vpn03c048' => 'Radnice-Jabl',
    'rna-vpn03c049' => 'Proseč',
    'rna-vpn03c060' => 'XS-35',
    'rna-vpn03c061' => 'Magna-serv-61',
    'rna-vpn03c062' => 'Magna-virt-62',
    'rna-vpn03c063' => 'Magna-RPi-EC3',
    'rna-vpn03c064' => 'RPi-SMS-Arena-64',
]);
