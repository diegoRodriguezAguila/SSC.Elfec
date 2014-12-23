<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 11:00 AM
 */

namespace data_access;

/**
 * Provee de un metodo para obtener una instancia de IAccountDAL con la configuración de acceso
 * a base de datos determinado en config.php
 * Class AccountDALFactory
 * @package data_access
 */
class AccountDALFactory extends AbstractFactory {
    public static function instance()
    {
        self::$Name = 'AccountDAL';
        return parent::instance();
    }
} 