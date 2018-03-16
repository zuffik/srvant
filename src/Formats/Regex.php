<?php
/**
 * Created by PhpStorm.
 * User: zuffa
 * Date: 19.8.2016
 * Time: 13:28
 */

namespace Zuffik\Srvant\Formats;


use Zuffik\Srvant\Exceptions\InvalidArgumentException;
use Zuffik\Srvant\Types\Str;

class Regex
{
    /** @var Str */
    private $regex;

    /**
     * Regex constructor. Also checks for it validity.
     * @param string|Str $regex
     * @throws InvalidArgumentException
     */
    public function __construct($regex)
    {
        if (@preg_match((string)$regex, '') === false) {
            throw new InvalidArgumentException('Regex "' . $regex . '" is not valid');
        }
        $this->regex = new Str($regex);
    }

    /**
     * Returns regex
     * @return Str
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * Matches subject returning array of matches.
     * @param string|Str $subject
     * @param bool $global
     * @return array|null
     */
    public function match($subject, $global = false)
    {
        if ($global) {
            preg_match_all((string)$this->regex, (string)$subject, $matches);
        } else {
            preg_match((string)$this->regex, (string)$subject, $matches);
        }
        return $matches;
    }

    /**
     * Replaces matches in $subject with $replace
     * @param string|Str $subject
     * @param string|Str|callable $replace
     * @return mixed
     */
    public function replace($subject, $replace)
    {
        if (is_callable($replace)) {
            return preg_replace_callback((string)$this->regex, $replace, (string)$subject);
        } else {
            return preg_replace((string)$this->regex, (string)$subject, (string)$replace);
        }
    }

    /**
     * Returns regular expression
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getRegex();
    }
}
