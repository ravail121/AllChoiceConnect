<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cart;


    /**
     * This function removes the order-group and updates the sessions
     *
     * @param  int        $id
     * @return Response
     */
    public function removeItem($id)
    {
        $this->getDeviceName($id);
        $response = $this->requestConnection('order/remove?order_hash='.session('hash')['order_hash'].'&order_group_id='.$id.'&paid_monthly_invoice='.session('paid_monthly_invoice'), 'patch');

        $this->updateSession();

        return $this->successRedirect('devices', 'The <span style="color: #1ba4d6;">'.session('deleted_item').'</span> was removed successfully.');
    }

    public function editItem($id)
    {
        return $id;
    }

    protected function updateSession()
    {
        $this->cart = $this->requestConnection('order?order_hash='.session('hash')['order_hash'].'&paid_monthly_invoice='.session('paid_monthly_invoice'));
        session(['cart' => $this->cart]);
        return true;
    }


    /**
     * This function updates only the session('cart')
     *
     * @param  int        $id
     * @return boolean
     */
    protected function getDeviceName($id)
    {
        $this->cart = session('cart') ?: [];

        if (isset($this->cart['order_groups']) && count($this->cart['order_groups'])) {


            foreach ($this->cart['order_groups'] as $cart) {
                if ($cart['device'] != null) {
                    if ($cart['id'] == $id) {
                        session(['deleted_item' => $cart['device']['name']]);
                    }

                } elseif ($cart['plan'] != null) {
                    if ($cart['id'] == $id) {
                        session(['deleted_item' => $cart['plan']['name']]);
                    }
                } else {
                    session(['deleted_item' => 'Device/Plan']);

                }
            }
        }

        return true;
    }

    public function editSim(Request $request)
    {
        $newSimNumber   = $request->simNewNumber;

        return $this->requestConnection('order-group/edit', 'post', [
            'newSimNumber'  => $newSimNumber,
            'orderGroupId'  => $request->orderGroupId
        ]);

    }

    public function clearOrder()
    {
        session()->forget(['cart', 'hash', 'couponAmount', 'couponCodes', 'changePlanStatus', 'taxrate', 'new_customer', 'total_price']);
        return redirect('devices')->with(['notification' => [
            'status'  => 'success',
            'message' => 'Your cart has been cleared.',
        ]]);
    }

}
