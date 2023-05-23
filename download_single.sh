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

path="data/$name"
if [ ! -d $path ]; then
 mkdir -p $path
fi

pages=`php crawler/DownloadPage.php $name $recipe`
i=0
while [ $i -le $pages ]
do
  printf "Downloading items.... $[$i*100] of $[$pages*100]\r"
  page=$[1099 + $i*100]
  if [ ! -f "$path/$page.html" ]; then
   php crawler/download.php $name $i $recipe
  fi
  i=$[$i+1]
done

title=`php crawler/DownloadTitle.php $name $recipe`

folder="$(pwd)/$path"
cover=`find $path -type f -name "logo.*"`
target=`yq eval '.target_folder' 'config.yml'`
epub_path="$target/$name.epub"
recipe_path="recipe/$recipe.recipe"

if [ ! -f "$epub_path" ]; then
  echo "Saving $epub_path ...."
  /Applications/calibre.app/Contents/MacOS/ebook-convert $recipe_path $epub_path --title-sort $folder --title "$title" --cover "$cover" >> /dev/null
fi
