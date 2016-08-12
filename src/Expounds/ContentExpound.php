<?php

namespace Fonsecas72\FailureExpoExtension\Expounds;

use Behat\Mink\Mink;

class ContentExpound extends Expound
{
    public function expose()
    {
        $htmlResponseContent = $this->mink->getSession()->getPage()->getContent();
        $htmlResponseFilename = $screenshotFilename = $this->description.'.html';
        $destination = '';
        file_put_contents(
            $destination.$htmlResponseFilename,
            $htmlResponseContent
        );
        echo PHP_EOL."| HtmlResponse captured ~> ".$htmlResponseFilename;
    }
}
