<?php
/**
 * Created by PhpStorm.
 * User: TeppeiIsayama
 * Date: 2016/03/27
 * Time: 20:50
 */

namespace CPEDictionaryImporter\Task;

use CLIFramework\Logger;
use Ramsey\Uuid\Uuid;

class DownloadTask
{

    public function download() {

        $dictionaryUrl = "https://static.nvd.nist.gov/feeds/xml/cpe/dictionary/official-cpe-dictionary_v2.3.xml.zip";

        $tempFileUuid = Uuid::uuid4()->toString();
        $downloadedZipPath = TMP_DIR_PATH . DIRECTORY_SEPARATOR . $tempFileUuid . '.zip';

        $logger = new Logger();

        $fp = fopen($downloadedZipPath, 'w+');

        $ch = curl_init($dictionaryUrl);

        curl_setopt($ch, CURLOPT_FILE, $fp);


        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION,
            function($resource, $download_size, $downloaded, $upload_size, $uploaded) use ($logger)
        {
            if($download_size > 0) {

                $percent = $downloaded / $download_size  * 100;

                $logger->writef('Download progress: %0.2f done.', $percent);
                $logger->newline();

            }
        });
        curl_setopt($ch, CURLOPT_NOPROGRESS, false); // needed to make progress function work

        curl_exec($ch); // get curl response
        curl_close($ch);
        fclose($fp);

        $zipArchive = new \ZipArchive();

        $res = $zipArchive->open($downloadedZipPath);

        if ($res === true) {
            $xmlDistPath = TMP_DIR_PATH . DIRECTORY_SEPARATOR;
            $zipArchive->extractTo($xmlDistPath, ['official-cpe-dictionary_v2.3.xml']);

            $zipArchive->close();

            $downloadedXmlPath = $xmlDistPath . 'official-cpe-dictionary_v2.3.xml';
            if (is_file($downloadedXmlPath)) {
                $this->unlink($downloadedZipPath);

                return $downloadedXmlPath;
            }
        }

        if (is_file($downloadedZipPath)) {
            $this->unlink($downloadedZipPath);
        }
        throw new \Exception('File');

    }

    public function unlink($filename) {
        return unlink($filename);
    }



}