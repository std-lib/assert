<?php
/**
 * @file    AssertTest.php
 * @package {the-ab} IntelliJ IDEA
 * @package Tests\Unit\Std
 * @author  A.B. Carroll <ben@hl9.net>
 */

namespace Tests\Unit\Std;

use \Std\Assert;
use PHPUnit\Framework\TestCase;

class AssertTest extends TestCase
{
    public function testHostnameBlank()
    {
        $this->expectException(\InvalidArgumentException::class);
        \Std\Assert::hostname(" ");
    }

    public function testHostnameWhitespaceOnly()
    {
        $this->expectException(\InvalidArgumentException::class);
        \Std\Assert::hostname(" ");
    }

    public function testHostnameExtraneousDots()
    {
        $this->expectException(\InvalidArgumentException::class);
        \Std\Assert::hostname(".example.org");
    }

    public function testHostnameIsEmail()
    {
        $this->expectException(\InvalidArgumentException::class);
        \Std\Assert::hostname("exmaple@example.org");
    }

    public function testHostnameWhitespaceMiddle()
    {
        $this->expectException(\InvalidArgumentException::class);
        \Std\Assert::hostname("example org");
    }

    public function testHostnameOnePart()
    {
        $this->expectNotToPerformAssertions();
        \Std\Assert::hostname("org");
    }

    public function testHostnameIsIp()
    {
        $this->expectException(\InvalidArgumentException::class);
        \Std\Assert::hostname("10.0.0.1");
    }
}
