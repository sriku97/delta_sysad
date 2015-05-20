#!/bin/bash
#Delta SysAd task

i=1
NAME="Folder"
for((i=1;i<=100;i++)) #loop to create folders and files
do
    VAR=$NAME$i
    mkdir $VAR
    cd $VAR
    touch $VAR.txt
    cd ..
    chmod -R 700 $VAR
done
