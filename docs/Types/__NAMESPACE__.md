
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
| `isEmpty` |  |
| `slug` |  |
| `slugify` |  |
| `pad` |  |
| `upperCamelCase` |  |
| `lowerCamelCase` |  |
| `camelCase` |  |
| `toCamelCase` |  |
| `toLowerCamelCase` |  |
| `toUpperCamelCase` |  |
| `snakeCase` |  |
| `toSnakeCase` |  |
| `format` | Format string |
| `formatNew` | Returns NEW formatted string string |
| `setValue` |  |
| `count` | Count elements of an object |
| `length` |  |
| `find` |  |
| `split` |  |
| `part` |  |
| `substrCount` |  |
| `removeAccents` |  |
| `randomSubstring` |  |
| `copy` |  |
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
| `getValues` |  |
| `setValue` |  |
| `getValue` |  |
| `toArray` |  |
| `verify` |  |
| `__debugInfo` |  |

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

