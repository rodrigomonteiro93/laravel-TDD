<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Box;

class FunctionsTest extends TestCase
{
    public function testSearchInArray(){

        $box = new Box(['car', 'bag', 'money']);
        $this->assertTrue($box->searchInArray('car'));
        $this->assertFalse($box->searchInArray('cube'));

    }

    public function testGetItem(){

        $box = new Box(['cooler', 'mouse']);
        $this->assertEquals('cooler', $box->getItem());
        $this->assertEquals('mouse', $box->getItem());
        $this->assertNull($box->getItem());

    }
    public function testFirstLetter(){

        $box = new Box(['cooler', 'mouse', 'phone', 'pencil', 'pen']);

        $results = $box->firstLetter('p');

        $this->assertCount(3, $results);
        $this->assertContains('phone', $results);
        $this->assertContains('pencil', $results);
        $this->assertContains('pen', $results);
        $this->assertEquals('cooler', $box->getItem());

        $this->assertEmpty($box->firstLetter('c'));

    }

}
