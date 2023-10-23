<?php

namespace Modules\Backup\Http\Controllers;

use App\dars;
use App\paye;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Log;


class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $claas = DB::table('clas')
            ->orderBy('paye')->orderBy('classnamber')
            ->get();
        $paye = paye::all();
        $dars = dars::all()->sortBy('paye')->sortBy('name');
        $navbar = ['name' => 'پشتیبان گیری', 'description' => 'مدیریت بکاپ ها'];
        $disk = Storage::disk('local');
        $files = $disk->files('Laravel');
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        return view('backup::index',compact('claas','paye','dars','navbar'))->with(compact('backups'));
    }
    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run',['--only-db'=>true]);
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Downloads a backup zip file.
     *
     */
    public function download($file_name)
    {
        $file = '../storage/app/Laravel/'.$file_name;
        $name = basename($file);
        return response()->download($file, $name);
    }
    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk('local');
        if ($disk->exists('Laravel'. '/' . $file_name)) {
            $disk->delete('Laravel' . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
