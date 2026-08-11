<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index()
    {
        $semuaLog = AuditLog::with('user')
                            ->orderBy('id', 'desc')
                            ->get();

        return view('audit_log.index', compact('semuaLog'));
    }
}