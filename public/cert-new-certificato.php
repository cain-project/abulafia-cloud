<?php

	session_start();
	
	function __autoload ($class_name) { //funzione predefinita che si occupa di caricare dinamicamente tutti gli oggetti esterni quando vengono richiamati
		require_once "class/" . $class_name.".obj.inc";
	}
	
	include '../db-connessione-include.php';
	include 'maledetti-apici-centro-include.php';

	$idvisita = $_GET['idvisita'];
	$v = new Ambulatorio();
	$visita = $v->getVisita($idvisita);

	$idanagrafica = $_GET['idanagrafica'];
	$a = new Anagrafica();	
	$paziente = $a->infoAssistito($idanagrafica);

	$c = new Calendario();

	$finale = 'Documento generato digitalmente da Abulafia Web Ver.' . $_SESSION['version'].'. - https://www.abulafiaweb.it - info@abulafiaweb.it';
	
	require('lib/fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
		// Page header
		function Header()
		{

		}

		// Page footer
		function Footer() {
			$this->SetY(-10);
			$this->SetFont('Times','I',9);
			$this->Write('','Documento generato digitalmente da Abulafia Web Ver.' . $_SESSION['version'].'. - https://www.abulafiaweb.it - info@abulafiaweb.it');
		}
	}
		
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true,15);
	$pdf->AddPage('P','A4',90);
	$pdf->SetFont('Arial','',9);
	$pdf->SetTitle('Certificato_' . time());

	$pdf->Image("images/intestazione_certificato.png",23,11,33);
	$pdf->Cell(60,40,'',1,0,'C',false);
	$pdf->SetFont('Times','B',18);
	$pdf->Cell(69,40,'CERTIFICATO',1,0,'C',false);
	$pdf->SetFont('Times','BI',13);
	$pdf->Cell(60,20,'CER',1,2,'C',false);
	$pdf->Cell(60,20,'Rev. 1 del 06/02/2017',1,1,'C',false);

	$pdf->Ln(5);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(40,10,'Data: ' . date("d/m/Y", time()),0,0,'L',false);
	$pdf->Cell(50,10,'Rif. Visita: ' . $visita['id'],0,0,'L',false);
	$pdf->Cell(90,10,'Medico: ' . $a->getNome($_SESSION['loginid']) . ' ' . $a->getCognome($_SESSION['loginid']),0,1,'L',false);

	$pdf->Ln(5);
	$pdf->Cell(189,10,'Nome e Cognome Paziente: '. $paziente['nome'] .' ' . $paziente['cognome'],1,1,'L',false);
	$pdf->Cell(94.5,10,'Nato/a a: ' . $paziente['luogonascita'],1,0,'L',false);
	$pdf->Cell(94.5,10,'il: ' . $c->dataSlash($paziente['datanascita']),1,1,'L',false);
	$pdf->Cell(86.5,10,'Residente in: ' . $paziente['residenzacitta'],1,0,'L',false);
	$pdf->Cell(86,10,'Via: ' . $paziente['residenzavia'],1,0,'L',false);
	$pdf->Cell(16.5,10,'n. ' . $paziente['residenzanumero'],1,1,'L',false);
	$pdf->Cell(94.5,10,'Documento: ' . $paziente['documento'],1,0,'L',false);
	$pdf->Cell(94.5,10,'N. Documento ' . $paziente['documentonumero'],1,1,'L',false);
	$pdf->Ln(10);
	$pdf->MultiCell(189,10,'Si certifica di aver visitato in data ' . $c->dataSlash($visita['data']) . ' alle ore ' . $c->oraOM($visita['ora']) . ' il paziente sopraindicato.' . "\n" . 'Si omette la diagnosi in virtu\' del Dlgs. 196/2003 - L. Privacy.',0,'L',false);
	$pdf->Ln(15);
	$pdf->SetFont('Times','',11);
	$pdf->Write('','Rilasciato in carta semplice e su richiesta dell\'interessato per tutti gli usi consentiti dalla Legge.'); 
	$pdf->Ln(5);
	$pdf->Write('','Si autorizza al trattamento dei dati personali.');
	$pdf->Ln(25);
	$pdf->SetFont('Times','B',13);
	$pdf->SetX(130);
	$pdf->Write('','Il Medico di Guardia');

	$pdf->Output('Certificato_'.time().'.pdf','I');
	exit();
	?>