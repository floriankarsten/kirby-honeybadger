<?php
namespace Floriankarsten;


class Kirbyhoneybadger {
	private static $singleton;

	private $honeybadger;

    public function __construct(array $options = []) {
		if (option('floriankarsten.kirby-honeybadger.enabled') && option('floriankarsten.kirby-honeybadger.apiKey')) {
			$this->honeybadger = \Honeybadger::new([
				'api_key' => option('floriankarsten.kirby-honeybadger.apiKey')
			]);
		} else {
			$this->honeybadger = false;
		}
	}

    public static function singleton(array $options = [])
    {
        if (!self::$singleton) {
            self::$singleton = new self($options);
        }

        return self::$singleton;
    }

	public function notify($exception) {

		if($this->honeybadger) {
			$this->honeybadger->notify($exception);
		}
	}


}