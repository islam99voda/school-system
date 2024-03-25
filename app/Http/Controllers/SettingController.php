<?php

namespace App\Http\Controllers;

use App\Http\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\AttachFilesTrait;

class SettingController extends Controller
{
    use AttachFilesTrait;
    public function index(){

        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.setting.index', $setting);
    }

    public function update(Request $request){
        try{
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo'); 
                    $name = $file->getClientOriginalName(); 
                    $this->delete_one_file('public', 'logo');   
                    $this->uploadFile($file, $name, 'logo', 'public'); 
                    Setting::where('key', 'logo')->update(['value' => $name]); 
                }
            toastr()->success(trans('messages.Update'));
            return back();
        }
        catch (\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
