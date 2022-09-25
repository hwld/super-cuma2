<?php

namespace App\Controller\Component\Customers;

use App\Model\Table\CustomersTable;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use App\Controller\Component\Customers\ImporterException;
use Cake\Controller\Component;
use Exception;
use Psr\Http\Message\UploadedFileInterface;

class ImporterComponent extends Component
{
    /**
     * @param UploadedFileInterface $csv_file
     * @return int import count
     */
    public function from($csv_file)
    {
        $file_path = TMP . Security::randomString(30);
        $csv_file->moveTo($file_path);

        // アップロードされたファイルがCSVかどうかチェックする
        if (mime_content_type($file_path) !== 'text/csv') {
            throw new ImporterException('No CSV file', ImporterException::NO_CSV_FILE);
        }

        $file = fopen($file_path, 'r');
        if ($file === false) {
            throw new Exception('Could not open file');
        }
        rewind($file);

        $customers_table = TableRegistry::getTableLocator()->get('Customers');
        assert($customers_table instanceof CustomersTable);

        $connection = $customers_table->getConnection();
        $connection->begin();
        $row_count = 0;
        try {
            $is_first = true;
            while (($data = fgetcsv($file, 0, ',')) !== false) {
                if ($is_first) {
                    $is_first = false;
                    continue;
                }

                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                $customer = [
                    'customer_cd' => $data[0],
                    'name' => $data[1],
                    'kana' => $data[2],
                    'gender' => $data[3],
                    'company_id' => $data[4],
                    'zip' => $data[5],
                    'prefecture_id' => $data[6],
                    'address1' => $data[7],
                    'address2' => $data[8],
                    'phone' => $data[9],
                    'fax' => $data[10],
                    'email' => $data[11],
                    'lasttrade' => $data[12],
                ];
                $customer_entity = $customers_table->newEntity($customer);
                if (!$customers_table->save($customer_entity)) {
                    throw new ImporterException("Could not save", ImporterException::COULD_NOT_SAVE);
                };
                $row_count += 1;
            }
        } catch (Exception $e) {
            $connection->rollback();
            throw $e;
        } finally {
            fclose($file);
            unlink($file_path);
        }
        $connection->commit();

        return $row_count;
    }
}
