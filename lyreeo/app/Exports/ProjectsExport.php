<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ProjectMember;
use App\Models\ProjectDocument;

class ProjectsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $rowData = Project::leftJoin('project_status', 'project_status.fk_projectId', '=', 'projects.id')
            ->leftJoin('users', 'users.id', '=', 'projects.project_manager')
            ->leftJoin('business_units', 'business_units.id', '=', 'projects.fk_businessUnitId')
            ->select('projects.id', 'project_title', 'business_units.department_name', 'sponsor_name', 'sponsor_email',
                'users.name as project_manager', 'estimated_start_date',
                'estimated_end_date', 'is_public', 'is_group', 'projects.is_active', 'is_archive', 'projects.picture', 'project_description',
                'current_situation', 'project_objective', 'prerequisite_dependencies_exclusions', 'alternative_or_options',
                'milestones', 'required_resources', 'overall_status', 'percentage_completion', 'real_start_date','realistic_end_date', 'current_quality',
                'current_quality_explanation', 'cost_situation', 'cost_situation_explanation', 'time_planning','time_planning_explanation')
                ->get();
        foreach($rowData as $row) {
            $row['is_public'] = excelYesNo( $row['is_public'] );
            $row['is_group'] = excelYesNo( $row['is_group'] );
            $row['is_active'] = excelYesNo( $row['is_active'] );
            $row['is_archive'] = excelYesNo( $row['is_archive'] );

            $row['current_quality'] = excelGetStatusColors( $row['current_quality'] );
            $row['cost_situation'] = excelGetStatusColors( $row['cost_situation'] );
            $row['time_planning'] = excelGetStatusColors( $row['time_planning'] );
            $projectMembers = ProjectMember::where('fk_projectId', $row['id'])->select(\DB::raw("group_concat(fk_username SEPARATOR ', ') as names"))->first();
            if(isset($projectMembers->names)) {
                $row['project_members'] = $projectMembers->names;
            } else{
                $row['project_members'] = '';
            }

            unset($row['id']);
            if((isset($row['picture']) and $row['picture'] != null)) {
                $row['picture'] = url('image/'.$row['picture']);
            } else {
                $row['picture'] = url('dist/images/project-img-z.png');
            }
        }



        return $rowData;
    }

    public function headings():array
    {
        return [
            __('sentence.excel.project_name'),
            __('sentence.excel.business_unit'),
            __('sentence.excel.sponsor_name'),
            __('sentence.excel.sponsor_email'),
            __('sentence.excel.project_manager'),
            __('sentence.excel.estimated_start_date'),
            __('sentence.excel.estimated_end_date'),
            __('sentence.excel.public'),
            __('sentence.excel.group'),
            __('sentence.excel.active'),
            __('sentence.excel.archive'),
            __('sentence.excel.picture'),
            __('sentence.excel.project_description'),
            __('sentence.excel.current_situation'),
            __('sentence.excel.project_objective'),
            __('sentence.excel.prerequisite_dependencies_exclusions'),
            __('sentence.excel.alternative_or_options'),
            __('sentence.excel.milestones'),
            __('sentence.excel.required_resources'),
            __('sentence.excel.overall_status'),
            __('sentence.excel.percentage_completion'),
            __('sentence.excel.real_start_date'),
            __('sentence.excel.real_end_date'),
            __('sentence.excel.current_quality'),
            __('sentence.excel.current_quality_explanation'),
            __('sentence.excel.cost_situation'),
            __('sentence.excel.cost_situation_explanation'),
            __('sentence.excel.time_planning'),
            __('sentence.excel.time_planning_explanation'),
            __('sentence.excel.project_members')

        ];
    }
}
