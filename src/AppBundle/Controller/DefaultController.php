<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $usuario = new Usuario();
        $usuario->setNombre("Juana");
        $usuario->setApellido("Martinez");
        $usuario->setEmail("amartinez@mail.com");
        $usuario->setPassword("admin");
        $usuario->setHabilitado(true);

        $dbcnx = $this->getDoctrine()->getManager();
        $dbcnx->persist($usuario);
        $dbcnx->flush();


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/{id}", name="homepage2")
     *
     * @param Request $request
     * @param  Usuario $usuario
     */

    public function verUsuario(Request $request, Usuario $usuario)
    {




        // replace this example code with whatever you need
        return $this->render('@App/Usuario/ver_usuario.html.twig', [
            "usuarios" => [$usuario]
            //Mostrando el nombre del usuarios
        ]);


    }
}

