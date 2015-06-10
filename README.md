[![Build Status](https://travis-ci.org/gregoryv/php-timesheet.svg?branch=master)](https://travis-ci.org/gregoryv/php-timesheet)
[![Test Coverage](https://codeclimate.com/github/gregoryv/php-timesheet/badges/coverage.svg)](https://codeclimate.com/github/gregoryv/php-timesheet/coverage)
[![Code Climate](https://codeclimate.com/github/gregoryv/php-timesheet/badges/gpa.svg)](https://codeclimate.com/github/gregoryv/php-timesheet)

README
======

Text timesheet format and library.

The `data` directory contains example sheets.

* [API reference](http://gregoryv.github.io/php-timesheet/)

File format
-----------

The main goals of the file format are

- human readable
- easily editable with basic text editor
- easy to parse

### Example

    YYYY MonthName
    --------------
    Week Day DayName Hours (hours tag)* [notes]
