#!/bin/bash

porigin = echo $UPSTREAM_ORIGIN
git remote -v
git remote add upstream "${porigin}"
git remote -v
git status
