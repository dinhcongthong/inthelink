<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use File;
use Image;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = ['name', 'dir', 'path', 'size', 'target_type', 'target_id'];

    public static function uploadImages($dir, $files, $target_type = 0, $target_id = 0)
    {
        $rules = config('image.rules');
        // get id array when create data in gallery
        $idArr = array();

        if (!is_null($files) && count($files) > 0) {
            try {
                foreach ($files as $item) {
                    if (!is_null($item)) {
                        $validator = Validator::make(array('files' => $item), $rules);
                        // invalid photo
                        if (!$validator->passes()) {
                            return false;
                        }
                        $path = $item->getClientOriginalExtension();
                        
                        $data = [
                            'name' => $item->getClientOriginalName(),
                            'dir' => $dir,
                            'path' => '.' . $path,
                            'target_type' => $target_type,
                            'target_id' => $target_id
                        ];
                        
                        $saveImageInfo = self::create($data);
    
                        $lastId = self::all()->last()->id;
                        $idArr[] = $lastId;
    
                        if ($saveImageInfo) {
                            $fileName = $lastId . $data['name'];
                            $destination = config('image.upload_path') . $dir;
                            $uploaded = $item->move($destination, $fileName);
    
                            if (!$uploaded) {
                                return false;
                            }
                        }
                    }
                }

                return count($idArr) > 0 ? $idArr : false;
            } catch (\Exception $e) {
                return $e;
            }
        }
        return false;
    }

    public static function deleteImages($dir, $id) {
        $gallery = self::find($id);

        if (is_null($gallery)) {
            return false;
        }

        $destination = config('image.upload_path') . $dir . '/' . $gallery->id . $gallery->name;
        
        $file = File::delete($destination);

        $gallery->delete();

        if ($file) {
            return true;
        }
        return false;
    }

    public function getUrlAttribute() {
        $destination = 'upload/' . $this->dir . '/' . $this->id . $this->name;
        return asset($destination);
    }
}
