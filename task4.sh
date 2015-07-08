#!/bin/bash
cat access.txt |cut -d ' ' -f 1 |sort|uniq -c|wc -l #print no of unique ips
printf '\n'
cat access.txt |cut -d ' ' -f 1 |sort|uniq -c #print unique ips
printf '\n'
awk '{print $9}' access.txt | sort | uniq -c #print unique status codes
