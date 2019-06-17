#!/bin/bash

set -e
set -x

host=recette.gatling.io

destination=$host:gatling/themes/gatling

rm -rf assets
yarn build
cp -R vendor assets/css/
rsync -Pacvz --delete \
  --exclude /.git \
  --exclude /backups \
  --exclude /node_modules \
  --exclude /src \
  --exclude /vendor \
  --exclude .gitignore \
  --exclude gulpfile.js \
  --exclude package.json \
  --exclude publish.sh \
  --exclude yarn.lock \
  ./ ${destination}
