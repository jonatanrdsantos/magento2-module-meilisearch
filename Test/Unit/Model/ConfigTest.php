<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Meilisearch\Search\Model\Config;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @var MockObject
     */
    private MockObject $scopeConfigMock;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var array<string, string>
     */
    private array $options = [
        'key' => '65742d24d14fc23431bfc1c3f29e24da5e695ff21cdcf877f1a4b271d80de02f',
        'isAjax' => 'true',
        'engine' => 'meilisearch',
        'hostname' => 'localhost',
        'port' => '7700',
        'index' => 'magento2',
        'enableAuth' => '1',
        'timeout' => '15',
        'form_key' => 'gQol1C5I7N3mOHJt',
    ];

    /**
     * Set up test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->scopeConfigMock = $this->getMockBuilder(ScopeConfigInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->config = new Config($this->scopeConfigMock);
    }

    /**
     * Test prepareClientOptions method.
     *
     * @return void
     */
    public function testPrepareClientOptions(): void
    {
        $result = $this->config->prepareClientOptions($this->options);
        $this->assertArrayNotHasKey('key', $result);
        $this->assertArrayNotHasKey('isAjax', $result);
        $this->assertArrayNotHasKey('form_key', $result);
        $this->assertArrayHasKey('hostname', $result);
        $this->assertArrayHasKey('port', $result);
        $this->assertArrayHasKey('index', $result);
        $this->assertArrayHasKey('current_index', $result);
        $this->assertArrayHasKey('enableAuth', $result);
        $this->assertArrayHasKey('master_key', $result);
        $this->assertArrayHasKey('timeout', $result);
        $this->assertArrayHasKey('engine', $result);
    }

    /**
     * Test getServerHostname method.
     *
     * @return void
     */
    public function testGetServerHostname(): void
    {
        $hostname = 'localhost';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with('catalog/search/meilisearch_server_hostname', ScopeInterface::SCOPE_STORE)
            ->willReturn($hostname);
        $result = $this->config->getServerHostname();
        $this->assertEquals($hostname, $result);
    }

    /**
     * Test getServerPort method.
     *
     * @return void
     */
    public function testGetServerPort(): void
    {
        $port = '7700';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with('catalog/search/meilisearch_server_port', ScopeInterface::SCOPE_STORE)
            ->willReturn($port);
        $result = $this->config->getServerPort();
        $this->assertEquals($port, $result);
    }

    /**
     * Test getIndexPrefix method.
     *
     * @return void
     */
    public function testGetIndexPrefix(): void
    {
        $indexPrefix = 'magento2';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with('catalog/search/meilisearch_index_prefix', ScopeInterface::SCOPE_STORE)
            ->willReturn($indexPrefix);
        $result = $this->config->getIndexPrefix();
        $this->assertEquals($indexPrefix, $result);
    }

    /**
     * Test getCurrentIndex method.
     *
     * @return void
     */
    public function testGetCurrentIndex(): void
    {
        $currentIndex = 'magento2_product_1_v2';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with('catalog/search/meilisearch_current_index', ScopeInterface::SCOPE_STORE)
            ->willReturn($currentIndex);
        $result = $this->config->getCurrentIndex();
        $this->assertEquals($currentIndex, $result);
    }

    /**
     * Test isEnableAuth method.
     *
     * @return void
     */
    public function testIsEnableAuth(): void
    {
        $this->scopeConfigMock->expects($this->once())
            ->method('isSetFlag')
            ->with('catalog/search/meilisearch_enable_auth', ScopeInterface::SCOPE_STORE)
            ->willReturn(true);
        $result = $this->config->isEnableAuth();
        $this->assertEquals(true, $result);
    }

    /**
     * Test getMasterKey method.
     *
     * @return void
     */
    public function testGetMasterKey(): void
    {
        $masterKey = '65742d24d14fc23431bfc1c3f29e24da5e695ff21cdcf877f1a4b271d80de02f';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with('catalog/search/meilisearch_master_key', ScopeInterface::SCOPE_STORE)
            ->willReturn($masterKey);
        $result = $this->config->getMasterKey();
        $this->assertEquals($masterKey, $result);
    }

    /**
     * Test getServerTimeout method.
     *
     * @return void
     */
    public function testGetServerTimeout(): void
    {
        $timeout = '15';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with('catalog/search/meilisearch_server_timeout', ScopeInterface::SCOPE_STORE)
            ->willReturn($timeout);
        $result = $this->config->getServerTimeout();
        $this->assertEquals($timeout, $result);
    }
}
