<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $assign['pageInfo'] = ['page'  => 'Slider'];
        $assign['sliders'] = Slide::orderBy('position', 'asc')->get();

        return view('admin.slider.list', $assign);
    }

    public function store(Request $request)
    {
        // Kiểm tra nếu có file được upload
        if ($request->hasFile('image')) {
            // Lưu file vào thư mục public/images và nhận đường dẫn của file
            $imagePath = $request->file('image')->store('images', 'public');

            // Lấy tên file từ đường dẫn
            $imageName = basename($imagePath);

            // Tạo mới một slide
            $slide = new Slide();
            $slide->image = $imageName; // Lưu tên file vào cơ sở dữ liệu
            $slide->save();
        }

        // Cập nhật vị trí của các slide
        $position = 1;
        if (!empty($request->id)) {
            foreach ($request->id as $itemId) {
                Slide::where('id', $itemId)->update(['position' => $position++]);
            }
        }

        return redirect()->back()->with(['status' => 'success', 'message' => 'Lưu thành công']);
    }
    public function delete($id)
    {
        Slide::destroy($id);

        return redirect()->back()->with(['status' => 'success', 'message' => 'Delete success']);
    }

    public function upload(Request $request)
    {
        // $dataRequest = $request->file('image');
        // $imageFile = $dataRequest->getClientOriginalName();
        // Slide::create([
        //     'link' => $imageFile,
        //     'image' => $imageFile
        // ]);
          // Kiểm tra nếu có file được upload
          if ($request->hasFile('image')) {
            // Lưu file vào thư mục public/images và nhận đường dẫn của file
            $imagePath = $request->file('image')->store('images', 'public');

            // Lấy tên file từ đường dẫn
            $imageName = basename($imagePath);

            // Tạo mới một slide
            $slide = new Slide();
            $slide->image = $imageName; // Lưu tên file vào cơ sở dữ liệu
            $slide->save();
        }

        // Cập nhật vị trí của các slide
        $position = 1;
        if (!empty($request->id)) {
            foreach ($request->id as $itemId) {
                Slide::where('id', $itemId)->update(['position' => $position++]);
            }
        }


        return redirect()->back()->with(['status' => 'success', 'message' => 'Upload success']);
    }
}
