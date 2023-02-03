<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use  \App\Models\Category;


/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Ganga"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="title", type="string", readOnly="true", description="Titulo Ganga"),
 * @OA\Property(property="description", type="string", readOnly="true", description="Descripcion Ganga"),
 * @OA\Property(property="url", type="string", readOnly="true", description="url Ganga"),
 * @OA\Property(property="likes", type="integer", readOnly="true", description="numero de me gusta de Ganga"),
 * )
 */
class Ganga extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'ganga';
    protected $hidden = ['description'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
