<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReceivedMailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReceivedMailsTable Test Case
 */
class ReceivedMailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReceivedMailsTable
     */
    protected $ReceivedMails;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ReceivedMails',
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
        $config = $this->getTableLocator()->exists('ReceivedMails') ? [] : ['className' => ReceivedMailsTable::class];
        $this->ReceivedMails = $this->getTableLocator()->get('ReceivedMails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ReceivedMails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReceivedMailsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ReceivedMailsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
