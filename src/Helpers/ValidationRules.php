<?php
namespace basuregami\UserModule\Helpers;

class ValidationRules
{

    public function mySanitizeNumber($number)
    {
        return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }

    public function mySanitizeDecimal($decimal)
    {
        return filter_var($decimal, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public function mySanitizeString($string)
    {
        $string = strip_tags($string);
        $string = addslashes($string);
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public function mySanitizeHtml($string)
    {
        $string = strip_tags($string, '<a><strong><em><hr><br><p><u><ul><ol><li><dl><dt><dd><table><thead><tr><th><tbody><td><tfoot>');
        $string = addslashes($string);
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public function mySanitizeUrl($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    public function mySanitizeSlug($string)
    {
        $string = str_slug($string);
        return filter_var($string, FILTER_SANITIZE_URL);
    }

    public function mySanitizeEmail($string)
    {
        return filter_var($string, FILTER_SANITIZE_EMAIL);
    }
}
