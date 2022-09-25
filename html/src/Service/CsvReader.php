<?php

namespace App\Service;

use App\Controller\Component\Customers\ImporterException;
use Cake\Utility\Security;
use Exception;
use Psr\Http\Message\UploadedFileInterface;

class CsvReader
{
    /** @var string */
    private $temp_path = '';

    /** @var null|resource */
    private $temp_file = null;

    /** @var bool */
    private $skip_header = false;

    /** @var bool */
    private $is_new_line = true;

    public static function from(UploadedFileInterface $file): CsvReader
    {
        $reader = new CsvReader();
        $reader->open($file);
        return $reader;
    }

    public function setSkipHeader(): void
    {
        $this->skip_header = true;
    }

    private function open(UploadedFileInterface $file): void
    {
        $file->moveTo($this->temp_path);

        //ファイルがcsvかどうかチェックする
        if (mime_content_type($this->temp_path) !== 'text/csv') {
            throw new ImporterException('No CSV file', ImporterException::NO_CSV_FILE);
        }

        $file = fopen($this->temp_path, 'r');
        if ($file === false) {
            throw new Exception('Could not open file');
        }
        rewind($file);

        $this->temp_file = $file;
    }

    /**
     * @return array|null
     */
    public function readLine()
    {
        if (is_null($this->temp_file)) {
            throw new Exception('File not open');
        }

        $data = fgetcsv($this->temp_file, 0, ',');
        if ($data === false) {
            return null;
        }

        // 最初の行で、ヘッダの読み飛ばしが設定されていたら
        // 再帰的に呼び出して次の行を処理させる。
        if ($this->is_new_line) {
            $this->is_new_line = false;
            if ($this->skip_header) {
                return $this->readLine();
            }
        }

        mb_convert_variables('UTF-8', 'SJIS-win', $data);
        return $data;
    }

    private function __construct()
    {
        $this->temp_path = TMP . Security::randomString(30);
    }

    public function __destruct()
    {
        if (!is_null($this->temp_file)) {
            fclose($this->temp_file);
        }

        if (file_exists($this->temp_path)) {
            unlink($this->temp_path);
        }
    }
}
