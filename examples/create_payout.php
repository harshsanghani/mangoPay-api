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

        $payout                         = new MangoPay\PayOut();
        $payout->Tag                    = "Withdrow balance from wallet to bank account";
        $payout->AuthorId               = 10499113; // Change with your AuthorId
        $payout->DebitedWalletId        = 10501717; // Change with your DebitedWalletId

        $payout->DebitedFunds           = new \MangoPay\Money();
        $payout->DebitedFunds->Amount   = '2000';
        $payout->DebitedFunds->Currency = 'USD';
        $payout->Fees                   = new \MangoPay\Money();
        $payout->Fees->Amount           = '0';
        $payout->Fees->Currency         = 'USD';

        $details                        = new \MangoPay\PayOutPaymentDetailsBankWire();
        $details->BankAccountId         = 10553115; // Change with your BankAccountId
        $details->BankWireRef           = "Transfer from wallet to bank account";

        $payout->MeanOfPaymentDetails   = $details;
        $payout->PaymentType            = "BANK_WIRE";

        $payoutResult                   = $api->PayOuts->Create($payout);

        // display result
        MangoPay\Libraries\Logs::Debug('Payout : ', $payoutResult);

    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>