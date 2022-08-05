<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ProductService $service)
    {
        $data = Storage::get('tmp/products.json');
        if (!$data) {
            return;
        }

        $data = json_decode($data, true);
        foreach ($data as $product) {
            $service->create($product);
        }
    }
}
