<?php
/**
 * Created by PhpStorm.
 * User: TeppeiIsayama
 * Date: 2016/03/27
 * Time: 20:34
 */


require __DIR__ . '/../vendor/autoload.php';

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

//tmpファイルのdirを設定
if (!defined('TMP_DIR_PATH')) {
    define('TMP_DIR_PATH', ROOT . DIRECTORY_SEPARATOR . 'tmp');
}

$app = new \CPEDictionaryImporter\Console;

$app->runWithTry($argv);