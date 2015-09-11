#!/bin/bash

cd prints
for f in *; do
    echo "Converting $f"
    convert "$f" -thumbnail x200 "../thmbs/$f"
    convert "$f" -resize x700 "../views/$f"
done
cd ..

