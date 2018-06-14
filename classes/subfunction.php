<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:39
 */

class subfunction
{
    private $IdSubfunction;
    private $StrCodSubfunction;
    private $StrNameSubfunction;

    /**
     * @return mixed
     */
    public function getIdSubfunction()
    {
        return $this->IdSubfunction;
    }

    /**
     * @param mixed $IdSubfunction
     */
    public function setIdSubfunction($IdSubfunction): void
    {
        $this->IdSubfunction = $IdSubfunction;
    }

    /**
     * @return mixed
     */
    public function getStrCodSubfunction()
    {
        return $this->StrCodSubfunction;
    }

    /**
     * @param mixed $StrCodSubfunction
     */
    public function setStrCodSubfunction($StrCodSubfunction): void
    {
        $this->StrCodSubfunction = $StrCodSubfunction;
    }

    /**
     * @return mixed
     */
    public function getStrNameSubfunction()
    {
        return $this->StrNameSubfunction;
    }

    /**
     * @param mixed $StrNameSubfunction
     */
    public function setStrNameSubfunction($StrNameSubfunction): void
    {
        $this->StrNameSubfunction = $StrNameSubfunction;
    }

    /**
     * subfunction constructor.
     * @param $IdSubfunction
     * @param $StrCodSubfunction
     * @param $StrNameSubfunction
     */
    public function __construct($IdSubfunction, $StrCodSubfunction, $StrNameSubfunction)
    {
        $this->IdSubfunction = $IdSubfunction;
        $this->StrCodSubfunction = $StrCodSubfunction;
        $this->StrNameSubfunction = $StrNameSubfunction;
    }
}