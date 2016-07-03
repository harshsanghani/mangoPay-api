<?php session_start();
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api = new MangoPay\MangoPayApi();

        $cardID                         = $_SESSION['cardRegisterId'];
        $cardRegister                   = $api->CardRegistrations->Get($cardID);
        $cardRegister->RegistrationData = isset($_GET['data']) ? 'data=' . $_GET['data'] : 'errorCode=' . $_GET['errorCode'];
        $cardRegister->CardId           = $cardID;
        $cardResult                     = $api->CardRegistrations->Update($cardRegister);

        $card = $api->CardRegistrations->Get($cardID);

        // create pay-in CARD DIRECT
        $payIn                              = new \MangoPay\PayIn();
        $payIn->CreditedWalletId            = '10000747'; // Change with your CreditedWalletId
        $payIn->AuthorId                    = $card->UserId;

        $payIn->DebitedFunds                = new \MangoPay\Money();
        $payIn->DebitedFunds->Amount        = '9999';
        $payIn->DebitedFunds->Currency      = 'USD';
        $payIn->Fees                        = new \MangoPay\Money();
        $payIn->Fees->Amount                = '0';
        $payIn->Fees->Currency              = 'USD';

        // payment type as CARD
        $payIn->PaymentDetails              = new \MangoPay\PayInPaymentDetailsCard();
        $payIn->PaymentDetails->CardType    = $card->CardType;

        // execution type as DIRECT
        $payIn->ExecutionDetails            = new \MangoPay\PayInExecutionDetailsDirect();
        $payIn->ExecutionDetails->CardId    = $card->Id;
        $payIn->ExecutionDetails->SecureModeReturnURL = 'http://test.com';

        // create Pay-In
        $createdPayIn                       = $api->PayIns->Create($payIn);

        //Build the parameters for the request
        $CardPreAuthorization                           = new \MangoPay\CardPreAuthorization();
        $CardPreAuthorization->AuthorId                 = $card->UserId;

        $CardPreAuthorization->DebitedFunds             = new \MangoPay\Money();
        $CardPreAuthorization->DebitedFunds->Currency   = "USD";
        $CardPreAuthorization->DebitedFunds->Amount     = 3471;

        $CardPreAuthorization->SecureMode               = "FORCE";
        $CardPreAuthorization->CardId                   = $card->Id;
        $CardPreAuthorization->SecureModeReturnURL      = "http://www.example.com/file.php";


        //Send the request
        $result = $mangoPayApi->CardPreAuthorizations->Create($CardPreAuthorization);

        // display result
        MangoPay\Libraries\Logs::Debug('CREATED USER CARD', $cardResult);

        $_SESSION = array();

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>