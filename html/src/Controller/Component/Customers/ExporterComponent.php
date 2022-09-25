<?php

namespace App\Controller\Component\Customers;

use App\Model\Entity\Customer;
use Cake\Controller\Component;
use Cake\Http\CallbackStream;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Exception;
use Psr\Http\Message\StreamInterface;

/**
 * @property \Cake\Controller\Component\PaginatorComponent $Paginator
 */
class ExporterComponent extends Component
{
    public $components = [
        'Paginator'
    ];

    public function getStream(): StreamInterface
    {
        $customers_table = TableRegistry::getTableLocator()->get('Customers');

        return new CallbackStream(function () use ($customers_table) {
            $header = 'customer_cd,name,kana,gender,company_id,zip,prefecture_id,address1,address2,phone,fax,email,lasttrade'."\n";
            echo mb_convert_encoding($header, 'SJIS-win', 'UTF-8');

            // 必ず全pageを処理させるため、intの最大値を使用する。
            // paginateでNotFoundExceptonが投げられたときに処理を終了させる。
            for ($page = 1; $page < PHP_INT_MAX; $page++) {
                try {
                    // 100件ずつ処理する
                    $limit = 100;

                    $customers = $this->Paginator->paginate($customers_table, [
                        'limit' => $limit,
                        'page' => $page
                    ]);

                    $csv = '';
                    foreach ($customers as $c) {
                        assert($c instanceof Customer);
                        $csv .= $c->customer_cd.','.$c->name.','.$c->kana.','.$c->gender.','.$c->company_id.','.$c->zip.','
                             .$c->prefecture_id.','.$c->address1.','.$c->address2.','.$c->phone.','.$c->fax.','.$c->email.','
                             .$c->lasttrade."\n";
                    }
                    echo mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
                } catch (NotFoundException $e) {
                    break;
                }
            }
        });
    }
}
