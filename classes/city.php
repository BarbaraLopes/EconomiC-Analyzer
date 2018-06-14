<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class city
{
    private $IdCity;
    private $StrNameCity;
    private $StrCodSiafiCity;
    private $TbStateIdState;

    /**
     * city constructor.
     * @param $IdCity
     * @param $StrNameCity
     * @param $StrCodSiafiCity
     * @param $TbStateIdState
     */
    public function __construct($IdCity, $StrNameCity, $StrCodSiafiCity, $TbStateIdState)
    {
        $this->IdCity = $IdCity;
        $this->StrNameCity = $StrNameCity;
        $this->StrCodSiafiCity = $StrCodSiafiCity;
        $this->TbStateIdState = $TbStateIdState;
    }

    /**
     * @return mixed
     */
    public function getIdCity()
    {
        return $this->IdCity;
    }

    /**
     * @param mixed $IdCity
     */
    public function setIdCity($IdCity): void
    {
        $this->IdCity = $IdCity;
    }

    /**
     * @return mixed
     */
    public function getStrNameCity()
    {
        return $this->StrNameCity;
    }

    /**
     * @param mixed $StrNameCity
     */
    public function setStrNameCity($StrNameCity): void
    {
        $this->StrNameCity = $StrNameCity;
    }

    /**
     * @return mixed
     */
    public function getStrCodSiafiCity()
    {
        return $this->StrCodSiafiCity;
    }

    /**
     * @param mixed $StrCodSiafiCity
     */
    public function setStrCodSiafiCity($StrCodSiafiCity): void
    {
        $this->StrCodSiafiCity = $StrCodSiafiCity;
    }

    /**
     * @return mixed
     */
    public function getTbStateIdState()
    {
        return $this->TbStateIdState;
    }

    /**
     * @param mixed $TbStateIdState
     */
    public function setTbStateIdState($TbStateIdState): void
    {
        $this->TbStateIdState = $TbStateIdState;
    }
}