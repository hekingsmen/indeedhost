<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Validator;
use DB;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $emailTemplates = EmailTemplate::all();
        return view('backend.email_templates.list', compact('emailTemplates'));
    }

    public function templateDetails($id=null)
    {
        $emailTemplateDetail = EmailTemplate::find($id);
        return view('backend.email_templates.add', compact('emailTemplateDetail'));
    }

    public function saveDetails(Request $request)
    {
        $validation = (new EmailTemplate)->emailTemplateValidation($request);
        if($validation->fails()) {
            return webResponse(false, 206, $validation->getMessageBag());
        }
        try
        {
            \DB::beginTransaction();
             (new EmailTemplate)->saveEmailTemplateDetails($request);
            \DB::commit();
            return webResponse(true, 200, 'Email Template saved.');
        } catch (\Exception $e)
        {
            \DB::rollBack();
            return webResponse(false, 207, __('message.server_error'));
        }
    }
}