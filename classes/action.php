<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:17
 */

class action
{

    private $IdAction;
    private $StrCodAction;
    private $StrNameAction;

    /**
     * action constructor.
     * @param $IdAction
     * @param $StrCodAction
     * @param $StrNameAction
     */
    public function __construct($IdAction, $StrCodAction, $StrNameAction)
    {
        $this->IdAction = $IdAction;
        $this->StrCodAction = $StrCodAction;
        $this->StrNameAction = $StrNameAction;
    }

    /**
     * @return mixed
     */
    public function getIdAction()
    {
        return $this->IdAction;
    }

    /**
     * @param mixed $IdAction
     */
    public function setIdAction($IdAction): void
    {
        $this->IdAction = $IdAction;
    }

    /**
     * @return mixed
     */
    public function getStrCodAction()
    {
        return $this->StrCodAction;
    }

    /**
     * @param mixed $StrCodAction
     */
    public function setStrCodAction($StrCodAction): void
    {
        $this->StrCodAction = $StrCodAction;
    }

    /**
     * @return mixed
     */
    public function getStrNameAction()
    {
        return $this->StrNameAction;
    }

    /**
     * @param mixed $StrNameAction
     */
    public function setStrNameAction($StrNameAction): void
    {
        $this->StrNameAction = $StrNameAction;
    }


}
