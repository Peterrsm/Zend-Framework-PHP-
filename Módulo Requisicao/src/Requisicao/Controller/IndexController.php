<?php

namespace Requisicao\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Requisicao\Entity\requisicao;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }

        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);
         
        return $this->redirect()->toUrl('/requisicao/index/lista');
    }


    public function adicionaAction()
    {
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);

        
        if($this->request->isPost())
        {
            $assunto = $this->request->getPost('assunto');
            $corpo = $this->request->getPost('corpo');
            $aprovado = $this->request->getPost('aprovado');
            $usuario = $this->identity()->getNome();
            if($aprovado == null){
                $finaliza = 0;
            }
            else{
                $finaliza = 1;
            }

            /* call data base */
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
            /* end */
            
            $requisicao = new requisicao($assunto, $usuario, $corpo, $finaliza);
            $entityManager->persist($requisicao);
            $entityManager->flush();
            
            return $this->redirect()->toUrl('/requisicao/index');
        }       
    
        return new ViewModel();
    }


    public function listaAction()
    {
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);
         

        /* call data base */
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
        /* end */
        
        $result = $verifica->findAll();
        
        return new ViewModel([
            'result' => $result,
            'setor' => $setor,
            'usuario' => $usuario,
        ]);
    }




    public function listaaprovadosAction()
    {
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);
         

        /* call data base */
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
        /* end */

        $result = $verifica->findAll();
    
        return new ViewModel([
            'result' => $result,
        ]);
    }


    public function removeAction()
    {
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);

        $id = $this->request->getPost('id');
        
        /* call data base */
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
        /* end */
        
        $requisicao = $verifica->find($id);
        $entityManager->remove($requisicao);
        $entityManager->flush();
    
        return $this->redirect()->toUrl('/requisicao/index/lista');
        
    }


    public function removeemmassaAction()
    {
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);


        $arrais = $this->request->getPost('arrais');

        $arrais = substr($arrais, 1, (strlen($arrais)-3));
        $array_arrais=explode(",",$arrais); 
        
        /* call data base */
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
        /* end */

        foreach ($array_arrais as $value){
            $requisicao = $verifica->find($value);
            $entityManager->remove($requisicao);
            $entityManager->flush();
        }
        
    
        return $this->redirect()->toUrl('/requisicao/index/lista');
        
    }

    
    public function editaAction()
    {  
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);

        if($this->request->isPost())
        {
            /* call data base */
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
            /* end */

            $id = $this->request->getPost('id');

            $find = $verifica->find($id);

            $nome = $find->getAssunto();
            $corpo = $find->getCorpo();
        }     

          
        return new ViewModel([
            'assunto' => $nome,
            'corpo' => $corpo,
            'id' => $id
        ]);        
    }


    public function editabancoAction()
    {  
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);


        if($this->request->isPost())
        {
            $assunto = $this->request->getPost('assunto');
            $corpo = $this->request->getPost('corpo');

            /* call data base */
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
            /* end */

            $id = $this->request->getPost('id');

            $find = $verifica->find($id);
            
            
            $find->setAssunto($assunto);
            $find->setCorpo($corpo);
            $entityManager->persist($find);
            $entityManager->flush();
            
    
            return $this->redirect()->toUrl('/requisicao/index/lista');
        }       
    
        return new ViewModel();
        
    }


    public function aprovaAction()
    {  
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }
        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);


        if($this->request->isPost())
        {
            /* call data base */
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
            /* end */

            $id = $this->request->getPost('id');

            $find = $verifica->find($id);
            
            $find->setFinaliza('1');
            $entityManager->persist($find);
            $entityManager->flush();
            
    
            return $this->redirect()->toUrl('/requisicao/index/lista');
        }       
    
        return new ViewModel();
        
    }


    public function aprovaemmassaAction()
    {
        if(!$user = $this->identity()){
            return $this->redirect()->toUrl('/login');
        }
        /* select nivel */
        $setor = $this->identity()->getSetor();
        if($setor == 'admin' OR $setor == 'faturamento'){
            
        }else{
            return $this->redirect()->toUrl('/dashboard');
        }

        /* end */
        $usuario = $this->identity()->getNome();
        $avatar = $this->identity()->getAvatar();
        $setor = $this->identity()->getSetor();
        $this->layout()->setVariable('usuario', $usuario);
        $this->layout()->setVariable('avatar', $avatar);
        $this->layout()->setVariable('setor', $setor);

        $arrais = $this->request->getPost('arrais2');
        $arrais = substr($arrais, 1, (strlen($arrais)-3));
        $array_arrais=explode(",",$arrais); 

        echo "Arrais: ";
        echo $arrais;

        echo "      Array_arrais: ";
        echo $array_arrais;
        
        /* call data base */
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $verifica = $entityManager->getRepository('Requisicao\Entity\requisicao');
        /* end */

        foreach ($array_arrais as $value){
            $find = $verifica->find($value);
            $find->setFinaliza('1');
            $entityManager->persist($find);
            $entityManager->flush();
        }
        
    
        return $this->redirect()->toUrl('/requisicao/index/lista');
        
    }

}

