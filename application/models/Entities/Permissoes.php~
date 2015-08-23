<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permissoes
 *
 * @ORM\Table(name="permissoes")
 * @ORM\Entity
 */
class Permissoes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="chave", type="string", length=100, nullable=false)
     */
    private $chave;

    /**
     * @var string
     *
     * @ORM\Column(name="controlador", type="string", length=45, nullable=false)
     */
    private $controlador;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=200, nullable=false)
     */
    private $descricao;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Permissoes
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set chave
     *
     * @param string $chave
     * @return Permissoes
     */
    public function setChave($chave)
    {
        $this->chave = $chave;

        return $this;
    }

    /**
     * Get chave
     *
     * @return string 
     */
    public function getChave()
    {
        return $this->chave;
    }

    /**
     * Set controlador
     *
     * @param string $controlador
     * @return Permissoes
     */
    public function setControlador($controlador)
    {
        $this->controlador = $controlador;

        return $this;
    }

    /**
     * Get controlador
     *
     * @return string 
     */
    public function getControlador()
    {
        return $this->controlador;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Permissoes
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }
}
