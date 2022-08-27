<?php
namespace App\Controller;

use App\Model\Table\BusinessCategoriesTable;
use App\Model\Table\CompaniesTable;
use App\Model\Table\CustomersTable;
use App\Model\Table\ProductsTable;

class DatatotalsController extends AppController {
    public function customersByIndustry()
    {
        $query = $this->getBusinessCategories()->find()
            ->leftJoinWith('Companies.Customers');

        $query->select([
            'business_category_name' => 'BusinessCategories.business_category_name',
            'count' => $query->func()->count('DISTINCT Customers.id')
        ])
        ->group('BusinessCategories.id');
        
        $this->set('customersByIndustry', $query->all());
    }

    public function salesRankingByProduct()
    {
        $rankingQuery = $this->getProducts()->find()
            ->leftJoinWith('Sales');

        $ranking = $rankingQuery->select([
            'product_name',
            'unit_price',
            'total_quantity' => $rankingQuery->newExpr()->add('
                IFNULL(SUM(Sales.amount), 0)
            '),
            'total_price' => $rankingQuery->newExpr()->add('
               IFNULL(SUM(Sales.amount) * unit_price, 0)
            '),
            'ranking' => $rankingQuery->newExpr()->add('
                RANK() OVER (ORDER BY unit_price * SUM(Sales.amount) DESC )
            ')
        ])
        ->group(['Products.id'])
        ->order(['total_price' => 'DESC'])
        ->all();

        $this->set('ranking', $ranking);
    }

    public function avgCustomerUnitPrice()
    {
        $spendQuery = $this->getCustomers()->find()
            ->leftJoinWith('Sales.Products');
            
        $customerUnitPrice = $spendQuery
            ->select([
                'name',
                'unit_price' => $spendQuery->newExpr()->add('
                    IFNULL(SUM(Products.unit_price * Sales.amount), 0)
                ')
            ])
            ->group('Customers.id')
            ->order(['unit_price' => 'DESC'])
            ->all();

        $this->set('customerUnitPrice', $customerUnitPrice);
    }

    private function getBusinessCategories(): BusinessCategoriesTable
    {
        return $this->getTableLocator()->get('BusinessCategories');
    }

    private function getProducts(): ProductsTable
    {
        return $this->getTableLocator()->get('Products');
    }

    private function getCustomers(): CustomersTable
    {
        return $this->getTableLocator()->get('Customers');
    }
}