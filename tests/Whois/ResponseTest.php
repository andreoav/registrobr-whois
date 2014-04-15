<?php namespace Whois;

use PHPUnit_Framework_TestCase as TestCase;

class ResponseTest extends TestCase
{
    /**
     * @var \Whois\Response
     */
    protected $response;
    
    /**
     *
     */
    public function __construct()
    {
        $whois = new Whois(new \GuzzleHttp\Client);
        $this->response = $whois->queryDomain('registro.br');
    }
    
    /**
     *
     */
    public function testIsAvailable()
    {
        $this->assertFalse($this->response->isAvailable());
    }
    
    /**
     *
     */
    public function testIsFree()
    {
        $this->assertFalse($this->response->isFree());
    }
    
    /**
     *
     */
    public function testGetReason()
    {
        $this->assertEquals($this->response->getReason(), 'Motivo: Dom&iacute;nio j&aacute; registrado');
    }
}