<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Test\Unit\Model\ResourceModel;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Magento\Eav\Model\Entity\Attribute;
use Magento\Catalog\Model\Product\Visibility;
use Meilisearch\Search\Model\ResourceModel\Engine;

class EngineTest extends TestCase
{
    /**
     * @var MockObject
     */
    private MockObject $visibility;

    /**
     * @var MockObject|Attribute
     */
    private MockObject|Attribute $attribute;

    /**
     * @var Engine
     */
    private Engine $engine;

    /**
     * Set up test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->visibility = $this->getMockBuilder(Visibility::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->attribute = $this->getMockBuilder(Attribute::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->engine = new Engine($this->visibility);
    }

    /**
     * Test getAllowedVisibility method.
     *
     * @return void
     */
    public function testGetAllowedVisibility(): void
    {
        $this->visibility->expects($this->once())
            ->method('getVisibleInSiteIds')
            ->willReturn([
                Visibility::VISIBILITY_IN_SEARCH,
                Visibility::VISIBILITY_IN_CATALOG,
                Visibility::VISIBILITY_BOTH
            ]);
        $this->assertEquals(
            [
                Visibility::VISIBILITY_IN_SEARCH,
                Visibility::VISIBILITY_IN_CATALOG,
                Visibility::VISIBILITY_BOTH
            ],
            $this->engine->getAllowedVisibility()
        );
    }

    /**
     * Test allowAdvancedIndex method.
     *
     * @return void
     */
    public function testAllowAdvancedIndex(): void
    {
        $this->assertFalse($this->engine->allowAdvancedIndex());
    }

    /**
     * Test processAttributeValue method.
     *
     * @return void
     */
    public function testProcessAttributeValue(): void
    {
        $this->assertEquals(1, $this->engine->processAttributeValue($this->attribute, 1));
    }

    /**
     * Test prepareEntityIndex method.
     *
     * @return void
     */
    public function testPrepareEntityIndex(): void
    {
        $this->assertEquals([], $this->engine->prepareEntityIndex([], ' '));
    }

    /**
     * Test isAvailable method.
     *
     * @return void
     */
    public function testIsAvailable(): void
    {
        $this->assertTrue($this->engine->isAvailable());
    }
}
