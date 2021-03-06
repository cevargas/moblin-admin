<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * GruposPermissoes
 *
 * @ORM\Table(name="grupos_permissoes", indexes={@ORM\Index(name="fk_grupos_permissoes_grupos_id_idx", columns={"id_grupo"}), @ORM\Index(name="fk_grupos_permissoes_permissoes_id_idx", columns={"id_permissao"})})
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
     *   @ORM\JoinColumn(name="id_grupo", referencedColumnName="id")
     * })
     */
    private $idGrupo;

    /**
     * @var \Entities\Permissoes
     *
     * @ORM\ManyToOne(targetEntity="Entities\Permissoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_permissao", referencedColumnName="id")
     * })
     */
    private $idPermissao;


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
     * Set idGrupo
     *
     * @param \Entities\Grupos $idGrupo
     * @return GruposPermissoes
     */
    public function setIdGrupo(\Entities\Grupos $idGrupo = null)
    {
        $this->idGrupo = $idGrupo;

        return $this;
    }

    /**
     * Get idGrupo
     *
     * @return \Entities\Grupos 
     */
    public function getIdGrupo()
    {
        return $this->idGrupo;
    }

    /**
     * Set idPermissao
     *
     * @param \Entities\Permissoes $idPermissao
     * @return GruposPermissoes
     */
    public function setIdPermissao(\Entities\Permissoes $idPermissao = null)
    {
        $this->idPermissao = $idPermissao;

        return $this;
    }

    /**
     * Get idPermissao
     *
     * @return \Entities\Permissoes 
     */
    public function getIdPermissao()
    {
        return $this->idPermissao;
    }
}
