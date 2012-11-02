<?php

/*
Plugin Name: Weather Slider
Plugin URI: http://wordpress.org/extend/plugins/weather-slider/
Description: Lee el tiempo desde Yahoo! Weather, de los c&#243;digos de las ciudades insertadas en el formulario, desde <a href="http://weather.yahooapis.com/forecastrss?p=" target="_blank">weather.yahooapis.com</a>. Muestra dos ciudades en cada &#237;tem y se desplaza por el resto autom&#225;ticamente, con la opci&#243;n de poder seleccionar un &#237;tem. Cantidad de ciudades y CSS configurables, utiliza la librer&#237;a <a href="http://cssglobe.com/post/4004/easy-slider-15-the-easiest-jquery-plugin-for-sliding">easySlider</a>. 
Version: 1.0
Author: Michel Mart&#237;nez
Author URI: http://www.michelmartinez.com
*/

define("CANT_URL",6); // Cantidad de Ciudades para mostrar, alterar cuando quieran más o menos ciudades

function show_weather() {
$num_mostra = 0;
echo "<div id=\"slider\"><ul>";
for($i=1;$i<=CANT_URL;$i++)
{
	$url = get_option('url_feed'.$i);
	$rss = wp_remote_fopen($url);
	$yTiempo = simplexml_load_string(str_replace('yweather:', '', $rss));
	
	if ($url != "" or $url != null) 
	{
		$num_mostra ++;
		
		// Conditions
		$aConditions = array();
		foreach($yTiempo->channel->item->condition->attributes() as $a => $b) {
		   $cleanStr = array("'" => '', '"' => '', '=' => '', $a => '');
		   $aConditions[$a] = trim(strtr($b->asXML(), $cleanStr));
		}
		
		($aConditions);
		// End Conditions
		
		// Forecast
		$cConditions = array();
		foreach($yTiempo->channel->item->forecast->attributes() as $c => $d) {
		   $cleanStr = array("'" => '', '"' => '', '=' => '', $c => '');
		   $cConditions[$c] = trim(strtr($d->asXML(), $cleanStr));
		}
		
		($cConditions);
		// End Forecast
		
		// Location
		$lConditions = array();
		foreach($yTiempo->channel->location->attributes() as $l => $n) {
		   $cleanStr = array("'" => '', '"' => '', '=' => '', $l => '');
		   $lConditions[$l] = trim(strtr($n->asXML(), $cleanStr));
		}
		
		($lConditions);
		// End Location
		
		// Units
		$uConditions = array();
		foreach($yTiempo->channel->units->attributes() as $u => $v) {
		   $cleanStr = array("'" => '', '"' => '', '=' => '', $u => '');
		   $uConditions[$u] = trim(strtr($v->asXML(), $cleanStr));
		}
		
		($uConditions);
		// End Units
		
		$city = $lConditions['city'];
		$temp = $aConditions['temp'];
		$tempmax = $cConditions['high'];
		$tempmin = $cConditions['low'];
		$tempunit = $uConditions['temperature'];
		
		if($num_mostra%2 !=0)
		{
		 	echo "<li>";
		}	
			 
		echo "<div class=\"";
			 
		if($num_mostra%2 !=0){
			echo "tiempo";
		}else{
		 	echo "tiempo2";
		}
				 
		echo "\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
		$imagen = $yTiempo->channel->item->description;
		$num_resultado = preg_match( "/<img .+?\/?>/im", $imagen, $resultado );
		if( $num_resultado > 0 )
		{
		   echo ( $resultado[ 0 ] );
		}else{
		   echo "Erro...";
		} 
	     echo "</td><td nowrap>";
		 echo '<b>'.$city.' '.$temp.'&#176;</b>';
		 echo '<br/>Min: '.$tempmin.' &#176;'.$tempunit;
		 echo '<br/>M&#225;x: '.$tempmax.' &#176;'.$tempunit;
		 echo "</td></tr></table></div>";
		 if($num_mostra%2 == 0){
		 	echo "</li>";
		 }
	}
}
echo "</ul></div>";
}



function options_weather() {

	echo "<div class=\"wrap\">";
	echo "<h2>Weather Slider</h2>";
	
	echo "Adicionar las URLs, ejemplo: <a href='http://weather.yahooapis.com/forecastrss?p=POXX0022&u=c' target='_blank'>http://weather.yahooapis.com/forecastrss?p=POXX0022&u=c</a> , en la <b>p</b> de la URL inserta el c&#243;digo de la ciudad de 
		  la que quieres el tiempo, puedes sacar el c&#243;digo de la ciudad que desees aqu&#237; ( <a href='http://xoap.weather.com/weather/search/search?where=' target='_blank'>xoap.weather.com</a> en el par&#225;metro <b>where</b> pones el nombre 
		  de la ciudad. Por ejemplo para buscar la ciudad de <a href='http://xoap.weather.com/weather/search/search?where=Porto' target='_blank'>Porto</a> copias el id(c&#243;digo) de 
		  la ciudad que deseas entre todos los resultados), y en la <b>u</b>, si quieres grados cent&#237;grados coloca <b>c</b>, si lo quieres en Fahrenheit coloca <b>f</b>. Para alterar la 
		  cantidad de ciudades, en /wp-content/plugins/weather-slider/weather-slider.php altere la constante <b>CANT_URL</b> para la cantidad deseada.<br/><br/>";
	
	echo '<form method="post" action="options.php">';

	wp_nonce_field('update-options');
	$nome_feeds = '';
	for($i = 1; $i <= CANT_URL; $i++)	
	{
		echo 'URL '.$i.': <input type="text" name="url_feed'.$i.'" value="'.get_option('url_feed'.$i).'" size="80"/><br/>';
		$nome_feeds = $nome_feeds.'url_feed'.$i.',';
	}
	
	echo '<input type="hidden" name="action" value="update" />';
	echo '<input type="hidden" name="page_options" value="'.$nome_feeds.'" />';
	echo '<p class="submit">
		  <input type="submit" name="Submit" value="Actualizar" />
		  </p>';

	echo "</div> Donde quieras leer el tiempo de las ciudades, invoca la funci&#243;n <b>show_weather()</b>."?>

<?php
}

	
function weather_add_menu(){
	$icon_url = get_bloginfo('url').'/wp-content/plugins/weather-slider/images/weather.png';
	add_menu_page('Weather', 'Weather', 7, __FILE__, 'options_weather', $icon_url);
}

function weather_add_headerCode() {
	 // Registra la css 'styletiempo.css' en el HEAD del portal
     echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/weather-slider/css/styleweather-slider.css" />' . "\n";
     // Registra los .js necesarios en el HEAD del portal
     echo '<script type="text/javascript" src="'. get_bloginfo('wpurl') . '/wp-content/plugins/weather-slider/js/jquery-1.2.3.js"></script>' . "\n";
     echo '<script type="text/javascript" src="'. get_bloginfo('wpurl') . '/wp-content/plugins/weather-slider/js/easySlider1.5.js"></script>' . "\n";
     // Registra el script necesario para correr el slider
     echo '<script type="text/javascript">
			$(document).ready(function(){
			$("#slider").easySlider({
				prevText: \'\',	
				nextText: \'\',
				controlsBefore:	\'<p id="controls">\',
				controlsAfter:	\'</p>\',
				speed: 1000,
				auto: true,
				pause: 5000, //Milisegundos
				continuous: true
				});
			});	
		  </script>';
}

if (function_exists('add_action')) {
	add_action('admin_menu', 'weather_add_menu');
	add_action("wp_head",'weather_add_headerCode'); 
}

?>
