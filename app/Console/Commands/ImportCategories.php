<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import categories from json';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CategoryService $service)
    {
        $data = Storage::get('tmp/categories.json');
        if (!$data) {
            return;
        }

        $data = json_decode($data, true);
        foreach ($data as $category) {
            $service->create($category);
        }
    }
}
