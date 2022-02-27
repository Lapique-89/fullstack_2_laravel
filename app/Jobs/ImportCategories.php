<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImportCategories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $filePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filePath)
    {
       $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cont = fopen($this->filePath, 'r');     

        $i = 0;
        $insert = [];
        while ($row = fgetcsv($cont, 1000, ';')) {
            if ($i++ == 0) {
                $bom = pack('H*','EFBBBF');
                $row = preg_replace("/^$bom/", '', $row);
                $columns = $row;
                continue;
            }
    
            $data = array_combine($columns, $row);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $insert[] = $data;        
        }    
        Category::upsert($insert,['id'],$columns);
        
        
    }
}
