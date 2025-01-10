<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Files.php';

class FilesTest extends TestCase
{
    public function testAssignmentFile()
    {
        $assignment = new Files("assignment", ".word", "ABCDEFGH", "homework");

        $this->assertEquals("200MB", $assignment->getLifetimeBandwidthSize());
        $this->assertEquals("MMMABCDEFGH", $assignment->prependContent("MMM"));
        $this->assertEquals("MMMABhello worldCDEFGH", $assignment->addContent("hello world", 5));
        $this->assertEquals("homework > assignment.word", $assignment->showFileLocation());
    }

    public function testBladeFile()
    {
        $blade = new Files("blade", ".txt", "bg-primary text-white m-0 p-0 d-flex justify-content-center", "view");

        $this->assertEquals("1.475GB", $blade->getLifetimeBandwidthSize());
        $this->assertEquals("bg-primary font-weight-bold text-white m-0 p-0 d-flex justify-content-center", $blade->addContent("font-weight-bold ", 11));
        $this->assertEquals("view > blade.txt", $blade->showFileLocation());
    }
}

// 実行方法
// $ php vendor/bin/phpunit --testdox tests/FilesTest.php