<?php
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api = new MangoPay\MangoPayApi();

        $cardID                         = '10503663'; // Change with your cardID
        $cardRegister                   = $api->CardRegistrations->Get($cardID);
        $cardRegister->RegistrationData = 'XBDYiG8w9PrylPS01KmupQ0tAk7TLPNTS5LQ60gvUkOgV1eDyUlU9N-NVUN0P9a17qGR3HARSHUiPbx-Z--VxQ';
        $cardResult                     = $api->CardRegistrations->Update($cardRegister);

        // display result
        MangoPay\Libraries\Logs::Debug('CARD UPDATE', $cardResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }