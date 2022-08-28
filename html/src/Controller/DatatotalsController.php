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

        $customersByIndustry =  $query->select([
            'business_category_name' => 'BusinessCategories.business_category_name',
            'count' => $query->func()->count('DISTINCT Customers.id')
        ])
        ->group('BusinessCategories.id')
        ->all();
    
        $this->set('customersByIndustry', $customersByIndustry);
    }

    public function salesRankingByProduct()
    {
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

    public function avgCustomerUnitPrice()
    {
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