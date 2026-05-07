#!/usr/bin/expect -f
spawn php bin/console make:entity Currency
expect "New property name"
send "code\r"
expect "Field type"
send "string\r"
expect "Field length"
send "3\r"
expect "Can this field be null"
send "no\r"
expect "New property name"
send "exchangeRate\r"
expect "Field type"
send "float\r"
expect "Can this field be null"
send "no\r"
expect "New property name"
send "\r"
expect eof
