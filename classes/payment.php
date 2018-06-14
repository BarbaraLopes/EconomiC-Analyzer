<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class payment
{
    private $IdPayment;
    private $TbCityIdCity;
    private $TbFunctionsIdFunction;
    private $TbSubfunctionsIdSubfunction;
    private $TbProgramIdProgram;
    private $TbActionIdAction;
    private $TbBeneficiariesIdBeneficiaries;
    private $TbSourceIdSource;
    private $TbFilesIdFile;
    private $IntMonth;
    private $IntYear;
    private $DbValue;

    /**
     * @return mixed
     */
    public function getIdPayment()
    {
        return $this->IdPayment;
    }

    /**
     * @param mixed $IdPayment
     */
    public function setIdPayment($IdPayment): void
    {
        $this->IdPayment = $IdPayment;
    }

    /**
     * @return mixed
     */
    public function getTbCityIdCity()
    {
        return $this->TbCityIdCity;
    }

    /**
     * @param mixed $TbCityIdCity
     */
    public function setTbCityIdCity($TbCityIdCity): void
    {
        $this->TbCityIdCity = $TbCityIdCity;
    }

    /**
     * @return mixed
     */
    public function getTbFunctionsIdFunction()
    {
        return $this->TbFunctionsIdFunction;
    }

    /**
     * @param mixed $TbFunctionsIdFunction
     */
    public function setTbFunctionsIdFunction($TbFunctionsIdFunction): void
    {
        $this->TbFunctionsIdFunction = $TbFunctionsIdFunction;
    }

    /**
     * @return mixed
     */
    public function getTbSubfunctionsIdSubfunction()
    {
        return $this->TbSubfunctionsIdSubfunction;
    }

    /**
     * @param mixed $TbSubfunctionsIdSubfunction
     */
    public function setTbSubfunctionsIdSubfunction($TbSubfunctionsIdSubfunction): void
    {
        $this->TbSubfunctionsIdSubfunction = $TbSubfunctionsIdSubfunction;
    }

    /**
     * @return mixed
     */
    public function getTbProgramIdProgram()
    {
        return $this->TbProgramIdProgram;
    }

    /**
     * @param mixed $TbProgramIdProgram
     */
    public function setTbProgramIdProgram($TbProgramIdProgram): void
    {
        $this->TbProgramIdProgram = $TbProgramIdProgram;
    }

    /**
     * @return mixed
     */
    public function getTbActionIdAction()
    {
        return $this->TbActionIdAction;
    }

    /**
     * @param mixed $TbActionIdAction
     */
    public function setTbActionIdAction($TbActionIdAction): void
    {
        $this->TbActionIdAction = $TbActionIdAction;
    }

    /**
     * @return mixed
     */
    public function getTbBeneficiariesIdBeneficiaries()
    {
        return $this->TbBeneficiariesIdBeneficiaries;
    }

    /**
     * @param mixed $TbBeneficiariesIdBeneficiaries
     */
    public function setTbBeneficiariesIdBeneficiaries($TbBeneficiariesIdBeneficiaries): void
    {
        $this->TbBeneficiariesIdBeneficiaries = $TbBeneficiariesIdBeneficiaries;
    }

    /**
     * @return mixed
     */
    public function getTbSourceIdSource()
    {
        return $this->TbSourceIdSource;
    }

    /**
     * @param mixed $TbSourceIdSource
     */
    public function setTbSourceIdSource($TbSourceIdSource): void
    {
        $this->TbSourceIdSource = $TbSourceIdSource;
    }

    /**
     * @return mixed
     */
    public function getTbFilesIdFile()
    {
        return $this->TbFilesIdFile;
    }

    /**
     * @param mixed $TbFilesIdFile
     */
    public function setTbFilesIdFile($TbFilesIdFile): void
    {
        $this->TbFilesIdFile = $TbFilesIdFile;
    }

    /**
     * @return mixed
     */
    public function getIntMonth()
    {
        return $this->IntMonth;
    }

    /**
     * @param mixed $IntMonth
     */
    public function setIntMonth($IntMonth): void
    {
        $this->IntMonth = $IntMonth;
    }

    /**
     * @return mixed
     */
    public function getIntYear()
    {
        return $this->IntYear;
    }

    /**
     * @param mixed $IntYear
     */
    public function setIntYear($IntYear): void
    {
        $this->IntYear = $IntYear;
    }

    /**
     * @return mixed
     */
    public function getDbValue()
    {
        return $this->DbValue;
    }

    /**
     * @param mixed $DbValue
     */
    public function setDbValue($DbValue): void
    {
        $this->DbValue = $DbValue;
    }

    /**
     * payment constructor.
     * @param $IdPayment
     * @param $TbCityIdCity
     * @param $TbFunctionsIdFunction
     * @param $TbSubfunctionsIdSubfunction
     * @param $TbProgramIdProgram
     * @param $TbActionIdAction
     * @param $TbBeneficiariesIdBeneficiaries
     * @param $TbSourceIdSource
     * @param $TbFilesIdFile
     * @param $IntMonth
     * @param $IntYear
     * @param $DbValue
     */
    public function __construct($IdPayment, $TbCityIdCity, $TbFunctionsIdFunction, $TbSubfunctionsIdSubfunction, $TbProgramIdProgram, $TbActionIdAction, $TbBeneficiariesIdBeneficiaries, $TbSourceIdSource, $TbFilesIdFile, $IntMonth, $IntYear, $DbValue)
    {
        $this->IdPayment = $IdPayment;
        $this->TbCityIdCity = $TbCityIdCity;
        $this->TbFunctionsIdFunction = $TbFunctionsIdFunction;
        $this->TbSubfunctionsIdSubfunction = $TbSubfunctionsIdSubfunction;
        $this->TbProgramIdProgram = $TbProgramIdProgram;
        $this->TbActionIdAction = $TbActionIdAction;
        $this->TbBeneficiariesIdBeneficiaries = $TbBeneficiariesIdBeneficiaries;
        $this->TbSourceIdSource = $TbSourceIdSource;
        $this->TbFilesIdFile = $TbFilesIdFile;
        $this->IntMonth = $IntMonth;
        $this->IntYear = $IntYear;
        $this->DbValue = $DbValue;
    }
}