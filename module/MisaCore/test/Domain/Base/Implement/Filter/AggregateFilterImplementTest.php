<?php
namespace MisaCoreTest\Domain\Base\Implement\Filter;

use MisaCoreTest\Domain\Base\Implement\Filter\Fake\FakeFilterA;
use MisaCoreTest\Domain\Base\Implement\Filter\Fake\FakeFilterB;
use MisaCoreTest\Domain\Base\Implement\Filter\Fake\FakeFilterC;
use MisaCoreTest\Domain\Base\Implement\Filter\Fake\FakeFilterD;
use MisaCoreTest\Domain\Base\Implement\Filter\Fake\FakeFilterE;
use MisaCoreTest\Domain\Base\Implement\Filter\Fake\FakeFilterF;
use MisaCoreTest\TestCase;

/**
 * AggregateFilterImplementTest Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class AggregateFilterImplementTest extends TestCase
{
    public function testAgregateBasico()
    {
        $params = [
            'id' => '8',
            'name' => ' jose ',
            'other' => ''
        ];
        $filter = new FakeFilterA();
        $paramsFiltered = $filter->allFilter($params);
        $this->assertEquals(8, $paramsFiltered['id']);
        $this->assertEquals('jose', $paramsFiltered['name']);
        $this->assertEquals('', $paramsFiltered['other']);
    }

    public function testAggregateAnidado()
    {
        $params = [
            'id' => '2',
            'a-id' => null,
            'a-name' => ' jose ',
            'a-other' => '',
        ];
        $filter = new FakeFilterB();
        $paramsFiltered = $filter->allFilter($params);
        $this->assertEquals('2', $paramsFiltered['id']);

        $this->assertEquals('', $paramsFiltered['a-id']);
        $this->assertEquals('jose', $paramsFiltered['a-name']);
        $this->assertEquals('', $paramsFiltered['a-other']);
    }

    public function testAggregateAnidado2niveles()
    {

        $params = [
            'name' => "guillermo ",
            'b-id' => '2',
            'b-a-id' => null,
            'b-a-name' => ' jose ',
            'b-a-other' => '',
        ];
        $filter = new FakeFilterC();
        $paramsFiltered = $filter->allFilter($params);
        $this->assertEquals('guillermo', $paramsFiltered['name']);

        $this->assertEquals(2, $paramsFiltered['b-id']);

        $this->assertEquals('', $paramsFiltered['b-a-id']);
        $this->assertEquals('jose', $paramsFiltered['b-a-name']);
        $this->assertEquals('', $paramsFiltered['b-a-other']);
    }


    public function testCollectionAgregate()
    {
        $params = [
            'name' => "jose ",
            'a' => [
                [
                    'id' => 8,
                    'name' => ' jose ',
                    'other' => ''
                ],
                [
                    'id' => 8,
                    'name' => ' guillermo ',
                ]
            ]
        ];
        $filter = new FakeFilterD();
        $paramsFiltered = $filter->allFilter($params);

        $this->assertEquals('jose', $paramsFiltered['name']);

        $this->assertEquals('8', $paramsFiltered['a'][0]['id']);
        $this->assertEquals('jose', $paramsFiltered['a'][0]['name']);
        $this->assertEquals('', $paramsFiltered['a'][0]['other']);

        $this->assertEquals('8', $paramsFiltered['a'][1]['id']);
        $this->assertEquals('guillermo', $paramsFiltered['a'][1]['name']);
    }


    public function testColecctionAgregateAnidados()
    {

        $params = [
            'name' => "jose ",
            'lastName' => "guillermo ",
            'c' => [
                [
                    'name' => "guillermo ",
                    'b-id' => '1',
                    'b-a-id' => null,
                    'b-a-name' => ' jose ',
                ],
                [
                    'name' => "guillermo2 ",
                    'b-id' => '22',
                    'b-a-id' => null,
                    'b-a-name' => ' jose2 ',
                    'b-a-other' => '2',
                ]
            ]
        ];
        $filter = new FakeFilterE();
        $paramsFiltered = $filter->allFilter($params);

        $this->assertEquals('jose ', $paramsFiltered['name']);
        $this->assertEquals('guillermo', $paramsFiltered['lastName']);

        $this->assertEquals('guillermo', $paramsFiltered['c'][0]['name']);
        $this->assertEquals(1, $paramsFiltered['c'][0]['b-id']);
        $this->assertEquals('', $paramsFiltered['c'][0]['b-a-id']);
        $this->assertEquals('jose', $paramsFiltered['c'][0]['b-a-name']);

        $this->assertEquals('guillermo2', $paramsFiltered['c'][1]['name']);
        $this->assertEquals(22, $paramsFiltered['c'][1]['b-id']);
        $this->assertEquals('', $paramsFiltered['c'][1]['b-a-id']);
        $this->assertEquals('jose2', $paramsFiltered['c'][1]['b-a-name']);
        $this->assertEquals('2', $paramsFiltered['c'][1]['b-a-other']);
    }


    public function testCollectionDeCollection()
    {
        $params = [
            'lastName' => "guillermo ",
            'e' => [
                [
                    'lastName' => ' Jose ',
                    'c' => [
                        [
                            'name' => "guillermo ",
                            'b-id' => '1',
                            'b-a-id' => null,
                            'b-a-name' => ' jose ',
                        ],
                        [
                            'name' => "guillermo2 ",
                            'b-id' => '22',
                            'b-a-id' => null,
                            'b-a-name' => ' jose2 ',
                            'b-a-other' => '2',
                        ]
                    ],
                ],
                [
                    'lastName' => ' Jose ',
                    'c' => [
                        [
                            'name' => "guillermo ",
                            'b-id' => '1',
                            'b-a-id' => null,
                            'b-a-name' => ' jose ',
                        ],
                        [
                            'name' => "guillermo2 ",
                            'b-id' => '22',
                            'b-a-id' => null,
                            'b-a-name' => ' jose2 ',
                            'b-a-other' => '2',
                        ]
                    ],
                ]
            ]
        ];


        $filter = new FakeFilterF();
        $paramsFiltered = $filter->allFilter($params);

        $this->assertEquals('guillermo', $paramsFiltered['lastName']);

        $this->assertEquals('Jose', $paramsFiltered['e'][0]['lastName']);
        $this->assertEquals('guillermo', $paramsFiltered['e'][0]['c'][0]['name']);
        $this->assertEquals(1, $paramsFiltered['e'][0]['c'][0]['b-id']);
        $this->assertEquals('', $paramsFiltered['e'][0]['c'][0]['b-a-id']);
        $this->assertEquals('jose', $paramsFiltered['e'][0]['c'][0]['b-a-name']);


        $this->assertEquals('Jose', $paramsFiltered['e'][1]['lastName']);
        $this->assertEquals('guillermo', $paramsFiltered['e'][1]['c'][0]['name']);
        $this->assertEquals(1, $paramsFiltered['e'][1]['c'][0]['b-id']);
        $this->assertEquals('', $paramsFiltered['e'][1]['c'][0]['b-a-id']);
        $this->assertEquals('jose', $paramsFiltered['e'][1]['c'][0]['b-a-name']);
    }
}
