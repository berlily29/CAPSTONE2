<?php

namespace App\Http\Controllers;

use App\Models\AppConfig;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppConfigController extends Controller
{

    protected function delete_existing($filename) {
        $media_path = 'images/logo/' . $filename;


        if(file_exists($media_path)) {
            unlink($media_path);
        }



    }
    public function index(){
        return view('admin.config.view')->with([
            'config'=> AppConfig::where('id',1)->first()
        ]);
    }

    public function update(Request $request) {
        $config = AppConfig::where('id', 1)->first();

        $config->update([
            'name'=> $request->name
        ]);


        $path = 'images/logo/';
        if($request->hasFile('primary')) {

            $this->delete_existing($config->primary_logo );
            $primary = 'primary.' . $request->file('primary')-> getClientOriginalExtension();


            $request->file('primary')->move($path, $primary);
            $config->update([
                'primary_logo'=>$primary
            ]);



        }

        if($request->hasFile('secondary')) {
            $this->delete_existing($config->secondary_logo);
            $secondary = 'secondary.' . $request->file('secondary')-> getClientOriginalExtension();

            $request->file('secondary')->move($path, $secondary);

            $config->update([
                'secondary_logo'=> $secondary
            ]);


        }


        return response() ->json([
            'success'=>true
        ]);


    }
}
