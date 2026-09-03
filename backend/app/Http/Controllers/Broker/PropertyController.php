<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PropertyController extends Controller
{


    public function index()
    {

        $properties = auth()
            ->user()
            ->properties()
            ->latest()
            ->get();


        return view(
            'broker.properties.index',
            compact('properties')
        );

    }



    public function create()
    {

        return view(
            'broker.properties.create'
        );

    }



    public function store(Request $request)
    {

        $validated = $request->validate([

            'title'=>'required|string|max:255',

            'description'=>'required|string',

            'property_type'=>'required|string',

            'listing_type'=>'required|string',

            'location'=>'required|string',

            'price'=>'required|numeric',

            'floor_area'=>'required|numeric',

            'images.*'=>'image|max:2048',

        ]);



        $validated['broker_id'] = auth()->id();

        $validated['status'] = 'available';



        $property = Property::create($validated);



        if($request->hasFile('images')){


            foreach($request->file('images') as $image){


                $path = $image->store(
                    'properties',
                    'public'
                );


                PropertyImage::create([

                    'property_id'=>$property->id,

                    'image_path'=>$path,

                ]);

            }

        }



        return redirect()
            ->route('broker.properties.index')
            ->with(
                'success',
                'Property created successfully.'
            );

    }



    public function edit(string $id)
    {

        $property = auth()
            ->user()
            ->properties()
            ->findOrFail($id);



        return view(
            'broker.properties.edit',
            compact('property')
        );

    }




    public function update(Request $request,string $id)
    {

        $property = auth()
            ->user()
            ->properties()
            ->findOrFail($id);



        $validated=$request->validate([

            'title'=>'required|string|max:255',

            'description'=>'required|string',

            'property_type'=>'required|string',

            'listing_type'=>'required|string',

            'location'=>'required|string',

            'price'=>'required|numeric',

            'floor_area'=>'required|numeric',

        ]);



        $property->update($validated);



        return redirect()
            ->route('broker.properties.index')
            ->with(
                'success',
                'Property updated.'
            );

    }




    public function destroy(string $id)
    {

        $property = auth()
            ->user()
            ->properties()
            ->findOrFail($id);



        foreach($property->images as $image){

            Storage::disk('public')
                ->delete($image->image_path);

        }



        $property->delete();



        return redirect()
            ->route('broker.properties.index')
            ->with(
                'success',
                'Property deleted.'
            );

    }


}