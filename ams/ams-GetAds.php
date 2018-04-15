<?php


function GetWorkList($arrData) {
    $arrLanKod = array('SE-K' => 10, 'SE-W' => 20, 'SE-I' => 9, 'SE-X' => 21, 'SE-N' => 13, 'SE-Z' => 23, 'SE-F' => 6, 'SE-H' => 8, 'SE-G' => 7, 'SE-BD' => 25, 'SE-M' => 12, 'SE-AB' => 1, 'SE-D' => 4, 'SE-C' => 3, 'SE-S' => 17, 'SE-AC' => 24, 'SE-Y' => 22, 'SE-U' => 19, 'SE-O' => 14,'SE-T' => 18, 'SE-E' => 5);
    $arrData['lanid'] = $arrLanKod[$arrData['lanid']];
    $method = '';
    $url = 'http://api.arbetsformedlingen.se/af/v0/platsannonser/matchning';
    $result = CurlAPI($method, $url, $arrData);
    $arrWork = array();
    
    $arrWorkList = $result['matchningslista']['matchningdata'];
    foreach($arrWorkList as $value) {
        $arrWorkTemp = GetWork($value['annonsid']);

        $arrTemp = array();
        $arrTemp['annonsid'] = $arrWorkTemp['platsannons']['annons']['annonsid'];
        $arrTemp['platsannonsUrl'] = $arrWorkTemp['platsannons']['annons']['platsannonsUrl'];
        $arrTemp['annonsrubrik'] = $arrWorkTemp['platsannons']['annons']['annonsrubrik'];
        $arrTemp['annonstext'] = substr($arrWorkTemp['platsannons']['annons']['annonstext'] ,0 ,200);
        $arrTemp['kommunnamn'] = $arrWorkTemp['platsannons']['annons']['kommunnamn'];
        $arrTemp['arbetstid'] = $arrWorkTemp['platsannons']['villkor']['arbetstid'];
        $arrWork[] = $arrTemp;
    }

    return $arrWork;
}

function GetWork($strData) {
    $method = '';
    $arrData = false;
    $url = 'http://api.arbetsformedlingen.se/af/v0/platsannonser/'.$strData;

    $result = CurlAPI($method, $url, $arrData);

    return $result;
}


function CurlAPI($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'charset: utf-8',
        'Accept-Language: sv-SE',
        'qs: 1'
    ));

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result, true);
}


?>
