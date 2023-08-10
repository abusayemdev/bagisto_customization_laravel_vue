<?php

namespace Webkul\Paystack\Payment;

use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;

class Standard extends Paystack
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'paystack_standard';

    /**
     * Line items fields mapping
     *
     * @var array
     */
    protected $itemFieldsFormat = [
        'id'       => 'item_number_%d',
        'name'     => 'item_name_%d',
        'quantity' => 'quantity_%d',
        'price'    => 'amount_%d',
    ];
    protected $secretKey;

    /**
     * Instance of Client
     * @var Client
     */
    protected $client;

    /**
     *  Response from requests made to Paystack
     * @var mixed
     */
    protected $response;

    /**
     * Paystack API base Url
     * @var string
     */
    protected $baseUrl;

    /**
     * Authorization Url - Paystack payment page
     * @var string
     */
    protected $authorizationUrl;

    public function __construct()
    {
        $this->setKey();
        $this->setBaseUrl();
        $this->setRequestOptions();
    }

    /**
     * Get Base Url from Paystack config file
     */
    public function setBaseUrl()
    {
        $this->baseUrl = 'https://api.paystack.co/transaction/initialize';
    }

    /**
     * Get secret key from Paystack config file
     */
    public function setKey()
    {
        $this->secretKey = 'sk_test_8d5ff7c9b66476531798610a71f7de844af87607';

    }

    /**
     * Set options for making the Client request
     */
    private function setRequestOptions()
    {
        $authBearer = 'Bearer ' . $this->secretKey;

        $this->client = new Client(
            [
                'base_uri' => $this->baseUrl,
                'headers' => [
                    'Authorization' => $authBearer,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ]
            ]
        );
    }
    /**
     * Return paystack redirect url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return route('paystack.standard.redirect');
    }
    /**
     * Generate a Unique Transaction Reference
     * @return string
     */
    public function genTranxRef()
    {
        return TransRef::getHashedToken();
    }

    /**
     * Return form field array
     *
     * @return array
     */
    public function getFormFields()
    {
        $cart = $this->getCart();

        $fields = [
            "email" => $this->getConfigData('business_account'),
            "orderID" => $cart->id,
            "amount" => $cart->sub_total,
            "quantity" => 1,
            "currency" => "NGN",
            "reference" => $this->genTranxRef(),
            'business'        => $this->getConfigData('business_account'),
            'invoice'         => $cart->id,
            'currency_code'   => $cart->cart_currency_code,
            'paymentaction'   => 'sale',
            'callback_url' => route('paystack.standard.verify'),
            'return'          => route('paystack.standard.success'),
            'cancel_return'   => route('paystack.standard.cancel'),
            'notify_url'      => route('paystack.standard.ipn'),
            'charset'         => 'utf-8',
            'item_name'       => core()->getCurrentChannel()->name,
            'amount'          => $cart->sub_total,
            'tax'             => $cart->tax_total,
            'shipping'        => $cart->selected_shipping_rate ? $cart->selected_shipping_rate->price : 0,
            'discount_amount' => $cart->discount_amount,
            'grand_total'  => $cart->grand_total
        ];

        $paystack_charge = session()->get('paystack_charge');

        if (isset($paystack_charge)) {
            $fields['paystack_charge'] = $paystack_charge;
        }else {
            $fields['paystack_charge'] = 0;
        }

        if ($this->getIsLineItemsEnabled()) {
            $fields = array_merge($fields, array(
                'cmd'    => '_cart',
                'upload' => 1,
            ));

            $this->addLineItemsFields($fields);

            if ($cart->selected_shipping_rate)
                $this->addShippingAsLineItems($fields, $cart->items()->count() + 1);

            if (isset($fields['tax'])) {
                $fields['tax_cart'] = $fields['tax'];
            }

            if (isset($fields['discount_amount'])) {
                $fields['discount_amount_cart'] = $fields['discount_amount'];
            }
        } else {
            $fields = array_merge($fields, array(
                'cmd'           => '_ext-enter',
                'redirect_cmd'  => '_xclick',
            ));
        }

        $this->addAddressFields($fields);

        return $fields;
    }

    /**
     * Add shipping as item
     *
     * @param  array  $fields
     * @param  int    $i
     * @return void
     */
    protected function addShippingAsLineItems(&$fields, $i)
    {
        $cart = $this->getCart();

        $fields[sprintf('item_number_%d', $i)] = $cart->selected_shipping_rate->carrier_title;
        $fields[sprintf('item_name_%d', $i)] = 'Shipping';
        $fields[sprintf('quantity_%d', $i)] = 1;
        $fields[sprintf('amount_%d', $i)] = $cart->selected_shipping_rate->price;
    }
}