<?php

function GetLan() {
    $method = '';
    $url = 'http://api.arbetsformedlingen.se/af/v0/arbetsformedling/soklista/lan';
    $data = false;
    $result = CurlAPI($method, $url, $data);
    //echo '<pre>';var_dump($result);echo '</pre>';exit;
    $Lan = $result['soklista']['sokdata'];
    echo '<script type="javscript/text">';
    echo 'var gdpData = {';
    foreach($Lan as $value) {
        echo 'SE-O: '.$value['id'].', ';
    }
    echo '};';
    echo '</script>';
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
    // Optional Authentication:
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result, true);
}

?>
