<?php
/**
 * Created by PhpStorm.
 * User: TeppeiIsayama
 * Date: 2016/03/27
 * Time: 20:21
 */

namespace CPEDictionaryImporter;

use CLIFramework\Application;

class Console extends Application
{

    /**
     * コマンドにサブコマンドをアタッチ
     */
    public function init() {
        parent::init();

        $this->command('fetch');
        $this->command('parse');
    }


}