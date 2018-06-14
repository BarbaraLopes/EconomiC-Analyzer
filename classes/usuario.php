<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:17
 */

class usuario
{

    private $idUsuario;
    private $usuario;
    private $senha;
    private $nome;
    private $email;
    private $resetar;
    private $perfil;

    /**
     * usuario constructor.
     * @param $idUsuario
     * @param $usuario
     * @param $senha
     * @param $nome
     * @param $email
     * @param $resetar
     */
    public function __construct($idUsuario, $usuario, $senha, $nome, $email, $resetar, $perfil)
    {
        $this->idUsuario = $idUsuario;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->email = $email;
        $this->resetar = $resetar;
        $this->perfil = $perfil;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getResetar()
    {
        return $this->resetar;
    }

    /**
     * @param mixed $resetar
     */
    public function setResetar($resetar)
    {
        $this->resetar = $resetar;
    }

    /**
     * @return mixed
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * @param mixed $resetar
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }
}
