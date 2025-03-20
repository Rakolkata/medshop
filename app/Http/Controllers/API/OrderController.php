<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_User_Profile;
use App\Models\Order_details;
use App\Models\User;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // You can define additional logic for listing orders if needed.
        return response()->json([
            'message' => 'Orders endpoint accessed',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/orders/store",
     *     summary="Create a new order",
     *     description="Create a new order with customer details and products. Requires bearer token authentication. Only users with admin access can create orders.",
     *     tags={"Orders"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="coustomer_email", type="string", format="email", example="customer@example.com"),
     *             @OA\Property(property="coustomer_name", type="string", example="John Doe"),
     *             @OA\Property(property="coustomer_phone", type="string", example="9876543210"),
     *             @OA\Property(property="customer_address", type="string", example="123 Street Name, City"),
     *             @OA\Property(property="doc_name_regdno", type="string", example="Dr. Smith - ABC123"),
     *             @OA\Property(property="grand_total", type="number", format="float", example=500.75),
     *             @OA\Property(property="total_gst", type="number", format="float", example=50.00),
     *             @OA\Property(property="total_discount", type="number", format="float", example=10.00),
     *             @OA\Property(property="round_off", type="number", format="float", example=0.25),
     *             @OA\Property(property="title", type="array", @OA\Items(type="string", example="Product A")),
     *             @OA\Property(property="id", type="array", @OA\Items(type="integer", example=1)),
     *             @OA\Property(property="rate", type="array", @OA\Items(type="number", format="float", example=100.00)),
     *             @OA\Property(property="qty", type="array", @OA\Items(type="integer", example=2)),
     *             @OA\Property(property="gst", type="array", @OA\Items(type="number", format="float", example=5.00)),
     *             @OA\Property(property="total", type="array", @OA\Items(type="number", format="float", example=200.00))
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Order created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Order created successfully"),
     *             @OA\Property(property="orderID", type="string", example="M12302024")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized! Admin access only.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized! Admin access only.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized! Invalid or missing bearer token.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized! Invalid or missing bearer token.")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         required=true,
     *         description="Bearer token for authentication (e.g., 'Bearer <token>')",
     *         @OA\Schema(type="string", example="Bearer eyJhbGciOiJIUzI1NiIsInR5...")
     *     )
     * )
    */

    public function store(Request $req)
    {
        $user_find = User::where('email', $req['coustomer_email'])->first();
        $user_id = '';

        if (!$user_find) {
            $register = new RegisterController;
            $register->create([
                'name' => $req['coustomer_name'],
                'email' => $req['coustomer_email'],
                'type' => null,
                'password' => '12345678',
            ]);
            $reg_id = User::where('email', $req['coustomer_email'])->first();
            $user_id = $reg_id->id;
        } else {
            $user_id = $user_find->id;
        }

        $orderUserProfile = new Order_User_Profile;
        $orderUserProfile->phone = $req['coustomer_phone'];
        $orderUserProfile->Address = $req['customer_address'];
        $orderUserProfile->Doc_Name_RegdNo = $req['doc_name_regdno'];
        $orderUserProfile->User_id = $user_id;
        $orderUserProfile->save();

        $last_id = $orderUserProfile->id;

        $order = new Order;
        $order->Profile_id = $last_id;
        $order->Total_Order = $req['grand_total'];
        $order->Total_Gst = $req['total_gst'];
        $order->Discount = $req['total_discount'];
        $order->Adjustment = $req['round_off'];
        $order->orderID = "";
        $order->save();

        $order_last_id = $order->id;
        $dt = substr(env('APP_NAME'), 0, 1) . date("dmY") . $order_last_id;
        $order->orderID = $dt;
        $order->save();

        $prod_name = $req['title'];
        $prod_id = $req['id'];
        $prod_rate = $req['rate'];
        $prod_qty = $req['qty'];
        $prod_gst = $req['gst'];
        $prod_price = $req['total'];

        foreach ($prod_name as $index => $value) {
            $order_details = new Order_details;
            $order_details->Order_id = $order_last_id;
            $order_details->Product_id = $prod_id[$index];
            $order_details->rate = $prod_rate[$index];
            $order_details->qty = $prod_qty[$index];
            $order_details->gst = $prod_gst[$index];
            $order_details->Product_price = $prod_price[$index];
            $order_details->save();

            // Update product stock
            $product = Product::find($order_details->Product_id);
            $product->Stock -= $order_details->qty;
            $product->save();
        }

        return response()->json([
            'message' => 'Order created successfully',
            'orderID' => $dt,
        ], 201);
    }

    public function order_details($Order_id)
    {
        $order_details = Order_details::where('Order_id', $Order_id)
            ->with('products')
            ->get();

        return response()->json($order_details);
    }
}