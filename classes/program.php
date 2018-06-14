<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class program
{
    private $IdProgram;
    private $StrCodProgram;
    private $StrNameProgram;

    /**
     * @return mixed
     */
    public function getIdProgram()
    {
        return $this->IdProgram;
    }

    /**
     * @param mixed $IdProgram
     */
    public function setIdProgram($IdProgram): void
    {
        $this->IdProgram = $IdProgram;
    }

    /**
     * @return mixed
     */
    public function getStrCodProgram()
    {
        return $this->StrCodProgram;
    }

    /**
     * @param mixed $StrCodProgram
     */
    public function setStrCodProgram($StrCodProgram): void
    {
        $this->StrCodProgram = $StrCodProgram;
    }

    /**
     * @return mixed
     */
    public function getStrNameProgram()
    {
        return $this->StrNameProgram;
    }

    /**
     * @param mixed $StrNameProgram
     */
    public function setStrNameProgram($StrNameProgram): void
    {
        $this->StrNameProgram = $StrNameProgram;
    }

    /**
     * program constructor.
     * @param $IdProgram
     * @param $StrCodProgram
     * @param $StrNameProgram
     */
    public function __construct($IdProgram, $StrCodProgram, $StrNameProgram)
    {
        $this->IdProgram = $IdProgram;
        $this->StrCodProgram = $StrCodProgram;
        $this->StrNameProgram = $StrNameProgram;
    }
}