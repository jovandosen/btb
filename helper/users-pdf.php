<?php

require('fpdf184/fpdf.php');

require_once(__DIR__ . '/../config.php');

require_once(ABSPATH . 'vendor/autoload.php');

use App\Models\User;

class UsersPdf extends FPDF
{
    private function allUsers()
    {
        $dbUser = new User();

        return $dbUser->all();
    }

    public function makeUsersTable($pdfObj)
    {
        $users = $this->allUsers();

        while($row = $users->fetch_object()){
            $pdfObj->Cell(20, 10, $row->id, 1, 0, 'C');
            $pdfObj->Cell(40, 10, $row->name, 1, 0, 'C');
            $pdfObj->Cell(60, 10, $row->email, 1, 0, 'C');
            $pdfObj->Cell(20, 10, $row->role, 1, 0, 'C');
            $pdfObj->Cell(50, 10, $row->created, 1, 0, 'C');
            $pdfObj->Ln();
        }
    }
}

$usersPdf = new UsersPdf();

$usersPdf->AddPage();

$usersPdf->SetFont('Arial', 'B', 20);

$usersPdf->Cell(190, 10, 'Users', 0, 0, 'C', false);

$usersPdf->Ln();

$usersPdf->SetFont('Arial', 'B', 14);

$usersPdf->Cell(20, 10, 'ID', 1, 0, 'C');
$usersPdf->Cell(40, 10, 'NAME', 1, 0, 'C');
$usersPdf->Cell(60, 10, 'EMAIL', 1, 0, 'C');
$usersPdf->Cell(20, 10, 'ROLE', 1, 0, 'C');
$usersPdf->Cell(50, 10, 'CREATED', 1, 0, 'C');

$usersPdf->Ln();

$usersPdf->SetFont('Arial', '', 14);

$usersPdf->makeUsersTable($usersPdf);

$usersPdf->Output();

?>