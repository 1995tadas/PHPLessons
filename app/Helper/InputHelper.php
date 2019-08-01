<?php
namespace  App\Helper;

class InputHelper
{
    //validacijos
    //apdirbimai
    //password generatoriai

    public static function passwordGenerator($pass){
    return md5(md5($pass.'salt'));

}

    public static function passwordMatch($password, $password2)
    {
        if ($password === $password2){
            return true;
        }
        return false;
    }

    public static function prepareEmail($str)
    {
        $str = strtolower($str);
        return $str;
    }

    //
    public static function emailValid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    //--- tikrina ar unikalus emailas ---
    public static function uniqEmail($email)
    {
        $db = new \Core\Database();
        $db->select()->from('user')->where('email', $email);

        if ($db->get()) {
            return false;
        }
        return true;

    }

    public static function checkEmail($email)
    {
        $email = self::prepareEmail($email);
        if (self::uniqEmail($email) && self::emailValid($email)){
            return true;
        }
        return false;
    }

    public function makeSlug($title){
        $slug = strtolower($title);
        $slug = str_replace(' ', '-', $slug);
        return $slug;
    }
}
