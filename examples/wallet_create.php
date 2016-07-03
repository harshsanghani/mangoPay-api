<?php
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api = new MangoPay\MangoPayApi();

        // CREATE USER WALLET
        $wallet                 = new MangoPay\Wallet();
        $wallet->Tag            = 'Testing';
        $wallet->Owners         = array("10400036"); // Change with your Owner IDs
        $wallet->Description    = "My first Wallet";
        $wallet->Currency       = "USD";
        $wallet->Balance        = "1111";
        $walletResult           = $api->Wallets->Create($wallet);

        // display result
        MangoPay\Libraries\Logs::Debug('CREATED USER WALLET', $walletResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>