Convert EPUB
====

## Install
Install [Calibre](https://calibre-ebook.com/download_osx) for MacOS

```bash
brew install php@7.4
composer install
```

## Download single
- -n: short name, retrieved from url: https://bachngocsach.com.vn/reader/ban-long
- -r: recipe name, allowed values: bachngocsach, truyendichz

```shell
./download.sh -n ban-long
```

```shell
./download.sh -n truyen-bach-luyen-thanh-than -r truyendichz
```

## Download by config file
- Define a list in config.txt

```shell
-n ban-long
-n truyen-bach-luyen-thanh-than -r truyendichz
```

- Execute download.sh
```shell
./download.sh
```

## Recipe
- bachngocsach: https://bachngocsach.com.vn/reader/
- truyendichz: https://truyendichz.com/
