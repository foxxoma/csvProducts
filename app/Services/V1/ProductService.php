<?php

namespace App\Services\V1;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

use League\Csv\Reader;

class ProductService
{
    public function index(array $data = [])
    {
        $count = !empty($data['count']) ? $data['count'] : 10;

        $products = Product::orderBy('id', 'asc');
        return $products->paginate($count);
    }

    public function storeByCsv($file)
    {
        $products = [];

        $reader = Reader::createFromPath($file, 'r');
        $reader->setDelimiter(';');
        $reader->setEnclosure('"');
        $reader->setEscape('\\');

        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();

        foreach ($records as $offset => $record) {

            $cleanedRecord = [];
            foreach ($record as $key => $value) {
                $cleanedKey = trim($key, ',');
                $cleanedValue = trim($value, ',');
                $cleanedRecord[$cleanedKey] = $cleanedValue;
            }

            foreach (Product::$csvTitles as $title => $value) {
                $products[$offset-1][$value] = $cleanedRecord[$title];
            }
        }

        if (empty($products)) {
            return false;
        }

        return Product::insertOrIgnore($products);
    }
}
