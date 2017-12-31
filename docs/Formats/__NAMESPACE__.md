
# Formats

**Namespace**  : Zuffik\Srvant\Formats

# Overview

- [ExceptionFormatter](__NAMESPACE__.md#ExceptionFormatter)
- [Regex](__NAMESPACE__.md#Regex)
- [URL](__NAMESPACE__.md#URL)
- [CSV](__NAMESPACE__.md#CSV)
- [Random](__NAMESPACE__.md#Random)
- [JSON](__NAMESPACE__.md#JSON)


---
<a name="ExceptionFormatter"></a>
## ExceptionFormatter

**Class**  : Zuffik\Srvant\Formats\ExceptionFormatter

### Public methods

| Method | Description |
|---|---|
| `format` |  |

<a name="Regex"></a>
## Regex

**Class**  : Zuffik\Srvant\Formats\Regex

### Public methods

| Method | Description |
|---|---|
| `getRegex` |  |
| `match` |  |
| `replace` |  |
| `__toString` |  |

<a name="URL"></a>
## URL

**Class**  : Zuffik\Srvant\Formats\URL

### Public methods

| Method | Description |
|---|---|
| `parseUrl` |  |
| `getAbsoluteUrl` |  |
| `getDomain` |  |
| `setDomain` |  |
| `getProtocol` |  |
| `setProtocol` |  |
| `getSubdomain` |  |
| `setSubdomain` |  |
| `getTld` |  |
| `setTld` |  |
| `getRequestedURL` |  |
| `setRequestedURL` |  |
| `getQueryParams` |  |
| `setQueryParams` |  |
| `addQueryParam` |  |
| `__toString` |  |

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

<a name="Random"></a>
## Random

**Class**  : Zuffik\Srvant\Formats\Random

### Public methods

| Method | Description |
|---|---|
| `integer` |  |
| `decimal` |  |
| `string` |  |

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
| `__debugInfo` |  |

