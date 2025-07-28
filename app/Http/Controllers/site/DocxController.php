<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocxController extends Controller
{
    public function generate(): BinaryFileResponse
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Add text
        $section->addText('Hello, this is a generated DOCX document from Laravel!');
        $section->addText('This text is bold and italic.', ['bold' => true, 'italic' => true]);

        // Add an image (ensure the path is correct)
        // $section->addImage(public_path('images/your_image.png'), ['width' => 100, 'height' => 100]);

        // Add a table
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(1750)->addText('Header 1');
        $table->addCell(1750)->addText('Header 2');
        $table->addRow();
        $table->addCell(1750)->addText('Data 1');
        $table->addCell(1750)->addText('Data 2');

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'IC_DUTY_' . Carbon::now('Europe/Moscow')->toDateString() . '.docx';
        $objWriter->save(storage_path('app/' . $fileName));

        // Download the document
        return response()->download(storage_path('app/' . $fileName))->deleteFileAfterSend(true);
    }
}
