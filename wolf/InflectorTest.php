<?php

/**
 * Test class for Inflector.
 */
class InflectorTest extends PHPUnit_Framework_TestCase {

    protected function setUp() { }
    
    protected function tearDown() { }

    public function testCamelize() {
        $expected = 'LikeThisDearReader';
        $actual = Inflector::camelize('like_this_dear_reader');
        $this->assertEquals($expected, $actual);

        $expected = 'likeThisDearReader';
        $actual = Inflector::camelize('like_this_dear_reader');
        $this->assertFalse($expected == $actual);

        $expected = 'LikeThisDearReader';
        $actual = Inflector::camelize('Like_This_Dear_Reader');
        $this->assertEquals($expected, $actual);
    }

    public function testUnderscore() {
        $expected = 'like_this_dear_reader';
        $actual = Inflector::underscore('LikeThisDearReader');
        $this->assertEquals($expected, $actual);

        $actual = Inflector::underscore('likeThisDearReader');
        $this->assertEquals($expected, $actual);

        $actual = Inflector::underscore('LikeThisDearreader');
        $this->assertFalse($expected == $actual);
    }

    public function testHumanize() {
        $expected = 'Like this dear reader';
        $actual = Inflector::humanize('like_this_dear_reader');
        $this->assertEquals($expected, $actual);

        $actual = Inflector::humanize('Like_This_Dear_Reader');
        $this->assertEquals($expected, $actual);

        $actual = Inflector::humanize('likeThis_dear_reader');
        $this->assertFalse($expected == $actual);

        $actual = Inflector::humanize('like_This_dear_reader');
        $this->assertEquals($expected, $actual);

        $actual = Inflector::humanize('like-this_dear_reader');
        $this->assertFalse($expected == $actual);
    }

}

?>