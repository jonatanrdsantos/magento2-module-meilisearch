<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Test\Unit\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Meilisearch\Search\Block\Adminhtml\System\Config\TestConnection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class TestConnectionTest extends TestCase
{
    /**
     * @var array|string[]
     */
    private array $fields = [
        'engine' => 'catalog_search_engine',
        'hostname' => 'catalog_search_meilisearch_server_hostname',
        'port' => 'catalog_search_meilisearch_server_port',
        'index' => 'catalog_search_meilisearch_index_prefix',
        'enableAuth' => 'catalog_search_meilisearch_enable_auth',
        'master_key' => 'meilisearch_master_key',
        'timeout' => 'catalog_search_meilisearch_server_timeout',
    ];

    /**
     * @var Context|MockObject
     */
    private Context|MockObject $context;

    /**
     * Set up test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Test _getFieldMapping method.
     *
     * @return void
     */
    public function test_getFieldMapping():void
    {
        $class = new ReflectionClass(TestConnection::class);
        $method = $class->getMethod('_getFieldMapping');
        $method->setAccessible(true);
        $testConnection = new TestConnection($this->context);
        $result = $method->invoke($testConnection);
        $this->assertEquals($this->fields, $result);
    }
}
