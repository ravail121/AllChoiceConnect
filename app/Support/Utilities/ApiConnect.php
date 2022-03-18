<?php

namespace App\Support\Utilities;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait ApiConnect
{

    /**
     * Runs Api
     *
     * @param  string       $url          Url of the api
     * @param  string       $type         GET, POST, PUT, PATCH
     * @param  array        $parameters   form-data, parameters
     * @return Collection
     */
    public function requestConnection($url = null, $type = "get", $parameters = null)
    {
        $client = $this->getClientInstance();
        try {
            if ($type == 'get') {

                $response = $client->get(env('API_BASE_URL').'/'.$url, [
                    'query' => $parameters,
                    'allow_redirects' => [
                        'max' => 10,
                    ],
                ]);

            } elseif ($type == 'put') {
                $response = $client->put(env('API_BASE_URL').'/'.$url, [
                    'form_params' => $parameters,
                ]);

            } elseif ($type == 'post') {
                $response = $client->post(env('API_BASE_URL').'/'.$url, [
                    'form_params' => $parameters,
                ]);

            } elseif ($type == 'postWithFile') {

                $response = $client->post(env('API_BASE_URL').'/'.$url, [
                    'multipart' => $parameters,
                ]);

            } elseif ($type == 'patch') {
                $response = $client->patch(env('API_BASE_URL').'/'.$url);

            }

            $status = $response->getStatusCode();
            if ($status == 200) {
                return collect(json_decode($response->getBody(), true));
            } else {
                throw new \Exception('Failed');
            }

        }  catch (Exception $exception) {
            \Log::info($exception->getMessage());
            return $exception->getMessage();
        }

    }

    /**
     * Sets parameters with session data by default
     *
     * @param  string   $url
     * @param  string   $type
     * @param  array    $parameters
     * @return Function
     */
    public function requestConnectionForCustomer($url = null, $type = "get", $parameters = null)
    {
        $parameters['hash'] = session('customer_hash');
        $parameters['id']   = session('id');

        return $this->requestConnection($url, $type, $parameters);
    }

    public function requestToolConnection($url = null, $type = "get", $parameters = null, $rawResponse = false)
    {
        $client = $this->getClientInstance();
        try {
            if ($type == 'get') {
                $response = $client->get(env('API_TOOL_URL').'/'.$url, [
                    'query' => $parameters,
                    'timeout' => 2.0,
                    'checkout_timeout' => 2.0
                ]);

            } elseif ($type == 'post') {
                $response = $client->post(env('API_TOOL_URL') . '/' . $url, [
                    'form_params' => $parameters,
                    'timeout' => 2.0,
                    'checkout_timeout' => 2.0
                ]);
            }

            $status = $response->getStatusCode();
            if ($status == 200) {
                return $rawResponse ? $response->getBody() :collect(json_decode($response->getBody(), true));
            } else {
                return 'Failed';
            }
        } catch (GuzzleException $exception) {
            if ($exception->hasResponse()) {
                \Log::info($exception->getMessage());
                return "Failed";
            }
            return "Failed";
        } catch (Exception $exception) {
            \Log::info($exception->getMessage());
            return "Failed";
        }

    }

    /**
     * Connect with Ultra Mobile Portal
     * @param null   $url
     * @param string $type
     * @param null   $parameters
     * @param false  $rawResponse
     *
     * @return \Illuminate\Support\Collection|\Psr\Http\Message\StreamInterface|string
     */
    public function requestUltraMobileConnection(
        $url=null,
        $type='get',
        $parameters=null,
        $rawResponse=false)
    {
        $client = $this->getUltraMobileClientInstance();
        try {
            if ($type === 'get') {
                $response = $client->get(config('internal.__TELTIK_ULTRA_MOBILE_URL') . '/' . $url, [
                    'query'             => $parameters,
                    'timeout'           => 2.0,
                    'checkout_timeout'  => 2.0
                ]);

            } elseif ($type === 'post') {
                $response = $client->post(config('internal.__TELTIK_ULTRA_MOBILE_URL') . '/' . $url, [
                    'form_params'       => $parameters,
                    'timeout'           => 2.0,
                    'checkout_timeout'  => 2.0
                ]);
            }

            $status = $response->getStatusCode();
            if ($status === 200) {
                return $rawResponse ? $response->getBody() : collect(json_decode($response->getBody(), true));
            } else {
                return 'Failed';
            }
        } catch (GuzzleException $exception) {
            if ($exception->hasResponse()) {
                \Log::info($exception->getMessage());
                return "Failed";
            }
            return "Failed";
        } catch (Exception $exception) {
            \Log::info($exception->getMessage());
            return "Failed";
        }

    }

    /**
     * Sets header and instantiates Client
     *
     * @return Client  $object
     */
    protected function getClientInstance()
    {
        $headers = [
            'Content-Type'  => 'application/json',
            'AccessToken'   => 'key',
            'Authorization' => env('API_KEY'),
        ];

        $object = new Client([
            'headers' => $headers
        ]);
        return $object;
    }

    /**
     * @return Client
     */
    protected function getUltraMobileClientInstance()
    {
        $headers = [
            'Content-Type'  => 'application/json'
        ];

        return new Client([
            'headers' => $headers
        ]);
    }
}
