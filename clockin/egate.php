<?php

$vpcURL = "https://migs.mastercard.com.au/vpcdps";
//$vpcURL ="https://migs.mastercard.com.au/vpcpay";

// Start 3D processing config
$my_md5HashData = "495D7D78282D41A19D4F97F561DBCCE5";
$vpc_ReturnURL = "payment.php";
//$vpc_ReturnURL = "https://secure.flexihostings.net.au/web/index.php";

$vpc_Locale = "en";
$vpc_gateway= "threeDSecure";
// End 3D processing config

$vpcAccessCode = "2E69AB5B";
$vps_MID = "ANZFLEXI";

function check_cc_type($card_no)
{
		if (ereg("^5[1-5][0-9]{14}$", $card_no))
                return "Mastercard"; 
      elseif (ereg("^4[0-9]{12}([0-9]{3})?$", $card_no))
         return "Visa";
      elseif (ereg("^3[47][0-9]{13}$", $card_no))
         return "American Express";
      elseif (ereg("^3(0[0-5]|[68][0-9])[0-9]{11}$", $card_no))
         return "Diners Club"; 
      elseif (ereg("^6011[0-9]{12}$", $card_no))
         return "Discover"; 
      elseif (ereg("^(3[0-9]{4}|2131|1800)[0-9]{11}$", $card_no))
         return "JCB";
		else
				return "";
}

function getResponseDescription($responseCode) {

    switch ($responseCode) {
        case "0" : $result = "Transaction Successful"; break;
        case "?" : $result = "Transaction status is unknown"; break;
        case "1" : $result = "Unknown Error"; break;
        case "2" : $result = "Bank Declined Transaction"; break;
        case "3" : $result = "No Reply from Bank"; break;
        case "4" : $result = "Expired Card"; break;
        case "5" : $result = "Insufficient funds"; break;
        case "6" : $result = "Error Communicating with Bank"; break;
        case "7" : $result = "Payment Server System Error"; break;
        case "8" : $result = "Transaction Type Not Supported"; break;
        case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
        case "A" : $result = "Transaction Aborted"; break;
        case "C" : $result = "Transaction Cancelled"; break;
        case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
        case "F" : $result = "3D Secure Authentication failed"; break;
        case "I" : $result = "Card Security Code verification failed"; break;
        case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
        case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
        case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
        case "S" : $result = "Duplicate SessionID (OrderInfo)"; break;
        case "T" : $result = "Address Verification Failed"; break;
        case "U" : $result = "Card Security Code Failed"; break;
        case "V" : $result = "Address Verification and Card Security Code Failed"; break;
        default  : $result = "Unable to be determined"; 
    }
    return $result;
}

//  -----------------------------------------------------------------------------

// This method uses the verRes status code retrieved from the Digital
// Receipt and returns an appropriate description for the QSI Response Code

// @param statusResponse String containing the 3DS Authentication Status Code
// @return String containing the appropriate description

function getStatusDescription($statusResponse) {
    if ($statusResponse == "" || $statusResponse == "No Value Returned") {
        $result = "3DS not supported or there was no 3DS data provided";
    } else {
        switch ($statusResponse) {
            Case "Y"  : $result = "The cardholder was successfully authenticated."; break;
            Case "E"  : $result = "The cardholder is not enrolled."; break;
            Case "N"  : $result = "The cardholder was not verified."; break;
            Case "U"  : $result = "The cardholder's Issuer was unable to authenticate due to some system error at the Issuer."; break;
            Case "F"  : $result = "There was an error in the format of the request from the merchant."; break;
            Case "A"  : $result = "Authentication of your Merchant ID and Password to the ACS Directory Failed."; break;
            Case "D"  : $result = "Error communicating with the Directory Server."; break;
            Case "C"  : $result = "The card type is not supported for authentication."; break;
            Case "S"  : $result = "The signature on the response received from the Issuer could not be validated."; break;
            Case "P"  : $result = "Error parsing input from Issuer."; break;
            Case "I"  : $result = "Internal Payment Server system error."; break;
            default   : $result = "Unable to be determined"; break;
        }
    }
    return $result;
}


//  -----------------------------------------------------------------------------

// This subroutine takes a data String and returns a predefined value if empty
// If data Sting is null, returns string "No Value Returned", else returns input

// @param $in String containing the data String

// @return String containing the output String

function null2unknown($map, $key) {
    if (array_key_exists($key, $map)) {
        if (!is_null($map[$key])) {
            return $map[$key];
        }
    } 
    return "No Value Returned";
} 
    
//  ----------------------------------------------------------------------------

?>