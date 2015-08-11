<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * GruposProgramas
 *
 * @ORM\Table(name="grupos_programas", indexes={@ORM\Index(name="fk_grupo_programas_grupos_idx", columns={"id_grupo"}), @ORM\Index(name="fk_grupos_programas_programas_idx", columns={"id_programa"})})
 * @ORM\Entity
 */
class GruposProgramas
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
     * @var \Entities\Programas
     *
     * @ORM\ManyToOne(targetEntity="Entities\Programas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_programa", referencedColumnName="id")
     * })
     */
    private $idPrograma;


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
     * @return GruposProgramas
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
     * Set idPrograma
     *
     * @param \Entities\Programas $idPrograma
     * @return GruposProgramas
     */
    public function setIdPrograma(\Entities\Programas $idPrograma = null)
    {
        $this->idPrograma = $idPrograma;

        return $this;
    }

    /**
     * Get idPrograma
     *
     * @return \Entities\Programas 
     */
    public function getIdPrograma()
    {
        return $this->idPrograma;
    }
}
