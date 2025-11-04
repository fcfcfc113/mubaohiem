<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrdersrController extends Controller
{
    const Rate_SHIPPING_DISCOUNT = 150000; // Đơn hàng từ 150K sẽ được miễn phí vận chuyển
    const BANK_DISCOUNT_RATE = 0.15;   // Giảm 15% khi thanh toán qua ngân hàng
    public function prepare(Request $request)
    {
        $requestedData = $request->all();
        $shippingArr = $requestedData['shipping'] ?? [];
        $cartArr = $requestedData['cart'] ?? [];
        $coupon = $requestedData['coupon'] ?? null; // SALE15KN
        $clientTotals = $requestedData['client_totals'] ?? [];
        $payment_method = $requestedData['payment_method'] ?? 'cod';
        // Implement order preparation logic here
        // step 1: check customer exists or create new
        $email = $shippingArr['email'] ?? null;
        $phone = $shippingArr['phone'] ?? null;

        $customerChecked = null;

        if ($email) {
            $customerChecked = Customer::where('email', $email)->first();
        }

        if (!$customerChecked && $phone) {
            $customerChecked = Customer::where('phone', $phone)->first();
        }

        if (!$customerChecked) {
            $customerChecked = Customer::create([
                'name' => $shippingArr['full_name'] ?? 'Khách hàng',
                'email' => $email,
                'phone' => $phone,
                'address' => $shippingArr['address'] ?? '',
                'province' => $shippingArr['province'] ?? '',
                'district' => $shippingArr['district'] ?? '',
            ]);
        }
        $customerId = $customerChecked->id;
        // step 2: create order from cart
        $order = new Order();
        $order->customer_id = $customerId;

        // Calculate totals
        $subtotal = 0;
        foreach ($cartArr as $item) {
            $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 0);
        }
        $order->subtotal = $subtotal;
        // Shipping Fee
        $order->shipping_fee = ($subtotal >= self::Rate_SHIPPING_DISCOUNT) ? 0 : self::Rate_SHIPPING_DISCOUNT;
        // Bank Discount
        $order->bank_discount = ($payment_method === 'bank') ? round($subtotal * self::BANK_DISCOUNT_RATE) : 0;
        // Other Discount (Coupon)
        $order->other_discount = 0;
        if ($coupon) {
            $couponArr = $this->constCoupon()[$coupon] ?? null;
            if ($couponArr && is_array($couponArr)) {
                $kind = $couponArr['kind'] ?? '';
                $value = $couponArr['value'] ?? 0;
                $min = $couponArr['min'] ?? 0;
                if ($subtotal >= $min) {
                    if ($kind === 'amount') {
                        $order->other_discount = $value;
                    } elseif ($kind === 'ship') {
                        $order->other_discount = $order->shipping_fee;
                    }
                }
            }
        }
        // Total
        $order->total = $subtotal + $order->shipping_fee - $order->bank_discount - $order->other_discount;
        $order->status = 'pending';
        $order->address = $shippingArr['address'] ?? '';
        $order->province = $shippingArr['province'] ?? '';
        $order->district = $shippingArr['district'] ?? '';
        $order->note = $shippingArr['note'] ?? '';
        $order->payment_method = $payment_method;
        $order->code = 'ORD' . strtoupper(uniqid());
        $order->coupon_id = $coupon ? ($couponArr['code'] ?? null) : null;
        $order->save();
        // step 3: create order items
        foreach ($cartArr as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_name = $item['name'] ?? '';
            $orderItem->variant = $item['variant'] ?? '';
            $orderItem->product_id = $item['id'] ?? null;
            $orderItem->qty = $item['qty'] ?? 0;
            $orderItem->price = $item['price'] ?? 0;
            $orderItem->save();
        }
        // return full info to client
        $dataResult = [
            'order_id' => $order->id,
            'order_code' => $order->code,
            'totals' => [
                'subtotal' => $order->subtotal,
                'shipping_fee' => $order->shipping_fee,
                'bank_discount' => $order->bank_discount,
                'other_discount' => $order->other_discount,
                'total' => $order->total,
            ],
        ];
        $vietQrPayment = 'https://api.vietqr.io/image/970436-0531002589088-scxmG3n.jpg?accountName=VU%20THANH%20DAT&amount=' . $order->total . '&content=' . $order->code;
        if ($payment_method === 'bank') {
            $dataResult['qr_code'] = $vietQrPayment;
        }else{
            $dataResult['qr_code'] = null;
        }

        return response()->json([
            'ok' => true,
            'data' => $dataResult
        ]);
    }

    private function constCoupon(){
        $coupons = [
            'SALE15KN' =>  [ 'kind'=>'amount', 'value'=>30000, 'min'=>399000, 'label'=>'Giảm 30K đơn từ 399K' ],
            'SALE30KN' =>  [ 'kind'=>'amount', 'value'=>80000, 'min'=>699000, 'label'=>'Giảm 80K đơn từ 699K' ],
            'GG60KN'   =>  [ 'kind'=>'amount', 'value'=>100000, 'min'=>999000, 'label'=>'Giảm 100K đơn từ 999K' ],
            'FREESHIP10'=> [ 'kind'=>'ship',   'value'=>0,     'min'=>150000, 'label'=>'Miễn phí vận chuyển từ 150K' ]
        ];
        return $coupons;
    }
}
