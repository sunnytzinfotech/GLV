<?php

namespace App\CustomFunction;

use DB;

Class CustomFunction {

    public static function random_string($limit) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $limit; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }

    public static function random_string_capital($limit) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $limit; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }

    public static function filter_input($input) {
        $input = trim($input);
        $input = htmlentities($input);
        $input = addslashes($input);

        return $input;
    }

    public static function decode_input($input) {
        $input = htmlspecialchars_decode($input);
        $input = stripslashes($input);
        return $input;
    }

    public static function get_time_difference($time) {

        $output = date('j M, Y h:i a', strtotime($time));
        $now = date('Y-m-d H:i:s');

        $date1 = date_create($now);
        $date2 = date_create($time);
        $diff = date_diff($date1, $date2);

        if ($diff->d == 0) {
            $h = $diff->h;
            $i = $diff->i;
            $s = $diff->s;

            if ($i == 0) {
                $output = "just now";
            } else if ($h == 0) {
                $output = $i . " min ago";
            } else {
                $output = $h . " hr ago";
            }
        }

        return $output;
    }

    public static function validate_input($input, $vtype) {
        if ($vtype == "email") {
            if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
        }
        if ($vtype == "text_only") {
            if (preg_match("/^[a-zA-Z]*$/", $input)) {
                return true;
            }
        }
        if ($vtype == "text_with_space") {
            if (preg_match("/^[a-zA-Z ]*$/", $input)) {
                return true;
            }
        }
        if ($vtype == "text_with_number") {
            if (preg_match("/^[a-zA-Z0-9]*$/", $input)) {
                return true;
            }
        }
        if ($vtype == "text_with_number_space") {
            if (preg_match("/^[a-zA-Z0-9 ]*$/", $input)) {
                return true;
            }
        }
        if ($vtype == "price") {
            if (preg_match("/^[0-9.]*$/", $input)) {
                return true;
            }
        }
        if ($vtype == "all_text") {
            $text = strpos($input, '`');
            if (empty($text)) {
                return true;
            }
        }
        if ($vtype == "number_only") {
            if (preg_match("/^[0-9]*$/", $input)) {
                return true;
            }
        }
        if ($vtype == "phone_number") {
            if (preg_match("/^[+0-9-]*$/", $input)) {
                return true;
            }
        }
        return false;
    }

    public static function limited_text($text, $limit) {
        $text = CustomFunction::decode_input($text);
        $text = strip_tags($text);

        $len = strlen($text);

        if ($len > $limit) {
            $text_final = substr($text, 0, $limit) . '....';
        } else {
            $text_final = $text;
        }

        return $text_final;
    }

    public static function limited_text_no_strip_tags($text, $limit) {
        $text = CustomFunction::decode_input($text);

        $len = strlen($text);

        if ($len > $limit) {
            $text_final = substr($text, 0, $limit) . '....';
        } else {
            $text_final = $text;
        }

        return $text_final;
    }

    public static function base_encode_string($str) {
        $random = mt_rand(0, 9999999999);
        $newstr = $random . '#' . $str;
        $encode = base64_encode($newstr);
        return $encode;
    }

    public static function base_decode_string($str) {
        $decode_str = base64_decode($str);
        $decode_ex = explode('#', $decode_str);
        $decode = $decode_ex[1];
        return $decode;
    }

}
