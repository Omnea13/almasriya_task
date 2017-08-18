<?php

namespace App\Helpers;

use App\Http\Controllers\Slim;
use Auth;

class Helper
{
    /**
     * @param  [input] from HTML input name <input name="image" type="file">
     * @param  [destination] where to upload current image
     * @return [name] name of uploaded image to store in database
     */
    public static function uploadImage($input, $destination)
	{
		$image  = Slim::getImages($input)[0];
        $imgname = $image['input']['name'];
        $ext     = pathinfo($imgname, PATHINFO_EXTENSION);
        $upname  = time().'.'.$ext;
        $data    = $image['output']['data'];
        $file    = Slim::saveFile($data, $upname, public_path().'/images/'.$destination);

        return $file['name'];
	}
}