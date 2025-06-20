<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'spirit_id', 'answer_text', 'code'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function spirit()
    {
        return $this->belongsTo(Spirit::class);
    }
}
