<?php
/**
 * Created by PhpStorm.
 * User: TeppeiIsayama
 * Date: 2016/03/27
 * Time: 21:41
 */

namespace CPEDictionaryImporter\Task;

use DiDom\Document;
use DiDom\Query;

class ParserTask
{

    /** @var null|string  */
    public $xmlFilePath = null;

    /**
     * Parser constructor.
     *
     * @param $xmlFilePath string XmlFilePath
     * @throws \Exception
     */
    public function __construct($xmlFilePath)
    {
        if ($xmlFilePath) {
            $this->xmlFilePath = $xmlFilePath;
        } else {
            throw new \Exception('Required argument #1 is missing');
        }
    }


    function parse() {



        $document = new Document($this->xmlFilePath, true);

        foreach ($document->find('cpe-item') as $item) {
            $title = $item->find('title[zml:lang=en-US]', Query::TYPE_CSS)[0]->text();
            var_dump($title);

        }


    }




}