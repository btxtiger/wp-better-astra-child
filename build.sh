#!/bin/bash

# Create dist folder
mkdir -p dist/wp-better-astra-child

# Clear content of dist folder
rm -rf dist/wp-better-astra-child/*

# Copy files from src to dist/my-plugin
cp -R src/* dist/wp-better-astra-child/

# Run Gulp task
gulp

# Create a ZIP file from dist/my-plugin
cd dist
zip -r wp-better-astra-child.zip wp-better-astra-child/
