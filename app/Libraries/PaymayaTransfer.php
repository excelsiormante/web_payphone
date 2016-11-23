<?php

namespace App\Libraries;

use Config;

class PaymayaTransfer
{

   /**
     * cURL get operation.
     *
     * @param $url
     * @param $data
     * @return array
     */


  public static function CreateTransfer()
  {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.paymaya.com/sandbox/mi3/transfers");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    curl_setopt($ch, CURLOPT_POSTFIELDS, "{
      \"sender\": {
        \"type\": \"PAYMAYA\",
        \"value\": \"+639420189395\"
      },
      \"recipient\": {
        \"type\": \"PAYMAYA\",
        \"value\": \"+639420189396\"
      },
      \"amount\": {
        \"currency\": \"PHP\",
        \"value\": 100
      },
      \"note\": \"Thanks!\"
    }");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
      "Request-Reference-No: 668A5050-3164-4CD4-A646-4EEF4B19AF17",
      "Authorization: Basic c2stVUdQa3dIM3lPeFlxRWlBMFdvekt1WUNqVDQ0M1VVTlBLelNyVmR5aFFGQzo=",
      "efs-product-id: PYMY"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response,true);


  }

  public static function ExecuteTransfer($transferId)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paymaya.com/sandbox/mi3/transfers/".$transferId."/execute");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Request-Reference-No: 668A5050-3164-4CD4-A646-4EEF4B19AF17",
      "Authorization: Basic c2stWHN6SWR3Z255MERjY0NGejRqa0J3RlFnM05SMHBNeGFYZHZFbm96NGVxTjo="
    ));

    $executeresponse = curl_exec($ch);
    curl_close($ch);

    dd($executeresponse);
  }


}
