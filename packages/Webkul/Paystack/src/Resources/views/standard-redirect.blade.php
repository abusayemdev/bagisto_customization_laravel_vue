<?php $paystackStandard = app('Webkul\Paystack\Payment\Standard'); ?>

<?php
ob_start();
// foreach ($paystackStandard->getFormFields() as $key => $value) {
//     echo $key . " : " . $value . "<br/>";
// }
?>

<body data-gr-c-s-loaded="true" cz-shortcut-listen="true">
    You will be redirected to the Paystack website in a few seconds.
    <?php
    $url = sprintf('https://api.paystack.co/transaction/initialize');
    $allFields = $paystackStandard->getFormFields();
    $fields = $allFields;
    $fields['amount'] = ($fields['grand_total'] - $fields['paystack_charge']) * 100; //convert to naira
    $fields['metadata'] = json_encode($array = ['first_name' => $allFields['first_name'], 'last_name' => $allFields['last_name']]);

    $fields_string = json_encode($fields);
    //open connection
    $ch = curl_init();
    //comment out the test key
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer sk_test_8d5ff7c9b66476531798610a71f7de844af87607',
        'Cache-Control: no-cache',
        'Content-Type: application/json',
    ]);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //execute post
    $response = curl_exec($ch);
    //echo $response;

    $err = curl_error($ch);

    if ($err) {
        // there was an error contacting the Paystack API
        die('Curl returned error: ' . $err);
    }

    $tranx = json_decode($response, true);

    if (!$tranx['status']) {
        // there was an error from the API
        print_r('API returned error: ' . $tranx['message']);
    }

    // comment out this line if you want to redirect the user to the payment page
    //print_r($tranx);
    // redirect to page so User can pay
    // uncomment this line to allow the user redirect to the payment page
    echo $tranx['data']['authorization_url'];
    header('Location: ' . $tranx['data']['authorization_url'], true);
    echo '<script>window.top.location=' . "'" . $tranx['data']['authorization_url'] . "'" . '</script>';

    ?>





</body>