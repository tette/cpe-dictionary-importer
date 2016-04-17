<?php
/**
 * Created by PhpStorm.
 * User: TeppeiIsayama
 * Date: 2016/04/17
 * Time: 19:49
 */

namespace CPEDictionaryImporter\Command;


use CLIFramework\Command;
use CPEDictionaryImporter\Task\ParserTask;

class ParseCommand extends Command
{

    public function execute()
    {

        $xmlFilename = TMP_DIR_PATH . DIRECTORY_SEPARATOR . 'official-cpe-dictionary_v2.3.xml';
        $parser = new ParserTask($xmlFilename);
        $parser->parse();
    }

}