##!/bin/sh

recipe="bachngocsach"

while getopts n:r: flag
do
    case "${flag}" in
        n) name=${OPTARG};;
        r) recipe=${OPTARG};;
    esac
done

echo "Download: $name"

if [ ! -d "data/$name" ]; then
 mkdir -p "data/$name"
fi
path="data/$name"

pages=`php crawler/DownloadPage.php $name $recipe`
i=0
while [ $i -le $pages ]
do
  printf "Downloading: $i\r"
  page=$[1099 + $i*100]
  if [ ! -f "$path/$page.html" ]; then
   php download.php $name $i $recipe
  fi
  i=$[$i+1]
done

title=`php crawler/DownloadTitle.php $name $recipe`

path="data/$name"
folder="$(pwd)/$path"
cover=`find $path -type f -name "logo.*"`
target=`yq eval '.target_folder' 'config.yml'`

/Applications/calibre.app/Contents/MacOS/ebook-convert "recipe/$recipe.recipe" "$target/$name.epub" --title-sort $folder --title "$title" --cover "$cover"
