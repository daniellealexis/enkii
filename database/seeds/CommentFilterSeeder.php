<?php

use App\Framework\Utilities\Filters;
use Illuminate\Database\Seeder;
use App\CommentFilter;

class CommentFilterSeeder extends Seeder
{
    private const FILTER_DIR = 'badwords';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentFilter::truncate();

        $files = scandir(__DIR__ . '/' . CommentFilterSeeder::FILTER_DIR);
        foreach ($files as $file)
        {
            if ($file == '.' || $file == '..')
                continue;

            $handle = fopen(__DIR__ . '/' . CommentFilterSeeder::FILTER_DIR . '/' . $file, "r");
            if (!$handle)
                continue;

            while (($filter = fgets($handle)) !== false)
            {
                $filter = strtolower(rtrim($filter));
                $regex = Filters::generateFilter($filter);
                if (empty($filter) || CommentFilter::where('plain_text', $filter)->orwhere('filter', $regex)->exists())
                    continue;

                CommentFilter::create([
                    'plain_text' => $filter,
                    'filter' => $regex,
                ]);
            }

            fclose($handle);
        }
    }
}
