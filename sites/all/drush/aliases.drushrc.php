<?php

$aliases['staging'] = array(
	'uri'=> 'oden.ccistaging.com',
	'root' => '/home/staging/subdomains/oden/public_html',
	'remote-host'=> 'host.ccistudios.com',
	'remote-user'=> 'staging',
	'path-aliases'=> array(
		'%files'=> 'sites/default/files',
	),
	'ssh-options'=> '-p 37241'
);

$aliases['staging2'] = array(
        'uri'=> 'oden2.ccistaging.com',
        'root' => '/home/staging/subdomains/oden2/public_html',
        'remote-host'=> 'host.ccistudios.com',
        'remote-user'=> 'staging',
        'path-aliases'=> array(
                '%files'=> 'sites/default/files',
        ),
        'ssh-options'=> '-p 37241'
);

$aliases['staging3'] = array(
        'uri'=> 'staging.odenetwork.com',
        'root' => '/home7/odenetwo/public_html/subdomains/staging/public_html',
        'remote-host'=> '66.147.244.154',
        'remote-user'=> 'odenetwo',
        'path-aliases'=> array(
                '%files'=> 'sites/default/files',
        ),
);

$aliases['live'] = array(
        'uri'=> 'live.odenetwork.com',
        'root' => '/home7/odenetwo/public_html/subdomains/live/public_html',
        'remote-host'=> '66.147.244.154',
        'remote-user'=> 'odenetwo',
        'path-aliases'=> array(
                '%files'=> 'sites/default/files',
        ),
);
