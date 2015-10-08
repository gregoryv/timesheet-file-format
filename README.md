[![Build Status](https://travis-ci.org/gregoryv/php-timesheet.svg?branch=master)](https://travis-ci.org/gregoryv/php-timesheet)
[![Code Climate](https://codeclimate.com/github/gregoryv/php-timesheet/badges/gpa.svg)](https://codeclimate.com/github/gregoryv/php-timesheet)
[![Test Coverage](https://codeclimate.com/github/gregoryv/php-timesheet/badges/coverage.svg)](https://codeclimate.com/github/gregoryv/php-timesheet/coverage)

README
======

Text timesheet format and library.

* [API reference](http://gregoryv.github.io/php-timesheet/)

File format
-----------

The main goals of the file format are

- human readable
- easily editable with basic text editor
- easy to parse

### Example

The `data` directory contains more example sheets.


    2015 June
    ---------
    23  1 Mon 8
        2 Tue 8
        3 Wed 8
        4 Thu 8
        5 Fri 6 (-2 flex) Ended work 2 hours early, felt sick.
        6 Sat
        7 Sun
    24  8 Mon 8
        9 Tue 8
       10 Wed 8
       11 Thu 8 (7 conference) (1 travel)
       12 Fri 8
       13 Sat
       14 Sun
    25 15 Mon 8
       16 Tue 8
       17 Wed 8
       18 Thu 8
       19 Fri 8
       20 Sat
       21 Sun
    26 22 Mon 8
       23 Tue 8
       24 Wed 8
       25 Thu 8
       26 Fri 8
       27 Sat
       28 Sun
    27 29 Mon 8
       30 Tue 8


Tools
-----

### bin/sum.php

Generates a summary of one given report. For the above example the
summary would be

    sum=174 flex=-2 conference=7 travel=1


### bin/timesheet.php

Renders a timesheet template with for a given month. Each working
day, monday-friday, has 8 hours by default.
