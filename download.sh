#!/bin/bash

recipe=`yq eval '.recipe' 'config.yml'`

items=($(yq eval '.items' 'config.yml'))
for item in "${items[@]}"; do
  ./download_single.sh -n $item -r $recipe
done
