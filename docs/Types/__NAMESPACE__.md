
# Types

**Namespace**  : Zuffik\Srvant\Types

# Overview

- [StringActions](./StringActions/__NAMESPACE__.md)
    - [Partitioning](./StringActions/Partitioning/__NAMESPACE__.md)
        - [FromLast](StringActions/Partitioning/__NAMESPACE__.md#FromLast)
        - [UntilFirst](StringActions/Partitioning/__NAMESPACE__.md#UntilFirst)
        - [UntilLast](StringActions/Partitioning/__NAMESPACE__.md#UntilLast)
        - [StringPartition](StringActions/Partitioning/__NAMESPACE__.md#StringPartition)
        - [FromFirst](StringActions/Partitioning/__NAMESPACE__.md#FromFirst)
        - [AllBetween](StringActions/Partitioning/__NAMESPACE__.md#AllBetween)
        - [PartitionAction](StringActions/Partitioning/__NAMESPACE__.md#PartitionAction)
    - [Action](StringActions/__NAMESPACE__.md#Action)
- [Number](__NAMESPACE__.md#Number)
- [Double](__NAMESPACE__.md#Double)
- [Str](__NAMESPACE__.md#Str)
- [Boolean](__NAMESPACE__.md#Boolean)
- [Enum](__NAMESPACE__.md#Enum)
- [Integer](__NAMESPACE__.md#Integer)


---
<a name="Number"></a>
## Number

**Class**  : Zuffik\Srvant\Types\Number

### Public methods

| Method | Description |
|---|---|
| `create` |  |
| `setValue` |  |
| `getValue` |  |
| `__toString` |  |
| `add` |  |
| `subtract` |  |
| `multiply` |  |
| `divide` |  |
| `abs` |  |
| `numberFormat` |  |

<a name="Double"></a>
## Double

**Class**  : Zuffik\Srvant\Types\Double

### Public methods

| Method | Description |
|---|---|
| `getValue` |  |
| `__toString` |  |

<a name="Str"></a>
## Str

**Class**  : Zuffik\Srvant\Types\Str

### Public methods

| Method | Description |
|---|---|
| `__debugInfo` |  |
| `replace` |  |
| `__toString` |  |
| `toUppercase` |  |
| `toLowercase` |  |
| `toUpper` |  |
| `toLower` |  |
| `capitalize` |  |
| `lowerFirst` |  |
| `capitalizeAll` |  |
| `substring` |  |
| `contains` |  |
| `trim` |  |
| `isEmpty` | Returns true if string is '' |
| `slug` | Makes slug from containing string |
| `slugify` |  |
| `pad` |  |
| `upperCamelCase` | Makes upper camel case from containing string |
| `lowerCamelCase` | Makes lower camel case from containing string |
| `camelCase` |  |
| `toCamelCase` |  |
| `toLowerCamelCase` |  |
| `toUpperCamelCase` |  |
| `snakeCase` | Makes camel case |
| `toSnakeCase` |  |
| `format` | Format string |
| `formatNew` | Returns NEW formatted string string |
| `setValue` | Setter for value |
| `count` |  |
| `length` |  |
| `find` |  |
| `split` |  |
| `part` | String partition |
| `substrCount` |  |
| `removeAccents` | Removes accents |
| `randomSubstring` | Random substring from given string |
| `copy` | Returns new instance with same content |
| `bind` | Binds string into placeholder (similar as string format but with named placeholders) |

<a name="Boolean"></a>
## Boolean

**Class**  : Zuffik\Srvant\Types\Boolean

### Public methods

| Method | Description |
|---|---|
| `getValue` |  |
| `setValue` |  |
| `__toString` |  |

<a name="Enum"></a>
## Enum

**Class**  : Zuffik\Srvant\Types\Enum

### Public methods

| Method | Description |
|---|---|
| `getValues` | Return all values |
| `setValue` | Setter for value |
| `getValue` | Returns value of enumerator |
| `toArray` | Returns possible values |
| `verify` | If $value can be passed in enumerator returns it. Otherwise it throws an exception. |

<a name="Integer"></a>
## Integer

**Class**  : Zuffik\Srvant\Types\Integer

### Public methods

| Method | Description |
|---|---|
| `getValue` |  |
| `__toString` |  |
| `divide` |  |
| `mod` |  |

