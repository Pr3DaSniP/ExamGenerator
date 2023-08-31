<?php

require_once 'fpdf.php';

include_once 'helvetica.php';
include_once 'helveticab.php';

class PDF extends fpdf
{
    function __construct()
    {
        parent::__construct();
    }

    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Helvetica', 'I', 10);
        // Couleur du texte en gris
        $this->SetTextColor(0, 0, 0);
        // Numéro et nombre de pages
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' sur {nb}', 0, 0, 'C');
    }
}