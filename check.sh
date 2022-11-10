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

title=`php crawler/DownloadPage.php $name $recipe`
echo $title
