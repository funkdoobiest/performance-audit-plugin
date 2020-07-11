<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PerformanceAudit\tests\Unit\Metric;

require PIWIK_INCLUDE_PATH . '/plugins/PerformanceAudit/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Piwik\Metrics\Formatter;
use Piwik\Plugins\PerformanceAudit\Columns\Metrics\MaxSeconds;
use Piwik\Plugins\PerformanceAudit\Columns\Metrics\MedianSeconds;
use Piwik\Plugins\PerformanceAudit\Columns\Metrics\MinSeconds;

/**
 * @group Metric
 * @group SecondsTest
 * @group PerformanceAudit
 * @group Plugins
 */
class SecondsTest extends TestCase
{
    /** @var Formatter */
    private $formatter;

    public function setUp()
    {
        parent::setUp();

        $this->formatter = new Formatter();
    }

    public function test_max_median_min_seconds_format_as_expected()
    {
        $objs = [
            new MaxSeconds(),
            new MedianSeconds(),
            new MinSeconds()
        ];

        foreach ($objs as $obj) {
            $this->assertSame('0.000', $obj->format(0, $this->formatter));
            $this->assertSame('0.001', $obj->format(1, $this->formatter));
            $this->assertSame('50.125', $obj->format(50125, $this->formatter));
            $this->assertSame('100', $obj->format(100000, $this->formatter));
            $this->assertSame('-100.55', $obj->format(-100550, $this->formatter));
            $this->assertSame('0.000', $obj->format('test', $this->formatter));
        }
    }
}
