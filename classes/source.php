<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class source
{
    private $IdSource;
    private $StrGoal;
    private $StrOrigin;
    private $StrPeriodicity;

    /**
     * @return mixed
     */
    public function getIdSource()
    {
        return $this->IdSource;
    }

    /**
     * @param mixed $IdSource
     */
    public function setIdSource($IdSource): void
    {
        $this->IdSource = $IdSource;
    }

    /**
     * @return mixed
     */
    public function getStrGoal()
    {
        return $this->StrGoal;
    }

    /**
     * @param mixed $StrGoal
     */
    public function setStrGoal($StrGoal): void
    {
        $this->StrGoal = $StrGoal;
    }

    /**
     * @return mixed
     */
    public function getStrOrigin()
    {
        return $this->StrOrigin;
    }

    /**
     * @param mixed $StrOrigin
     */
    public function setStrOrigin($StrOrigin): void
    {
        $this->StrOrigin = $StrOrigin;
    }

    /**
     * @return mixed
     */
    public function getStrPeriodicity()
    {
        return $this->StrPeriodicity;
    }

    /**
     * @param mixed $StrPeriodicity
     */
    public function setStrPeriodicity($StrPeriodicity): void
    {
        $this->StrPeriodicity = $StrPeriodicity;
    }

    /**
     * source constructor.
     * @param $IdSource
     * @param $StrGoal
     * @param $StrOrigin
     * @param $StrPeriodicity
     */
    public function __construct($IdSource, $StrGoal, $StrOrigin, $StrPeriodicity)
    {
        $this->IdSource = $IdSource;
        $this->StrGoal = $StrGoal;
        $this->StrOrigin = $StrOrigin;
        $this->StrPeriodicity = $StrPeriodicity;
    }
}