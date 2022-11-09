##!/bin/sh
## ./download_bachngocsach.sh huyen-gioi-chi-mon 16 "Huyen gioi chi mon"
if [ ! -d $1 ]; then
 mkdir $1
fi

i=0
while [ $i -le $2 ]
do
  printf "Downloading: $i\r"
  firstpage=$[1099 + $i*100]
  if [ ! -f "$1/$firstpage.html" ]; then
   php $(pwd)/crawler/download_list.php $1 $i
   sleep 10
  fi
  i=$[$i+1]
done

perl -pi -w -e 's/Bachngocsach.com/ /g;' $1/*
perl -pi -w -e 's/bachngocsach.com/ /g;' $1/*
perl -pi -w -e 's/sach.com/ /g;' $1/*

cover="$(pwd)/$1/cover.jpeg"
/Applications/calibre.app/Contents/MacOS/ebook-convert bachngocsach.recipe ~/Downloads/$1.epub --title-sort "$1" --title="$2" --cover="$cover"
