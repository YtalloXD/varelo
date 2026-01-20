<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imer extends Model
{
    protected $fillable = [
        'message',
    ];

    // $user = \App\Models\User::create([\
    //  . 'name' => 'Jane Doe',\
    //  . 'email' => 'janedoes@gmail.com',\
    //  . 'password' => bcrypt('amogus')\
    //  . ]);

    public function user()
    {
        return $this->belongsTo(User::class);    
    }
}





// [
//         [
//             'author' => 'Jane Doe',
//             'message' => 'Yep, that is me.',
//             'time' => '5 minutes ago'
//         ],
//         [
//             'author' => 'Hebert Richard',
//             'message' => 'Versão Brasileira, Hebert Richard? Versão Brasileira, Hebert Richard.',
//             'time' => '1 hour ago'
//         ],
//         [
//             'author' => 'Jose',
//             'message' => 'Wandering around Mementos...',
//             'time' => '3 hours ago'
//         ]
//     ];