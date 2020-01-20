<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Todo extends Model{
   //
   protected $table = 'todo_details';
   protected $fillable = ['user_id','name','description','time','status','cat_id'];
}
