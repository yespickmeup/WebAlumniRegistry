<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\Facades\Image as Image;

class UploadController extends Controller
{


    public function resizeImage()
    {
        return view('resizeImage');
    }

    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();

        $path = public_path('src/' . $filename);


        Image::make($image->getRealPath())->resize(200, 200)->save($path);

        return back()
            ->with('success', 'Image Upload successful')
            ->with('imageName', $filename);
    }

    public function fileUpload(Request $request)
    {

        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:15000',
        ]);
        $filename = $request->get('filename');
        $image = $request->file('image');
        $input['imagename'] = $filename.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/src/images/uploads');
        $image->move($destinationPath, $input['imagename']);
        return back()->with('success','Image Upload successful');
    }


    public function fileUpload2(Request $request)
    {

        $data = $request->json()->all();
        $image = $request->file('file');
        $filename = $request->get('filename');
        $input['imagename'] =  $filename.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/src/images/uploads');
        $image->move($destinationPath, $input['imagename']);


        return response()->json(['data'=>$image]);
    }
}