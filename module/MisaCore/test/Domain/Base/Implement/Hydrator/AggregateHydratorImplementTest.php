<?php
/**
 * AggregateHydratorImplementTest Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCoreTest\Domain\Base\Implement\Hydrator;

use MisaCore\Domain\Base\Implement\Hydrator\AggregateHydratorImplement;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\ClassRoom;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\FakeA;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\FakeCollectionA;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\FakeCollectionB;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\Person;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\School;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\Student;
use MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate\Teacher;
use MisaCoreTest\TestCase;

class AggregateHydratorImplementTest extends TestCase
{


    public function testExtractorDeentidadSimple()
    {
        $dataprueba = [
            'name' => 'Jose',
            'lastName' => 'Guillermo',
            'id' => 150];

        $person = new Person();
        $person->setId($dataprueba['id']);
        $person->setName($dataprueba['name']);
        $person->setLastName($dataprueba['lastName']);


        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($person);

        $this->assertEquals($dataprueba, $data);
    }

    public function testHerenciaDeEntidades()
    {
        $dataprueba = [
            'name' => 'Jose',
            'lastName' => 'Guillermo',
            'id' => 150,
            'code-yearBirth' => '1990',
            'code-num' => '159'
        ];
        $teacher = new Teacher();
        $teacher->setId($dataprueba['id']);
        $teacher->setName($dataprueba['name']);
        $teacher->setLastName($dataprueba['lastName']);
        $teacher->getCode()->setYearBirth($dataprueba['code-yearBirth']);
        $teacher->getCode()->setNum($dataprueba['code-num']);
        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($teacher);
        $this->assertEquals($dataprueba, $data);
    }

    public function testExtractorDeAgregatesDentroDeUnaentidad()
    {
        $dataprueba = [
            'name' => 'colegio 1',
            'id' => 12,
            'head-name' => 'Jose',
            'head-lastName' => 'Guillermo',
            'head-id' => 150
        ];

        $headschool = new Person();
        $headschool->setId($dataprueba['head-id']);
        $headschool->setName($dataprueba['head-name']);
        $headschool->setLastName($dataprueba['head-lastName']);

        $school = new School();
        $school->setId($dataprueba['id']);
        $school->setName($dataprueba['name']);
        $school->setHead($headschool);

        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($school);

        $this->assertEquals($dataprueba, $data);
    }

    public function testDobleAggregateEnUnaEntidad()
    {
        $dataprueba = [
            'name' => 'Jose',
            'lastName' => 'Guillermo',
            'id' => 150,
            'codigo' => 2,

            'father-name' => 'father name',
            'father-lastName' => 'father lastname',
            'father-id' => 85,

            'mother-name' => 'father name',
            'mother-lastName' => 'mother lastname',
            'mother-id' => 92,
        ];

        $student = new Student();
        $student->setId($dataprueba['id']);
        $student->setName($dataprueba['name']);
        $student->setLastName($dataprueba['lastName']);
        $student->setCodigo($dataprueba['codigo']);

        $student->getFather()->setLastName($dataprueba['father-lastName']);
        $student->getFather()->setName($dataprueba['father-name']);
        $student->getFather()->setId($dataprueba['father-id']);

        $student->getMother()->setLastName($dataprueba['mother-lastName']);
        $student->getMother()->setName($dataprueba['mother-name']);
        $student->getMother()->setId($dataprueba['mother-id']);

        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($student);

        $this->assertEquals($dataprueba, $data);
    }

    public function testagregateDentroDeOtroAgregate()
    {

        $dataprueba = [
            'name' => 'A-301',
            'id' => 2,
            'teacher-name' => 'Jose',
            'teacher-lastName' => 'Guillermo',
            'teacher-id' => 150,
            'teacher-code-yearBirth' => '1990',
            'teacher-code-num' => '159',
            'students' => [
                ['name' => 'Jose',
                    'lastName' => 'Guillermo',
                    'id' => 150,
                    'codigo' => 2,

                    'father-name' => 'father name',
                    'father-lastName' => 'father lastname',
                    'father-id' => 85,

                    'mother-name' => 'father name',
                    'mother-lastName' => 'mother lastname',
                    'mother-id' => 92,]
            ]
        ];


        $student = new Student();
        $student->setId($dataprueba['students'][0]['id']);
        $student->setName($dataprueba['students'][0]['name']);
        $student->setLastName($dataprueba['students'][0]['lastName']);
        $student->setCodigo($dataprueba['students'][0]['codigo']);
        $student->getFather()->setLastName($dataprueba['students'][0]['father-lastName']);
        $student->getFather()->setName($dataprueba['students'][0]['father-name']);
        $student->getFather()->setId($dataprueba['students'][0]['father-id']);
        $student->getMother()->setLastName($dataprueba['students'][0]['mother-lastName']);
        $student->getMother()->setName($dataprueba['students'][0]['mother-name']);
        $student->getMother()->setId($dataprueba['students'][0]['mother-id']);


        $teacher = new Teacher();
        $teacher->setId($dataprueba['teacher-id']);
        $teacher->setName($dataprueba['teacher-name']);
        $teacher->setLastName($dataprueba['teacher-lastName']);
        $teacher->getCode()->setYearBirth($dataprueba['teacher-code-yearBirth']);
        $teacher->getCode()->setNum($dataprueba['teacher-code-num']);

        $classRoom = new ClassRoom();
        $classRoom->setId($dataprueba['id']);
        $classRoom->setName($dataprueba['name']);
        $classRoom->setTeacher($teacher);

        $classRoom->getStudents()->add($student);


        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($classRoom);

        $this->assertEquals($dataprueba, $data);
    }


    public function testValueobjectHeredados()
    {
        $dataprueba = [
            'a' => 'a',
            'aa' => 'aa',
            'fb-b' => 'b',
            'fb-bb' => 'bb',
            'fb-fc-c' => 'c',
            'fb-fc-cc' => 'cc',
            'fb-fc-fd-d' => 'd',
            'fb-fc-fd-dd' => 'dd',
        ];

        $fakeA = new FakeA();
        $fakeA->setA('a')->setAa('aa');
        $fakeA->getFb()->setB('b')->setBb('bb');
        $fakeA->getFb()->getFc()->setC('c')->setCc('cc');
        $fakeA->getFb()->getFc()->getFd()->setD('d')->setDd('dd');

        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($fakeA);
        $this->assertEquals($dataprueba, $data);
    }


    public function testAgregatesCollection()
    {

        $dataprueba = [
            'a' => [
                0 => [
                    'a' => 'a',
                    'aa' => 'aa',
                    'fb-b' => 'b',
                    'fb-bb' => 'bb',
                    'fb-fc-c' => 'c',
                    'fb-fc-cc' => 'cc',
                    'fb-fc-fd-d' => 'd',
                    'fb-fc-fd-dd' => 'dd',
                ],
                1 => [
                    'a' => 'a',
                    'aa' => 'aa',
                    'fb-b' => 'b',
                    'fb-bb' => 'bb',
                    'fb-fc-c' => 'c',
                    'fb-fc-cc' => 'cc',
                    'fb-fc-fd-d' => 'd',
                    'fb-fc-fd-dd' => 'dd',
                ]
            ],
            'name' => 'hola',
        ];


        $fakeA = new FakeA();
        $fakeA->setA('a')->setAa('aa');
        $fakeA->getFb()->setB('b')->setBb('bb');
        $fakeA->getFb()->getFc()->setC('c')->setCc('cc');
        $fakeA->getFb()->getFc()->getFd()->setD('d')->setDd('dd');

        $fakeCollectionA = new FakeCollectionA();

        $fakeCollectionA->getA()->add($fakeA)->add($fakeA);
        $fakeCollectionA->setName('hola');

        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($fakeCollectionA);

        $this->assertEquals($dataprueba, $data);
    }


    public function testCollectionAnidados()
    {

        $dataprueba = [
            'b' => [
                0 => ['a' => [
                    0 => [
                        'a' => 'a',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd',
                    ],
                    1 => [
                        'a' => 'a',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd',
                    ]
                ],
                    'name' => 'hola',],
                1 => ['a' => [
                    0 => [
                        'a' => 'a',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd',
                    ],
                    1 => [
                        'a' => 'a',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd',
                    ]
                ],
                    'name' => 'hola',],
            ],
            'name' => 'collectionB'

        ];


        $fakeA = new FakeA();
        $fakeA->setA('a')->setAa('aa');
        $fakeA->getFb()->setB('b')->setBb('bb');
        $fakeA->getFb()->getFc()->setC('c')->setCc('cc');
        $fakeA->getFb()->getFc()->getFd()->setD('d')->setDd('dd');

        $fakeCollectionA = new FakeCollectionA();

        $fakeCollectionA->getA()->add($fakeA)->add($fakeA);
        $fakeCollectionA->setName('hola');


        $fakeCollectionB = new FakeCollectionB();

        $fakeCollectionB->setName('collectionB');
        $fakeCollectionB->getB()->add($fakeCollectionA)->add($fakeCollectionA);

        $hydrator = new AggregateHydratorImplement();
        $data = $hydrator->extract($fakeCollectionB);

        $this->assertEquals($dataprueba, $data);
    }

    public function testHydratorBase()
    {
        $dataprueba = [
            'name' => 'Jose',
            'lastName' => 'Guillermo',
            'id' => 150];

        $person = new Person();

        $hydrator = new AggregateHydratorImplement();

        /** @var Person $objPerson */
        $objPerson = $hydrator->hydrate($dataprueba, $person);

        $this->assertEquals($dataprueba['name'], $objPerson->getName());
        $this->assertEquals($dataprueba['lastName'], $objPerson->getLastName());
        $this->assertEquals($dataprueba['id'], $objPerson->getId());
    }


    public function testHydratarAggregateDentroDeOtroAggregate()
    {
        $dataprueba = [
            'name' => 'Jose',
            'lastName' => 'Guillermo',
            'id' => 150,
            'codigo' => 2,

            'father-name' => 'father name',
            'father-lastName' => 'father lastname',
            'father-id' => 85,

            'mother-name' => 'father name',
            'mother-lastName' => 'mother lastname',
            'mother-id' => 92,
        ];

        $student = new Student();

        $hydrator = new AggregateHydratorImplement();

        /** @var Student $objStudent */
        $objStudent = $hydrator->hydrate($dataprueba, $student);

        $this->assertEquals($dataprueba['id'], $objStudent->getId());
        $this->assertEquals($dataprueba['name'], $objStudent->getName());
        $this->assertEquals($dataprueba['lastName'], $objStudent->getLastName());
        $this->assertEquals($dataprueba['codigo'], $objStudent->getCodigo());

        $this->assertEquals($dataprueba['father-name'], $objStudent->getFather()->getName());
        $this->assertEquals($dataprueba['father-lastName'], $objStudent->getFather()->getLastName());
        $this->assertEquals($dataprueba['father-id'], $objStudent->getFather()->getId());

        $this->assertEquals($dataprueba['mother-name'], $objStudent->getMother()->getName());
        $this->assertEquals($dataprueba['mother-lastName'], $objStudent->getMother()->getLastName());
        $this->assertEquals($dataprueba['mother-id'], $objStudent->getMother()->getId());
    }

    public function testHydratadorAnidadoA4Niveles()
    {
        $dataprueba = [
            'a' => 'a',
            'aa' => 'aa',
            'fb-b' => 'b',
            'fb-bb' => 'bb',
            'fb-fc-c' => 'c',
            'fb-fc-cc' => 'cc',
            'fb-fc-fd-d' => 'd',
            'fb-fc-fd-dd' => 'dd',
        ];
        $fakeA = new FakeA();

        $hydrator = new AggregateHydratorImplement();

        /** @var FakeA $objFakeA */
        $objFakeA = $hydrator->hydrate($dataprueba, $fakeA);


        $this->assertEquals($dataprueba['a'], $objFakeA->getA());
        $this->assertEquals($dataprueba['aa'], $objFakeA->getAa());

        $this->assertEquals($dataprueba['fb-b'], $objFakeA->getFb()->getB());
        $this->assertEquals($dataprueba['fb-bb'], $objFakeA->getFb()->getBb());

        $this->assertEquals($dataprueba['fb-fc-c'], $objFakeA->getFb()->getFc()->getC());
        $this->assertEquals($dataprueba['fb-fc-cc'], $objFakeA->getFb()->getFc()->getCc());

        $this->assertEquals($dataprueba['fb-fc-fd-d'], $objFakeA->getFb()->getFc()->getFd()->getD());
        $this->assertEquals($dataprueba['fb-fc-fd-dd'], $objFakeA->getFb()->getFc()->getFd()->getDd());
    }


    public function testCollectionHydrate()
    {
        $dataprueba = [
            'a' => [
                'param1' => [
                    'a' => 'a',
                    'aa' => 'aa',
                    'fb-b' => 'b',
                    'fb-bb' => 'bb',
                    'fb-fc-c' => 'c',
                    'fb-fc-cc' => 'cc',
                    'fb-fc-fd-d' => 'd',
                    'fb-fc-fd-dd' => 'dd',
                ],
                'param2' => [
                    'a' => 'a1',
                    'aa' => 'aa1',
                    'fb-b' => 'b1',
                    'fb-bb' => 'bb1',
                    'fb-fc-c' => 'c1',
                    'fb-fc-cc' => 'cc1',
                    'fb-fc-fd-d' => 'd1',
                    'fb-fc-fd-dd' => 'dd1',
                ]
            ],
            'name' => 'hola',
        ];

        $fakeCollectionA = new FakeCollectionA();

        $hydrator = new AggregateHydratorImplement();

        /** @var FakeCollectionA $objFakeCollectionA */
        $objFakeCollectionA = $hydrator->hydrate($dataprueba, $fakeCollectionA);

        $this->assertEquals($dataprueba['name'], $objFakeCollectionA->getName());

        /** @var FakeA $fakeA0 */
        $fakeA0 = $objFakeCollectionA->getA()->getByKey('param1');

        /** @var FakeA $fakeA1 */
        $fakeA1 = $objFakeCollectionA->getA()->getByKey('param2');

        $this->assertEquals($dataprueba['a']['param1']['a'], $fakeA0->getA());
        $this->assertEquals($dataprueba['a']['param1']['aa'], $fakeA0->getAa());
        $this->assertEquals($dataprueba['a']['param1']['fb-fc-fd-dd'], $fakeA0->getFb()->getFc()->getFd()->getDd());

        $this->assertEquals($dataprueba['a']['param2']['a'], $fakeA1->getA());
        $this->assertEquals($dataprueba['a']['param2']['aa'], $fakeA1->getAa());
        $this->assertEquals($dataprueba['a']['param2']['fb-fc-fd-dd'], $fakeA1->getFb()->getFc()->getFd()->getDd());
    }


    public function testHydratorCollectionDecollection()
    {

        $dataprueba = [
            'b' => [
                0 => ['a' => [
                    0 => [
                        'a' => 'a',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd',
                    ],
                    1 => [
                        'a' => 'a',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd',
                    ]
                ],
                    'name' => 'hola',],
                1 => ['a' => [
                    0 => [
                        'a' => 'a1',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd1',
                    ],
                    1 => [
                        'a' => 'a11',
                        'aa' => 'aa',
                        'fb-b' => 'b',
                        'fb-bb' => 'bb',
                        'fb-fc-c' => 'c',
                        'fb-fc-cc' => 'cc',
                        'fb-fc-fd-d' => 'd',
                        'fb-fc-fd-dd' => 'dd11',
                    ]
                ],
                    'name' => 'hola',],
            ],
            'name' => 'collectionB'

        ];

        $fakeCollectionB = new FakeCollectionB();

        $hydrator = new AggregateHydratorImplement();

        /** @var FakeCollectionB $objFakecollectionB */
        $objFakecollectionB = $hydrator->hydrate($dataprueba, $fakeCollectionB);

        /** @var FakeCollectionA $fakeCollectionA0 */
        $fakeCollectionA0 = $objFakecollectionB->getB()->getByKey(0);

        /** @var FakeA $fakeA00 */
        $fakeA00 = $fakeCollectionA0->getA()->getByKey(0);


        /** @var FakeCollectionA $fakeCollectionA1 */
        $fakeCollectionA1 = $objFakecollectionB->getB()->getByKey(1);

        /** @var FakeA $fakeA11 */
        $fakeA11 = $fakeCollectionA1->getA()->getByKey(1);

        $this->assertEquals($dataprueba['name'], $objFakecollectionB->getName());

        $this->assertEquals($dataprueba['b'][0]['a'][0]['a'], $fakeA00->getA());
        $this->assertEquals($dataprueba['b'][0]['a'][0]['fb-fc-fd-dd'], $fakeA00->getFb()->getFc()->getFd()->getDd());


        $this->assertEquals($dataprueba['b'][1]['a'][1]['a'], $fakeA11->getA());
        $this->assertEquals($dataprueba['b'][1]['a'][1]['fb-fc-fd-dd'], $fakeA11->getFb()->getFc()->getFd()->getDd());
    }
}
