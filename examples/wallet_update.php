<?php
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api = new MangoPay\MangoPayApi();

        // CREATE NATURAL USER
        $wallet                     = new MangoPay\Wallet();
        $wallet->Id                 = "10500061"; // Change with your walletId
        $wallet->Tag                = 'Testing';
        $wallet->Owners             = array("10400091"); // Change with your Owner IDs
        $wallet->Description        = "Testing credit in users wallet";
        $wallet->Currency           = "USD";
        $wallet->Balance            = new MangoPay\Money();
        $wallet->Balance->Amount    = 1111;
        $wallet->Balance->Currency  = 'USD';
        $walletResult               = $api->Wallets->Update($wallet);

        // display result
        MangoPay\Libraries\Logs::Debug('USER WALLET : ', $walletResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>