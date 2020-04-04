<?php


namespace App\Helpers;


use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * Extend Symfony's Request class to add support for JSON content requests
 * @package App\Helpers
 */
class Request extends SymfonyRequest
{
    /**
     * @var ParameterBag
     */
    public $json;

    /**
     * @inheritDoc
     */
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->json = new ParameterBag((array) json_decode($this->getContent(), true));
    }

    /**
     * Override the Symfony Request get method to allow getting from json request
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        if ($this !== $result = $this->json->get($key, $this)) {
            return $result;
        }
        return parent::get($key, $default);
    }
}