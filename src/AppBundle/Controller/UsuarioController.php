<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Usuario;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route  ("/usuario")
 */

class UsuarioController extends Controller
{
    /**
     * @Route("/", name="ver_usuario")
     */
    public function indexAction(Request $request)
    {
     //   $usuario = new Usuario();
     //   $usuario->setNombre("Juana");
     //   $usuario->setApellido("Martinez");
      //  $usuario->setEmail("amartinez@mail.com");
       // $usuario->setPassword("admin");
        // $usuario->setHabilitado(true);

      //  $dbcnx = $this->getDoctrine()->getManager();
      //  $dbcnx->persist($usuario);
      //  $dbcnx->flush();

        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findAll();


        return $this->render('@App/Usuario/ver_usuario.html.twig', [
            "usuarios" => [$usuario]
    ]);
    }
}
