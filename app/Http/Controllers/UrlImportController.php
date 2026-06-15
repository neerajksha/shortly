<?php

namespace App\Http\Controllers;

use App\Imports\UrlImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UrlTemplateExport;

class UrlImportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required','file','mimes:csv,xlsx,xls']
        ]);

        Excel::import(
            new UrlImport(
                auth()->id()
            ),
            $request->file('file')
        );

        return back()->with(
            'success',
            'URLs imported successfully.'
        );
    }

    public function sample()
    {
        return Excel::download(
            new UrlTemplateExport(),
            'shortly-import-template.xlsx'
        );
    }
}