<?php
/**
 * Created by PhpStorm.
 * User: frede
 * Date: 08/06/2018
 * Time: 22:38
 */

class beneficiary
{
    private $IdBeneficiaries;
    private $StrNis;
    private $StrNamePerson;

    /**
     * @return mixed
     */
    public function getIdBeneficiaries()
    {
        return $this->IdBeneficiaries;
    }

    /**
     * @param mixed $IdBeneficiaries
     */
    public function setIdBeneficiaries($IdBeneficiaries): void
    {
        $this->IdBeneficiaries = $IdBeneficiaries;
    }

    /**
     * @return mixed
     */
    public function getStrNis()
    {
        return $this->StrNis;
    }

    /**
     * @param mixed $StrNis
     */
    public function setStrNis($StrNis): void
    {
        $this->StrNis = $StrNis;
    }

    /**
     * @return mixed
     */
    public function getStrNamePerson()
    {
        return $this->StrNamePerson;
    }

    /**
     * @param mixed $StrNamePerson
     */
    public function setStrNamePerson($StrNamePerson): void
    {
        $this->StrNamePerson = $StrNamePerson;
    }

    /**
     * beneficiary constructor.
     * @param $IdBeneficiaries
     * @param $StrNis
     * @param $StrNamePerson
     */
    public function __construct($IdBeneficiaries, $StrNis, $StrNamePerson)
    {
        $this->IdBeneficiaries = $IdBeneficiaries;
        $this->StrNis = $StrNis;
        $this->StrNamePerson = $StrNamePerson;
    }
}