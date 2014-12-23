<?php
/**
 * Created by Diego
 * Date: 23-12-14
 * Time: 02:04 PM
 */

namespace data_access;

/**
 * Provee de un metodo para obtener una instancia de IUserDAL con la configuración de acceso
 * a base de datos determinado en config.php
 * Class AccountDALFactory
 * @package data_access
 */
class ClientDALFactory extends AbstractFactory {

    public static function instance()
    {
        self::$Name = 'ClientDAL';
        return parent::instance();
    }
}