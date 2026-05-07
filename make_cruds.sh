#!/usr/bin/expect -f
spawn php bin/console make:admin:crud
expect "Which Doctrine entity"
send "User\r"
expect "Which directory"
send "\r"
expect "Namespace"
send "\r"

spawn php bin/console make:admin:crud
expect "Which Doctrine entity"
send "Currency\r"
expect "Which directory"
send "\r"
expect "Namespace"
send "\r"

spawn php bin/console make:admin:crud
expect "Which Doctrine entity"
send "Customer\r"
expect "Which directory"
send "\r"
expect "Namespace"
send "\r"

spawn php bin/console make:admin:crud
expect "Which Doctrine entity"
send "Product\r"
expect "Which directory"
send "\r"
expect "Namespace"
send "\r"

spawn php bin/console make:admin:crud
expect "Which Doctrine entity"
send "Invoice\r"
expect "Which directory"
send "\r"
expect "Namespace"
send "\r"

expect eof
