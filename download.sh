#!/bin/bash

function configGet {
  configFile="config.yml";
  if [ -f "config.local.yml" ]; then
    configFile="config.local.yml";
  fi

  recipe=`yq eval $1 $configFile`
  echo $recipe
}

function downloadChapter {
  name=$1
  recipe=$2

  pages=(`php crawler/DownloadPage.php $name $recipe`)
  total=$[ ${pages[0]}*100 + ${pages[1]} ]
  i=0
  while [ $i -le ${pages[0]} ]
  do
    page=$[1099 + $i*100]
    php crawler/download.php $name $i $recipe $total
    i=$[$i+1]
  done
}

function convert {
  name=$1
  recipe=$2

  title=`php crawler/DownloadTitle.php $name $recipe`

  path="data/$name"
  folder="$(pwd)/$path"
  cover=`find $path -type f -name "logo.*"`
  target=$(configGet '.target_folder')
  epub_path="$target/$name.epub"
  recipe_path="recipe/$recipe.recipe"

  if [ ! -f "$epub_path" ]; then
    echo "Proccessing epub format ...."
    /Applications/calibre.app/Contents/MacOS/ebook-convert $recipe_path "$epub_path" --title-sort $folder --title "$title" --cover "$cover" >> /dev/null
  fi
  echo "New file saved in $epub_path"
}

function download {
  name=$1
  recipe=$2

  echo "Download: $name"

  path="data/$name"
  if [ ! -d $path ]; then
   mkdir -p $path
  fi

  downloadChapter $name $recipe
  convert $name $recipe
}

recipe=$(configGet '.recipe')
items=($(configGet '.items'))

for item in "${items[@]}"; do
  download $item $recipe
done
