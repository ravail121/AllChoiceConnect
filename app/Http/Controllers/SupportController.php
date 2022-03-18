<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Api\ApiResponse;
use Exception;

class SupportController extends Controller
{
    public function index()
    {
        $data = $this->requestConnection('support');
        return view('support.index', compact('data'));
    }

    public function sendEmail(Request $request)
    {
        $data = $request->validate(
            [
                'name'      => 'required|string',
                'email'     => 'required|email',
                'subject'   => 'required|string',
                'message'   => 'required|string'
            ]
        );
        try {
            $this->requestConnection('support/email', 'post', $data);
        } catch (Exception $e) {
            \Log::info($e->getMessage());
            return redirect()->back()->with('error', 'Server problem, please try again later.');
        }

        return redirect()->back()->with(['notification' =>
            [
                'status'  => 'success',
                'message' => 'Your message has been sent to support',
            ]
        ]);
    }
}
