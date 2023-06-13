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
     * set header to http client
     * @param array $headers
     * @return self
     */
    public function withHeaders(array $headers): self
    {
        $this->http->withHeaders($headers);
        return $this;
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

    /**
     * get http client
     * @param string $url
     * @param string|null $query
     * @return Response
     */
    public function get(string $url, string|null $query): Response
    {
        return $this->http->get($url, $query);
    }
}