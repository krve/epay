<?php

namespace Epay\Error;

class ErrorParser
{
    protected static $errors = [
        '-10006' => [
            'default' => 'The user canceled the EWIRE transaction',
        ],
        '-5604' => [
            'default' => 'Fee can not be calculated for the card type used.',
        ],
        '-5603' => [
            'default' => 'The store does not allow the type of card.',
        ],
        '-5602' => [
            'default' => 'An invalid currency code has been used.',
        ],
        '-5601' => [
            'default' => 'Fee can not be calculated for the card type used.',
        ],
        '-5600' => [
            'default' => 'The card number is not accurate - invalid prefix (must be 6 characters).',
        ],
        '-5516' => [
            'default' => 'The payment window was closed by user',
        ],
        '-5514' => [
            'default' => 'Customer\'s session has either expired or the payment process has not started correctly.',
        ],
        '-5511' => [
            'default' => 'An error has occurred! Please restart the payment process.',
        ],
        '-5509' => [
            'default' => 'You get the error Not valid data when you try to open the Standard Payment window. You get this error because ePay can not find the data to the transaction. This error occurs because the user / client has been inactive for more than 20 minutes!',
        ],
        '-5508' => [
            'default' => 'You receive the rror "No valid domains created for the company", when you try to open the payment window. You receive this error as you have not entered the domain for your account in the payment system. In the payment system in the menu "Settings" and "Payment system" you can see the domain(s) assigned to your accout.',
        ],
        '-5507' => [
            'default' => 'You receive the error "URL not allowed for relaying", when you try to open the payment window. You receive this error as the domain you open up the window from, is not entered in the payment system. In the administration to the payment system from the menu "Settings" and "Payment System", you can enter you domain.',
        ],
        '-5506' => [
            'default' => 'You get the error Invalid merchant number, when you try to open the Standard Payment window. You get this error because it indløsningsnummer / merchant number you use is not established in the payment! Check whether you are using the correct merchant number.',
        ],
        '-5505' => [
            'default' => 'You get the error No cardtypes defined when you try to open the Standard Payment window. This is because there are NO cards up to your account in the payment system.',
        ],
        '-5504' => [
            'default' => 'You get the error Invalid currencycode when you try to open the Standard Payment window. You get this error because you are using an invalid currencycode. You can from your administration to thepayment system in the menu "Support" and "Currency Codes" see the list of currency codes available.',
        ],
        '-5503' => [
            'default' => 'The data that you send to the payment window are not correct! You get a description of the data as it is not listed correctly.',
        ],
        '-5502' => [
            'default' => 'You receive the error "Invalid company" when you try to open the payment window. You receive this error as you have not activated the payment window yet. You have to activate the window from your administration to the payment system from the menu "Settings" and "Payment window".',
        ],
        '-5501' => [
            'default' => 'You receive the error "Window not activated", when you try to open the payment window. You receive this error as you have not activated the payment window yet. You have to activate the window from your administration to the payment system from the menu "Settings" and "Payment window".',
        ],
        '-2003' => [
            'default' => 'Declined - Issuers country / region does not match the country the payment come from.',
        ],
        '-2002' => [
            'default' => 'Declined - Nonsecure payments from country / region are not accepted.',
        ],
        '-2001' => [
            'default' => 'Declined - Payments from country / region are not accepted.',
        ],
        '-2000' => [
            'default' => 'Declined - Payments from your IP Address are not accepted.',
        ],
        '-1602' => [
            'default' => 'PBS test gateway is unfortunately down at the moment, please try again later.',
        ],
        '-1601' => [
            'default' => 'The reply sent to the payment system was expected to be from a bank, but is invalid. Invalid data was posted.',
        ],
        '-1600' => [
            'default' => 'The session of banking has already been used. The same session can not be used again.',
        ],
        '-1312' => [
            'default' => 'Declined - Transaction could not be captured - try again or contact PayPal',
        ],
        '-1303' => [
            'default' => 'Rejected - Payment could not be increased - rejected by EWIRE.',
        ],
        '-1302' => [
            'default' => 'Rejected - Error ewire MD5 data. Check the MD5 data is posted in both EWIRE and ePay.',
        ],
        '-1301' => [
            'default' => 'Rejected - EWIRE emrchant number was not found - Check if your EWIRE merchant number is setup at ePay.',
        ],
        '-1300' => [
            'default' => 'Unknown currency code. You can only use the currency codes that you can see in the menu "Support" and "Currency Codes" in the administration.',
        ],
        '-1200' => [
            'default' => 'Ukendt valutakode. Du kan kun benytte de valutakoder, som du kan se under menupunktet Support og Valutakoder i administrationen.',
        ],
        '-1100' => [
            'default' => 'Invalid data received at the payment system. You must remember to send the amount in the smallest unit / minor units (eg GBP must. Specified in Pennies), and may not use the comma or dot (separator). Please also remember to send the fields cardno, expmonth and expyear which are also mandatory.',
        ],
        '-1024' => [
            'default' => 'Invalid card number entered. Please correct and try again.',
        ],
        '-1023' => [
            'default' => 'The transaction is already captured',
        ],
        '-1022' => [
            'default' => 'The transaction is declined as the merchant blocks all transactions made by the matching card number.',
        ],
        '-1021' => [
            'default' => 'An operation every 15 minutes can be performed on a transaction. Please wait 15 minutes and try again.',
        ],
        '-1020' => [
            'default' => 'The transaction is deleted',
        ],
        '-1019' => [
            'default' => 'Invalid password used for webservice access!',
        ],
        '-1018' => [
            'default' => 'Invalid test-card used! You find the correct test-information from the menu Support - Test Information as you are logged into the payment system.',
        ],
        '-1017' => [
            'default' => 'No access to PCI required function!',
        ],
        '-1016' => [
            'default' => 'There is disruption at the acquirer. This is an offline procedure. Please wait a moment and try again.',
        ],
        '-1015' => [
            'default' => 'Currency code was not found. You should check your currency code you can accept payments with.',
        ],
        '-1014' => [
            'default' => 'The transaction could not be made as 3D secure. The transaction is declined. Try another credit card or contact the merchant.',
        ],
        '-1012' => [
            'default' => 'Rejected - Unable to renew this type of card.',
        ],
        '-1011' => [
            'default' => 'MD5 stamp was not valid.',
        ],
        '-1010' => [
            'default' => 'The cardtype was not found in the specified list of predefined card types (field cardtype). If you wish to receive this type of card you need to add the card type to this list.',
        ],
        '-1009' => [
            'default' => 'Subscription was not found.',
        ],
        '-1008' => [
            'default' => 'The transaction could not be found.',
        ],
        '-1007' => [
            'default' => 'There are differences in the amount captured / available. Please examine the amount of which is captured / credited against the amount authorized / captured. Note if there is a Euroline transaction and the transaction is captured, it can only be credited the following day.',
        ],
        '-1006' => [
            'default' => 'Product Unavailable.',
        ],
        '-1005' => [
            'default' => 'Disruption - try again later.',
        ],
        '-1004' => [
            'default' => 'Error code not found.',
        ],
        '-1003' => [
            'default' => 'No access to the ipaddress for remote interface (API).',
        ],
        '-1002' => [
            'default' => 'Merchantnumber was not found in the payment system.',
        ],
        '-1001' => [
            'default' => 'Order number already exists.',
        ],
        '-1000' => [
            'default' => 'Communication disorders at the acquirer.',
        ],
        '-23' => [
            'default' => 'PBS test gateway unavailable.',
        ],
        '-4' => [
            'default' => 'Communication disorders at the acquirer.',
        ],
        '-3' => [
            'default' => 'Communication disorders at the acquirer.',
        ],
        '4000' => [
            'default' => 'eDankort / PBS 3D secure / Banking - payment interrupted by user',
        ],
        '4001' => [
            'default' => 'SOLO - user cut off payment',
        ],
        '4002' => [
            'default' => 'SOLO - the user was rejected',
        ],
        '4003' => [
            'default' => 'SOLO - errors in MAC (MD5)',
        ],
        '4100' => [
            'default' => 'Rejected - No answer',
        ],
        '4101' => [
            'default' => 'Rejected - Call the card issuer',
        ],
        '4102' => [
            'default' => 'Rejected - Call the card issuer and keep the card (fraud)',
        ],
        '4103' => [
            'default' => 'The payment was declined. You might have entered wrong information. Please try again or contact the merchant.',
        ],
        '4104' => [
            'default' => 'Rejected - System Error - no answer',
        ],
        '4105' => [
            'default' => 'Rejected - unknown error',
        ],
        '4106' => [
            'default' => 'Rejected - Card is not approved by VISA / MasterCard / JCB (3D Secure). Please try again.',
        ],
        '4107' => [
            'default' => 'Rejected - Can not release Euro Line (SEB) payment (not supported)',
        ],
        '4108' => [
            'default' => 'Rejected - Can not renew Euro Line (SEB) payment (not supported)',
        ],
        '4109' => [
            'default' => 'Rejected - card could not be approved by the 3D secure',
        ],
        '4110' => [
            'default' => 'Rejected - An error occurred during the approval of 3D secure',
        ],
        '4111' => [
            'default' => 'Rejected - The card could not be found in 3D secure',
        ],
        '4121' => [
            'default' => 'The transaction was cancelled by Customer at ViaBill',
        ],
        '4122' => [
            'default' => 'The transaction was cancelled by Customer at ViaBill',
        ],
        '10004' => [
            'default' => 'The payment through Danske Bank was interrupted.',
        ],
        '10005' => [
            'default' => 'The payment through Danske Bank was interrupted.',
        ],
    ];

    /**
     * Get the error message based on the code.
     *
     * @param $code
     *
     * @throws \Epay\Error\ErrorCodeNotFound
     *
     * @return string
     */
    public static function getMessage($code)
    {
        if (!in_array($code, array_keys(static::$errors))) {
            throw new ErrorCodeNotFound();
        }

        return $code.': '.static::$errors[$code]['default'];
    }
}
