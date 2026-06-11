<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // ეს მასივი ეუბნება ლარაველს, რომ ამ ველების შევსება უსაფრთხოა და ნებადართულია
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'priority_id',
        'user_id'
    ];

    // კავშირი კატეგორიასთან
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // კავშირი პრიორიტეტთან
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    // კავშირი იუზერთან
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}