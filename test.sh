#!/bin/sh
for d in *; do
  if [ -d "$d" ]; then
    echo "$d"
  fi
done