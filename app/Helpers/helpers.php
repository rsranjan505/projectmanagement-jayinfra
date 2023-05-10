<?php

function recordSave($table,$req,$extra_data=null,$codition=null)
{
    //record update
    if(isset($req['id'])){
        $model=$table::find($req['id']);

        if(! isset($model->id)){
            return false;
        }
        collect($req)->map(function($val,$key) use($model,$extra_data){

            if($key!='_token' && $key!='_method'){
                $model->$key=$val;

                if($extra_data!=null){
                    $extra_data->map(function($extra_data_val,$key) use($model){
                        $model->$key=$extra_data_val;
                    });
                }
            }
        });
    }else{
        //record insert
        $model=new $table();
        collect($req)->map(function($val,$key) use($model,$extra_data){
            if($key!='_token'){
                $model->$key=$val;

                if($extra_data!=null){
                    $extra_data->map(function($extra_data_val,$key) use($model){
                        $model->$key=$extra_data_val;
                    });
                }
            }
        });
    }
    return $model->save() ? $model : false;
}

function fileUpload($file, $model, $storageType='local'): array
{
    try {
        if($storageType == 'local'){
            $extension = $file->getClientOriginalExtension();
            $filename = $model->id.'_'.time().'.'.$extension;


            $path = 'images'.'/'.$model->getTable().'/';

            $folder = public_path('/storage/'.$path);
            if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
            }

            $file->move($folder, $filename);
            $image = url('/storage/' . $path . $filename);

            $datas = [
            'filename' => $filename,
            'filepath' =>'/storage/'.$path.$filename,
            'url'=> $image,
            'original_name'=> $file->getClientOriginalName(),
            'filetype' =>  $file->getClientMimeType(),
            'created_by' => auth()->user()->id,
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

