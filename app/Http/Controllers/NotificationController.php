<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\CourseDetail;
class NotificationController extends Controller
{

	public function notify(Request $request)
    {
        $result = file_get_contents('php://input');
        $result = json_decode($result);

        if($result === null){
          dd($request);
        }

        switch ($result->transaction_status) {
            case 'capture':
                $result->transaction_status = 1;
                break;
            case 'deny':
                $result->transaction_status = 2;
                break;
            case 'pending': case 'settlement':
                $result->transaction_status = 3;
                break;
            default:
                $result->transaction_status = 0;
                break;
        }
        if($transaction_status === 1){
            $tran = Transaction::where('ak_tran_saction_midtrans_id' , '=', $result->transaction_id)->get();
            foreach($tran as $i){
              $course = CourseDetail::where('ak_course_id', '=', $i->ak_tran_saction_user)->first();
              if($course->ak_course_detail_seat > 0){
                $course->ak_course_detail_seat = $course->ak_course_detail_seat - 1;
              }
              $course->save();
            }
        }

        Transaction::where('ak_tran_saction_midtrans_id', '=', $result->transaction_id)
                  ->update(['ak_tran_saction_status' => $result->transaction_status]);

        // $name = "notification ".date("d M Y / H:m:s");
        // $maincat = new MainCategory();
        // $maincat->ak_maincat_name = $name;
        // $maincat->save();

        dd($request);
/*
        $midtrans = new Midtrans();
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if($result){
            $notif = $midtrans->status($result->order_id);
            echo 'result is an object';
        }

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
