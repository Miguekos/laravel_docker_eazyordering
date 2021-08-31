<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public $warehouse_id;

    public function __construct($warehouse_id){
        $this->warehouse_id = $warehouse_id;

    }

    public function collection(Collection $rows)
    {
        //$spreadsheet = IOFactory::load(storage_path('app\products.xlsx'));
        /*
        $i = 0;
        $path = [];
        foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG :
                        $extension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG :
                        $extension = 'jpg';
                        break;
                }
            } else {
                $zipReader = fopen($drawing->getPath(), 'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader, 1024);
                }
                fclose($zipReader);
                $extension = $drawing->getExtension();
            }

            $myFileName = time() .++$i. '.' . $extension;
            file_put_contents('images/products/' . $myFileName, $imageContents);

            array_push($path, $myFileName);
        }

        $i = 0;*/

        foreach ($rows as $row) 
        {
            if (isset($row['code']) && $row['description_en'] && $row['unit_price']) {
                Product::updateOrCreate(['code' => $row['code'], 'warehouse_id' => (int)$this->warehouse_id], [
                    'code' => $row['code'],
                    'category' => isset($row['category']) ? $row['category'] : '',
                    'family' => isset($row['family']) ? $row['family'] : '',
                    'description_en' => $row['description_en'],
                    'description_es' => isset($row['description_es']) ? $row['description_es'] : '',
                    'description_it' => isset($row['description_it']) ? $row['description_it'] : '',
                    'unit_weight' => isset($row['unit_weight']) ? $row['unit_weight'] : '',
                    'total_weight' => isset($row['total_weight']) ? $row['total_weight'] : '',
                    'pieces' => isset($row['pieces']) ? $row['pieces'] : '',
                    'uom' => isset($row['uom']) ? $row['uom'] : '',
                    'pack_description' => isset($row['pack_description']) ? $row['pack_description'] : '',
                    'stock' => isset($row['stock']) ? $row['stock'] : '',
                    'availability' => isset($row['availability']) ? $row['availability'] : 1,
                    'availability_date' => isset($row['availability_date']) ? $row['availability_date'] : now(),
                    'unit_price' => $row['unit_price'],
                    'total_price' => $row['unit_price']*$row['pieces'],
                    'warehouse_id' => (int)$this->warehouse_id,
                    //'photo' => $path[$i]
                ]);
            }

            //$i++;
        }

    }
}
