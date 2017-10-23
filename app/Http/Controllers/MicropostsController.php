<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Micropost;    // 追加
use App\User;    // 追加☆

use Illuminate\Support\Facades\Input;                  // 追加
use Intervention\Image\ImageManagerStatic as Image;    // 追加

class MicropostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:255',
        ]);
        
        // 初期化
        $fileName = '';

        if($request->hasFile('photo')) {
            $Extension = $request['photo']->getClientOriginalExtension();
            if ($Extension == 'jpg' or $Extension == 'gif' or $Extension == 'png') {
                // ファイル保存
                $fileName = $request['photo']->getClientOriginalName();
                $fileName = date('YmdHms')."_".$request->user()->id."_".$fileName;
                $photo = Input::file('photo');
                Image::make($photo)->save(public_path() . '/images/' .$fileName);
            } else {
                // エラー処理
                $error = '画像ファイルではありません。';
                return redirect()->back()->withErrors($error)->withInput();
            }
        }
 
        $request->user()->microposts()->create([
            'content' => $request->content,
            'filename' => $fileName,
        ]);

    
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $micropost = Micropost::find($id);
        
        if (\Auth::user()->id === $micropost->user_id) {
            // 画像ファイルを削除する
            if ($micropost->filename !== "") {
                \File::delete(public_path() . '/images/' .$micropost->filename);
            } 
            
            // micropostを削除する時に全てのBookmarkを外す(削除)
            $micropost->all_unbookmark($id);

            // micropostを削除
            $micropost->delete();
        }
        
        return redirect()->back();
    }
}
