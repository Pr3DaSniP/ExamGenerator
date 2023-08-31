<?php

class ExportDataController extends Controller
{
    public function exportData()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Exportation de données";
        $this->render('exportData', true, compact('title', 'user'));
    }

    public function export()
    {
        $csv = $_POST['format'] === 'csv' ? true : false;
        $exports = $_POST['export'];
        $files = [];

        // Création des fichiers temporaires
        foreach($exports as $export){
            $this->loadModel($export);
            $tmp = $this->$export->export($csv);
            $files[] = [
                'file' => $tmp,
                'name' => $export . '.' . ($csv ? 'csv' : 'txt')
            ];
        }

        // Création du zip
        $zip_file = tempnam(sys_get_temp_dir(), 'prefix_') . '.zip';
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE);
        foreach($files as $file){
            $zip->addFile($file['file'], $file['name']);
        }
        $zip->close();

        // Téléchargement du zip
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="exports.zip"');
        header('Content-Length: ' . filesize($zip_file));
        readfile($zip_file);

        // Suppression des fichiers temporaires
        unlink($zip_file);
        foreach($files as $file){
            unlink($file['file']);
        }
    }
}