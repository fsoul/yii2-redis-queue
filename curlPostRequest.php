<?php

for ($i = 0; $i < 404; $i++) {

    //API URL
    $url = 'http://backend.test/person/create';


    $ch = curl_init($url);

    $data = array(
        'firstName' => 'firstName',
        'lastName' => 'lastName' . $i,
        'phoneNumbers' => array(
            '344 68-' . rand(10, 99),
            '344 67-' . rand(10, 99)
        )
    );
    $payload = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    var_dump($result);
    curl_close($ch);

}