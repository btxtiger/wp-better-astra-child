#!/bin/bash

# Extract version from package.json
VERSION=$(node -p -e "require('./package.json').version")

# Create dist folder
mkdir -p dist/wp-better-astra-child

# Clear Content Of Dist Folder
rm -rf dist/wp-better-astra-child/*

# Copy files from src to dist/my-plugin
cp -R src/* dist/wp-better-astra-child/

# Run Gulp task
gulp

# Go to the dist directory
cd dist

# Create a ZIP file from dist/my-plugin
zip -r wp-better-astra-child-$VERSION.zip wp-better-astra-child/
