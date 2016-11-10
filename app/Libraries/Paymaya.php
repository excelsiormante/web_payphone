<?php namespace App\Libraries;

use Config, Session;

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
        $name = Session::get('name');

        $ip = $_SERVER['REMOTE_ADDR'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://pg-sandbox.paymaya.com/checkout/v1/checkouts");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"totalAmount\": {
    \"currency\": \"USD\",
    \"value\": \"".$amount."\",
    \"details\": {}
  },
  \"buyer\": {
    \"firstName\": \"Juan\",
    \"middleName\": \"dela\",
    \"lastName\": \"Cruz\",
    \"contact\": {
      \"phone\": \"+63(2)1234567890\",
      \"email\": \"paymayabuyer1@gmail.com\"
    },
    \"shippingAddress\": {},
    \"billingAddress\": {},
    \"ipAddress\": \"".$ip."\"
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
    }
  ],
  \"redirectUrl\": {
    \"success\": \"http://shop.someserver.com/success?id=6319921\",
    \"failure\": \"http://shop.someserver.com/failure?id=6319921\",
    \"cancel\": \"http://shop.someserver.com/cancel?id=6319921\"
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