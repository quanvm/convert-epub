##!/bin/sh

recipe="bachngocsach"

while getopts n:p:r:t: flag
do
    case "${flag}" in
        n) name=${OPTARG};;
        p) pages=${OPTARG};;
        r) recipe=${OPTARG};;
        t) title=${OPTARG};;
    esac
done

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
   php download.php $name $i $recipe
   sleep 10
  fi
  i=$[$i+1]
done

path="data/$name"
folder="$(pwd)/$path"
cover=`find $path -type f -name "logo.*"`

/Applications/calibre.app/Contents/MacOS/ebook-convert "recipe/$recipe.recipe" "data/$name.epub" --title-sort $folder --title="$title" --cover="$cover"
