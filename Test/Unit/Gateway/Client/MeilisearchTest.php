<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Test\Unit\Gateway\Client;

use MeiliSearch\Client;
use MeiliSearch\ClientFactory;
use Meilisearch\Search\Gateway\Client\Meilisearch;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MeilisearchTest extends TestCase
{
    /**
     * @var MockObject
     */
    private MockObject $client;

    /**
     * @var MockObject
     */
    private MockObject $clientFactory;

    /**
     * @var Meilisearch
     */
    private Meilisearch $meilisearch;

    /**
     * @var array
     */
    private array $options = [
        'hostname' => 'localhost',
        'port' => '7700',
        'master_key' => 'MASTER_KEY'
    ];

    /**
     * Set up test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->client = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->clientFactory = $this->getMockBuilder(ClientFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->meilisearch = new Meilisearch($this->clientFactory, $this->options);
    }

    /**
     * Test testConnection but with provided meilisearch client method.
     *
     * @return void
     */
    public function testClientOnConstructor():void
    {
        $isHealthy = true;
        $this->client->expects($this->once())->method('isHealthy')->willReturn($isHealthy);
        $meilisearch = new Meilisearch($this->clientFactory, $this->options, $this->client);
        $result = $meilisearch->testConnection();
        $this->assertEquals($isHealthy, $result);
    }

    /**
     * Test testConnection method.
     *
     * @return void
     */
    public function testTestConnection(): void
    {
        $isHealthy = true;
        $this->client->expects($this->once())->method('isHealthy')->willReturn($isHealthy);
        $this->clientFactory->expects($this->once())
            ->method('create')
            ->with([
                'url' => $this->options['hostname'] . ':' . $this->options['port'],
                'apiKey' => $this->options['master_key']
            ])
            ->willReturn($this->client);
        $result = $this->meilisearch->testConnection();
        $this->assertEquals($isHealthy, $result);
    }
}
