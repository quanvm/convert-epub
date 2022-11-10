Convert EPUB
====

## Install
Install [Calibre](https://calibre-ebook.com/download_osx) for MacOS

```bash
brew install php@7.4
composer install
```

## Using
- -n: short name, retrieved from url: https://bachngocsach.com/reader/ban-long
- -r: recipe name, allowed values: bachngocsach, truyendichz

```shell
./download.sh -n ban-long
``` 

```shell
./download.sh -n truyen-bach-luyen-thanh-than -r truyendichz
``` 

## Recipe
- bachngocsach: https://bachngocsach.com/reader/
- truyendichz: https://truyendichz.com/
