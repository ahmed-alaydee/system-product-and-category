<?php

namespace App\Http\Controllers;

use App\Models\Cratecar;
use App\Http\Controllers\Controller;
use App\Models\SparePart;
use App\Models\Usermodel;
use Illuminate\Http\Request;

class CratecarController extends Controller
{

    public function index()
    {
        // تغيير اسم المتغير إلى car بدلاً من cars
        $car = Cratecar::all();
        $users = Usermodel::all();
        $sparparts = SparePart::all();

        return view('admin.CreateCar.showcar', compact('car', 'users', 'sparparts'));
    }


    public function showCar($id)
    {
        $car = Cratecar::with('spare_parts')->findOrFail($id);
        $users = Usermodel::all();
        $sparparts = SparePart::all();

        return view('admin.CreateCar.showcar', compact('car', 'users', 'sparparts'));
    }
 
    public function create()
    {
        $cars = Cratecar::all();
        $sparparts = SparePart::all();
        $users = Usermodel::all();


        return view('admin.CreateCar.createcar' ,compact('cars', 'sparparts', 'users')) ;
    }


    public function store(Request $request)
    {
        $request->validate([
            'make'    => 'required|string|max:100',
            'model'   => 'required|string|max:100',
            'year'    => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'color'   => 'nullable|string|max:50',
            'car_no'  => 'nullable|string|max:50|unique:cratecars,car_no',
            'km'      => 'nullable|integer|min:0',
            'phone'   => 'required|string|max:255',
            'name'    => 'required|string|max:255',
        ]);

        // Create or register the user first
        $user = Usermodel::create([
            'name'  => $request->input('name'),
            'phone' => $request->input('phone'),
        ]);

        // Car data
        $input = $request->only(['make', 'model', 'year', 'color', 'car_no', 'km']);
        $input['user_id'] = $user->id;

        // Calculate total price from spare parts
        $totalPrice = 0;
        $sparePartsJson = $request->input('spare_parts_data');
        if ($sparePartsJson) {
            $spareParts = json_decode($sparePartsJson, true);
            if (is_array($spareParts)) {
                foreach ($spareParts as $part) {
                    $totalPrice += isset($part['price']) ? floatval($part['price']) : 0;
                }
            }
        }
        $input['total_price'] = $totalPrice;

        // Handle image uploads
        if ($request->hasFile('car_images')) {
            $imagePaths = [];
            foreach ($request->file('car_images') as $image) {
                $path = $image->store('car_images', 'public');
                $imagePaths[] = $path;
            }
            $input['image_paths'] = json_encode($imagePaths);
        }

        // Create the car
        $cratecar = Cratecar::create($input);

        // Handle spare parts JSON array
        $sparePartsJson = $request->input('spare_parts_data');
        if ($sparePartsJson) {
            $spareParts = json_decode($sparePartsJson, true);
            if (is_array($spareParts)) {
                foreach ($spareParts as $part) {
                    SparePart::create([
                        'car_id' => $cratecar->id,
                        'type'        => $part['type'] ?? '',
                        'item'        => $part['item'] ?? '',
                        'quantity'    => $part['quantity'] ?? 0,
                        'price'       => $part['price'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('carcreate.index')->with('success', 'Car and spare parts created successfully.');
    }

    public function show(Cratecar $cratecar)
    {
        //
    }

 
    public function edit(Cratecar $cratecar)
    {
        //
    }

   
    public function update(Request $request, Cratecar $cratecar)
    {
        //
    }


    public function destroy(Cratecar $cratecar)
    {
        //
    }
}
 