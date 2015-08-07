<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * GruposPermissoes
 *
 * @ORM\Table(name="grupos_permissoes", indexes={@ORM\Index(name="fk_grupos_permissoes_grupos_id_idx", columns={"grupo_id"}), @ORM\Index(name="fk_grupos_permissoes_permissoes_id_idx", columns={"permissao_id"})})
 * @ORM\Entity
 */
class GruposPermissoes
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
     * @var \Entities\Grupos
     *
     * @ORM\ManyToOne(targetEntity="Entities\Grupos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     * })
     */
    private $grupo;

    /**
     * @var \Entities\Permissoes
     *
     * @ORM\ManyToOne(targetEntity="Entities\Permissoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="permissao_id", referencedColumnName="id")
     * })
     */
    private $permissao;


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
     * Set grupo
     *
     * @param \Entities\Grupos $grupo
     * @return GruposPermissoes
     */
    public function setGrupo(\Entities\Grupos $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \Entities\Grupos 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set permissao
     *
     * @param \Entities\Permissoes $permissao
     * @return GruposPermissoes
     */
    public function setPermissao(\Entities\Permissoes $permissao = null)
    {
        $this->permissao = $permissao;

        return $this;
    }

    /**
     * Get permissao
     *
     * @return \Entities\Permissoes 
     */
    public function getPermissao()
    {
        return $this->permissao;
    }
}
