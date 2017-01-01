<?php
namespace Contentstack\Stack;

use Contentstack\Utility;
use Contentstack\Stack\ContentType\ContentType;

require_once __DIR__."/content_type.php";
require_once __DIR__."/../../config/index.php";

/*
 * Stack Class to initialize the provided parameter Stack
 * */
class Stack {
    /* header - array where all the headers for the request will be stored */
    var $header = array();
    /* host - Host to be used to fetch the content */
    private $host = HOST;
    /* port - Port of the HOST */
    private $port = PORT;
    /* protocol - Protocol to be used to fetch the content */
    private $protocol = PROTOCOL;
    /* environment - Environment on which content published to be retrieved */
    private $environment;

    /*
     * Constructor of the Stack
     * */
    public function __construct($api_key = '', $access_token = '', $environment = 'development') {
        $this->header = Utility\validateInput('stack', array('api_key' => $api_key, 'access_token' => $access_token, 'environment' => $environment));
        $this->environment = $this->header['environment'];
        unset($this->header['environment']);
        return $this;
    }

    /*
     * To initialize the ContentType object from where the content will be fetched/retrieved
     * @param
     *      string|contentTypeId - valid content type uid relevant to configured stack
     * @return ContentType
     * */
    public function ContentType($contentTypeId = '') {
        return new ContentType($contentTypeId, $this);
    }

    /*
     * To get the last_activity information of the configured environment from all the content types
     * @return Result
     * */
    public function getLastActivities() {
        $this->_query = array("only_last_activity" => "true");
        return Utility\getLastActivites($this);
    }

    /*
     * To set the host on stack object
     * @param
     *      host - host name/ipaddress from where the content to be fetched
     * @return Stack
     * */
    public function setHost($host = '') {
        Utility\validateInput('host', $host);
        $this->host = $host;
        return $this;
    }

    public function getHost() {
        return $this->host;
    }

    public function setProtocol($protocol = '') {
        Utility\validateInput('protocol', $protocol);
        $this->protocol = $protocol;
        return $this;
    }

    public function getProtocol() {
        return $this->protocol;
    }

    public function setPort($port = '') {
        Utility\validateInput('port', $port);
        $this->port = $port;
        return $this;
    }

    public function getPort() {
        return $this->port;
    }

    public function setAPIKEY($api_key = '') {
        Utility\validateInput('api_key', $api_key);
        $this->header['api_key'] = $api_key;
        return $this;
    }

    public function setAccessToken($access_token = '') {
        Utility\validateInput('access_token', $access_token);
        $this->header['access_token'] = $access_token;
        return $this;
    }

    public function setEnvironment($environment = '') {
        Utility\validateInput('environment', $environment);
        $this->environment = $environment;
        return $this;
    }
    
    public function getAPIKEY() {
        return $this->header['api_key'];
    }

    public function getAccessToken() {
        return $this->header['access_token'];
    }

    public function getEnvironment() {
        return $this->environment;
    }
}