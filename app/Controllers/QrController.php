<?php

namespace App\Controllers;

use App\Models\CajaModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrController extends BaseController
{
    public function generateQr($id)
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

        return redirect()->to('/cajas/view/' . $id);
    }
}
