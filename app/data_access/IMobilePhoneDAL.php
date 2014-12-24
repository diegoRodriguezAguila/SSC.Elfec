<?php
/**
 * Created by PhpStorm.
 * User: Zuki
 * Date: 12/24/14
 * Time: 5:23 PM
 */

namespace data_access;

use models\MobilePhone;

interface IMobilePhoneDAL {

    /**
     * Registra un nuevo telefono relacionado a un cliente y retorna el Id que se le asignó
     * @param Client $newClient
     * @return int
     */
    public function RegisterPhone(MobilePhone $phone);

} 