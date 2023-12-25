<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Backup\StoreRequest;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupController extends AdminController
{
    private $view = 'administrator.modules.backup.';

    private $route = 'admin.backup.';

    private $module = 'module.backup';

    /**
     * BackupController constructor.
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];

        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path'     => $f,
                    'file_name'     => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size'     => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }

        $data['backups'] = array_reverse($backups);

        return view($this->view . 'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function create()
    {
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return mixed
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function store(StoreRequest $request)
    {
        $backupJob = BackupJobFactory::createFromArray(config('backup'));

        if ($request->type === "1") {
            $backupJob->dontBackupFilesystem();
            $backupJob->setFilename('database-' . date('Y-m-d-H-i-s') . '.zip');
        } elseif ($request->type === "2") {
            $backupJob->dontBackupDatabases();
            $backupJob->setFilename('source-' . date('Y-m-d-H-i-s') . '.zip');
        } else {
            $backupJob->setFilename('all-' . date('Y-m-d-H-i-s') . '.zip');
        }

        $backupJob->run();

        LogActivityHelper::addToLog([
            'module'      => 'backup',
            'action'      => 'create',
            'description' => date('Y-m-d-H-i-s') . '.zip',
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
            ], 201);
    }

    /**
     * Download backup
     *
     * @param string $filename
     * @return mixed
     * @throws \League\Flysystem\FileNotFoundException
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function download(string $filename)
    {
        $file = config('backup.backup.name') . '/' . $filename;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists($file)) {
            $fs     = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            LogActivityHelper::addToLog([
                'module'      => 'backup',
                'action'      => 'download',
                'description' => basename($file),
            ]);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type"        => $fs->getMimetype($file),
                "Content-Length"      => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => message_module($this->module, 'backup.backup_file_not_found'),
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $filename
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy(string $filename)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $filename)) {
            $disk->delete(config('backup.backup.name') . '/' . $filename);

            LogActivityHelper::addToLog([
                'module'      => 'backup',
                'action'      => 'delete',
                'description' => $filename,
            ]);

            return response()->json(
                [
                    'status'  => 'success',
                    'message' => message_module($this->module, 'crud.destroy_success'),
                ], 200);
        } else {
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => message_module($this->module, 'backup.backup_file_not_found'),
                ], 200);
        }
    }
}
