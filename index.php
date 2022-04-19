<?php
@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('floriankarsten/kirby-honeybadger', [
	'options'=> [
		'enabled' => false,
		'apiKey' => null,
	],
	'siteMethods' => [
        'honeybadger' => function ($exception) {
			$honeybadger = \Floriankarsten\Kirbyhoneybadger::singleton();
			$honeybadger->notify($exception);
        }
    ]
]);


if (! class_exists('Floriankarsten\Kirbyhoneybadger')) {
    require_once __DIR__ . '/classes/Log.php';
}

if (! function_exists('honeybadger')) {
    function honeybadger($exception)
    {
        return \Floriankarsten\Kirbyhoneybadger::singleton()->notify($exception);
    }
}