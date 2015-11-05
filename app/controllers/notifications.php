<?php
/**
 * Created by drodriguez
 * Date: 15-05-15
 * Time: 03:13 PM
 */

namespace controllers;
use business_logic\NotificationManager;
use helpers\Logging;

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
     * Envia notificaciones a todos los suminsitros que tengan 2 o más facturas vencidas hasta el día de hoy y que recién
     * el día anterior se haya vencido
     */
    public function nonpayment_outage()
    {
        set_time_limit(0);
        ignore_user_abort(true);
        ob_start();
        http_response_code(202);
        header('Connection: close');
        header('Content-Length: 0');
        ob_end_flush();
        ob_flush();
        flush();
        // close current session
        if (session_id()) session_write_close();
        //Continue processing
        $log = new Logging();
        $log->lfile( $_SERVER['DOCUMENT_ROOT'].'\logs\nonpayment_outage.txt');
        $log->lwrite('Inicio de proceso de envío de mensajes de cortes por mora');
        $log->lclose();
        $count = NotificationManager::processNonPaymentOutageNotificationSend();
        $log->lwrite("Fin de proceso de envío de mensajes de cortes por mora. Número de mensajes enviados: $count");
        $log->lclose();
    }

    /**
     * Envia notificaciones a todos los suminsitros que tengan facturas vencidas el día de hoy
     */
    public function expired_debts()
    {
        set_time_limit(0);
        ignore_user_abort(true);
        ob_start();
        http_response_code(202);
        header('Connection: close');
        header('Content-Length: 0');
        ob_end_flush();
        ob_flush();
        flush();
        // close current session
        if (session_id()) session_write_close();
        //Continue processing
        $log = new Logging();
        $log->lfile( $_SERVER['DOCUMENT_ROOT'].'\logs\expired_debts.txt');
        $log->lwrite('Inicio de proceso de envío de mensajes de facturas vencidas');
        $log->lclose();
        $count = NotificationManager::processExpiredDebtNotificationSend();
        $log->lwrite("Fin de proceso de envío de mensajes de facturas vencidas. Número de mensajes enviados: $count");
        $log->lclose();
    }
} 