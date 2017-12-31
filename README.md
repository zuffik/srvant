![ant](https://lkmstudio.eu/s/ant.png)

# srvant

**srvant** is your little but helpful package that improves PHP usability.

-------

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SNFEPSATF37TN)

## Docs

### Installation

simply...

```bash 
composer require zuffik/srvant
```

### Usage

#### Structures

**Lists:**

- Array List
- Linked List

**Maps:**

- Hash map

*example:*

```php
$list = new ArrayList();
$list->add(1, 2, 3, -1);
foreach($list as $item) {
	echo $item . "\n";
}
// And equivalent
$list->map(function($item) {
	echo $item . "\n";
	return $item;
})->filter(function($item) {
	return $item > 0;
});
// And many more
```

> Full documentation available [here](https://github.com/zuffik/srvant/tree/master/docs/).

#### String

Offers interface with string functions.

*example:*

```php
$str = string('Hallo world')
	->replace('a', 'e')
	->lowerCase()
	->slugify()
	->upperCase();
echo $str; // HELLO-WORLD
```

> Full documentation available [here](https://github.com/zuffik/srvant/tree/master/docs/).

#### Formats

- CSV
- JSON
- Regex
- URL

All of these offer a interface for work with certain data format.

*example:*

```php
$url = new URL('http://sub.example.com/index.php?action=page');
echo $url->getDomain(); // example
echo $url->getRequestedUrl(); // index.php
```

> Full documentation available [here](https://github.com/zuffik/srvant/tree/master/docs/).

There are planned many features in future.

## Contribution

Contribution is simple. Make pull request with your new or edited code. It **MUST** follow PSR coding standards. For new feature provide also unit tests.

### Donate

If you are satisfied with **srvant**, please donate. Thank you all. :)

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SNFEPSATF37TN)