<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 12.2.2017
 * Time: 18:29
 */

namespace Zuffik\Srvant\Types;


use Zuffik\Srvant\Formats\Regex;
use Zuffik\Srvant\Types\StringActions\Partitioning\PartitionAction;
use Zuffik\Srvant\Types\StringActions\Partitioning\StringPartition;

/**
 * String wrapper
 * Usage:
 * ```php
 * $str = string('Hallo world')
 *  ->replace('a', 'e')
 *  ->lowerCase()
 *  ->slugify()
 *  ->upperCase();
 * echo $str; // HELLO-WORLD
 * ```
 * @package Zuffik\Srvant\Types
 * @property-read int $length
 */
class Str implements \Countable
{
    /**
     * @var string
     */
    private $string;

    /**
     * @var array
     */
    private static $dynamicProps = [
        'length' => 'count'
    ];

    /**
     * Str constructor.
     * @param string|Str|null $string
     */
    public function __construct($string = '')
    {
        $this->string = (string)$string;
    }

    /**
     * @inheritDoc
     */
    public function __get($name)
    {
        if(empty(self::$dynamicProps[$name])) {
            throw new \InvalidArgumentException("Str::\$$name does not exists.");
        }
        return call_user_func([$this, self::$dynamicProps[$name]]);
    }


    /**
     * @inheritDoc
     */
    public function __debugInfo()
    {
        return [
            'ptr' => spl_object_hash($this),
            'string' => (string) $this->string
        ];
    }

    /**
     * @param string $name
     * @param array ...$args
     * @return mixed
     */
    private function callFunc($name, ...$args)
    {
        return function_exists("mb_$name") ? call_user_func_array("mb_$name", $args) : call_user_func_array($name, $args);
    }

    /**
     * @see str_replace()
     * @param string|Str|Regex $search
     * @param string|Str $replace
     * @return Str
     */
    public function replace($search, $replace)
    {
        if ($search instanceof Regex) {
            $this->string = $search->replace($this->string, $replace);
        }
        $this->string = $this->callFunc('str_replace', $search, $replace, $this->string);
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * @see strtoupper()
     * @return Str
     */
    public function toUppercase()
    {
        $this->string = $this->callFunc('strtoupper', $this->string);
        return $this;
    }

    /**
     * @see strtolower()
     * @return Str
     */
    public function toLowercase()
    {
        $this->string = $this->callFunc('strtolower', $this->string);
        return $this;
    }

    /**
     * @see Str::toUppercase()
     * @return Str
     */
    public function toUpper()
    {
        return $this->toUppercase();
    }

    /**
     * @see Str::toLowercase()
     * @return Str
     */
    public function toLower()
    {
        return $this->toLowercase();
    }

    /**
     * @see ucfirst()
     * @return Str
     */
    public function capitalize()
    {
        $this->string = $this->callFunc('ucfirst', $this->string);
        return $this;
    }

    /**
     * @see lcfirst()
     * @return Str
     */
    public function lowerFirst()
    {
        $this->string = $this->callFunc('lcfirst', $this->string);
        return $this;
    }

    /**
     * @see ucwords()
     * @return Str
     */
    public function capitalizeAll()
    {
        $this->string = $this->callFunc('ucwords', $this->string);
        return $this;
    }

    /**
     * @see substr()
     * @param int $start
     * @param int $length
     * @return Str
     */
    public function substring($start = 0, $length = null)
    {
        $this->string = $this->callFunc('substr', $this->string, $start, $length);
        return $this;
    }

    /**
     * @see strpos()
     * @param Str|string $string
     * @return bool
     */
    public function contains($string)
    {
        return $this->callFunc('strpos', $this->string, (string)$string) !== false;
    }

    /**
     * @see trim()
     * @param string $charlist
     * @return Str
     */
    public function trim($charlist = " \t\n\r\0\x0B")
    {
        $this->string = trim($this->string, $charlist);
        return $this;
    }

    /**
     * Returns true if string is ''
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->string) || ((string)$this->trim()) == '';
    }

    /**
     * Makes slug from containing string
     * @param string $delimiter
     * @return Str
     * @see https://gist.github.com/james2doyle/9158349
     */
    public function slug($delimiter = '-')
    {
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = $this->removeAccents();
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', (string)$clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        setlocale(LC_ALL, $oldLocale);
        $this->string = $clean;
        if (empty($this->string)) {
            $this->string = 'n-a';
        }
        return $this;
    }

    /**
     * @see Str::slug()
     * @return Str
     */
    public function slugify()
    {
        return $this->slug();
    }

    /**
     * @see str_pad()
     * @param Integer|int $length
     * @param string|Str $string
     * @param Integer|int $side
     * @return $this
     */
    public function pad($length, $string = '0', $side = STR_PAD_LEFT)
    {
        $this->string = str_pad(
            intval((string)$this->string),
            intval((string)$length),
            $string,
            intval((string)$side)
        );
        return $this;
    }

    /**
     * Makes upper camel case from containing string
     * @return Str
     */
    public function upperCamelCase()
    {
        $delimiters = " \t\r\n\f\v_";
        $this->string = preg_replace("/[$delimiters]/", '', ucwords($this->string, $delimiters));
        return $this;
    }

    /**
     * Makes lower camel case from containing string
     * @return Str
     */
    public function lowerCamelCase()
    {
        $this->string = lcfirst($this->upperCamelCase());
        return $this;
    }

    /**
     * @see Str::lowerCamelCase()
     * @return Str
     */
    public function camelCase()
    {
        return $this->lowerCamelCase();
    }

    /**
     * @see Str::lowerCamelCase()
     * @return Str
     */
    public function toCamelCase()
    {
        return $this->camelCase();
    }

    /**
     * @see Str::lowerCamelCase()
     * @return Str
     */
    public function toLowerCamelCase()
    {
        return $this->camelCase();
    }

    /**
     * @see Str::upperCamelCase()
     * @return Str
     */
    public function toUpperCamelCase()
    {
        return $this->upperCamelCase();
    }

    /**
     * Makes camel case
     * @return Str
     */
    public function snakeCase()
    {
        $this->string = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $this->camelCase())), '_');
        return $this;
    }

    /**
     * @see Str::snakeCase()
     * @return Str
     */
    public function toSnakeCase()
    {
        return $this->snakeCase();
    }

    /**
     * @param string[] $args
     * @return string[]
     */
    private function getSprintfArgs($args)
    {
        if (count($args) > 1 || !is_array($args[0])) {
            $args = $args[0];
        }
        return $args;
    }

    /**
     * Format string
     * @see sprintf()
     * @param array $args
     * @return Str
     * @throws \Exception
     */
    public function format(...$args)
    {
        $args = $this->getSprintfArgs($args);
        $expected = count($args);
        $real = substr_count($this->string, '%s');
        if ($expected != $real) {
            throw new \Exception("Method Str::format expects $expected exactly arguments. $real given.");
        }
        $this->string = vsprintf($this->string, $args);
        return $this;
    }

    /**
     * Returns NEW formatted string string
     * @see sprintf()
     * @param array $args
     * @return Str
     * @throws \Exception
     * @deprecated use copy & format
     */
    public function formatNew(...$args)
    {
        return string($this)->format($args);
    }

    /**
     * Setter for value
     * @param string|Str $string
     * @return Str
     */
    public function setValue($string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * @see strlen()
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return $this->callFunc('strlen', (string)$this->string);
    }

    /**
     * @see Str::count()
     * @return int
     */
    public function size()
    {
        return $this->count();
    }

    /**
     * @see Str::count()
     * @return int
     */
    public function length()
    {
        return $this->count();
    }

    /**
     * @see strpos()
     * @param Str|string $subString
     * @return int
     */
    public function find($subString)
    {
        $pos = $this->callFunc('strpos', $this->string, $subString);
        return $pos === false ? -1 : $pos;
    }

    /**
     * @param string $delimiter
     * @return \Zuffik\Srvant\Structures\ArrayList
     */
    public function split($delimiter = ' ')
    {
        return arrayList(explode($delimiter, $this->string));
    }

    /**
     * String partition
     * @see StringPartition
     * @param Str|string $character
     * @param string $type
     * @return Str
     * @throws \Exception
     */
    public function part($character, $type)
    {
        StringPartition::verify($type);
        /** @var PartitionAction $action */
        $action = new $type;
        return $action->process($this, $character);
    }

    /**
     * @see substr_count()
     * @param string|Str $char
     * @return int
     */
    public function substrCount($char)
    {
        return $this->callFunc('substr_count', $this->string, (string)$char);
    }

    /**
     * Removes accents
     * @return Str
     */
    public function removeAccents()
    {
        $this->string = iconv('UTF-8', 'ASCII//TRANSLIT', $this->string);
        return $this;
    }

    /**
     * Random substring from given string
     * @param int $length
     * @return Str
     * @throws \Exception
     */
    public function randomSubstring($length = 1)
    {
        if ($length > $this->length()) {
            throw new \Exception("Str::randomSubstring length is larger than length of string ($length/{$this->length()})");
        }
        return string($this)->substring(rand(0, $this->length() - $length), $length);
    }

    /**
     * Returns new instance with same content
     * @return Str
     */
    public function copy()
    {
        return new self($this);
    }

    /**
     * Binds string into placeholder (similar as string format but with named placeholders)
     * @param string|Str $placeholder
     * @param string|Str $value
     * @param string|Str $enclosing char or 2 chars for left and right enclosing
     * @return Str
     */
    public function bind($placeholder, $value, $enclosing = '%')
    {
        $le = $enclosing[0];
        $re = strlen((string)$enclosing) == 2 ? $enclosing[1] : $le;
        return $this->replace("$le$placeholder$re", $value);
    }

    /**
     * @param int $length
     * @param string|Str $ellipsis
     * @param bool $ellipsisInclInLength
     * @return Str
     */
    public function ellipsize($length, $ellipsis = '...', $ellipsisInclInLength = false)
    {
        if($ellipsisInclInLength) {
            $length -= strlen((string) $ellipsis);
        }
        if($this->length > $length) {
            $this->string = $this->callFunc('substr', $this->string, 0, $length);
            $this->string .= $ellipsis;
        }
        return $this;
    }
}