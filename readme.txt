=== Plugin Name ===

Contributors: mimartinez
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=553DAMF8NZ7XA&lc=PT&item_name=michelmartinez&item_number=DONIN&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: Yahoo! Weather, weather, slider, temperatura, temperature, tiempo, clima, cent&#237;grados, Fahrenheit
Requires at least: 2.1
Tested up to: 2.9.1
Stable tag: 1.0

Lee el tiempo desde Yahoo! Weather, de los c&#243;digos de las ciudades insertadas en el formulario. Muestra en los templates con efecto slider.

== Description ==

Lee el tiempo desde Yahoo! Weather, de los c&#243;digos de las ciudades insertadas en el formulario, desde <a href="http://weather.yahooapis.com/forecastrss?p=" target="_blank">weather.yahooapis.com</a>. Muestra dos ciudades en cada &#237;tem y se desplaza por el resto autom&#225;ticamente, con la opci&#243;n de poder seleccionar un &#237;tem. Cantidad de ciudades y CSS configurables, utiliza la librer&#237;a <a href="http://cssglobe.com/post/4004/easy-slider-15-the-easiest-jquery-plugin-for-sliding">easySlider</a>.

Adicionar las URLs, ejemplo: <a href='http://weather.yahooapis.com/forecastrss?p=POXX0022&u=c' target='_blank'>http://weather.yahooapis.com/forecastrss?p=POXX0022&u=c</a> , en la `p` de la URL inserta el c&#243;digo de la ciudad de la que quieres el tiempo, puedes sacar el c&#243;digo de la ciudad que desees aqu&#237; ( <a href='http://xoap.weather.com/weather/search/search?where=' target='_blank'>xoap.weather.com</a> en el par&#225;metro `where` pones el nombre de la ciudad. Por ejemplo para buscar la ciudad de <a href='http://xoap.weather.com/weather/search/search?where=Porto' target='_blank'>Porto</a> copias el id(c&#243;digo) de la ciudad que deseas entre todos los resultados), y en la `u`, si quieres grados cent&#237;grados coloca `c`, si lo quieres en Fahrenheit coloca `f`. Para alterar la cantidad de ciudades, en `/wp-content/plugins/weather-slider/weather-slider.php` altere la constante `CANT_URL` para la cantidad deseada.


== Installation ==

Installation Instructions:

1. Download the plugin and unzip it.
2. Put the `weather-slider` directory into your `wp-content/plugins/` directory.
3. Go to the Plugins page in your WordPress Administration area and click `Activate` next to Weather Slider.
4. Go to the Weather option and configure your settings.
5. Place `<?php show_weather();?>` in your templates.

== Screenshots ==

1. Preview in Template
2. Preview in WordPress Administration area