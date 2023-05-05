<?php

if (!function_exists('fileUpload')) {
    function fileUpload($file, $model, $storageType='local'): array
    {
        try {
            if($storageType == 'local'){
                $extension = $file->getClientOriginalExtension();
                $filename = $model->id.'_'.time().'.'.$extension;
                if($model->staff){
                    $filename = $model->staff->employeeId.'_'.time().'.'.$extension;
                }

                $path = tenant()->id.'/'.$model->getTable().'/';

                $folder = public_path('/storage/'.$path);
                if (!File::exists($folder)) {
                File::makeDirectory($folder, 0775, true, true);
                }

                $file->move($folder, $filename);
                $image = url('/storage/' . $path . $filename);

                $datas = [
                'name' => $filename,
                'title' => $filename,
                'file' =>'/storage/'.$path.$filename,
                'url'=> $image,
                'originalName'=> $file->getClientOriginalName(),
                'mimeType' =>  $file->getClientMimeType(),
                'addedBy' => auth()->user()->id,
                ];
                return $datas;
            }
            else{
                return [];
            }
        } catch (Exception $e) {
            return [];
        }
    }
}


