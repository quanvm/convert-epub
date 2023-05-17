#!/bin/bash

file="config.txt"

while IFS= read -r line; do
  ./download_single.sh $line
done < "$file"
