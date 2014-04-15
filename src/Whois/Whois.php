<?php namespace Whois;

use GuzzleHttp\Client as HttpClient;

class Whois
{
    /**
     * URL to query
     *
     * @var string
     */
    protected static $queryUrl = "https://registro.br/cgi-bin/avail/?";
    
    /*
     *
     * @var string
     */
    protected static $refererHeader = "http://registro.br";
    
    /**
     * Curl Http Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;
    
    /*
     *
     */
    protected $queryResponse;
    
    /**
     * @param \GuzzleHttp\Client|null $_client
     * @return void
     */
    public function __construct(HttpClient $_client)
    {
        $this->httpClient = $_client; // Dependency injection
        $this->httpClient->setDefaultOption('headers/Referer', static::$refererHeader);
    }
    
    /*
     *
     */
    public function queryDomain($domain)
    {
        $response = $this->httpClient->get($this->createQueryString($domain));
        $this->queryResponse = new Response(json_decode($response->getBody()));
        return $this->queryResponse;
    }
    
    /*
     *
     */
    public function createQueryString($params)
    {
        $params = is_array($params) ? $params : array('qr' => $params);
        return static::$queryUrl . http_build_query($params);
    }
    
    /*
     *
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }
    
    /*
     *
     */
    public function getResponse()
    {
        return $this->queryResponse;
    }
}