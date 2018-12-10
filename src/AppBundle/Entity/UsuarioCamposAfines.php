<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioCampoAfin
 *
 * @ORM\Table(name="UsuarioCampoAfin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioCamposAfinesRepository")
 */
class UsuarioCamposAfines
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="misUsuarios")
     *
     */

    private $usuarioTecnico;

    /**
     * Usuario constructor.
     * @param int $id
     */


    public function __construct4()
    {
        $this->misUsuarios = new  ArrayCollection();
    }


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="misUsuariosCamposAfines")
     *
     */

    private $misCamposAfines;

    /**
     * Usuario constructor.
     * @param int $id
     */


    public function __construct5()
    {
        $this->misUsuariosCamposAfines = new  ArrayCollection();
    }




    /**
     * Get id
     *
     * @return int
     */


    public function getId()
    {
        return $this->id;
    }
}

