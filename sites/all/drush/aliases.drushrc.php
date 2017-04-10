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
