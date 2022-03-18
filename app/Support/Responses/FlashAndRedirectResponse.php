<?php

namespace App\Support\Responses;

trait FlashAndRedirectResponse {

    /**
     * Redirect user to url and save response in session
     * @param  string $status  success || fail
     * @param  array $content data or errors
     * @param  string $message Message Detail
     * @param  string $error Error
     * @return array
     */
    protected function generateRedirect($status, $url, $message = null, $content = null, $errorCode = null)
    {
        $r = compact('status');
        $key = $status == 'success' ? 'data' : 'errors';
        if($content) $r[$key] = $content;
        if($message) $r += compact('message');
        if($errorCode) $r['error_code'] = $errorCode;
        return redirect($url)->with('notification', $r);
        // return $httpCode ? response()->json($r, $httpCode) : response()->json($r);
    }

    /**
     * Generate Success Response
     * @param  array  $data
     * @param  string $message
     * @return array
     */
    protected function successRedirect($url, $message=null, $data=null)
    {
        // if(!$httpCode) $httpCode = 200;
        return $this->generateRedirect('success', $url, $message, $data, null);
    }

    /**
     * Generate Fail Response
     * @param  array  $data
     * @param  string $message
     * @return array
     */
    protected function failRedirect($url, $message=null, $errors=null, $errorCode = null)
    {
        // if(!$httpCode) $httpCode = 401;
        return $this->generateRedirect('fail', $url, $message, $errors, $errorCode);
    }
}