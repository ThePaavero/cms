<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'uri' => '',
                'title' => 'Home',
                'template_id' => 1
            ],
            [
                'uri' => 'about',
                'title' => 'About',
                'template_id' => 1
            ],
            [
                'uri' => 'about/staff',
                'title' => 'Staff',
                'template_id' => 1
            ],
            [
                'uri' => 'about/philosophy',
                'title' => 'Philosophy',
                'template_id' => 1
            ],
            [
                'uri' => 'services',
                'title' => 'Services',
                'template_id' => 1
            ],
            [
                'uri' => 'services/guaranteed-quality',
                'title' => 'Guaranteed Quality',
                'template_id' => 1
            ],
        ];

        foreach ($pages as $pageData)
        {
            $page = new \App\Cms\Core\Page();
            $page->uri = $pageData['uri'];
            $page->title = $pageData['title'];
            $page->template_id = $pageData['template_id'];
            $page->save();

            $pageId = $page->id;
        }
    }
}
