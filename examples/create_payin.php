<?php
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api    = new MangoPay\MangoPayApi();

        $card   = $api->Cards->Get('10000663'); // Change with your CardId

        // create pay-in CARD DIRECT
        $payIn                          = new \MangoPay\PayIn();
        $payIn->CreditedWalletId        = $createdWallet->Id;
        $payIn->AuthorId                = '10400036'; // Change with your AuthorId

        $payIn->DebitedFunds            = new \MangoPay\Money();
        $payIn->DebitedFunds->Amount    = '9999';
        $payIn->DebitedFunds->Currency  = 'USD';
        $payIn->Fees                    = new \MangoPay\Money();
        $payIn->Fees->Amount            = 0;
        $payIn->Fees->Currency          = 'USD';

        // payment type as CARD
        $payIn->PaymentDetails              = new \MangoPay\PayInPaymentDetailsCard();
        $payIn->PaymentDetails->CardType    = $card->CardType;

        // execution type as DIRECT
        $payIn->ExecutionDetails                        = new \MangoPay\PayInExecutionDetailsDirect();
        $payIn->ExecutionDetails->CardId                = $card->Id;
        $payIn->ExecutionDetails->SecureModeReturnURL   = 'http://test.com';

        // create Pay-In
        $createdPayIn                   = $api->PayIns->Create($payIn);

        // display result
        MangoPay\Libraries\Logs::Debug('CREATED PAYIN', $createdPayIn);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>