<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    // $src = $this->fileSave('files/categories/',$request,'inputName');
    public function fileSave($path, $request, $inputName)
    {
        $name = null;
        if ($request->hasFile($inputName)) {
            $file = $request->{$inputName};
            $name = $file->hashName();
            $file->move(public_path($path), $name);
        }
        return $name;
    }

    public function multiFileSave($path, $request, $inputName)
    {
        $names = [];
        if ($request->hasFile($inputName)) {
            foreach ($request->file($inputName) as $file) {
                $name = $file->hashName();
                $file->move(public_path($path), $name);
                $names[] = $name;
            }

        }
        return $names;
    }

    // $this->fileDelete('files/categories/'.$category->src);
    public function fileDelete($path, $driver = 'public'): bool
    {
        if ($driver == 's3') {
            Storage::disk('s3')->delete($path);
        } else {
            if (File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
        }

        return true;
    }

    // $src   = $this->fileUpdate($category->src, $request->hasFile('foto'), $request->foto, 'files/categories/');
    public function fileUpdate($name, $fileSend, $file, $path)
    {
        if ($fileSend) {
            if (File::exists(public_path($path . $name))) {
                File::delete(public_path($path . $name));
            }

            $name = $file->hashName();
            $file->move(public_path($path), $name);
        }

        return $name;
    }

    public function fileSaveWithCrop($file, $path, $driver = 'public'): string
    {
        if ($driver == 'public') {
            return $this->saveBase64ToPublic($path, $file);
        } else {
            return $this->saveBase64ToS3($path, $file);
        }
    }

    private function saveBase64ToS3($path, $file): string
    {
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));
        $imageName = $path . str_random(10) . '-' . time() . '.png';

        Storage::disk('s3')->put($imageName, $image, 'public');

        return $imageName;
    }

    private function saveBase64ToPublic($path, $file): string
    {
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $name = time() . '.png';
        $image_parts = explode(";base64,", $file);
        $image_base64 = base64_decode($image_parts[1]);
        $file = public_path($path) . $name;
        file_put_contents($file, $image_base64);
        return $path . $name;
    }

    public function fileUpdateWithCrop($name, $fileSend, $file, $path): string
    {
        if ($fileSend) {
            if (File::exists(public_path($path . $name))) {
                File::delete(public_path($path . $name));
            }

            $name = $this->saveBase64($path, $file);
        }
        return $name;
    }

    public function fileUpdateWithIntervention($name, $fileSend, $file, $path)
    {
        if ($fileSend) {
            if (File::exists(public_path($path . $name))) {
                File::delete(public_path($path . $name));
            }

            // $name   = $file->hashName();
            // $file->move(public_path($path), $name);

            $name = $file->hashName();

            $destinationPath = public_path($path);
            $img = Image::make($file->getRealPath());
            $img->resize(500, null, static function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $name);

            //            $file->move(public_path($path), $name);
        }

        return $name;
    }

    public function profileUploader($new_file, $old_file, $driver = 'public'): string
    {
        if ($driver == 's3') {
            $path = $this->profileUploaderToS3($new_file, $old_file);
        } else {
            $path = $this->profileUploaderToPublic($new_file, $old_file);
        }

        return $path;
    }

    private function profileUploaderToPublic($new_file, $old_file): string
    {
        if (File::exists($old_file) && $old_file != 'avatar.png') {
            File::delete($old_file);
        }

        $new_name = $new_file->hashName();

        $image_resize = Image::make($new_file->getRealPath());
        $image_resize = $image_resize->orientate();
        $image_resize->resize(200, null, static function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $path = 'assets/avatars/' . $new_name;
        $image_resize->save(public_path($path));
        return $path;
    }

    private function profileUploaderToS3($new_file, $old_file): string
    {
        if ($old_file != 'avatar.png') {
            Storage::disk('s3')->delete($old_file);
        }

        $image_name = $new_file->hashName();
        return $new_file->storeAs(
            'avatars',
            $image_name,
            's3'
        );
    }
}
