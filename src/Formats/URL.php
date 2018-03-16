<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 4.9.2016
 * Time: 13:49
 */

namespace Zuffik\Srvant\Formats;


use Zuffik\Srvant\Exceptions\InvalidArgumentException;
use Zuffik\Srvant\Structures\Maps\HashMap;

/**
 * Class URL for parsing and building url.
 * @package Zuffik\Srvant\Formats
 */
class URL
{
    const PATTERN = '/^((https?):\/\/)?(([a-z0-9_-]+)\.)?(([a-z0-9_-]+)\.([a-z.0-9]+)|localhost)(\/[^?]*)?(\?.*)?$/';

    /** @var string */
    private $domain;
    /** @var string */
    private $protocol;
    /** @var string */
    private $subdomain;
    /** @var string */
    private $tld;
    /** @var string */
    private $requestedURL;
    /** @var HashMap */
    private $queryParams;
    /** @var string */
    private $fullUrl;

    /**
     * URL constructor.
     * @param string $url
     * @throws InvalidArgumentException
     */
    public function __construct($url = '')
    {
        if ($url != '') {
            $this->parseUrl($url);
        }
    }

    /**
     * Parses given url using self::PATTERN regex
     * @param $url
     * @throws InvalidArgumentException
     */
    public function parseUrl($url)
    {
        preg_match(self::PATTERN, $url, $m);
        if (empty($m)) {
            $this->fullUrl = $url;
            $this->queryParams = new HashMap();
        } else {
            $this->protocol = $m[2] == '' ? 'http' : $m[2];
            $this->domain = $m[5] == 'localhost' ? $m[5] : $m[6];
            $this->subdomain = $m[4];
            $this->tld = $m[7];
            $this->requestedURL = isset($m[8]) && strpos($m[8], '/') === 0 && ltrim($m[8], '/') != '' ? $m[8] : '';
            parse_str(isset($m[9]) && strpos($m[9], '?') === 0 && ltrim($m[9], '?') != '' ? substr($m[9], 1) : '', $params);
            $this->queryParams = new HashMap($params);
        }
    }

    /**
     * Builds entire URL address with properties
     * @return string
     */
    public function getAbsoluteUrl()
    {
        return empty($this->fullUrl) ? sprintf(
            '%s://%s%s%s%s%s%s',
            $this->protocol,
            $this->subdomain == '' ? '' : ($this->subdomain . '.'),
            $this->domain,
            $this->domain == 'localhost' ? '' : '.',
            $this->tld,
            $this->requestedURL,
            empty($this->queryParams) || empty($this->queryParams->toArray()) ? '' : ('?' . http_build_query($this->queryParams->toArray()))
        ) : $this->fullUrl;
    }

    /**
     * Returns domain (eg. google)
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Setter for domain
     * @param string $domain
     * @return URL
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Returns protocol (eg. http)
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Setter for protocol
     * @param string $protocol
     * @return URL
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * Returns subdomain (eg. gist)
     * @return string
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * Setter for subdomain
     * @param string $subdomain
     * @return URL
     */
    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;
        return $this;
    }

    /**
     * Returns top level domain (eg. com)
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * Setter for top level domain
     * @param string $tld
     * @return URL
     */
    public function setTld($tld)
    {
        $this->tld = $tld;
        return $this;
    }

    /**
     * Returns requested URL (eg. index.php)
     * @return string
     */
    public function getRequestedURL()
    {
        return $this->requestedURL;
    }

    /**
     * Setter for requested URL
     * @param string $requestedURL
     * @return URL
     */
    public function setRequestedURL($requestedURL)
    {
        $this->requestedURL = $requestedURL;
        return $this;
    }

    /**
     * Returns query parameters in Map (eg. ['foo' => 'bar', 'baz' => 1]
     * @return HashMap
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Setter for query parameters
     * @param HashMap $queryParams
     * @return URL
     * @throws InvalidArgumentException
     */
    public function setQueryParams($queryParams)
    {
        if (is_string($queryParams)) {
            parse_str($queryParams, $params);
        } else {
            $params = $queryParams;
        }
        $this->queryParams = new HashMap($params);
        return $this;
    }

    /**
     * Add query parameter
     * @param string $name
     * @param string $value
     * @return URL
     */
    public function addQueryParam($name, $value)
    {
        $this->queryParams->set($name, $value);
        return $this;
    }

    /**
     * Returns absolute URL
     * @return string
     */
    public function __toString()
    {
        return $this->getAbsoluteUrl();
    }


}