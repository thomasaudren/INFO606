<?php

include "/application/models/agendaM.php";

class agendaC
{	
	private $agenda;

	public function __construct()
	{
		$this->agenda= new agendaM;
	}

	public function getAgendaByIdClasse($id)
	{
		return $this->agenda->getAgendaByIdClasse($id);
	}

	public function getPagesByIdAgenda($id)
	{
		return $this->agenda->getPagesByIdAgenda($id);
	}
}


