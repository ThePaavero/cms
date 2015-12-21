<?php

use Illuminate\Database\Seeder;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [
            'Basic Template',
            'Gallery Template'
        ];

        foreach($templates as $name)
        {
            $template = new \App\Cms\Core\Template();
            $template->name = $name;
            $template->save();
        }
    }
}
