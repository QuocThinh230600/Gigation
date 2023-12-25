<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Config\UpdateRequest;
use App\Repositories\Config\ConfigRepository;
use App\Models\Config as ModelsConfig;


class ConfigController extends AdminController
{
    private $view = 'administrator.modules.config.';

    private $route = 'admin.config.';

    private $module = 'module.config';

    private $config;

    /**
     * ConfigController constructor.
     * @param ConfigRepository $config
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ConfigRepository $config)
    {
        parent::__construct();

        $this->middleware('permission:config_edit', ['only' => ['edit', 'update']]);

        $this->config = $config;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function edit()
    {
        $data['config'] = $this->config->get_all_config();

        return view($this->view . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @return mixed
     * @throws \Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(UpdateRequest $request)
    {
        $this->config->update_value('website_name', $request->website_name);
        $this->config->update_value('title', $request->title);
        $this->config->update_value('meta_robots', is_null($request->meta_robots) ? null : implode(",", $request->meta_robots));
        $this->config->update_value('meta_google_bot', is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot));
        $this->config->update_value('meta_keywords', $request->meta_keywords);
        $this->config->update_value('meta_description', $request->meta_description);
        $this->config->update_value('copyright', $request->copyright);
        $this->config->update_value('author', $request->author);
        $this->config->update_value('placename', $request->placename);
        $this->config->update_value('region', $request->region);
        $this->config->update_value('position', $request->position);
        $this->config->update_value('icbm', $request->icbm);
        $this->config->update_value('revisit_after', $request->revisit_after);
        $this->config->update_value('facebook', $request->facebook);
        $this->config->update_value('youtube', $request->youtube);
        $this->config->update_value('twitter', $request->twitter);
        $this->config->update_value('linkedin', $request->linkedin);
        $this->config->update_value('google_plus', $request->google_plus);
        $this->config->update_value('google_analytics', $request->google_analytics);
        $this->config->update_value('google_ads', $request->google_ads);
        $this->config->update_value('facebook_script', $request->facebook_script);
        $this->config->update_value('chat', $request->chat);
        $this->config->update_value('logo', $request->logo);
        $this->config->update_value('favicon', $request->favicon);
        $this->config->update_value('contrast_logo', $request->contrast_logo);
        $this->config->update_value('error_image', $request->error_image);
        $this->config->update_value('js', $request->js);
        $this->config->update_value('css', $request->css);

        $config = $this->config->get_all_config();

        LogActivityHelper::addToLog([
            'module' => 'config',
            'action' => 'edit',
        ]);
        ModelsConfig::flushQueryCache(['config']);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit'),
                'result'   => array('config' => $config)
            ], 200);
    }
}
