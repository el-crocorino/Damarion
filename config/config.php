<?php

    class config {

        protected $config_data = array();

        public static $unique_instance = NULL;

        private function __construct() {

                $dConfig = array();

                // Application libraries

                $dConfig['includes'] = array(
                    'functions' => 'functions.php',
                    'load' => 'load.php'
                );

                // PATHS

                $dConfig['paths'] = array(
                    'base_path' => substr(__DIR__, 0, -6),
                    'classes'   => 'classes/',
                    'includes'  => 'includes/',
                    'save'  => 'save/',
                    'tests'   => 'tests/'
                );

                // Tests

                $dConfig['tests'] = array(
                    'application',
                    'campus',
                    'salary',
                    'student',
                    'teacher',
                    'list'
                    );

            $this->set_config($dConfig);

        }

        public static function get_config_instance() {

            if (NULL === self::$unique_instance) {
                self::$unique_instance = new config();
            }

            return self::$unique_instance;

        }

        public function get_config($item) {

            $item_list = explode('/', $item);

            $storage = $this->config_data;

            foreach ($item_list AS $value) {
                $storage = $storage[$value];
            }

            if (isset($storage)) {
                return $storage;
            } else {
                throw new Exception("No config value for " . $item . " available.");
            }

        }

        public function set_config(array $dConfig) {

            if (is_array($dConfig)) {
                $this->config_data = $dConfig;
            }

        }

        public static function get($item) {
            $config = config::get_config_instance();
            return $config->get_config($item);
        }

    }

    // Php configuration

    ini_set("register_globals","on");
    ini_set("display_errors","on");

    ini_set('error_reporting', E_ALL);
    ini_set('include_path', substr(__DIR__, 0, -6) . 'classes:' . substr(__DIR__, 0, -6) . 'includes:' . __DIR__);

    date_default_timezone_set('Europe/Paris');
