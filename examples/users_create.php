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

        // CREATE NATURAL USER
        $naturalUser                    = new MangoPay\UserNatural();
        $naturalUser->Email             = 'abc@pqr.com';
        $naturalUser->FirstName         = "Harsh";
        $naturalUser->LastName          = "Sanghani";
        $naturalUser->Birthday          = 121271;
        $naturalUser->Nationality       = "FR";
        $naturalUser->CountryOfResidence= "ZA";
        $naturalUserResult              = $api->Users->Create($naturalUser);

        // display result
        MangoPay\Libraries\Logs::Debug('CREATED NATURAL USER', $naturalUserResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>