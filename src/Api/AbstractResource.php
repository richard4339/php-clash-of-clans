<?php

namespace ClashOfClans\Api;

abstract class AbstractResource
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var AbstractResource[]
     */
    protected $casts = [];

    protected function __construct()
    {

    }

    /**
     * @param array $properties
     * @return static
     */
    public static function makeFromArray(array $properties)
    {
        $instance = new static;

        $instance->parseProperties($properties);

        return $instance;
    }

    protected function parseProperties(array $properties)
    {
        foreach ($properties as $key => $value) {
            $this->parse($key, $value);
        }
    }

    protected function parse($key, $value)
    {
        if ($this->isCastable($key)) {
            return $this->cast($key, $value);
        }

        return $this->setRawProperty($key, $value);
    }

    /**
     * @param $key
     * @return bool
     */
    protected function isCastable($key)
    {
        return array_key_exists($key, $this->casts) || is_int($key);
    }

    /**
     * @param $key
     * @param $value
     * @return AbstractResource
     */
    protected function cast($key, $value)
    {
        $class = is_int($key) ? $this->casts['all'] : $this->casts[$key];

        return $this->setRawProperty($key, $class::makeFromArray($value));
    }

    /**
     * @param $key
     * @param $value
     * @return AbstractResource
     */
    protected function setRawProperty($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @param mixed $key
     * @return array|mixed|null
     */
    protected function get($key = null)
    {
        if ($key === null) {
            return $this->data;
        }

        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function __call($name, $arguments)
    {
        if ($data = $this->get($name)) {
            return $data;
        }
    }

    public function __get($name)
    {
        if ($data = $this->get($name)) {
            return $data;
        }
    }

    /**
     * Formats the specified time using the supplied format
     *
     * @internal The Clash of Clans API returns their date in a format not directly parseable by PHP. This function makes the date parseable by PHP
     *
     * @param string $time
     * @param string $format Defaults to DATE_ATOM
     * @return false|string
     *
     * @link https://secure.php.net/manual/en/function.date.php
     * @link https://secure.php.net/manual/en/class.datetime.php#datetime.constants.types
     */
    public static function formatTime($time, $format = DATE_ATOM)
    {
        if(empty($time)) {
            return false;
        }

        $a = str_split($time);

        array_splice($a, 4, 0, '-');
        array_splice($a, 7, 0, '-');
        array_splice($a, 13, 0, ':');
        array_splice($a, 16, 0, ':');

        return date($format, strtotime(implode("", $a)));
    }
}
