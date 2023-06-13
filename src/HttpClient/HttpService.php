<?php

namespace D3cr33\Communication\HttpClient;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

final class HttpService
{
    /**
     * store http client
     * @var Http
     */
    private Http $http;

    public function __construct()
    {
        $this->http = new Http();   
    }

    /**
     * post http client
     * @param string $url
     * @param array $data
     * @return Response
     */
    public function post(string $url, array $data): Response
    {
        return $this->http->post($url, $data);
    }
}