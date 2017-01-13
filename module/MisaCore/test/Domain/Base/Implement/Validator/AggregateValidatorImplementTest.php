<?php
namespace MisaCoreTest\Domain\Base\Implement\Validator;

use MisaCore\Domain\Base\Exception\RepErrorException;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCoreTest\Domain\Base\Implement\Validator\Fake\FakeValidatorA;
use MisaCoreTest\Domain\Base\Implement\Validator\Fake\FakeValidatorB;
use MisaCoreTest\Domain\Base\Implement\Validator\Fake\FakeValidatorC;
use MisaCoreTest\Domain\Base\Implement\Validator\Fake\FakeValidatorD;
use MisaCoreTest\Domain\Base\Implement\Validator\Fake\FakeValidatorE;
use MisaCoreTest\Domain\Base\Implement\Validator\Fake\FakeValidatorF;
use MisaCoreTest\TestCase;

/**
 * AggregateFilterImplementTest Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class AggregateValidatorImplementTest extends TestCase
{

    public function testAgregateBasico()
    {
        $params = [
            'id' => '12345678901234',
            'name' => ' jose',
            'other' => ''
        ];
        $validator = new FakeValidatorA();
        $isValid = $validator->isValid($params);
        $this->assertEquals(true, $isValid);
    }

    public function testAgregateBasicoErrorCatch()
    {
        $params = [
            'id' => '8',
            'name' => ' j',
            'other' => ''
        ];
        $validator = new FakeValidatorA();

        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertCount(2, $messages);
            $this->assertTrue(isset($messages['name']['stringMinMax']));
        }
    }

    public function testAgregateBasico2Errores()
    {
        $params = [
            'id' => 'hola',
            'name' => ' j',
            'other' => ''
        ];
        $validator = new FakeValidatorA();

        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(2, count($messages));

            $this->assertEquals(
                true,
                isset($messages['id']['noCorrect'])
            );

            $this->assertEquals(
                true,
                isset($messages['name']['stringMinMax'])
            );
        }
    }


    public function testAgregateBasicoErrorRequired()
    {
        $params = [
            'id' => '12345678901234',
        ];
        $validator = new FakeValidatorA();

        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(1, count($messages));
            $this->assertEquals(true, isset($messages['name']));
            $this->assertEquals(true, isset($messages['name']['required']));
            $this->assertEquals(1, count($messages['name']));
        }
    }


    public function testValidatorAggregateAnidadoNivel2Error()
    {
        $params = [
            'id' => '2',
            'a-id' => '8',
            'a-name' => 'j',
        ];
        $validator = new FakeValidatorB();

        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(3, count($messages));
            $this->assertEquals(true, isset($messages['id']['noCorrect']));
            $this->assertEquals(true, isset($messages['a-id']));
            $this->assertEquals(true, isset($messages['a-name']));
        }
    }


    public function testValidatorAggregateAnidadoNivel2RequiredError()
    {
        $params = [
            'id' => '12345678901234',
            'a-id' => '12345678901234',
        ];
        $validator = new FakeValidatorB();
        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(
                1,
                count($messages)
            );
            $this->assertEquals(
                1,
                count($messages['a-name'])
            );
            $this->assertEquals(
                true,
                isset($messages['a-name'])
            );
            $this->assertEquals(
                true,
                isset($messages['a-name']['required'])
            );
        }
    }

    public function testValidatorAggregateAnidadoNivel2Ok()
    {
        $params = [
            'id' => '12345678901234',
            'a-id' => '12345678901234',
            'a-name' => 'jose',
        ];
        $validator = new FakeValidatorB();
        $isValid = $validator->isValid($params);
        $this->assertTrue($isValid);
    }

    public function testValidatorAggregateanidadoNivel3Error()
    {
        $params = [
            'name' => "g",
            'b-id' => '2',
            'b-a-id' => '1',
            'b-a-name' => 'j',
        ];
        $validator = new FakeValidatorC();
        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(4, count($messages));

            $this->assertEquals(true, isset($messages['name']['stringMinMax']));
            $this->assertEquals(true, isset($messages['b-id']['noCorrect']));
            $this->assertEquals(true, isset($messages['b-a-id']['noCorrect']));
            $this->assertEquals(true, isset($messages['b-a-name']['stringMinMax']));
        }
    }

    public function testValidatorAggregateanidadoNivel3ErrorRequired()
    {
        $params = [
            'name' => "guillermo",
            'b-id' => '12345678901234',
            'b-a-id' => '12345678901234',
        ];
        $validator = new FakeValidatorC();
        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(1, count($messages));
            $this->assertEquals(true, isset($messages['b-a-name']['required']));
            $this->assertEquals(1, count($messages['b-a-name']));
        }
    }

    public function testValidatorAggregateanidadoNivel3ErrorRequiredEmpty()
    {
        $params = [
            'name' => "guillermo",
            'b-id' => '12345678901234',
            'b-a-id' => '12345678901234',
            'b-a-name' => '',
        ];
        $validator = new FakeValidatorC();
        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(1, count($messages));
            $this->assertEquals(true, isset($messages['b-a-name']['required']));
            $this->assertEquals(1, count($messages['b-a-name']));
        }
    }

    public function testValidatorAggregateanidadoNivel3Ok()
    {
        $params = [
            'name' => "guillermo",
            'b-id' => '12345678901234',
            'b-a-id' => '12345678901234',
            'b-a-name' => 'jose',
        ];
        $validator = new FakeValidatorC();
        $isValid = $validator->isValid($params);
        $this->assertTrue($isValid);
    }


    public function testcollectionAggregateError()
    {
        $params = [
            'name' => "j",
            'a' => [
                'item1' => [
                    'id' => '12345678901234',
                    'name' => 'j',
                    'other' => ''
                ],
                'item2' => [
                    'id' => '7',
                    'name' => 'gguillermo',
                ]
            ]
        ];
        $validator = new FakeValidatorD();
        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(true, isset($messages['name']));
            $this->assertEquals(true, isset($messages['a']['item1']['name']));
            $this->assertEquals(true, isset($messages['a']['item2']['id']));
            $this->assertEquals(2, count($messages));
            $this->assertEquals(2, count($messages['a']));
        }
    }


    public function testcollectionAggregateOk()
    {
        $params = [
            'name' => "Jguillermo",
            'a' => [
                'item1' => [
                    'id' => '12345678901234',
                    'name' => 'joseGuillermo',
                    'other' => ''
                ],
                'item2' => [
                    'id' => '12345678901234',
                    'name' => 'guillermo',
                ]
            ]
        ];
        $validator = new FakeValidatorD();
        $isValid = $validator->isValid($params);
        $this->assertTrue($isValid);
    }

    public function testCollectionAggregateAggregateError()
    {
        $params = [
            'lastName' => "j",
            'c' => [
                'item1' => [
                    'name' => "g",
                    'b-id' => '1',
                    'b-a-id' => '2',
                    'b-a-name' => 'j',
                ],
                'item2' => [
                    'name' => "gguillermo",
                    'b-id' => '2',
                    'b-a-id' => '2',
                    'b-a-name' => 'j2',
                    'b-a-other' => '2',
                ]
            ]
        ];
        $validator = new FakeValidatorE();
        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertEquals(true, isset($messages['lastName']));
            $this->assertEquals(true, isset($messages['c']));
            $this->assertEquals(true, isset($messages['c']['item1']['name']));
            $this->assertEquals(true, isset($messages['c']['item1']['b-a-name']));
            $this->assertEquals(true, isset($messages['c']['item2']['b-id']));
            $this->assertEquals(true, isset($messages['c']['item2']['b-a-name']));

            $this->assertEquals(2, count($messages));
            $this->assertEquals(4, count($messages['c']['item1']));
            $this->assertEquals(3, count($messages['c']['item2']));
        }
    }

    public function testCollectionAggregateAggregateOk()
    {
        $params = [
            'lastName' => "joseGuiller",
            'c' => [
                'item1' => [
                    'name' => "gguillermo",
                    'b-id' => '12345678901234',
                    'b-a-id' => '12345678901234',
                    'b-a-name' => 'jose',
                ],
                'item2' => [
                    'name' => "guillermo",
                    'b-id' => '12345678901234',
                    'b-a-id' => '12345678901234',
                    'b-a-name' => 'jose2',
                    'b-a-other' => '2',
                ]
            ]
        ];
        $validator = new FakeValidatorE();
        $isValid = $validator->isValid($params);
        $this->assertTrue($isValid);
    }


    public function testCollectionDeCollectionError()
    {
        $params = [
            'lastName' => "g",
            'e' => [
                'itemA' => [
                    'lastName' => 'j',
                    'c' => [
                        'item1' => [
                            'name' => "g",
                            'b-id' => '1',
                            'b-a-id' => '2',
                            'b-a-name' => 'j',
                        ],
                        'item2' => [
                            'name' => "g",
                            'b-id' => '2',
                            'b-a-id' => '2',
                            'b-a-name' => 'j',
                            'b-a-other' => '2',
                        ]

                    ]
                ],
                'itemB' => [
                    //'lastName'=>'g',
                    'c' => [
                        'item3' => [
                            'name' => "g",
                            'b-id' => '1',
                            'b-a-id' => '1',
                            'b-a-name' => 'j',
                        ],
                        'item4' => [
                            'name' => "g2",
                            'b-id' => '2',
                            'b-a-id' => '2',
                            'b-a-name' => 'j2',
                            'b-a-other' => '2',
                        ]
                    ]
                ]
            ]
        ];


        $validator = new FakeValidatorF();
        try {
            $isValid = $validator->isValid($params);
            $this->assertTrue(false);
        } catch (SrvErrorException $e) {
            $messages = $e->getListError();
            $this->assertTrue(isset($messages['lastName']));

            $this->assertTrue(isset($messages['e']));

            $this->assertTrue(isset($messages['e']['itemA']['lastName']['stringMinMax']));
            $this->assertTrue(isset($messages['e']['itemA']['c']));
            $this->assertTrue(isset($messages['e']['itemA']['c']['item1']));
            $this->assertTrue(isset($messages['e']['itemA']['c']['item1']['name']['stringMinMax']));
            $this->assertTrue(isset($messages['e']['itemA']['c']['item2']['b-a-name']['stringMinMax']));
            $this->assertTrue(isset($messages['e']['itemB']['lastName']['required']));
            $this->assertTrue(isset($messages['e']['itemB']['c']['item3']['b-a-name']['stringMinMax']));
            $this->assertEquals(2, count($messages));
            $this->assertEquals(2, count($messages['e']['itemA']));
            $this->assertEquals(2, count($messages['e']['itemB']));
        }
    }


    public function testCollectionDeCollectionOk()
    {
        $params = [
            'lastName' => "guillermo",
            'e' => [
                'itemA' => [
                    'lastName' => 'joseGuill',
                    'c' => [
                        'item1' => [
                            'name' => "guillermo",
                            'b-id' => '12345678901234',
                            'b-a-id' => '12345678901234',
                            'b-a-name' => 'jose',
                        ],
                        'item2' => [
                            'name' => "guillermo",
                            'b-id' => '12345678901234',
                            'b-a-id' => '12345678901234',
                            'b-a-name' => 'jose',
                            'b-a-other' => 2,
                        ]

                    ]
                ],
                'itemB' => [
                    'lastName' => 'joseGuill',
                    'c' => [
                        'item3' => [
                            'name' => "gguillermo",
                            'b-id' => '12345678901234',
                            'b-a-id' => '12345678901234',
                            'b-a-name' => 'jose',
                        ],
                        'item4' => [
                            'name' => "guillermo",
                            'b-id' => '12345678901234',
                            'b-a-id' => '12345678901234',
                            'b-a-name' => 'jose',
                            'b-a-other' => 2,
                        ]
                    ]
                ]
            ]
        ];


        $validator = new FakeValidatorF();
        $isValid = $validator->isValid($params);
        $this->assertTrue($isValid);
    }
}
