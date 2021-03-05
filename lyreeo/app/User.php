<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'language'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $sortOrder = 'asc';
    public $sortEntity = 'users.id';

    public function projectManagers()
    {
        return $this->leftJoin('roles', 'roles.id', '=', 'users.role')->where('roles.project_management_panel', 1)//->where('roles.name', 'Project Manager')
            ->where('users.is_active', '1')->pluck('users.name', 'users.id')->toArray();
    }

    public function validatePassword($params=null,$old_image=null){
        
        $oldPassword = self::where('id',Auth::user()->id)->pluck('password')->first();

        if(!empty($params['old_password']) && isset($params['old_password'])){

            $isPasswordCorrect = Hash::check($params['old_password'], $oldPassword);
            if($isPasswordCorrect==false){
                return 400;
            }
            $newInputPassword = Hash::make(trim($params['password']));

        }else{
            $newInputPassword = $oldPassword;
        }
            $data = array(
                    'password' => $newInputPassword,
                    'job_title' => $params['job_title'],
                    'language' => $params['language'],
                );
            if(!empty($old_image)){ $data['avatar']=$old_image; }
			$duration = 12*24*60*60;
			\Cookie::queue('locale', $params['language'], $duration);
            $res = self::where('id',Auth::user()->id)->update($data);
            
            if($res){
                return 200;
            }
        
    }

    public function userRole()
    {
        return $this->belongsTo('App\Models\Role','role','id');
    }

}
