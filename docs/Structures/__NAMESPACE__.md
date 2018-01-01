
# Structures

**Namespace**  : Zuffik\Srvant\Structures

# Overview

- [Maps](./Maps/__NAMESPACE__.md)
    - [HashMap](Maps/__NAMESPACE__.md#HashMap)
    - [KeyValue](Maps/__NAMESPACE__.md#KeyValue)
- [Lists](./Lists/__NAMESPACE__.md)
    - [LinkedList](Lists/__NAMESPACE__.md#LinkedList)
    - [ArrayList](Lists/__NAMESPACE__.md#ArrayList)
    - [DataItem](Lists/__NAMESPACE__.md#DataItem)
- [AbstractStructure](__NAMESPACE__.md#AbstractStructure)
- [AssociativeStructure](__NAMESPACE__.md#AssociativeStructure)
- [OrderedStructure](__NAMESPACE__.md#OrderedStructure)
- [IArray](__NAMESPACE__.md#IArray)
- [Structure](__NAMESPACE__.md#Structure)


---
<a name="AbstractStructure"></a>
## AbstractStructure

**Class**  : Zuffik\Srvant\Structures\AbstractStructure

### Public methods

| Method | Description |
|---|---|
| `__toString` |  |
| `__debugInfo` |  |
| `copy` | Returns new instance of List with same content. |
| `offsetExists` | Necessary for ArrayAccess but always true due to keep exceptional programming |
| `offsetGet` |  |
| `offsetSet` |  |
| `offsetUnset` |  |
| `isEmpty` |  |
| `swap` |  |
| `jsonSerialize` |  |

<a name="AssociativeStructure"></a>
## AssociativeStructure

**Class**  : Zuffik\Srvant\Structures\AssociativeStructure

### Public methods

| Method | Description |
|---|---|
| `__get` |  |
| `__set` |  |
| `__isset` |  |
| `__unset` |  |
| `iterator` |  |

<a name="OrderedStructure"></a>
## OrderedStructure

**Class**  : Zuffik\Srvant\Structures\OrderedStructure

### Public methods

| Method | Description |
|---|---|
| `map` | Iterates over each item in List and pass it in closure (param: $item, $key, returns: mixed - value that will be replaced in list) |
| `push` | Add value to end of List |
| `pop` | Removes last item from List and returns it. |
| `last` | Get last item from array. |
| `first` | Get first item from array. |
| `slice` | Makes subset from List by its start index and length of subset |
| `sort` | Sort List by given callable (params: $item1, $item2) |
| `reverse` | Reverses List. |
| `diff` | Computes the difference of arrays |
| `find` | Recursively searches for item in List. If no item was found, null is returned. |
| `multiSort` | Sort by multiple criteria (assoc. array with key representing what will be compared and |
| `current` |  |
| `next` |  |
| `key` |  |
| `valid` |  |
| `rewind` |  |
| `join` | Recursively joins items in List by given glue. |
| `getGenerator` | yields each item |
| `categorize` | Returns hash map with given categorization, eg. ```php |
| `rand` | Returns random item from List. |
| `removeIf` | Removes item from List by comparing its value |
| `countIf` | Counts every item that meets condition in callable (params: $value, $index) |
| `sumIf` | Sum every item that meets condition in callable (params: $value, $index) |
| `sum` | Returns sum of List items. |
| `min` | Returns minimum of List items. |
| `max` | Returns maximum of List items. |
| `contains` |  |
| `__sleep` |  |
| `__wakeup` |  |

<a name="IArray"></a>
## IArray

**Interface**  : Zuffik\Srvant\Structures\IArray

### Public methods

| Method | Description |
|---|---|
| `toArray` | Every object can be converted to array due to high native PHP compatibility. |

<a name="Structure"></a>
## Structure

**Interface**  : Zuffik\Srvant\Structures\Structure

### Public methods

| Method | Description |
|---|---|
| `__construct` | Structure constructor. |
| `merge` | Merges List with array or a structure |
| `filter` | Filters items by given callable (param: $item, returns: bool whether item stays in list or will be removed) |
| `clear` | Removes all items from List. |
| `sort` | Sort List by given callable (params: $item1, $item2) |
| `get` | Returns item from given key |
| `set` | Sets an offset to value |
| `remove` | Removes item from List by its key. |
| `copy` | Return new instance with same content. |
| `isEmpty` | Whether List is empty. |
| `swap` |  |
| `keyExists` |  |
| `contains` | Whether value exists in structure |
| `unify` | Makes structure values unique |

