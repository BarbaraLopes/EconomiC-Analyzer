<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class state
{
    private $IdState;
    private $StrUf;
    private $StrName;
    private $TbRegionIdRegion;

    /**
     * state constructor.
     * @param $IdState
     * @param $StrUf
     * @param $StrName
     * @param $TbRegionIdRegion
     */
    public function __construct($IdState, $StrUf, $StrName, $TbRegionIdRegion)
    {
        $this->IdState = $IdState;
        $this->StrUf = $StrUf;
        $this->StrName = $StrName;
        $this->TbRegionIdRegion = $TbRegionIdRegion;
    }

    /**
     * @return mixed
     */
    public function getIdState()
    {
        return $this->IdState;
    }

    /**
     * @param mixed $IdState
     */
    public function setIdState($IdState): void
    {
        $this->IdState = $IdState;
    }

    /**
     * @return mixed
     */
    public function getStrUf()
    {
        return $this->StrUf;
    }

    /**
     * @param mixed $StrUf
     */
    public function setStrUf($StrUf): void
    {
        $this->StrUf = $StrUf;
    }

    /**
     * @return mixed
     */
    public function getStrName()
    {
        return $this->StrName;
    }

    /**
     * @param mixed $StrName
     */
    public function setStrName($StrName): void
    {
        $this->StrName = $StrName;
    }

    /**
     * @return mixed
     */
    public function getTbRegionIdRegion()
    {
        return $this->TbRegionIdRegion;
    }

    /**
     * @param mixed $TbRegionIdRegion
     */
    public function setTbRegionIdRegion($TbRegionIdRegion): void
    {
        $this->TbRegionIdRegion = $TbRegionIdRegion;
    }

}