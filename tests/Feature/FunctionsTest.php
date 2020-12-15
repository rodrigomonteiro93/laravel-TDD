<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Caixa;

class FunctionsTest extends TestCase
{
    public function testSearchInArray(){

        $caixa = new Caixa(['car', 'bag', 'money']);
        $this->assertTrue($caixa->searchInArray('car'));
        $this->assertFalse($caixa->searchInArray('cube'));

    }

    public function testGetItem(){

        $caixa = new Caixa(['cooler', 'mouse']);
        $this->assertEquals('cooler', $caixa->getItem());
        $this->assertEquals('mouse', $caixa->getItem());
        $this->assertNull($caixa->getItem());

    }
    public function testFirstLetter(){

        $caixa = new Caixa(['cooler', 'mouse', 'phone', 'pencil', 'pen']);

        $results = $caixa->firstLetter('p');

        $this->assertCount(3, $results);
        $this->assertContains('phone', $results);
        $this->assertContains('pencil', $results);
        $this->assertContains('pen', $results);
        $this->assertEquals('cooler', $caixa->getItem());

        $this->assertEmpty($caixa->firstLetter('c'));

    }

}
