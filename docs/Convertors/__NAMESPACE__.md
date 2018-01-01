
# Convertors

**Namespace**  : Zuffik\Srvant\Convertors

# Overview

- [FromScalar](__NAMESPACE__.md#FromScalar)
- [ArrayStructureConverter](__NAMESPACE__.md#ArrayStructureConverter)


---
<a name="FromScalar"></a>
## FromScalar

**Class**  : Zuffik\Srvant\Convertors\FromScalar

### Public methods

| Method | Description |
|---|---|
| `formatInput` | Make object from scalar type (eg. serialized string) or returns given parameter. |

<a name="ArrayStructureConverter"></a>
## ArrayStructureConverter

**Class**  : Zuffik\Srvant\Convertors\ArrayStructureConverter

### Public methods

| Method | Description |
|---|---|
| `toArray` | Converts Structure to array |
| `toStructure` | Converts array to structure. Also checks for continuous indexes to determine if it is Map or List |

