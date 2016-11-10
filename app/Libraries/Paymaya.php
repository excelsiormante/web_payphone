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
    \"value\": \"6404.90\",
    \"details\": {
      \"discount\": \"300.00\",
      \"serviceCharge\": \"50.00\",
      \"shippingFee\": \"200.00\",
      \"tax\": \"691.60\",
      \"subtotal\": \"5763.30\"
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
      \"name\": \"Canvas Slip Ons\",
      \"code\": \"CVG-096732\",
      \"description\": \"Shoes\",
      \"quantity\": \"3\",
      \"amount\": {
        \"value\": \"1621.10\",
        \"details\": {
          \"discount\": \"100.00\",
          \"subtotal\": \"1721.10\"
        }
      },
      \"totalAmount\": {
        \"value\": \"4863.30\",
        \"details\": {
          \"discount\": \"300.00\",
          \"subtotal\": \"5163.30\"
        }
      }
    },
    {
      \"name\": \"PU Ballerina Flats\",
      \"code\": \"CVR-096RE2\",
      \"description\": \"Shoes\",
      \"quantity\": \"1\",
      \"amount\": {
        \"value\": \"600.00\"
      },
      \"totalAmount\": {
        \"value\": \"600.00\"
      }
    }
  ],
  \"redirectUrl\": {
    \"success\": \"localhost/webpayphone-app/public/payment/success\",
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