<?php
class StringHelper
{
    public static function br2nl($string) {
        return preg_replace('/<br(\s+)?\/?>/i', '', htmlspecialchars_decode($string));
    }
}
