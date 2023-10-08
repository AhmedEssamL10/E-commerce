<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function delete($id)
    {
        Complaint::where('id', $id)->delete();
        return redirect(route('dashboard'));
    }
}
