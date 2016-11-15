<?php namespace App\Libraries;

use Config;

class Paymaya
{
  /**
     * cURL get operation.
     *
     * @param $url
     * @param $data
     * @return array
     */
    public static function checkout($amount)
    {
        $fields_string = '';

        /*
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $fields_string[] = $key . '=' . urlencode($value);
            }
        }  */

        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://pg-sandbox.paymaya.com/checkout/v1/checkouts");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"totalAmount\": {
    \"currency\": \"PHP\",
    \"value\": \"".$amount."\",
    \"details\": {
      \"discount\": \"0.00\",
      \"serviceCharge\": \"0.00\",
      \"shippingFee\": \"0.00\",
      \"tax\": \"0.00\",
      \"subtotal\": \"".$amount."\"
    }
  },
  \"buyer\": {
    \"firstName\": \"Juan\",
    \"middleName\": \"dela\",
    \"lastName\": \"Cruz\",
    \"contact\": {
      \"phone\": \"+63(2)1234567890\",
      \"email\": \"paymayabuyer1@gmail.com\"
    },
    
    \"ipAddress\": \"125.60.148.241\"
  },
  \"items\": [
    {
      \"name\": \"E-Wallet\",
      \"code\": \"ELOAD-012345\",
      \"description\": \"E-Wallet load\",
      \"quantity\": \"1\",
      \"amount\": {
        \"value\": \"".$amount."\",
        \"details\": {
          \"discount\": \"0.00\",
          \"subtotal\": \"".$amount."\"
        }
      },
      \"totalAmount\": {
        \"value\": \"".$amount."\",
        \"details\": {
          \"discount\": \"0.00\",
          \"subtotal\": \"".$amount."\"
        }
      }
    }
  ],
  \"redirectUrl\": {
    \"success\": \"localhost/webpayphone-app/public\",
    \"failure\": \"localhost/webpayphone-app/public\",
    \"cancel\": \"localhost/webpayphone-app/public\"
  },
  \"requestReferenceNumber\": \"000141386713\",
  \"metadata\": {}
}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/json",
          "Authorization: Basic cGstOHJPejRNUUtSeGQ1T0xLQlBjUjZGSVV4NEtheTcxa0IzVXJCRkRhSDE3Mjo="
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response,true);
      
    }

} 