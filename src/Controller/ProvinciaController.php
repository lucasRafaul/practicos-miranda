<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProvinciaRepository;
use App\Repository\PaisRepository;
use App\Form\Filtro\ProvinciaFiltroType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dompdf\Dompdf; 
use Dompdf\Options; 


class ProvinciaController extends AbstractController{

    #[Route('/provincia/reporte', name: 'provincia_reporte')] 
    public function reporteProvinciaAction(Request $request, ProvinciaRepository $provinciaRepository): Response 
    { 
        $form = $this->createForm(ProvinciaFiltroType::class); 
        $form->handleRequest($request); 
 
        // Se van a mostrar todas las provincias por defecto, hasta que defina criterios en filtro 
        $provincias = $provinciaRepository->findAll(); 
 
        if ($form->isSubmitted() && $form->isValid()) { 
            $data = $form->getData(); 
 
            $pais = null; 
            $minPoblacion = null; 
            $maxSuperficie = null; 
 
            if(isset($data['pais'])) { 
                $pais = $data['pais']; 
            } 
 
            if (isset($data['minPoblacion'])) { 
                $minPoblacion = $data['minPoblacion']; 
            } 
 
            if (isset($data['maxSuperficie'])) { 
                $maxSuperficie = $data['maxSuperficie']; 
            } 
 
            // Se va a aplicar el  filtro solo si se envia el formulario 
            $provincias = $provinciaRepository->filtrar($pais, $minPoblacion, 
            $maxSuperficie); 
        } 
 
        return $this->render('reportes/provinciaReporte.html.twig', [ 
            'form_filtro' => $form->createView(), 
            'provincias' => $provincias, 
        ]); 
    }

    #[Route('/provincia/exportar/excel', name: 'reporte_excel')] 
    public function exportarExcel( Request $request, PaisRepository $paisRepository, ProvinciaRepository $provinciaRepository ): Response { 
    // Filtros recibidos 
    $paisId = $request->query->get('pais'); 
    $minPoblacion = $request->query->get('minPoblacion'); 
    $maxSuperficie = $request->query->get('maxSuperficie'); 
 
    $pais = null; 
    if ($paisId) { 
        $pais = $paisRepository->find($paisId); 
    } 
 
    $provincias = $provinciaRepository->filtrar( 
        $pais, 
        $minPoblacion ? (int) $minPoblacion : null, 
        $maxSuperficie ? (float) $maxSuperficie : null 
    ); 
 
    $html = $this->renderView('reportes/provinciaReporteXlsx.html.twig', [ 
        'provincias' => $provincias, 
    ]); 
 
    // Crear respuesta con cabeceras de Excel 
    $response = new Response($html); 
    $response->headers->set('Content-Type', 'application/vnd.ms-excel'); 
    $response->headers->set('Content-Disposition', 'attachment; filename="reporte_provincias.xls"'); 
    $response->headers->set('Pragma', 'no-cache'); 
    $response->headers->set('Expires', '0'); 
    
        return $response; 
    }

    #[Route('/provincia/exportar/pdf', name: 'provincia_exportar_pdf')] 
    public function exportarPdf( Request $request, PaisRepository $paisRepository, ProvinciaRepository $provinciaRepository ): Response { 
    $paisId = $request->query->get('pais'); 
    $minPoblacion = $request->query->get('minPoblacion'); 
    $maxSuperficie = $request->query->get('maxSuperficie'); 
 
    $pais = null; 
    if ($paisId) { 
        $pais = $paisRepository->find($paisId); 
    } 
 
    $provincias = $provinciaRepository->filtrar( 
        $pais, 
        $minPoblacion ? (int)$minPoblacion : null, 
        $maxSuperficie ? (float)$maxSuperficie : null 
    ); 
 
    $html = $this->renderView('reportes/provinciaReporteXlsx.html.twig', [ 
        'provincias' => $provincias, 
    ]); 
 
    
    $options = new Options(); 
    $options->get('defaultFont', 'DejaVu Sans'); 
    $dompdf = new Dompdf($options); 
    $dompdf->loadHtml($html); 
    $dompdf->setPaper('A4', 'portrait'); 
    $dompdf->render(); 
 
    return new Response( 
        $dompdf->output(), 
        200, 
        [ 
            'Content-Type' => 'application/pdf', 
            'Content-Disposition' => 'attachment; 
            filename="reporte_provincias.pdf"', 
                    ] 
                ); 
            } 


}



?>