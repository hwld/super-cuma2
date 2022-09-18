<?php

declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Test\Factory\BusinessCategoryFactory;
use App\Test\Factory\CompanyFactory;
use App\Test\Factory\CustomerFactory;
use App\Test\Factory\PrefectureFactory;
use App\Test\Factory\UserFactory;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CustomersController Test Case
 *
 * @uses \App\Controller\CustomersController
 */
class CustomersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    private array $admin_user_session;
    private array $normal_user_session;

    public function setUp(): void
    {
        parent::setUp();

        $admin_user = UserFactory::make(['isAdmin' => true])->getEntity();
        $this->admin_user_session = [
            'Auth' => $admin_user->toArray()
        ];

        $normal_user = UserFactory::make(['isAdmin' => false])->getEntity();
        $this->normal_user_session = [
            'Auth' => $normal_user->toArray()
        ];
    }

    public function tearDown(): void
    {
        parent::tearDown();
        CustomerFactory::make()->deleteAll();
    }

    /**
     * IndexにSessionなしでアクセスした場合、ログイン画面にリダイレクトされる。
     */
    public function testIndexWithoutSession(): void
    {
        $this->get('/customers');
        $this->assertRedirectContains("/users/login");
    }

    /**
     * IndexにSessionありでアクセスした場合、ResponseOkが返ってくる。
     *
     * @return void
     * @uses \App\Controller\CustomersController::index()
     */
    public function testIndexWithSession(): void
    {
        $this->session($this->normal_user_session);

        $this->get('/customers');
        $this->assertResponseOk();
    }

    /**
     * viewにセッションありでアクセスした場合、ResponseOkが返ってくる。
     *
     * @return void
     * @uses \App\Controller\CustomersController::view()
     */
    public function testViewWithSession(): void
    {
        $this->session($this->normal_user_session);

        CustomerFactory::make(['id' => 123])
        ->withCompanyAndPrefecture()
        ->persist();

        $this->get('/customers/view/123');
        $this->assertResponseOk();
    }

    /**
     * 一般ユーザーがaddにアクセスすると、権限エラーが返ってくる。
     */
    public function testGetAddWithNormalUser(): void
    {
        $this->session($this->normal_user_session);

        $this->get('/customers/add');
        $this->assertResponseCode(403);
    }

    /**
     * 管理者ユーザーがaddにアクセスすると、ResponseOkが返ってくる。
     *
     *
     * @return void
     * @uses \App\Controller\CustomersController::add()
     */
    public function testGetAddWithAdminUser(): void
    {
        $this->session($this->admin_user_session);

        $this->get('/customers/add');
        $this->assertResponseOk();
    }

    /**
     * 管理者ユーザーからのaddへのPostで、formデータに対応するエンティティが作成される。
     */
    public function testPostAddWithAdminUser(): void
    {
        $this->enableCsrfToken();
        $this->session($this->admin_user_session);

        $company_id = 22222;
        $prefecture_id = 42;

        // 業種データ、会社データを作成する
        CompanyFactory::make(['id' => $company_id])
        ->with('BusinessCategories', BusinessCategoryFactory::make())
        ->persist();
        // 都道府県データを作成する
        PrefectureFactory::make(['id' => $prefecture_id])->persist();

        $this->assertEquals(0, CustomerFactory::count());

        $this->post('/customers/add', [
            ...CustomerFactory::make([
                'company_id' => $company_id,
                'prefecture_id' => $prefecture_id
            ])->getEntity()->toArray()
        ]);

        $this->assertEquals(1, CustomerFactory::count());
        $this->assertRedirect('/customers');
    }

    /**
     * 存在するcustomerのidを指定したeditへのpostで対応する顧客が更新される。
     *
     * @return void
     * @uses \App\Controller\CustomersController::edit()
     */
    public function testEdit(): void
    {
        $this->enableCsrfToken();
        $this->session($this->admin_user_session);

        CustomerFactory::make(['id' => 123, 'name' => 'test'])->withCompanyAndPrefecture()->persist();

        $this->assertEquals(1, CustomerFactory::count());

        $this->post('/customers/edit/123', [
            'name' => 'updated'
        ]);

        $this->assertEquals(1, CustomerFactory::count());
        $created_customer = CustomerFactory::find()->first()->toArray();
        $this->assertEquals('updated', $created_customer['name']);
    }

    /**
     * 存在するcustomerのidを指定したdeleteへのpostで対応する顧客が削除される。
     *
     * @return void
     * @uses \App\Controller\CustomersController::delete()
     */
    public function testDelete(): void
    {
        $this->enableCsrfToken();
        $this->session($this->admin_user_session);

        CustomerFactory::make(['id' => 100])->withCompanyAndPrefecture()->persist();

        $this->assertEquals(1, CustomerFactory::count());

        $this->post('/customers/delete/100');

        $this->assertEquals(0, CustomerFactory::count());
        $this->assertRedirect('/customers');
    }
}
