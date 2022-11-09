##!/bin/sh

while getopts n:p:r:t: flag
do
    case "${flag}" in
        n) name=${OPTARG};;
        p) pages=${OPTARG};;
        r) recipe=${OPTARG};;
        t) title=${OPTARG};;
    esac
done

echo $name;

if [ ! -d "data/$name" ]; then
 mkdir "data/$name"
fi
path="data/$name"

i=0
while [ $i -le $pages ]
do
  printf "Downloading: $i\r"
  page=$[1099 + $i*100]
  if [ ! -f "$path/$page.html" ]; then
   php download.php $name $i
   sleep 10
  fi
  i=$[$i+1]
done

perl -pi -w -e 's/Bachngocsach.com/ /g;' $1/*
perl -pi -w -e 's/bachngocsach.com/ /g;' $1/*
perl -pi -w -e 's/sach.com/ /g;' $1/*

cover="$(pwd)/$1/cover.jpeg"
/Applications/calibre.app/Contents/MacOS/ebook-convert bachngocsach.recipe ~/Downloads/$1.epub --title-sort "$1" --title="$2" --cover="$cover"
