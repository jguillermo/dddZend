<?php
namespace MisaCore\Domain\Base\Implement\Validator;

use MisaCore\Domain\Base\Aggregate\ValueObject;
use MisaCore\Domain\Base\Dto\ValidatorDto;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Base\Implement\Hydrator\AggregateHydratorImplement;
use MisaCore\Domain\Base\Validator\AggregateValidator;

/**
 * AggregateValidatorImplement Class
 *
 * @package MisaCore\Domain\Base\Implement\Validator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class AggregateValidatorImplement implements AggregateValidator
{
    /** @var string  */
    private $prefix;

    /** @var ValidatorDto  */
    private $dto;

    /**
     * AggregateValidatorImplement constructor.
     */
    public function __construct()
    {
        $this->prefix = "";
    }

    /**
     * @param $name
     * @param string $message
     * @return AggregateValidatorImplement
     */
    private function setMessage($name, $message)
    {
        /**
         * se limpian los demas errores en caso que se encuentre una
         * validacion de required
         */
        if (isset($message['required'])) {
            $message = ['required' => $message['required']];
        }
        $this->dto->mesagge()->set($name, $message);
    }


    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }


    /**
     * @param string $prefix
     * @return AggregateValidatorImplement
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @param array $params
     * @return bool
     * @throws SrvErrorException
     */
    public function isValid(array $params)
    {

        $this->dto = $this->getDto(true);
        $this->dto = $this->processDto($this->elementValidate($params), $this->dto);
        $this->dto = $this->processDto($this->elementAggregateValidate($params), $this->dto);
        $this->dto = $this->processDto($this->elementCollectionValidate($params), $this->dto);

        if (! $this->dto->isOk()) {
            throw new SrvErrorException("error en la validacion", $this->dto->mesagge()->toArray());
        }
        return true;
    }


    /**
     * filtra elemtos primitivos como string, int, float, etc
     * @param array $data
     * @return ValidatorDto
     */
    private function elementValidate(array $data)
    {
        $dtoLocal = $this->getDto(true);

        $filterMethods = $this->getFilterMethods('validate');
        foreach ($filterMethods as $method => $nameKeyMethod) {
            $nameKeyMethod = $this->getPrefix().$nameKeyMethod;
            if (! isset($data[$nameKeyMethod])) {
                $data[$nameKeyMethod] = null;
            }
            /** @var ValidatorDto $dtoValidator */
            $dtoValidator = $this->{'validate'.$method}($data[$nameKeyMethod]);
            if (! $dtoValidator->isOk()) {
                $this->setMessage($nameKeyMethod, $dtoValidator->mesagge()->toArray());
            }
            $dtoLocal = $this->processDto($dtoValidator, $dtoLocal);
        }
        return $dtoLocal;
    }


    /**
     * filtra los elementos de un aggregate anidado
     * para eso usa recursividad
     * @param array $data
     * @return ValidatorDto
     */
    private function elementAggregateValidate(array $data)
    {
        $dtoLocal = $this->getDto(true);
        $filterMethods = $this->getFilterMethods('aggregate');

        foreach ($filterMethods as $method => $nameKeyMethod) {
            $nameKeyMethod = $this->getPrefix().$nameKeyMethod;
            /** @var AggregateValidatorImplement $validator */
            $validator = $this->{'aggregate'.$method}();
            if ($validator instanceof AggregateValidatorImplement) {
                $validator->setPrefix($nameKeyMethod.AggregateHydratorImplement::SEPARATE);

                $dtoaggregate = $this->getDto(true);
                try {
                    $isValid = $validator->isValid($data);
                } catch (SrvErrorException $e) {
                    $dtoaggregate->setStatus(false);
                    foreach ($e->getListError() as $keyError => $rowError) {
                        $this->setMessage($keyError, $rowError);
                    }
                }

                $dtoLocal = $this->processDto($dtoaggregate, $dtoLocal);
            }
        }
        return $dtoLocal;
    }


    /**
     * filtra los elementos de una coleccion de agregates
     * @param array $data
     * @return ValidatorDto
     */
    private function elementCollectionValidate($data)
    {
        $dtoLocal = $this->getDto(true);
        $filterMethods = $this->getFilterMethods('collection');

        foreach ($filterMethods as $method => $nameKeyMethod) {
            $nameKeyMethod = $this->getPrefix().$nameKeyMethod;
            /** @var AggregateValidatorImplement $validator */
            $validator = $this->{'collection'.$method}();
            if ($validator instanceof AggregateValidatorImplement) {
                if (! isset($data[$nameKeyMethod]) || ! is_array($data[$nameKeyMethod])) {
                    $data[$nameKeyMethod] = [];
                }
                $collectionMessage = [];
                foreach ($data[$nameKeyMethod] as $key => $row) {
                    $validator = $this->{'collection'.$method}();

                    $dtoCollection = $this->getDto(true);
                    try {
                        $isValid = $validator->isValid($row);
                    } catch (SrvErrorException $e) {
                        $dtoCollection->setStatus(false);
                        $collectionMessage[$key] = $e->getListError();
                    }

                    $dtoLocal = $this->processDto($dtoCollection, $dtoLocal);
                }
                if (count($collectionMessage) > 0) {
                    $this->setMessage($nameKeyMethod, $collectionMessage);
                }
            }
        }
        return $dtoLocal;
    }


    /**
     * genera un array con los nombres de las funciones
     * que tengan el prefijo pasado por el parametro
     * @param $prefix
     * @return array
     */
    private function getFilterMethods($prefix)
    {
        $listMethods = get_class_methods($this);
        $return = [];
        $strlenPrefix = strlen($prefix);
        foreach ($listMethods as $method) {
            if (substr($method, 0, $strlenPrefix) === $prefix) {
                $return[substr($method, $strlenPrefix)] =
                    strtolower(substr($method, $strlenPrefix, 1)) . substr($method, ($strlenPrefix + 1));
            }
        }
        return $return;
    }


    /**
     * retorna el objeo para pasar el isvalid
     * standar para filtros
     * @param bool $status
     * @return ValidatorDto
     */
    protected function getDto($status = false)
    {
        $dto = new ValidatorDto();
        if ($status === true) {
            $dto->setStatus(true);
        }
        return $dto;
    }

    /**
     * processa los Dto, si al menos uno es falso, hace que el redo sea falso
     * esto hace que el resuiltado final sea falso , si uno es falso
     * @param ValidatorDto $currentDto
     * @param $previosDto
     * @return ValidatorDto
     */
    private function processDto(ValidatorDto $currentDto, $previosDto)
    {
        if (is_null($previosDto)) {
            return $currentDto;
        }
        /** @var ValidatorDto $previosDto */
        /** si al menos uno de los 2 dto es false, hace que el reasultado final se falso */
        if (! $currentDto->isStatus() || ! $previosDto->isStatus()) {
            $previosDto->setStatus(false);
        }

        /** si el dto actual es falso, se agregan los mensajes de error al dto previo */
        /*if (! $currentDto->isStatus()) {
            $previosDto->mesagge()->set($currentDto->mesagge()->toArray());
        }*/

        return $previosDto;
    }
}
