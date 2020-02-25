<?php

## Custom values 
#
# Add any custom values here. If a value is empty, the default value defined 
# below is used. 

$custom = array(
	'targetdir'       => '',
	'apacheconfdir'   => '',
	'apacheconffile'  => '',
	'apacheuser'      => '',
	'apachegroup'     => '',
	'etc_conf'        => '',
	'htpasswd_file'   => '',
	# See config/vshell.conf for explanations of each value
	'vshell_baseurl'  => '',
	'TTL'             => '',
	'update_interval' => '',
	'nagios_coreurl'  => '',
	'lang'            => '',
);

## Default values
#
# Do not edit these defaults

$defaults = array();

$defaults['debian'] = array(
	'targetdir'       => '/usr/local/vshell2',
	'apacheconfdir'   => '/etc/apache2/sites-enabled',
	'apacheconffile'  => 'vshell2.conf',
	'apacheuser'      => 'www-data',
	'apachegroup'     => 'www-data',
	'etc_conf'        => 'vshell2.conf',
	'htpasswd_file'   => '/etc/nagios/htpasswd.users',
	'vshell_baseurl'  => 'vshell2',
	'nagios_coreurl'  => 'nagios',
	'TTL'             => '90',
	'update_interval' => '90',
	'lang'            => 'en_GB',
);

$defaults['redhat'] = array(
	'targetdir'       => '/usr/local/vshell2',
	'apacheconfdir'   => '/etc/httpd/conf.d',
	'apacheconffile'  => 'vshell2.conf',
	'apacheuser'      => 'apache',
	'apachegroup'     => 'apache',
	'etc_conf'        => 'vshell2.conf',
	'htpasswd_file'   => '/etc/nagios/passwd',
	'vshell_baseurl'  => 'vshell2',
	'nagios_coreurl'  => 'nagios',
	'TTL'             => '90',
	'update_interval' => '90',
	'lang'            => 'en_GB',
);

## Create defintions
#
# Determine the OS family, merge custom values with defaults,
# and create PHP definitions for each key.

$default_values = $defaults[get_os_family()];
$custom_values = array_filter($custom);
$config = array_merge($default_values, $custom_values);

create_definitions($config);

## Helper functions

function get_os_family(){
    # Simple check, default to redhat
    $output = system('test -s /etc/debian_version && echo "Debian"');
    return ($output == 'Debian') ? 'debian' : 'redhat';
}

function create_definitions($values){
	foreach($values as $key => $value){
		$key = strtoupper($key);
		define($key, $value);
	}
}

// End of file install-config.php
