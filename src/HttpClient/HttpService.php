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
}