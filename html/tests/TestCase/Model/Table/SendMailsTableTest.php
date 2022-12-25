<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SendMailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SendMailsTable Test Case
 */
class SendMailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SendMailsTable
     */
    protected $SendMails;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SendMails',
        'app.Threads',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SendMails') ? [] : ['className' => SendMailsTable::class];
        $this->SendMails = $this->getTableLocator()->get('SendMails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SendMails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SendMailsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SendMailsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
