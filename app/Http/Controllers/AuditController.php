<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {

        $audits = Audit::select('audits.id', 'users.rut', 'audits.auditable_type', 'audits.event')
            ->join('users', 'users.id', '=', 'audits.user_id')->get();

//        dd($audits);

        return view('audits.index', compact('audits'));
    }

    public function show($id)
    {

        $audit = Audit::find($id);

        $attributeValue = key($audit->new_values);
        $oldValue = implode("','", $audit->old_values);
        $newValue = implode("','", $audit->new_values);

        return view('audits.show', compact('audit', 'attributeValue', 'oldValue', 'newValue'));
    }
}
