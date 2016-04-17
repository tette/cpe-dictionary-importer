<?php
/**
 * Created by PhpStorm.
 * User: TeppeiIsayama
 * Date: 2016/03/27
 * Time: 20:27
 */

namespace CPEDictionaryImporter\Command;
use CLIFramework\Command;
use CPEDictionaryImporter\Task\DownloadTask;
use CPEDictionaryImporter\Task\ParserTask;

class FetchCommand extends Command
{


    function execute() {

        $downloader = new DownloadTask();

        try {
            if ($xmlFilename = $downloader->download()) {

                $parser = new ParserTask($xmlFilename);
                $parser->parse();
            }
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }

    }


}