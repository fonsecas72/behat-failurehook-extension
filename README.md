# behat-failurehook-extension

This behat extension will trigger actions when your test failed that you can use e.g. to take a screenshot, save the html content, or something more specific as it allows you to add your own thing.


How your behat.yml should look like:
```
default:
    extensions:
        Fonsecas72\FailureExpoExtension:
            expounds:
                - Features\FailureHooks\MySQLDumpExpound
```

You should not need anything else to make it work.

# Adding your own hooks:

E.g. of a hook:

```php 
<?php

namespace Features\FailureHooks;

class MySQLDumpExpound extends \Fonsecas72\FailureExpoExtension\Expounds\Expound
{
    public function expose()
    {
        $fs = new \Symfony\Component\Filesystem\Filesystem();
        $destination = 'build/'.$this->description;
        $fs->mkdir($destination);
        shell_exec('mysqldump -uuser -ppass db > '.$destination.'/dbdump.sql');
        echo PHP_EOL.'| MysqlDump captured ~> '.$destination.'/dbdump.sql';
    }
}
```

# How it works

Your failure-hook should extend `\Fonsecas72\FailureExpoExtension\Expounds\Expound` and implement `expose` method.
This method will be called when a failure occurs.
Failure-hook extension will then expose a special "description" property that identifies the failing scenairo.

