# PHPUnit tests for Wolf CMS

These are the PHPUnit tests for Wolf CMS. Current status of the tests is very
dirty, simplistic and basic.

The setup of the tests make certain assumptions, mostly path related. These
paths can be found in `bootstrap.php`

When adding new tests, they should not contain paths and environment specific
information. All environment specific data should go into `bootstrap.php`

NOTE: if you're testing in Windows, it doesn't support ANSI escape sequences to
display colors in console, therefore PHPunit output is broken. There are some
workarounds for this, like `ANSICON` app but the easiest way to fix this: 

change `colors="true"` to `colors="false"` in `phpunit.xml`

http://www.wolfcms.org/
http://www.phpunit.de/
