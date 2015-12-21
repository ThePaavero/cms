<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $pages = [
            [
                'uri' => '',
                'title' => 'Home',
                'templateSlug' => 'default'
            ],
            [
                'uri' => 'about',
                'title' => 'About',
                'templateSlug' => 'default'
            ],
            [
                'uri' => 'about/staff',
                'title' => 'Staff',
                'templateSlug' => 'wide_content'
            ],
            [
                'uri' => 'about/philosophy',
                'title' => 'Philosophy',
                'templateSlug' => 'default'
            ],
            [
                'uri' => 'services',
                'title' => 'Services',
                'templateSlug' => 'default'
            ],
            [
                'uri' => 'services/guaranteed-quality',
                'title' => 'Guaranteed Quality',
                'templateSlug' => 'default'
            ],
        ];

        foreach ($pages as $pageData)
        {
            $page = new \App\Cms\Core\Page();
            $page->uri = $pageData['uri'];
            $page->title = $pageData['title'];
            $page->templateSlug = $pageData['templateSlug'];
            $page->save();

            $pageId = $page->id;

            $content = new \App\Cms\Core\Content();
            $content->content = $faker->sentence(20);
            $content->contentTypeSlug = 'textBlock';
            $content->parentId = $pageId;
            $content->save();
        }
    }
}
