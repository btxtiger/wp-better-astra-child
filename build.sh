#!/bin/bash

# compile all scss files in place to css
sass src --update

# Extract version from package.json
VERSION=$(node -p -e "require('./package.json').version")
releaseDir=dist/wp-better-astra-child

# Create dist folder
mkdir -p $releaseDir

# Clear Content Of Dist Folder
rm -rf $releaseDir/*

# Copy files from src to dist/my-plugin
cp -R src/* $releaseDir/

# Run Gulp task
gulp

# Replace {{ package.version }} in style.css
sed -i'' -e "s/{{ package.version }}/$VERSION/g" "$releaseDir/style.css"

# Replace {{ package.version }} in functions.php
sed -i'' -e "s/{{ package.version }}/$VERSION/g" "$releaseDir/functions.php"

# Go to the dist directory
cd dist

# Create a ZIP file from dist/my-plugin
zip -r wp-better-astra-child-$VERSION.zip wp-better-astra-child/
