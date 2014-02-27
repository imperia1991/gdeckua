<?php
/**
 * Description of StringHelper
 *
 * @author Геннадий
 */
class StringHelper
{
    public static function getPassword($lenght = 6)
    {
        //набор символов для пароля
        $symbols = array('a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9');


        $password = '';
        //запускаем цикл с количеством витков $lenght
        for($i = 0; $i < $lenght; $i++)
        {
            //случайным образом выбираем номер символа из массива $symbols для вставки в новый пароль
            $index = mt_rand(0, count($symbols) - 1);
            //склеиваем точкой имеющийся $password со случайным символом $symbols[$index]
            $password .= $symbols[$index];
        }

        //возвращаем новый пароль
        return $password;
    }
}
