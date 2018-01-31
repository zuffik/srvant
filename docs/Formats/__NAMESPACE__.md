
# Formats

**Namespace**  : Zuffik\Srvant\Formats

# Overview

- [ExceptionFormatter](__NAMESPACE__.md#ExceptionFormatter)
- [Regex](__NAMESPACE__.md#Regex)
- [URL](__NAMESPACE__.md#URL)
- [CSV](__NAMESPACE__.md#CSV)
- [JSON](__NAMESPACE__.md#JSON)


---
<a name="ExceptionFormatter"></a>
## ExceptionFormatter

**Class**  : Zuffik\Srvant\Formats\ExceptionFormatter

### Public methods

| Method | Description |
|---|---|
| `format` | Formats a exception to readable format. |

<a name="Regex"></a>
## Regex

**Class**  : Zuffik\Srvant\Formats\Regex

### Public methods

| Method | Description |
|---|---|
| `getRegex` | Returns regex |
| `match` | Matches subject returning array of matches. |
| `replace` | Replaces matches in $subject with $replace |
| `__toString` | Returns regular expression |

<a name="URL"></a>
## URL

**Class**  : Zuffik\Srvant\Formats\URL

### Public methods

| Method | Description |
|---|---|
| `parseUrl` | Parses given url using self::PATTERN regex |
| `getAbsoluteUrl` | Builds entire URL address with properties |
| `getDomain` | Returns domain (eg. google) |
| `setDomain` | Setter for domain |
| `getProtocol` | Returns protocol (eg. http) |
| `setProtocol` | Setter for protocol |
| `getSubdomain` | Returns subdomain (eg. gist) |
| `setSubdomain` | Setter for subdomain |
| `getTld` | Returns top level domain (eg. com) |
| `setTld` | Setter for top level domain |
| `getRequestedURL` | Returns requested URL (eg. index.php) |
| `setRequestedURL` | Setter for requested URL |
| `getQueryParams` | Returns query parameters in Map (eg. ['foo' =&gt; 'bar', 'baz' =&gt; 1] |
| `setQueryParams` | Setter for query parameters |
| `addQueryParam` | Add query parameter |
| `__toString` | Returns absolute URL |

<a name="CSV"></a>
## CSV

**Class**  : Zuffik\Srvant\Formats\CSV

### Public methods

| Method | Description |
|---|---|
| `current` | Return the current element |
| `next` | Move forward to next element |
| `key` | Return the key of the current element |
| `valid` | Checks if current position is valid |
| `rewind` | Rewind the Iterator to the first element |
| `toArray` | Every object can be converted to array due to high native PHP compatibility. |

<a name="JSON"></a>
## JSON

**Class**  : Zuffik\Srvant\Formats\JSON

### Public methods

| Method | Description |
|---|---|
| `getArray` |  |
| `toArray` |  |
| `__toString` |  |
| `offsetExists` | Whether a offset exists |
| `offsetGet` | Offset to retrieve |
| `offsetSet` | Offset to set |
| `offsetUnset` | Offset to unset |
| `current` | Return the current element |
| `next` | Move forward to next element |
| `key` | Return the key of the current element |
| `valid` | Checks if current position is valid |
| `rewind` | Rewind the Iterator to the first element |

