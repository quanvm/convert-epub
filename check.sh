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

cover=`find $path -type f -name "logo.*"`
echo $cover
