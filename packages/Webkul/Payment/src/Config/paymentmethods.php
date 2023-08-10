<?php
return [
    'cashondelivery'  => [
        'code'        => 'cashondelivery',
        'title'       => 'Cash On Delivery',
        'description' => 'Cash On Delivery',
        'class'       => 'Webkul\Payment\Payment\CashOnDelivery',
        'active'      => true,
        'sort'        => 1,
    ],

    'moneytransfer'   => [
        'code'        => 'moneytransfer',
        'title'       => 'Money Transfer',
        'description' => 'Money Transfer',
        'class'       => 'Webkul\Payment\Payment\MoneyTransfer',
        'active'      => true,
        'sort'        => 2,
    ],

    'paystack_standard' => [
        'code'             => 'paystack_standard',
        'title'            => 'Paystack Standard',
        'description'      => 'Paystack Standard',
        'class'            => 'Webkul\Paystack\Payment\Standard',
        'sandbox'          => true,
        'active'           => true,
        'business_account' => 'bdsemart@gmail.com',
        'sort'             => 3,
    ],
];