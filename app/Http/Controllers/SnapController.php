<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Veritrans\Midtrans;

use App\Course;
use App\CourseSchedule;
use App\CourseDetail;
use App\Customer;

class SnapController extends Controller
{
    public function __construct ()
    {   
        Midtrans::$serverKey = 'VT-server-2VeBbUOXLfMXxH04FznIt83J';
        Midtrans::$isProduction = false;
        $this->middleware('auth');
    }

    public function snap ()
    {
        $order_id = session('orders', []);
        $populate = function ($id) {
            $course = Course::find($id);
            $course->detail = CourseDetail::where('ak_course_id', $course->ak_course_id)->first();
            return $course;
        };
        $cart = array_map($populate, $order_id);

        return view('snap_checkout')->with('cart', $cart);
    }

    public function addtocart (Request $request) {
        $orders = session('orders', []);
        $total = session('total', 0);
        $course_id = $request->course_id;

        if(!in_array($course_id, $orders)){
            array_push($orders, $course_id);

            $course = Course::find($course_id);
            $detail = CourseDetail::where('ak_course_id', $course_id)->first();
            $total += $detail->ak_course_detail_price;

            session([
                'orders'   => $orders,
                'total'    => $total
            ]);

            return 'true';
        }

        return 'false';
    }

    public function removefromcart (Request $request) {
        return 'false';
    }

    public function reset () {
        session([
            'orders'   => [],
            'total'    => 0
        ]);

        return redirect('/snap');
    }

    public function token ()
    {
        error_log('masuk ke snap token dari ajax');

        // Populate transaction details
        $transaction_details = [
            'order_id'      => uniqid(),
            'gross_amount'  => session('total', 0)
        ];
        
        // Populate items
        $order_id = session('orders', []);
        $populate = function ($id) {
            $course = Course::find($id);
            $detail = CourseDetail::where('ak_course_id', $course->ak_course_id)->first();
            return [
                'id'       => $id,
                'price'    => $detail->ak_course_detail_price,
                'quantity' => 1,
                'name'     => $course->ak_course_name,
            ];
        };
        $items = array_map($populate, $order_id);

        // Populate customer details
        $customer = Customer::find(session('user_id', 0));
        if($customer){
            $customer_details = [
                'first_name'   => $customer->ak_user_firstname,
                'last_name'    => $customer->ak_user_lastname,
                'email'        => $customer->ak_user_email,
                'phone'        => $customer->ak_user_phone,
            ];
        }else{
            $customer_details = [];
        }

        // Data yang akan dikirim untuk request redirect_url.
        $transaction_data = array(
            'transaction_details'  => $transaction_details,
            'item_details'         => $items,

            'customer_details'     => $customer_details,
       );

        try
        {
            $midtrans = new Midtrans();
            $snap_token = $midtrans->getSnapToken($transaction_data);

            session([
                'saveorder' => session('orders', [])
            ]);

            return $snap_token;
        }
        catch (Exception $e) 
        {   
            return $e->getMessage;
        }
    }

    public function finish(Request $request)
    {
        $result = $request->input('result_data');
        $result = json_decode($result);

        switch ($result->transaction_status) {
            case 'success':
                $result->transaction_status = 1;
                break;
            case 'error':
                $result->transaction_status = 2;
                break;
            case 'pending':
                $result->transaction_status = 3;
                break;
            default:
                $result->transaction_status = 0;
                break;
        }

        $orders = session('saveorder', []);
        $result->courses = json_encode($orders);

        $user = session('user_id', 1);
        $result->user_id = $user;

        TransactionController::save($result);
        $this->reset();

        return view('payment_finish')->with('snap', $result);
    }

    public function unfinish (Request $request)
    {
        dd($request);
    }

    public function error (Request $request)
    {
        dd($request);
    }

    public function notification(Request $request)
    {
        // echo $request;
        // echo '<br />is this successful<br />';
        // $test = file_get_contents('php://input');
        // echo $test;
        // echo '<br />this may be successful<br />';
        // $ttest = json_decode($test);
        // dd($ttest);

        $midtrans = new Midtrans();
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if($result){
            $notif = $midtrans->status($result->order_id);
            echo 'result is an object';
        }
/*
        error_log(print_r($result,TRUE));

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
          // For credit card transaction, we need to check whether transaction is challenge by FDS or not
          if ($type == 'credit_card'){
            if($fraud == 'challenge'){
              // TODO set payment status in merchant's database to 'Challenge by FDS'
              // TODO merchant should decide whether this transaction is authorized or not in MAP
              echo "Transaction order_id: " . $order_id ." is challenged by FDS";
              } 
              else {
              // TODO set payment status in merchant's database to 'Success'
              echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
              }
            }
          }
        else if ($transaction == 'settlement'){
          // TODO set payment status in merchant's database to 'Settlement'
          echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
          } 
          else if($transaction == 'pending'){
          // TODO set payment status in merchant's database to 'Pending'
          echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
          } 
          else if ($transaction == 'deny') {
          // TODO set payment status in merchant's database to 'Denied'
          echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }*/
    }
}    