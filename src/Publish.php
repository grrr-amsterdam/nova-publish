<?php

namespace Publish;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Publish extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script("publish", __DIR__ . "/../dist/js/tool.js");
        Nova::style("publish", __DIR__ . "/../dist/css/tool.css");
    }

    public function menu(Request $request)
    {
        return MenuSection::make(__("Publish"))
            ->path("/publish")
            ->icon("cloud-upload");
    }
}
