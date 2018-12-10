<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route  ("/usuario")
 */

class UsuarioController extends Controller
{
    /**
     * @Route("/usuario", name="ver_usuario")
     */
    public function indexAction(UserPasswordEncoderInterface $encoder, Request $request)
    {
        $usuario = new Usuario();
        $usuario->setNombre("Cama");
        $usuario->setApellido("Martinez");
        $usuario->setEmail("cama@gmail.com");
        $usuario->setPassword("1223456");
        $usuario->setHabilitado(true);

        $encoder = $encoder->encodePassword($usuario, "123456");
        $usuario->setPassword($encoder);


        $dbcnx = $this->getDoctrine()->getManager();
        $dbcnx->persist($usuario);
        $dbcnx->flush();

         $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findAll();


        return $this->render('@App/Usuario/ver_usuario.html.twig', [
            "usuarios" => $usuario
        ]);
    }




}
