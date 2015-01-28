<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 28-01-15
 * Time: 10:36 AM
 */

namespace data_access\pgsql;

use models\Contact;

class ContactDAL implements IContactDAL{

    /**
     * Obtiene el contacto actual que se encuentre activo
     * Nota.- solo un contacto puede y debe estar activo al mismo tiempo
     * @return Contact
     */
    public function GetCurrentActiveContact()
    {
        $db = Database::get();
        $result  = $db->select("SELECT * FROM contacts WHERE status=1 ORDER BY insert_date DESC LIMIT 1");
        $size = count($result);
        if($size==0)
            return null;
        return Contact::create()->setId($result[0]->id)->setPhone($result[0]->phone)->setAddress($result[0]->address)
            ->setEmail($result[0]->email)->setWebPage($result[0]->webpage)->setFacebook($result[0]->facebook)->setFacebookId($result[0]->facebook_id)
            ->setStatus($result[0]->status)->setInsertDate($result[0]->insert_date)->setUpdateDate($result[0]->update_date);
    }
} 