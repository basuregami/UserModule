<?php
namespace basuregami\UserModule\Helpers;

class ValidationRules
{

    function my_sanitize_number($number) {
        return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }

    function my_sanitize_decimal($decimal) {
        return filter_var($decimal, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    function my_sanitize_string($string) {
        $string = strip_tags($string);
        $string = addslashes($string);
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    function my_sanitize_html($string) {
        $string = strip_tags($string, '<a><strong><em><hr><br><p><u><ul><ol><li><dl><dt><dd><table><thead><tr><th><tbody><td><tfoot>');
        $string = addslashes($string);
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    function my_sanitize_url($url) {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    function my_sanitize_slug($string) {
        $string = str_slug($string);
        return filter_var($string, FILTER_SANITIZE_URL);
    }

    function my_sanitize_email($string) {
        return filter_var($string, FILTER_SANITIZE_EMAIL);
    }

}