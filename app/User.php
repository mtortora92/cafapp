<?php

namespace cafapp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'nome',
        'cognome',
        'username',
        'password',
        'idRuolo',
        'isValid',
        'caf_id',
        'remember_token'
    ];

    protected $guarded = [];

    public static function getUtentiSupervisorPerCaf($idCaf){
        return User::where('idRuolo',1)->where('caf_id',$idCaf)->get();
    }

    public static function getUtentiNormaliPerCaf($idCaf){
        return User::where('idRuolo',2)->where('caf_id',$idCaf)->get();
    }

    public static function insertUser($data){
        return User::create([
            'nome' => $data['nome'],
            'cognome' => $data['cognome'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'idRuolo' => $data['role'],
            'caf_id' => $data['caf_id'],
        ]);
    }

    public function isSuperAdmin(){
        if($this->idRuolo == 3){
            return true;
        } else {
            return false;
        }
    }

    public function isSupervisor(){
        if($this->idRuolo == 1){
            return true;
        } else {
            return false;
        }
    }
}
