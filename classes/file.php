<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:17
 */

class file
{

    private $IdFile;
    private $StrNameFile;
    private $StrMonth;
    private $StrYear;

    /**
     * file constructor.
     * @param $IdFile
     * @param $StrNameFile
     * @param $StrMonth
     * @param $StrYear
     */
    public function __construct($IdFile, $StrNameFile, $StrMonth, $StrYear)
    {
        $this->IdFile = $IdFile;
        $this->StrNameFile = $StrNameFile;
        $this->StrMonth = $StrMonth;
        $this->StrYear = $StrYear;
    }

    /**
     * @return mixed
     */
    public function getIdFile()
    {
        return $this->IdFile;
    }

    /**
     * @param mixed $IdFile
     */
    public function setIdFile($IdFile): void
    {
        $this->IdFile = $IdFile;
    }

    /**
     * @return mixed
     */
    public function getStrNameFile()
    {
        return $this->StrNameFile;
    }

    /**
     * @param mixed $StrNameFile
     */
    public function setStrNameFile($StrNameFile): void
    {
        $this->StrNameFile = $StrNameFile;
    }

    /**
     * @return mixed
     */
    public function getStrMonth()
    {
        return $this->StrMonth;
    }

    /**
     * @param mixed $StrMonth
     */
    public function setStrMonth($StrMonth): void
    {
        $this->StrMonth = $StrMonth;
    }

    /**
     * @return mixed
     */
    public function getStrYear()
    {
        return $this->StrYear;
    }

    /**
     * @param mixed $StrYear
     */
    public function setStrYear($StrYear): void
    {
        $this->StrYear = $StrYear;
    }


}
