<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
      return view('user.index');
    }
    public function order()
    {
      $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
      return view('user.orders',compact('orders'));
    }

    public function order_detail($order_id)
    { 
        $order = Order::where('user_id',Auth::user()->id)->where('id',$order_id)->first();
        if($order)
         {
           $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
           $transaction = Transaction::where('order_id', $order->id)->first();
           return view('user.order_details',compact('order', 'transaction','orderItem'));
         }
        else
          {
              return redirect()->route('login');
          }

    }

    public function order_cancel(Request $request)
    {
      $order = Order::find($request->order_id);
      $order->status = 'canceled';
      $order->canceled_date = Carbon::now();
      $order->save();
      return back()->with('status', 'Order has been canceled successfully');

    }
}
