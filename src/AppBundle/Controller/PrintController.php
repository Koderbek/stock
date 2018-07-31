<?php

namespace AppBundle\Controller;

use AppBundle\Entity\WorkingShift;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrintController extends Controller
{
    /**
     * @Route("/print", name="print")
     * @Method("GET")
     */
    public function printAction()
    {
        $em = $this->getDoctrine()->getManager();
        $workingShifts = $em->getRepository(WorkingShift::class)->findAll();

        $pdf = $this
            ->get("white_october.tcpdf")
            ->create('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $format = '150x200';
        $filename = "Report ".$format;
        $pdf->SetFont('arial', '', 12);
        $pdf->AddPage('L', explode('x', $format));
        $html = $this->renderView('report.html.twig', array(
            'workingShifts' => $workingShifts,
        ));
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        return $pdf->Output($filename . '.pdf', 'I');
    }
}
