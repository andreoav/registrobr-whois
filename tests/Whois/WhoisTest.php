<?php namespace Whois;

use PHPUnit_Framework_TestCase as TestCase;

class WhoisTest extends TestCase
{
    public function __construct()
    {
        $this->whois = new Whois(new \GuzzleHttp\Client);
    }
    
    public function testGuzzleInstance()
    {
        $this->assertAttributeInstanceOf('\GuzzleHttp\Client', 'httpClient', $this->whois);
    }
    
    public function testCreateQueryString()
    {
        $this->assertEquals($this->whois->createQueryString('cbo.org.br'), 'https://registro.br/cgi-bin/avail/?qr=cbo.org.br');
    }
    
    public function testQueryDomain()
    {
        $response = $this->whois->queryDomain('registro.br');
        
        // Asserts
        $this->assertEquals($response->getFqdn(), 'registro.br');
        $this->assertEquals($response->getDomain(), 'registro');
        $this->assertFalse($response->isAvailable());
    }
    
    public function testIsAvailable()
    {
        $response = $this->whois->queryDomain('registro,br');
        $this->assertFalse($response->isAvailable());
    }
    
}