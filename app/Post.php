<?php

namespace App;

class Post extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = 'posts';
    protected $fillable = array('url', 'title', 'description','content','image','blog','category_id','created_at_ip', 'updated_at_ip');


    public static function prevBlogPostUrl($id){
    	$blog = static::where('id', '<', $id)->orderBy('id','desc')->first();
    	return $blog ? $blog->url : '#';
    }

    public static function nextBlogPostUrl($id){
		$blog = static::where('id', '>', $id)->orderBy('id', 'asc')->first();
	    return $blog ? $blog->url : '#';
    }

    public function tags(){
		return $this->belongsToMany('App\BlogTag','blog_post_tags','post_id','tag_id');
		/*defines a many to many relationship between posts and blog_tags using the intermediate table blog_post_tags. */
    }

}
