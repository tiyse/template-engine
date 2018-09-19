<?php
include_once( __DIR__ ."/tiyse.tpl.class.php");

$tiyse = new tiyse(
	array(
		'cache_dir'  => '/cache/',
		'tpl_dir'    => '/templates/Default/',
		'tpl_ext'    => 'tpl',
		'gzcompress' => true,
		'gzempty'    => true
	)
);

$main = array(
	'title' => 'Soru, cevap ve tartışma'
);

$tiyse->assign($main);

$tiyse->draw("main");
?>
