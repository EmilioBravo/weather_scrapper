<?php

	include_once('includes/simple_html_dom.php');
	$url = 'http://www.meteorologia.gov.py/';
	$weather = file_get_html($url);

	$tables = $weather->find('table');
	$_weather_current = $tables[4];

	$_temp_img = explode('/',trim($_weather_current->find('img',0)->src));
	$weather_current['temp_img'] = $_temp_img[2];
	$weather_current['temp_c'] = trim($_weather_current->find('td',1)->plaintext).' °C';
	$weather_current['temp_desc'] = trim($_weather_current->find('td',3)->plaintext);

	for($i=0;$i<5;$i++){

		$weather_forecast[$i]['day'] = trim(strip_tags($tables[8]->find('td', $i)->innertext));
		$weather_forecast[$i]['temp_c'] = trim($tables[8]->find('tr', 2)->find('td', $i)->innertext);
		$weather_forecast[$i]['temp_desc'] = trim(strip_tags($tables[8]->find('tr', 1)->find('td', $i)->innertext));
		$_temp_img = explode('/',trim($tables[8]->find('img',$i)->src));
		$weather_forecast[$i]['temp_img'] = $_temp_img[2];

	}

	echo '<h1>Weather Current</h1>';
	print_r($weather_current);

	echo '<h1>Weather Forecast</h1>';
	print_r($weather_forecast);
?>