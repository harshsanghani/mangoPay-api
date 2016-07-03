<?php
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api = new MangoPay\MangoPayApi();

        $userId             = '10400036'; // Change with your UserId
        $naturalUserResult  = $api->Users->GetNatural($userId);

        // display result
        MangoPay\Libraries\Logs::Debug('NATURAL USER', $naturalUserResult);

        $userId             = '10400036'; // Change with your UserId
        $legalUserResult    = $api->Users->GetLegal($userId);

        // display result
        MangoPay\Libraries\Logs::Debug('LEGAL USER', $legalUserResult);

        $userId     = '10400036'; // Change with your UserId
        $userResult = $api->Users->Get($userId);

        // display result
        MangoPay\Libraries\Logs::Debug('USER', $userResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>