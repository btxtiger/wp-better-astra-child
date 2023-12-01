#!/bin/bash

# Remove dist folder
rm -rf dist

# Create dist folder
mkdir -p dist/astra-child-jonas

# Copy files from src to dist/my-plugin
cp -R src/* dist/astra-child-jonas/

# Run Gulp task
gulp

# Create a ZIP file from dist/my-plugin
cd dist
zip -r astra-child-jonas.zip astra-child-jonas/
