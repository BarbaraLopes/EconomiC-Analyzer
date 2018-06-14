<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class region
{
    private $IdRegion;
    private $StrNameRegion;

    /**
     * region constructor.
     * @param $IdRegion
     * @param $StrNameRegion
     */
    public function __construct($IdRegion, $StrNameRegion)
    {
        $this->IdRegion = $IdRegion;
        $this->StrNameRegion = $StrNameRegion;
    }

    /**
     * @return mixed
     */
    public function getIdRegion()
    {
        return $this->IdRegion;
    }

    /**
     * @param mixed $IdRegion
     */
    public function setIdRegion($IdRegion): void
    {
        $this->IdRegion = $IdRegion;
    }

    /**
     * @return mixed
     */
    public function getStrNameRegion()
    {
        return $this->StrNameRegion;
    }

    /**
     * @param mixed $StrNameRegion
     */
    public function setStrNameRegion($StrNameRegion): void
    {
        $this->StrNameRegion = $StrNameRegion;
    }
}