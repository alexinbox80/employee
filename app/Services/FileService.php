<?php

namespace App\Services;

use Carbon\Carbon;
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

        //fgetcsv($handle, separator: ';');
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
    public static function convertProcess(string $filePath, Model $model, bool $flagId = true): bool
    {
        $fillableColumns = $model->getFillable();

        $array = [];
        foreach (self::convertCsv($filePath) as $row) {
            if (!empty($row)) {
                foreach ($row as $key => $item) {
                    if (($key > 0) && ($item != '') && ($flagId === true)) {
                        if ($fillableColumns[$key - 1] === 'birth_date') {
                            $item = Carbon::createFromFormat('d.m.Y', $item)->format('Y-m-d');
                        }
                        $array[$fillableColumns[$key - 1]] = $item;
                    }

                    if (!empty($item) && ($flagId === false)) {
                        if ($fillableColumns[$key] === 'date') {
                            $item = Carbon::createFromFormat('d.m.Y', $item)->format('Y-m-d');
                        }
                        $array[$fillableColumns[$key]] = $item;
                    }
                }
                $model::create($array);
            }
            $array = [];
        }

        return true;
    }
}
