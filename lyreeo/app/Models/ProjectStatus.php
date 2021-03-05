<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Carbon\Carbon;

class ProjectStatus extends Model
{
    protected $table = "project_status";
    protected $primaryKey = "id";
    protected $fillable = ['fk_projectId', "overall_status", "percentage_completion", "real_start_date", "realistic_end_date", "current_quality",
        "current_quality_explanation", "cost_situation", "cost_situation_explanation", "time_planning", "time_planning_explanation", "updated_by"];

    public function projectStatusValidation($request)
    {
		$inputs = $request->all();
		if(isset($inputs['real_start_date'])){ 
			$inputs['real_start_date'] = Carbon::createFromFormat('d/m/y', $inputs['real_start_date'])->format('Y-m-d');
		}
		if(isset($inputs['realistic_end_date'])){
				$inputs['realistic_end_date'] = Carbon::createFromFormat('d/m/y', $inputs['realistic_end_date'])->format('Y-m-d');
		} 
        return $validator = Validator::make($inputs , [
            'overall_status' => 'required',
            'percentage_completion' => 'required|numeric|max:100|min:0',
            'real_start_date' => 'required|before:realistic_end_date',
            'realistic_end_date' => 'required|after:real_start_date',
            'current_quality' => 'required',
            'current_quality_explanation' => 'required_if:current_quality,2,1',
            'cost_situation' => 'required',
            'cost_situation_explanation' => 'required_if:cost_situation,2,1',
            'time_planning' => 'required',
            'time_planning_explanation' => 'required_if:time_planning,2,1',
        ], [
            'current_quality_explanation.required_if'=>'This field is required',
            'cost_situation_explanation.required_if'=>'This field is required',
            'time_planning_explanation.required_if'=>'This field is required'
        ]);
    }

    public function saveProjectStatus($request)
    {
        $inputs = $request->input();
		if(isset($inputs['real_start_date'])){ 
			$inputs['real_start_date'] = Carbon::createFromFormat('d/m/y', $inputs['real_start_date'])->format('Y-m-d');
		}
		if(isset($inputs['realistic_end_date'])){
				$inputs['realistic_end_date'] = Carbon::createFromFormat('d/m/y', $inputs['realistic_end_date'])->format('Y-m-d');
		}  dd($inputs);
        $projectStatus = $this->updateOrCreate(['id'=>$inputs['id']], $inputs);
        return $projectStatus;
    }
}
