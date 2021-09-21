<?php
@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('floriankarsten/kirby-honeybadger', [
	'fatal' => function ($kirby, $exception) {
		if (option('floriankarsten.kirby-honeybadger.enabled') && option('floriankarsten.kirby-honeybadger.apiKey')) {
			$honeybadger = \Honeybadger::new([
				'api_key' => option('floriankarsten.kirby-honeybadger.apiKey')
			]);
			$honeybadger->notify($exception);
		}

		include $kirby->root('templates') . '/fatal.php';
	},
	'siteMethods' => [
        'honeybadger' => function ($exception) {
			if (option('floriankarsten.kirby-honeybadger.enabled') && option('floriankarsten.kirby-honeybadger.apiKey')) {
				$honeybadger = \Honeybadger::new([
					'api_key' => option('floriankarsten.kirby-honeybadger.apiKey')
				]);
				$honeybadger->notify($exception);
				return true;
			}
			return false;
        }
    ]
]);
