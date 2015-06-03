<?php
/**
 * Created by drodriguez
 * Date: 15-05-15
 * Time: 03:13 PM
 */

namespace controllers;
use business_logic\NotificationManager;

class Notifications extends \core\controller{


    /**
     * Notifica de una notificación de corte fortuito o programado
     */
    public function notification()
    {
        header('Content-Type: application/json');
        if(isset($_POST['message']) && isset($_POST['outage_case']))
        {
            $message=$_POST['message'];
            $outageCaseNumber = $_POST['outage_case'];
            if(NotificationManager::processOutageNotificationSend($message, $outageCaseNumber))
                exit ('{ "message": "'.$message.'", "case": "'.$outageCaseNumber.'"}');
            else {
                http_response_code(404);
                exit ('{ "error_message": "No se encontró el número de caso solicitado, no se envió ningun mensaje"}');
            }
        }
        else{
            http_response_code(400);
            exit ('{ "error_message": "No se enviaron los parámetros suficientes para consumir el servicio"}');
        }
    }

    /**
     * Envia notificaciones a todos los suminsitros que tengan deudas y sean pasibles a corte desde el día siguiente
     */
    public function nonpayment_outage()
    {
        NotificationManager::processNonPaymentOutageNotificationSend();
    }
} 