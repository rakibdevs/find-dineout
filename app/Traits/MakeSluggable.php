<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait MakeSluggable
{
	/**
     * Set the proper slug attribute.
     *
     * @param string $value
     * @return mixed
     */

	public function setSlugAttribute($value) 
    {
        if (static::whereSlug($slug = Str::of($value)->slug('-'))->exists()) {
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Increment slug
     *
     * @param   string $slug
     * @return  string
     **/

    public function incrementSlug($slug) 
    {

        $original = $slug;
        $count = 2;
        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }

        return $slug;
    }

}