<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/usuario")
 */
class RegistroController extends Controller
{
    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request, UserPasswordEncoderInterface $encoder)
    {

//        dump($request); die; ESTO ES UN DEBUGEADOR
        $usuario= new Usuario();

//        // CONSTRUYENDO el FORMULARIO

        $form =$this->createForm(UsuarioType::class,$usuario);
//        //$usuario->setEmail("juanp@gmail.com");
 //       // $usuario->setPassword("1234");
        $usuario->setHabilitado(true);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            //ENCRIPTANDO EL PASSWORD
            $encoder =$encoder->encodePassword($usuario,$usuario->getPassword());
            $usuario ->setPassword($encoder);

//          SALVANDO EL USUARIO
            $manajadorDb =$this->getDoctrine()->getManager();
            $manajadorDb->persist($usuario);
            $manajadorDb ->flush();

            return $this->redirectToRoute('login');
        }
        return $this->render('@App/Registro/registro.html.twig',[
            "form"=>$form->createView()]);

        //   $encoder =$encoder->encodePassword($$usuario, "123456");
        //$usuario ->setPassword($encoder);



        //  $usuario =$this->getDoctrine()->getRepository(Usuario::class)->findAll();

        // replace this example code with whatever you need

    }


}