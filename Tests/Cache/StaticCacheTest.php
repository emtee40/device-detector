<?php

/**
 * Device Detector - The Universal Device Detection library for parsing User Agents
 *
 * @link https://matomo.org
 *
 * @license http://www.gnu.org/licenses/lgpl.html LGPL v3 or later
 */

declare(strict_types=1);

namespace DeviceDetector\Tests\Cache;

use DeviceDetector\Cache\StaticCache;
use PHPUnit\Framework\TestCase;

class StaticCacheTest extends TestCase
{
    protected function setUp(): void
    {
        $cache = new StaticCache();
        $cache->flushAll();
    }

    public function testSetNotPresent(): void
    {
        $cache = new StaticCache();
        $this->assertFalse($cache->fetch('NotExistingKey'));
    }

    public function testSetAndGet(): void
    {
        $cache = new StaticCache();

        // add entry
        $cache->save('key', 'value');
        $this->assertEquals('value', $cache->fetch('key'));

        // change entry
        $cache->save('key', 'value2');
        $this->assertEquals('value2', $cache->fetch('key'));

        // remove entry
        $cache->delete('key');
        $this->assertFalse($cache->fetch('key'));

        // flush all entries
        $cache->save('key', 'value2');
        $cache->save('key3', 'value2');
        $cache->flushAll();
        $this->assertFalse($cache->fetch('key'));
        $this->assertFalse($cache->fetch('key3'));
    }
}
