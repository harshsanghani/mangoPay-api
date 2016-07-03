<!--
	Author :- Harsh Sanghani
	Website :- www.angelinfotech.info
	
	This demo is created for mangoPay-API user, You have to change some relative API key, id and etc for working example.
-->
<?php
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api = new MangoPay\MangoPayApi();

        // CREATE MONEY TRANSFER
        $transfer                           = new MangoPay\Transfer();
        $transfer->AuthorId                 = '10400033'; // Change with your AuthorId
        $transfer->CreditedUserId           = '10400033'; // Change with your CreditedUserId
        $transfer->DebitedFunds             = new \MangoPay\Money();
        $transfer->DebitedFunds->Amount     = '5000';
        $transfer->DebitedFunds->Currency   = 'USD';
        $transfer->Fees                     = new \MangoPay\Money();
        $transfer->Fees->Amount             = '0';
        $transfer->Fees->Currency           = 'USD';
        $transfer->DebitedWalletID          = '10500047'; // Change with your DebitedWalletID
        $transfer->CreditedWalletID         = "10500207"; // Change with your CreditedWalletID
        $transfer->Tag                      = "Wallet transfer";
        $walletResult                       = $api->Transfers->Create($transfer);

        // display result
        MangoPay\Libraries\Logs::Debug('WALLET TRANSFER', $walletResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>