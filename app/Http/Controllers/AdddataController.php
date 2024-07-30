<?php

namespace App\Http\Controllers;

use App\Models\Beautician;
use App\Models\Service;
use App\Models\AvailableTime;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdddataController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $beauticians = Beautician::all();
        $availableTimes = AvailableTime::orderByRaw("CAST(SUBSTRING_INDEX(time_slot, '->', 1) AS TIME)")->get();
        $trashedbeautician = Beautician::onlyTrashed()->paginate(5); // Retrieve all soft-deleted services

        return view('admin.admin-add', compact('services', 'beauticians', 'availableTimes','trashedbeautician'));
    }
    public function storeBeautician(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:beauticians',
        ],
        [
            'name.required' => 'กรุณากรอกชื่อ',
            'name.unique' => 'มีชื่อนี้อยู่แล้ว',
            'name.string' => 'เป็นตัวอักษร',
            'name.max' => 'ตัวอักษรไม่เกิน 255',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Beautician::create([
            'name' => $request->input("name"),
        ]);

        return redirect()->route('admin.addindex')->with('toast_success', 'เพิ่มช่างเรียบร้อย');
    }


    public function storeService(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:services',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ],
        [
            'name.required' => 'กรุณากรอกชื่อ',
            'name.unique' => 'มีชื่อนี้อยู่แล้ว',
            'name.string' => 'เป็นตัวอักษร',
            'name.max' => 'ตัวอักษรไม่เกิน 255',
            'price.required' => 'กรุณาใส่ราคา',
            'price.numeric' => 'ระบุราคาเป็นตัวเลข',

        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Service::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('admin.addindex')->with('toast_success', 'เพิ่มบริการเรียบร้อย');
    }
    
    public function storeAvailableTime(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'time_slot' => 'required|string|max:20|unique:available_times',
        ],
        [
            'time_slot.required' => 'กรุณากรอกช่วงเวลา',
            'time_slot.string' => 'ระบุช่วงเวลาเป้นช่วง',
            'time_slot.max' => 'ช่วงเวลาไม่เกิน 20  หลัก',
            'time_slot.unique' => 'มีช่วงเวลานี้อยู่แล้ว',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        AvailableTime::create([
            'time_slot' =>$request->input('time_slot'),
        ]);

        return redirect()->back()->with('toast_success', 'เพิ่มช่วงเวลาเรียร้อยแล้ว');
    }

    public function updateservice(Request $request,$service_id){
        //Rule::unique('services')->whereNull('deleted_at')->ignore($service_id), // Unique validation, excluding current service
        $validator = Validator::make($request->all(), [
            'name' => ['nullable',
                'string',
                'max:255',
                Rule::unique('services'), // Unique validation, excluding current service
            ],
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',

        ],
        [
            'name.unique' => 'มีบริการนี้อยู่แล้ว',
            'price.numeric'=>'ต้องเป็นตัวเลข',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $service = Service::findOrFail($service_id);
        $service->update([
            'name' => $request->input('name')?? $service->name,
            'description' => $request->input('description')?? $service->description,
            'price' => $request->input('price')?? $service->price,
        ]);
        return redirect()->route('admin.addindex')->with('toast_success', 'อัพเดตบริการเรียบร้อย');

    }   
    public function updatebeautician(Request $request,$beautician_id){
        //Rule::unique('services')->whereNull('deleted_at')->ignore($service_id), // Unique validation, excluding current service
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('beauticians'), // Unique validation, excluding current service
            ],

        ],
        [
            'name.required' => 'กรุณากรอกชื่อ',
            'name.unique' => 'ชื่อนี้มีอยู่แล้ว',
            'name.string' =>'ต้องเป็นตัวอักษรเท่านั้น',
            'name.max'=>'ตัวอักษรไม่เกิน 255',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $beautician = Beautician::findOrFail($beautician_id);
        if (!$beautician) {
            // ไม่พบเรคคอร์ดที่ตรงกับ $beautician_id
            return back()->with('toast_error', 'ไม่พบรายการที่ต้องการอัพเดต');
        }
        $beautician->update([
            'name' => $request->input('name')?? $beautician->name,

        ]);
        return redirect()->route('admin.addindex')->with('toast_success', 'อัพเดตชื่อเรียบร้อย');

    }

    public function updatetime(Request $request,$time_slot_id){
        //Rule::unique('services')->whereNull('deleted_at')->ignore($service_id), // Unique validation, excluding current service
        $validator = Validator::make($request->all(),[
            'time_slot' => [
                'required',
                'string',
                'max:20',
                Rule::unique('available_times','time_slot'), // Unique validation, excluding current service
            ],

        ],
        [
            'time_slot.required' => 'กรุณากรอกช่วงเวลา',
            'time_slot.unique' => 'ช่วงเวลานี้มีอยู่แล้ว',
            'time_slot.string' =>'ต้องเป็นตัวอักษรเท่านั้น',
            'time_slot.max'=>'ตัวอักษรไม่เกิน 20',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $AvailableTime = AvailableTime::findOrFail($time_slot_id);
        $AvailableTime->update([
            'time_slot' => $request->input('time_slot')?? $AvailableTime->name,

        ]);
        return redirect()->route('admin.addindex')->with('toast_success', 'อัพเดตช่วงเรียบร้อย');

    }

    public function servicedelete($service_id){
        $service = Service::where('id',$service_id)->firstOrFail();
        $service->delete();
        return redirect()->back()->with('toast_success','ลบบริการเรียบร้อย');

    }
    public function beauticiandelete($beautician_id){
        $beautician=Beautician::findOrFail($beautician_id);
        $beautician->delete();
        return redirect()->back()->with('toast_success','ลบช่างเรียบร้อย');
    }
    public function timedelete($time_slot_id){
        $AvailableTime = AvailableTime::where('id',$time_slot_id)->firstOrFail();
        $AvailableTime->delete();
        return redirect()->back()->with('toast_success','ลบช่วงเวลานี้เรียบร้อย');

    }
}
