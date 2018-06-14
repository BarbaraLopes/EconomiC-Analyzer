<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class functions
{
    private $IdFunction;
    private $StrCodFunction;
    private $StrNameFunction;

    /**
     * functions constructor.
     * @param $IdFunction
     * @param $StrCodFunction
     * @param $StrNameFunction
     */
    public function __construct($IdFunction, $StrCodFunction, $StrNameFunction)
    {
        $this->IdFunction = $IdFunction;
        $this->StrCodFunction = $StrCodFunction;
        $this->StrNameFunction = $StrNameFunction;
    }

    /**
     * @return mixed
     */
    public function getIdFunction()
    {
        return $this->IdFunction;
    }

    /**
     * @param mixed $IdFunction
     */
    public function setIdFunction($IdFunction): void
    {
        $this->IdFunction = $IdFunction;
    }

    /**
     * @return mixed
     */
    public function getStrCodFunction()
    {
        return $this->StrCodFunction;
    }

    /**
     * @param mixed $StrCodFunction
     */
    public function setStrCodFunction($StrCodFunction): void
    {
        $this->StrCodFunction = $StrCodFunction;
    }

    /**
     * @return mixed
     */
    public function getStrNameFunction()
    {
        return $this->StrNameFunction;
    }

    /**
     * @param mixed $StrNameFunction
     */
    public function setStrNameFunction($StrNameFunction): void
    {
        $this->StrNameFunction = $StrNameFunction;
    }
}