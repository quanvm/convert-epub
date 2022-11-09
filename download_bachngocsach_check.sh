##!/bin/sh

cover="$(pwd)/$1/cover.jpeg"
/Applications/calibre.app/Contents/MacOS/ebook-convert bachngocsach.recipe ~/Downloads/$1.epub --title-sort "$1" --title="$2" --cover="$cover"
