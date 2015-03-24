<?php

    class dbmanager {

        public static function get_master() {
            return new db(config::get('db/master'));
        }

        public static function get_slave() {
            return new db(config::get('db/slave'));
        }

    }
