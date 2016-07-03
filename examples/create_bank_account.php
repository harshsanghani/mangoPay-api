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

        $userId                         = '10499133'; // Change with your UserId

        $account                        = new MangoPay\BankAccount();
        $account->OwnerName             = 'Harsh Sanghani';
        $account->UserId                = $userId;
        $account->Type                  = 'IBAN';

        $account_address                = new MangoPay\Address();
        $account_address->AddressLine1  = "test";
        $account_address->AddressLine2  = "test";
        $account_address->City          = "test";
        $account_address->Region        = "test";
        $account_address->PostalCode    = "123456";
        $account_address->Country       = "IN";
        $account->OwnerAddress          = $account_address;

        $account_details                = new MangoPay\BankAccountDetailsIBAN();
        $account_details->IBAN          = 'FR7618829754160173622224154';
        $account_details->BIC           = 'CMBRFR2BCME';
        $account->Details               = $account_details;

        $account->Tag                   = 'Testing';

        $accountResult                   = $api->Users->CreateBankAccount($userId, $account);

        // display result
        MangoPay\Libraries\Logs::Debug('Bank Account : ', $accountResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>