<?php namespace Whois;

class Response
{
    /*
     * @var boolean
     */
    protected $available = '';
    
    /*
     * @var string
     */
    protected $domain = '';
    
    /*
     * @var string
     */
    protected $fqdn = '';
    
    /*
     * @var boolean
     */
    protected $free = false;
    
    /*
     * @var array
     */
    protected $suggestions = array();
    
    /*
     * @var string
     */
    protected $reason = '';
    
    /*
     *
     */
    protected $comment = '';
    
    /*
     *
     */
    public function __construct($response)
    {
        if ($response !== null)
        {
            isset($response->available) and ($this->available = $response->available);
            isset($response->comment)   and ($this->comment = $response->comment);
            isset($response->domain)    and ($this->domain = $response->domain);
            isset($response->reason)    and ($this->reason = $response->reason);
            isset($response->fqdn)      and ($this->fqdn = $response->fqdn);
            isset($response->free)      and ($this->free = $response->free);
            
            if (isset($response->suggestions) and count($response->suggestions) > 0)
            {
                foreach ($response->suggestions as $suggestion)
                {
                    $this->suggestions[] = $suggestion;
                }
            }
        }
    }
    
    public function isAvailable()
    {
        return $this->available;
    }
    
    public function isFree()
    {
        return $this->free;
    }
    
    public function getDomain()
    {
        return $this->domain;
    }
    
    public function getComment()
    {
        return $this->comment;
    }
    
    public function getReason()
    {
        return $this->reason;
    }
    
    public function getFqdn()
    {
        return $this->fqdn;
    }
}