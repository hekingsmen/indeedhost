<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = "email_templates";
    protected $primaryKey = "id";
    protected $fillable = ['template_code', "template_name", "template_subject", "template_content"];

    public function emailTemplateValidation($request)
    {
        $rules = [
            'template_name' => 'required',
            'template_subject' => 'required',
            'template_content' => 'required'
        ];
        return validator($request->input(), $rules);
    }

    public function saveEmailTemplateDetails($request)
    {
        $inputs = $request->input();
        $emailTemplate =  EmailTemplate::updateOrCreate(['id'=>$inputs['id']], $inputs);
        return $emailTemplate;
    }
}