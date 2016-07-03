<?php session_start();
    // require include only one file
    require_once '../MangoPay/Autoloader.php';

    try {
        // create object to manage MangoPay API
        $api = new MangoPay\MangoPayApi();

        // CREATE CARD
        $card                       = new MangoPay\CardRegistration();
        $card->Tag                  = 'First card';
        $card->UserId               = "10400036"; // Change with your UserId
        $card->Currency             = "USD";
        $card->CardType             = "CB_VISA_MASTERCARD ";
        $cardResult                 = $api->CardRegistrations->Create($card);

        $_SESSION['cardRegisterId'] = $cardResult->Id;
        $returnUrl                  = "http://localhost/demo/mangopay/new/demos/card_process.php"; // Change return URL accordingly


    } catch (MangoPay\Libraries\ResponseException $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
        MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
        MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

    } catch (MangoPay\Libraries\Exception $e) {

        MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
    }
?>
<html>
    <form action="<?php print $cardResult->CardRegistrationURL; ?>" method="post">
        <input type="hidden" name="data" value="<?php print $cardResult->PreregistrationData; ?>" />
        <input type="hidden" name="accessKeyRef" value="<?php print $cardResult->AccessKey; ?>" />
        <input type="hidden" name="returnURL" value="<?php print $returnUrl; ?>" />

        <label for="cardNumber">Card Number</label>
        <input type="text" name="cardNumber" value="" />
        <div class="clear"></div>

        <label for="cardExpirationDate">Expiration Date</label>
        <input type="text" name="cardExpirationDate" value="" placeholder="MMYY" />
        <div class="clear"></div>

        <label for="cardCvx">CVV</label>
        <input type="text" name="cardCvx" value="" />
        <div class="clear"></div>

        <input type="submit" value="Pay" />
    </form>
</html>