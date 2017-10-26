# pangpondpon/ngcli-indexifier

Package to insert angular assets to laravel blade template.

[![Build Status](https://travis-ci.org/pangpondpon/ngcli-indexifier.svg?branch=master)](https://travis-ci.org/pangpondpon/ngcli-indexifier)

## Problem
Angular Cli build production command will output the hash in js and css file. This library will help you include those files easily using blade directive `ngStyle` and `ngScripts`

## Prerequisite
1. PHP 7.1

## Installation
1. Run `composer install pangpondpon/ngcli-indexifier` to install the library
2. If you're using Laravel 5.4 or below, add the service provider to your config/app.php in `providers` array.
```
Indexifier\IndexifierServiceProvider::class,
```

## Usage
You need to add `ngStyle` before `<body>` tag and add `ngScripts` before `</body>`
```
<!DOCTYPE html><html lang="en"><head>
    <meta charset="utf-8">
    <title>My App</title>
    <base href="/">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    
    @ngStyle
</head>
<body>
    <app-root></app-root>
    
    @ngScripts
</body>
```