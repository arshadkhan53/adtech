#!/bin/bash

git remote -v
git remote add upstream ${{ secrets.UPSTREAM_ORIGIN }}
git remote -v
git status
