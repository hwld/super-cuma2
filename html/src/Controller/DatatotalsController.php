<?php

namespace App\Controller;

use App\Model\Table\BusinessCategoriesTable;
use App\Model\Table\CustomersTable;
use App\Model\Table\ProductsTable;
use TypeError;

class DatatotalsController extends AppController
{
    /**
     * @return void
     */
    public function customersByIndustry()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->getBusinessCategories()->find()
            ->leftJoinWith('Companies.Customers');

        $customersByIndustry =  $query->select([
            'business_category_name' => 'BusinessCategories.business_category_name',
            'count' => $query->func()->count('DISTINCT Customers.id')
        ])
        ->group('BusinessCategories.id')
        ->all();

        $this->set('customersByIndustry', $customersByIndustry);
    }

    /**
     * @return void
     */
    public function salesRankingByProduct()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->getProducts()->find()
            ->leftJoinWith('Sales');

        $ranking = $query->select([
            'product_name',
            'unit_price',
            'total_quantity' => $query->newExpr()->add(
                'IFNULL(SUM(Sales.amount), 0)'
            ),
            'total_price' => $query->newExpr()->add(
                'IFNULL(SUM(Sales.amount) * unit_price, 0)'
            ),
            'ranking' => $query->newExpr()->add(
                'RANK() OVER (ORDER BY unit_price * SUM(Sales.amount) DESC )'
            )
        ])
        ->group(['Products.id'])
        ->order(['total_price' => 'DESC'])
        ->all();

        $this->set('ranking', $ranking);
    }

    /**
     * @return void
     */
    public function avgCustomerUnitPrice()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->getCustomers()->find()
            ->leftJoinWith('Sales.Products');

        $customerUnitPrice = $query
            ->select([
                'name',
                'unit_price' => $query->newExpr()->add(
                    'IFNULL(SUM(Products.unit_price * Sales.amount), 0)'
                )
            ])
            ->group('Customers.id')
            ->order(['unit_price' => 'DESC'])
            ->all();

        $this->set('customerUnitPrice', $customerUnitPrice);
    }

    private function getBusinessCategories(): BusinessCategoriesTable
    {
        $table =  $this->getTableLocator()->get('BusinessCategories');
        assert($table instanceof BusinessCategoriesTable);
        return $table;
    }

    private function getProducts(): ProductsTable
    {
        $table = $this->getTableLocator()->get('Products');
        assert($table instanceof ProductsTable);
        return $table;
    }

    private function getCustomers(): CustomersTable
    {
        $table =  $this->getTableLocator()->get('Customers');
        assert($table instanceof CustomersTable);
        return $table;
    }
}
