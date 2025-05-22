<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{

    public function allBlock()
    {
        $blocks = Block::latest()->get();

        return view('admin.block.all_block',compact('blocks'));
    }

    public function addBlock()
    {

        return view('admin.block.add_block');
    }

    public function addBlockStore(Request $request)
    {


        $request->validate([
            'Name' => 'required|string',


            'Photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',

        ], [
            'Name.required' => 'حقل الاسم مطلوب.',
            'Name.string' => 'يجب أن يكون الاسم  نصًا.',







            'Photo.image' => 'يجب أن يكون الملف صورة.',
            'Photo.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'Photo.max' => 'يجب ألا يتجاوز حجم الصورة 60 ميغابايت.',


        ]);



        $filenamePhoto = "";

        if ($request->file('Photo')) {
            // $file = $request->file('photo');
            // $filename = date('YmdHi').$file->getClientOriginalName();
            // $file->move(public_path('upload/user_images'),$filename);


            $file = $request->file('Photo');
            $filenamePhoto = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('blocks'), $filenamePhoto);
        }






        Block::create([
            'Name' => $request->Name,
            'Latitude' => $request->Latitude,

            'Longitude' => $request->Longitude,
            'Start' => $request->Start,
            'End' => $request->End,
            'BlockNumber' => $request->BlockNumber,
            'BlockType' => $request->BlockType,
            'Photo' =>  $filenamePhoto,

        ]);

        $notification = array(
            'message' => 'تم اضافة البلوك',
            'alert-type' => 'success'
        );

        return redirect()->route('all.block')->with($notification);


        // return $request;

    }


    public function editBlock($id)
    {

        $block = Block::findOrFail($id);






        return view('admin.block.edit_block',compact('block'));





    }




    public function editBlockStore(Request $request)
    {


        $block_id = $request->id;
        $old_Photo = $request->old_Photo;

        $block = Block::findOrFail($block_id);





        $request->validate([
            'Name' => 'required|string',


            'Photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000',

        ], [
            'Name.required' => 'حقل الاسم مطلوب.',
            'Name.string' => 'يجب أن يكون الاسم  نصًا.',







            'Photo.image' => 'يجب أن يكون الملف صورة.',
            'Photo.mimes' => 'يجب أن تكون الصورة من نوع jpeg أو png أو jpg أو gif.',
            'Photo.max' => 'يجب ألا يتجاوز حجم الصورة 60 ميغابايت.',


        ]);


        // $filename = "";

        $pathPhoto = 'blocks/'.$old_Photo;




        if ($request->file('Photo')) {


            $file = $request->file('Photo');
            $filename = date('YmdHi') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('blocks'), $filename);


            if (file_exists($pathPhoto) && $old_Photo != "" ) {
                unlink($pathPhoto);
             }


             $block->Photo = $filename;








        }








        $block->Name = $request->Name;
        $block->Latitude = $request->Latitude;
        $block->Longitude = $request->Longitude;


        $block->Start = $request->Start;
        $block->End = $request->End;

        $block->BlockNumber = $request->BlockNumber;
        $block->BlockType = $request->BlockType;



        $block->save();

        $notification = array(
            'message' => 'تم التعديل',
            'alert-type' => 'success'
        );
        return redirect()->route('all.block')->with($notification);











    }


    public function deleteBlock($id){


        $block = Block::findOrFail($id);
        $Photo = $block->Photo;




        // unlink($img );

      //  return $user->photo;




        $pathPhoto = 'blocks/'.$block->Photo;

        if ($block->Photo && file_exists(public_path($pathPhoto))) {
            unlink(public_path($pathPhoto));
        }


        Block::findOrFail($id)->delete();
        $notification = array(
            'message' => 'تم حذف',
            'alert-type' => 'success'
        );
        return redirect()->route('all.block')->with($notification);

        // return redirect()->back()->with($notification);
    }// End Method



    public function showFrontEndBlock($id)
    {

        $block = Block::findOrFail($id);

        return view('frontend.block.block',compact('block'));
    }


    public function blockInactive($id){
        Block::findOrFail($id)->update(['status' => 'inactive']);
        $notification = array(
            'message' => ' غير مفعل',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method
      public function blockActive($id){
        Block::findOrFail($id)->update(['status' => 'active']);
        $notification = array(
            'message' => 'مفعل',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method




     //Api


     public function getBlockApi(Request $request)
     {
         $limit = (int) $request->limit; // Get limit from query, default to 0

         // Fetch blocks based on limit
         $blocks = $limit > 0
             ? Block::latest()->take($limit)->get()
             : Block::latest()->get();

         return response()->json($blocks);
     }
}
