<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\HttpResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use HttpResponseTrait;

    /** resource stoere */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $order = new Order();
            $order->name = $request->name;
            $order->user_id = Auth::id();
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->note = $request->note;
            $order->location = $request->location;
            $order->save();

            foreach ($request->carts as $item) {
                DB::table('carts')->insert([
                    'product_id' => $item['product_id'],
                    'qty'        => $item['qty'],
                    'order_id' => $order->order_id,
                ]);
            }
            DB::commit();

            return $this->HttpSuccessResponse("Product list", "Order Successfully Done...", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->HttpErrorResponse(array($e), 500);
        }
    }
}
