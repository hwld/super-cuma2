<?php

namespace App\Controller\Component\Customers;

use App\Model\Table\CustomersTable;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use App\Controller\Component\Customers\ImporterException;
use App\Service\CsvReader;
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
        $customers_table = TableRegistry::getTableLocator()->get('Customers');
        assert($customers_table instanceof CustomersTable);
        $connection = $customers_table->getConnection();
        $connection->begin();

        $row_count = 0;
        $reader = CsvReader::from($csv_file);
        $reader->setSkipHeader();
        try {
            while (($data = $reader->readLine()) !== null) {
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
        }
        $connection->commit();

        return $row_count;
    }
}
