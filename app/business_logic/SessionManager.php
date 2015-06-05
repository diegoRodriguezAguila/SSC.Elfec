<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 3/10/15
 * Time: 9:28 PM
 */

namespace business_logic;
use helpers\Session;
use helpers\Crypto;
use helpers\InvalidCiphertextException;
use helpers\CryptoTestFailedException;
use helpers\CannotPerformOperationException;
use models\enums\DataBaseType;

class SessionManager {

    /**
     * Obtiene los parámetros de conexión del usuario logeado actualmente
     * Nota.- Si no hay usuario logeado el usuario y password serán nulos
     * y puede que de problemas al conectar con la base de datos
     * @return array
     */
    public static function getUserDataBaseConnection()
    {
        $dbConn = DataBaseType::$PGSQL_DATABASE;
        $dbConn['user'] = Session::get("username");
        $dbConn['pass'] = self::decryptPassword(Session::get("password"), Session::get("key"));
        return $dbConn;
    }

    /**
     * Desencripta el password provisto con la clave provista, retorna null si es que la clave
     * no es la adecuada para desencriptar
     * @param $password
     * @param $key
     * @return string
     */
    private static function decryptPassword($password, $key)
    {
        try {
            return Crypto::Decrypt($password, $key);
        } catch (InvalidCiphertextException $ex) { // VERY IMPORTANT
            return null;
        } catch (CryptoTestFailedException $ex) {
            die('Cannot safely perform encryption');
        } catch (CannotPerformOperationException $ex) {
            die('Cannot safely perform decryption');
        }
    }

    public static function isLoggedIn()
    {
        return Session::get('username')!=null;
    }
    public static function logInUser($username, $password)
    {
        Session::set("username",$username);
        try {
            $key = Session::get('key')==null?Crypto::CreateNewRandomKey():Session::get('key');
            $encryptedPassword = Crypto::Encrypt($password, $key);
            Session::set("key",$key);
            Session::set("password",$encryptedPassword);
        } catch (CryptoTestFailedException $ex) {
            Session::destroy();
            die('Cannot safely create a key');
        } catch (CannotPerformOperationException $ex) {
            Session::destroy();
            die('Cannot safely create a key');
        }
    }
    public static function logOut()
    {
        Session::destroy();
    }
} 