<?php

namespace Requisicao\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */

	class requisicao {

	/**

	*@ORM\Id
		
	*@ORM\GeneratedValue(strategy="AUTO")

	*@ORM\Column(type="integer")

	*/
	private $id;


	/** @ORM\Column(type="string") */
	private $assunto;


	/** @ORM\Column(type="string") */
	private $usuario;


	/** @ORM\Column(type="text") */
    private $corpo;


	/** @ORM\Column(type="date") */
    private $data;


	/** @ORM\Column(type="boolean") */
    private $finaliza;
    


		public function __construct($assunto, $usuario, $corpo, $finaliza) {

			$this->assunto = $assunto;
			$this->usuario = $usuario;
			$this->corpo = $corpo;
			$this->data = new \DateTime('now');
			$this->finaliza = $finaliza;

		}


		public function getAssunto() {
			return $this->assunto;
		}
		public function getUsuario() {
			return $this->usuario;
		}
		public function getCorpo() {
			return $this->corpo;
		}
		public function getData() {
			return $this->data;
		}
		public function getFinaliza() {
			return $this->finaliza;
		}
		public function getId() {
			return $this->id;
		}

		

		/*set novos valores UPDATE*/

		public function setAssunto($assunto){
			$this->assunto = $assunto;
		}
		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}
		public function setCorpo($corpo){
			$this->corpo = $corpo;
		}
		public function setData($data){
			$this->data = $data;
		}
		public function setFinaliza($finaliza){
			$this->finaliza = $finaliza;
		}

		/*fim set novos valores UPDATE*/

	}

 ?>
