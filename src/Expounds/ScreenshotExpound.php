<?php

namespace Fonsecas72\FailureExpoExtension\Expounds;

use Behat\Mink\Mink;

class ScreenshotExpound extends Expound
{
    public function expose()
    {
        $screenshotFilename = $this->description.'.png';
        $screenshotContent = $this->mink->getSession()->getScreenshot();
        $destination = '';
        file_put_contents(
            $destination.$screenshotFilename,
            $screenshotContent
        );
        echo PHP_EOL."| Screenshot captured ~> ".$screenshotFilename;
    }
}
