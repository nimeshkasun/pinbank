<?php
function convertCurrency($amount,$from_currency,$to_currency){
//============================================================ 01 ===================================================================== 
  //https://free.currencyconverterapi.com
  /*$apikey = '71ed68752a6602bfe293';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  // change to the free URL if you're using the free version
  $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=$query&compact=ultra&apiKey=$apikey");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;

  if($total!=NULL){
    return number_format($total, 2, '.', '');
  }else{
    return "API Error";
  }
  

*/

//============================================================ 02 =====================================================================
//https://openexchangerates.org/account/app-ids
//https://openexchangerates.org/api/currencies.json
/*$to_Currency = urlencode($to_currency);

$app_id = '93c06353536e45f8a17fe679d9eb3881';
$oxr_url = "https://openexchangerates.org/api/latest.json?app_id=".$app_id."&symbols=".$to_Currency."";

// Open CURL session:
$ch = curl_init($oxr_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Get the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$oxr_latest = json_decode($json);
$rate = $oxr_latest->rates->$to_Currency;

if($rate!=NULL){
  return number_format($rate, 2, '.', '');
}else{
  return "API Error";
}
*/

return "API Commented";

}



?>