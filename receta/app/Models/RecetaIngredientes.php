<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

use Illuminate\Database\Eloquent\SoftDeletes;

class RecetaIngredientes extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "receta_ingredientes";
    
    protected $fillable = [
        "idreceta",
        "idingrediente",
        "cantidad_ingrediente",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function ingredientes()
    {
        return $this->hasMany(RecetaIngredientes::class,"foreign_key","localkey");
    }
}
