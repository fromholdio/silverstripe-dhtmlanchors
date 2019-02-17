# silverstripe-dbhtmlanchors

Quick and easy method of identifying anchors in DBHTMLText and DBHTMLVarchar fields.

## Requirements

SilverStripe 4

## Installation

`composer require fromholdio/silverstripe-dbhtmlanchors`

## Detail

Upon install, the `DBHTMLAnchorsExtension` is automatically applied to `DBHTMLText` and `DBHTMLVarchar`.

This adds a `getAnchors()` accessor to each of these DBFields.

When called on the field object, it processes any shortcodes, and then searches the html elements for `name` and `id` attributes that can be used as anchor link targets.

The list of anchor values is returned as a simple array.

## Usage example

Add a `DBHTMLText` or `DBHTMLVarchar` to your data object. The `Content` field of `SiteTree` is a common example of one that already exists.

```php
private static $db = [
    'Content' => 'HTMLText'
];
```

In your code, get the field object, and call `getAnchors()`. Make sure you get the field object, not the field's value.

```php

// CORRECT
$contentField = $this->dbObject('Content');
$anchors = $contentField->getAnchors();

// WRONG
$contentField = $this->Content;
$anchors = $contentField->getAnchors();
```

The value returned will be either `null` for no results, or an associative array, with key and value both containing the anchor value.

```php
// return value from ->getAnchors()
[
    'sectionone' => 'sectionone',
    'sectiontwo' => 'sectiontwo'
]
```
