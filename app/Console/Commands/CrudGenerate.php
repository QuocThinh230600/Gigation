<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudGenerate extends Command
{
    protected $signature = 'crud:generate {name : Class (singular) for example User}';

    protected $description = 'Create CRUD operations';

    protected $namespace = 'Administrator';

    protected $router = 'admin';

    protected $view = 'administrator';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->controller($name);
        $this->model($name);
        $this->store_request($name);
        $this->update_request($name);
        $this->eloquent($name);
        $this->repository($name);
        $this->repository_provider($name);
        $this->resources($name);
        $this->migrate($name);
        $this->view($name);
        $this->info('Generate module: ' . $name . ' successfully.You should run migrate and database seed again');
    }

    /**
     * Get theme to generate file
     *
     * @param $type
     * @return false|string
     * @author Quoc Tuan
     */
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    /**
     * Generate controller file
     *
     * @param $name
     * @author Quoc Tuan
     */
    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{controllerName}}',
                '{{controllerNameSnakeCase}}',
                '{{controllerNameCamelCase}}',
                '{{controllerNameSlug}}',
                '{{namespace}}',
                '{{viewRoot}}',
                '{{routeRoot}}'
            ],
            [
                $name,
                Str::snake($name),
                Str::camel($name),
                str_replace("_", "-", Str::snake($name)),
                $this->namespace,
                $this->view,
                $this->router
            ],
            $this->getStub('Controller')
        );

        if (!file_exists($path = app_path("/Http/Controllers/" . $this->namespace))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Http/Controllers/" . $this->namespace . "/{$name}Controller.php"), $controllerTemplate);
    }

    /**
     * Generate model file
     *
     * @param $name
     * @author Quoc Tuan
     */
    protected function model($name)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameSnakeCase}}'
            ],
            [
                $name,
                Str::snake($name)
            ],
            $this->getStub('Model')
        );

        if (!file_exists($path = app_path("Models"))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("Models/{$name}.php"), $modelTemplate);
    }

    /**
     * Generate store request file
     *
     * @param $name
     * @author Quoc Tuan
     */
    protected function store_request($name)
    {
        $requestTemplate = str_replace(
            [
                '{{requestName}}',
                '{{requestNameSnakeCase}}',
                '{{requestNameCamelCase}}',
                '{{namespace}}'
            ],
            [
                $name,
                Str::snake($name),
                Str::camel($name),
                $this->namespace
            ],
            $this->getStub('StoreRequest')
        );

        if (!file_exists($path = app_path("/Http/Requests/" . $this->namespace . "/{$name}"))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Http/Requests/" . $this->namespace . "/{$name}/StoreRequest.php"), $requestTemplate);
    }

    /**
     * Generate update request file
     *
     * @param $name
     * @author Quoc Tuan
     */
    protected function update_request($name)
    {
        $requestTemplate = str_replace(
            [
                '{{requestName}}',
                '{{requestTableName}}',
                '{{requestNameSnakeCase}}',
                '{{requestNameCamelCase}}',
                '{{namespace}}'
            ],
            [
                $name,
                strtolower(Str::snake($name)),
                Str::snake($name),
                Str::camel($name),
                $this->namespace
            ],
            $this->getStub('UpdateRequest')
        );

        if (!file_exists($path = app_path("/Http/Requests/" . $this->namespace . "/{$name}"))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Http/Requests/" . $this->namespace . "/{$name}/UpdateRequest.php"), $requestTemplate);
    }

    /**
     * Generate eloquent repository file
     *
     * @param $name
     * @author Quoc Tuan
     */
    protected function eloquent($name)
    {
        $eloquentTemplate = str_replace(
            [
                '{{eloquentName}}'
            ],
            [
                $name
            ],
            $this->getStub('Eloquent')
        );

        if (!file_exists($path = app_path("/Repositories/{$name}"))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Repositories/{$name}/Eloquent{$name}.php"), $eloquentTemplate);
    }

    /**
     * Generate repository file
     *
     * @param $name
     * @author Quoc Tuan
     */
    protected function repository($name)
    {
        $repositoryTemplate = str_replace(
            [
                '{{repositoryName}}'
            ],
            [
                $name
            ],
            $this->getStub('Repository')
        );

        if (!file_exists($path = app_path("/Repositories/{$name}"))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Repositories/{$name}/{$name}Repository.php"), $repositoryTemplate);
    }

    /**
     * Update repository in provider
     *
     * @param $name
     * @author Quoc Tuan
     */
    public function repository_provider($name)
    {
        $file01                   = file_get_contents(app_path("/Providers/RepositoriesServiceProvider.php"));
        $use_provider             = str_repeat(PHP_EOL, 1) . 'use App\Repositories\\' . $name . '\\' . $name . 'Repository;';
        $use_provider             .= str_repeat(PHP_EOL, 1) . 'use App\Repositories\\' . $name . '\\Eloquent' . $name . ';';
        $searchForUseProvider     = 'use Illuminate\Support\ServiceProvider;';
        $customUseProviders       = strpos($file01, $searchForUseProvider);
        $newChangesForUseProvider = substr_replace($file01, $use_provider, $customUseProviders + strlen($searchForUseProvider), 0);
        file_put_contents(app_path("/Providers/RepositoriesServiceProvider.php"), $newChangesForUseProvider);

        $file02                    = file_get_contents(app_path("/Providers/RepositoriesServiceProvider.php"));
        $bind_provider             = str_repeat(PHP_EOL, 1) . str_repeat(' ', 8) . '$this->app->bind(' . $name . 'Repository::class,Eloquent' . $name . '::class);';
        $searchForBindProvider     = '//Bind Provider';
        $customBindProviders       = strpos($file02, $searchForBindProvider);
        $newChangesForBindProvider = substr_replace($file02, $bind_provider, $customBindProviders + strlen($searchForBindProvider), 0);
        file_put_contents(app_path("/Providers/RepositoriesServiceProvider.php"), $newChangesForBindProvider);
    }

    /**
     * Generate resources api file
     *
     * @param $name
     * @author Quoc Tuan
     */
    public function resources($name)
    {
        $resourcesTemplate = str_replace(
            [
                '{{resourcesName}}'
            ],
            [
                $name
            ],
            $this->getStub('Resources')
        );

        if (!file_exists($path = app_path("/Http/Resources"))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(app_path("/Http/Resources/{$name}.php"), $resourcesTemplate);
    }

    /**
     * Generate migrate file
     *
     * @param $name
     * @author Quoc Tuan
     */
    public function migrate($name)
    {
        $migrateTemplate = str_replace(
            [
                '{{migrateName}}',
                '{{migrateNameSnakeCase}}',
            ],
            [
                $name,
                Str::snake($name),
            ],
            $this->getStub('Migrate')
        );

        $filename = date('Y_m_d_His') . '_' . 'create_' . Str::snake($name) . 's_table.php';

        file_put_contents(database_path("/migrations/{$filename}"), $migrateTemplate);
    }

    /**
     * Generate view index,create and update file
     *
     * @param $name
     * @author Quoc Tuan
     */
    protected function view($name)
    {
        $viewCreateTemplate = str_replace(
            [
                '{{viewName}}',
                '{{viewNameSnakeCase}}',
                '{{viewNameSlug}}',
                '{{viewRoot}}',
                '{{routeRoot}}'
            ],
            [
                $name,
                Str::snake($name),
                str_replace("_", "-", Str::snake($name)),
                $this->view,
                $this->router
            ],
            $this->getStub('ViewCreate')
        );

        $viewIndexTemplate = str_replace(
            [
                '{{viewName}}',
                '{{viewNameSnakeCase}}',
                '{{viewNameSlug}}',
                '{{viewRoot}}',
                '{{routeRoot}}'
            ],
            [
                $name,
                Str::snake($name),
                str_replace("_", "-", Str::snake($name)),
                $this->view,
                $this->router
            ],
            $this->getStub('ViewIndex')
        );

        $viewEditTemplate = str_replace(
            [
                '{{viewName}}',
                '{{viewNameSnakeCase}}',
                '{{viewNameSlug}}',
                '{{viewRoot}}',
                '{{routeRoot}}'
            ],
            [
                $name,
                Str::snake($name),
                str_replace("_", "-", Str::snake($name)),
                $this->view,
                $this->router
            ],
            $this->getStub('ViewEdit')
        );

        if (!file_exists($path = resource_path("/views/" . strtolower($this->view) . "/modules/" . Str::snake($name)))) {
            mkdir($path, 0777, true);
        }

        file_put_contents(resource_path("/views/" . strtolower($this->view) . "/modules/" . Str::snake($name) . "/create.blade.php"), $viewCreateTemplate);
        file_put_contents(resource_path("/views/" . strtolower($this->view) . "/modules/" . Str::snake($name) . "/index.blade.php"), $viewIndexTemplate);
        file_put_contents(resource_path("/views/" . strtolower($this->view) . "/modules/" . Str::snake($name) . "/edit.blade.php"), $viewEditTemplate);
    }

}
