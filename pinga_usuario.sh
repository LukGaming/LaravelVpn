#!/bin/bash
ping  -w 1 -c 1 $1 | grep -Po 'time=.*'  | tee -a $2 2>/dev/null >/dev/null &
