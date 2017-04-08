<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function notification () {

    	return view('payment');
    }

    public function error () {
    	return view('payment_error');
    }

    public function finish () {
    	return view('payment_finish');
    }

    public function unfinish () {
    	return view('payment_unfinish');
    }

    public function token() 
    {
        error_log('masuk ke snap token dari ajax');
        $midtrans = new Midtrans;
        $transaction_details = array(
            'order_id'          => uniqid(),
            'gross_amount'      => 200000
        );
        // Populate items
        $items = [
            array(
                'id'            => 'item1',
                'price'         => 100000,
                'quantity'      => 1,
                'name'          => 'Adidas f50'
            ),
            array(
                'id'            => 'item2',
                'price'         => 50000,
                'quantity'      => 2,
                'name'          => 'Nike N90'
            )
        ];
        // Populate customer's billing address
        $billing_address = array(
            'first_name'        => "Andri",
            'last_name'         => "Setiawan",
            'address'           => "Karet Belakang 15A, Setiabudi.",
            'city'              => "Jakarta",
            'postal_code'       => "51161",
            'phone'             => "081322311801",
            'country_code'      => 'IDN'
            );
        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'        => "John",
            'last_name'         => "Watson",
            'address'           => "Bakerstreet 221B.",
            'city'              => "Jakarta",
            'postal_code'       => "51162",
            'phone'             => "081322311801",
            'country_code'      => 'IDN'
            );
        // Populate customer's Info
        $customer_details = array(
            'first_name'        => "Andri",
            'last_name'         => "Setiawan",
            'email'             => "andrisetiawan@asdasd.com",
            'phone'             => "081322311801",
            'billing_address'   => $billing_address,
            'shipping_address'  => $shipping_address
            );
        // Data yang akan dikirim untuk request redirect_url.
        $transaction_data = array(
            'transaction_details'   => $transaction_details,
            'item_details'          => $items,
            'customer_details'      => $customer_details
        );
    
        try
        {
            $snap_token = $midtrans->getSnapToken($transaction_data);
            //return redirect($vtweb_url);
            echo $snap_token;
        } 
        catch (Exception $e) 
        {   
            return $e->getMessage;
        }
    }
}
