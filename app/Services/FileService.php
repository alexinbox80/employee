<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class FileService
{
    /**
     * @param string $filePath
     * @return \Generator
     * @throws \Exception
     */
    public static function convertCsv(string $filePath): \Generator
    {
        $handle = fopen($filePath, 'rb');
        if (!$handle) {
            throw new \Exception();
        }

        fgetcsv($handle, separator: ';');
        // пока не достигнем конца файла
        while (!feof($handle)) {
            // читаем строку
            // и генерируем значение
            yield fgetcsv($handle, separator: ';');
        }

        // закрываем
        fclose($handle);
    }

    /**
     * @param string $filePath
     * @param Model $model
     * @return bool
     * @throws \Exception
     */
    public static function convertProcess(string $filePath, Model $model): bool
    {
        /*

            $user = new User();
            $fillableColumns = $user->getFillable(); // Or simply $user->fillable
            dd($fillableColumns); // Display the array of fillable columns

         */

        foreach (self::convertCsv($filePath) as $row) {
            if (!empty($row))
                $model::create([
                    'CAB' => empty($row[0]) ? null : $row[0],
                    'F' => $row[1],
                    'I' => $row[2],
                    'O' => $row[3],
                    'COMP' => $row[4],
                    'IP' => $row[5],
                    'OLD_IP' => $row[8],
                    'MAC' => $row[6],
                    'INFO' => $row[7],
                    'FLAG' => empty($row[11]) ?? false,
                    'DT_REG' => new \DateTime($row[9]),
                    'DT_UPD' => new \DateTime($row[12])
                ]);
        }

        return true;
    }
}
