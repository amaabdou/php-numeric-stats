# PHP functions count stats
  
This is a very limited bad tool to get the count of functions in PHP files in current dir and sub dirs,
excluding version control dirs, unreadable files, all (vendor, tests, Tests) directories
  
## Usage

```
$ PhpNumStats.phar | sort -rn
  0 | functions found in file     1/1708|autoload.php
  5 | functions found in file     2/1708|symfony/polyfill-php72/bootstrap.php
  7 | functions found in file     3/1708|symfony/polyfill-php72/Php72.php
 40 | functions found in file     4/1708|symfony/polyfill-mbstring/Mbstring.php
 37 | functions found in file     5/1708|symfony/polyfill-mbstring/bootstrap.php
  0 | functions found in file     6/1708|symfony/polyfill-mbstring/Resources/unidata/lowerCase.php
  0 | functions found in file     7/1708|symfony/polyfill-mbstring/Resources/unidata/titleCaseRegexp.php
  0 | functions found in file     8/1708|symfony/polyfill-mbstring/Resources/unidata/upperCase.php
  1 | functions found in file     9/1708|symfony/filesystem/Exception/FileNotFoundException.php
  0 | functions found in file    10/1708|symfony/filesystem/Exception/InvalidArgumentException.php
  2 | functions found in file    11/1708|symfony/filesystem/Exception/IOException.php
  1 | functions found in file    12/1708|symfony/filesystem/Exception/IOExceptionInterface.php
  0 | functions found in file    13/1708|symfony/filesystem/Exception/ExceptionInterface.php
 24 | functions found in file    14/1708|symfony/filesystem/Filesystem.php
  2 | functions found in file    15/1708|symfony/filesystem/Tests/Fixtures/MockStream/MockStream.php
```


You can use it with other Linux tools like "sort",           
for example to get files ordered descendant

```
$ PhpNumStats.phar | sort -rn | head
164 | functions found in file   823/1320|nikic/php-parser/lib/PhpParser/PrettyPrinter/Standard.php
162 | functions found in file  1140/1320|phpunit/phpunit/src/Framework/Assert/Functions.php
156 | functions found in file  1145/1320|phpunit/phpunit/src/Framework/Assert.php
122 | functions found in file  1151/1320|phpunit/phpunit/src/Framework/TestCase.php
 78 | functions found in file   495/1320|webmozart/assert/src/Assert.php
 66 | functions found in file   345/1320|symfony/dependency-injection/ContainerBuilder.php
 61 | functions found in file  1147/1320|phpunit/phpunit/src/Framework/TestResult.php
 59 | functions found in file   410/1320|symfony/dependency-injection/Definition.php
 44 | functions found in file   341/1320|symfony/dependency-injection/Dumper/PhpDumper.php
```

The command output is awk and command line friendly,    
because I did not have time to add any options at all

the project is licensed under [BSD 3-Clause License](LICENSE)