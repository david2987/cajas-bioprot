<?php

namespace App\Controllers;

use App\Models\CajaModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrController extends BaseController
{
    public function generateQr($id , $saltear = null )
    {        

        $model = new CajaModel();
        $caja = $model->find($id);

        if (!$caja) {
            return redirect()->back()->with('error', 'Caja no encontrada.');
        }

        // Generar el QR Code
        $qrCode = QrCode::create(base_url('cajas/view/' . $id));
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Guardar la imagen en el servidor
        $filePath = WRITEPATH . 'uploads/qr_codes/' . $id . '.png';
        $result->saveToFile($filePath);
        
        // Actualizar la URL del QR en la base de datos
        $model->update($id, ['qr_code' => base_url('uploads/qr_codes/' . $id . '.png')]);

        if(!$saltear){
            return redirect()->to('/cajas/view/' . $id);
        }
    }

    public function runProcessCajas()
    {
        $message[] = "";
        $cajaModel = new CajaModel();
        $qrController = new QrController();

        // Obtener todas las cajas
        // $cajas = $cajaModel->findAll(); <-- poner de nuevo 
        $cajas = $cajaModel->findAll();

        foreach ($cajas as $caja) {
            try {
                // Llamar al método generateQr y pasar el ID de la caja                                
                $this->generateQr($caja['id']);
                $message[] =  "QR generado para la caja ID: {$caja['id']} <br>";                                
            } catch (\Exception $e) {
                $message[] = "Error al generar QR para la caja ID: {$caja['id']} - " . $e->getMessage() . " <br>";
                
            }
        }

        $message[] = 'Proceso de generación de QRs finalizado.';

        return json_encode($message);
        
    }
}
