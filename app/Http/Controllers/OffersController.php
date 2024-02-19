<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\File;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;
use GPBMetadata\Google\Api\Service;
use Kreait\Firebase\ServiceAccount;

//هنا

class OffersController extends Controller
{
    private $firebase;
    public function connect()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();
    }
    public function index()
    {
        $offerss = $this->connect()->getReference('offersdb')->getSnapshot()->getValue();
        return view('offers-list')->with([
            'offersdb' => $offerss
        ]);
    }
    public function store(Request $request)
    {
        $messages = [
            'of_category.required' => 'حقل التصنيف مطلوب.',
            'image.required' => 'حقل شعار الشركة مطلوب.',
            'image.image' => 'شعار الشركة يجب أن يكون صورة',
            'image.mimes' => 'شعار الشركة يجب أن يكون من نوع jpg,jpeg,bmp,png,gif,svg.',
            'of_name.required' => ' اسم الشركة مطلوب.',
            'of_discount.required' => ' مقدار الخصم مطلوب.',
            'of_discount.numeric'=> 'مقدار الخصم يجب أن يكون رقم',
            'of_discount.between'=> 'مقدار الخصم يجب أن يكون بين 1 و 100',
            'of_expDate.required' => ' تاريخ الانتهاء مطلوب.',
            'of_target.required' => ' الفئة المستهدفة مطلوب.',
            'of_contact.required' => ' وسيلة التواصل مطلوب.',
            'of_details.required' => ' تفاصيل الخصم مطلوب.',
            'of_code.required' => 'رمز الخصم مطلوب.',

        ];

        $validator = Validator::make($request->all(), [
            'of_category' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png,gif,svg|max:2048',
            'of_name' => 'required',
            'of_discount' => 'required|numeric|between:0,100',
            'of_expDate' => 'required|date|date_format:Y-m-d',
            'of_target' => 'required',
            'of_contact' => 'required',
            'of_details' => 'required',
            'of_code' => 'required',

        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $storage = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env("FIREBASE_DATABASE_URL"))
            ->createStorage();


        $image = $request->file('image');
        $imageName = 'offer_logo' . time() . '.' . $image->getClientOriginalExtension();
        $localPath =  public_path('image/');

        if ($image->move($localPath, $imageName)) {
            $uploadedfile = fopen($localPath . $imageName, 'r');
            $storage->getBucket()->upload($uploadedfile, ['name' => 'offers_web_images/' . $imageName]);
            unlink($localPath . $imageName);
        }
        $url = $storage->getBucket()->object('offers_web_images/' . $imageName)->signedUrl(new \DateTime('tomorrow'));

        $request->request->remove('image');
        // $request->merge(['image' => $url]);
        $request->request->add(['of_logo' => $url]);
        $request->flash();
        $this->connect()->getReference('offersdb')->push($request->except(['_token']));
        return redirect()->route('offers.index');
    }
    public function create()
    {
        return view('offers-form')->with([
            'id' => null
        ]);
    }
    public function edit($id)
    {
        $offer = $this->connect()->getReference('offersdb')->getChild($id)->getValue();
        return view('offers-form')->with([
            'offer' => $offer,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $url =  $this->connect()->getReference('offersdb/' . $id)->getChild('of_logo')->getValue();
        $messages = [
            'of_category.required' => ' التصنيف مطلوب.',
            'image.image' => 'شعار الشركة يجب أن يكون صورة',
            'image.mimes' => 'شعار الشركة يجب أن يكون من نوع jpg,jpeg,bmp,png,gif,svg.',
            'of_name.required' => ' اسم الشركة مطلوب.',
            'of_discount.required' => ' مقدار الخصم مطلوب.',
            'of_discount.numeric'=> 'مقدار الخصم يجب أن يكون رقم',
            'of_discount.between'=> 'مقدار الخصم يجب أن يكون بين 1 و 100',
            'of_expDate.required' => ' تاريخ الانتهاء مطلوب.',
            'of_target.required' => ' الفئة المستهدفة مطلوب.',
            'of_contact.required' => ' وسيلة التواصل مطلوب.',
            'of_details.required' => ' تفاصيل الخصم مطلوب.',
            'of_code.required' => 'رمز الخصم مطلوب.',

        ];

        $validator = Validator::make($request->all(), [
            'of_category' => 'required',
            'image' => 'image|mimes:jpg,jpeg,bmp,png,gif,svg|max:2048',
            'of_name' => 'required',
            'of_discount' => 'required|numeric|between:0,100',
            'of_expDate' => 'required|date|date_format:Y-m-d',
            'of_target' => 'required',
            'of_contact' => 'required',
            'of_details' => 'required',
            'of_code' => 'required',

        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'offer_logo' . time() . '.' . $image->getClientOriginalExtension();
            $localPath =  public_path('image/');

            if ($image->move($localPath, $imageName)) {
                $storage = (new Factory)
                    ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                    ->withDatabaseUri(env("FIREBASE_DATABASE_URL"))
                    ->createStorage();

                $uploadedfile = fopen($localPath . $imageName, 'r');
                $storage->getBucket()->upload($uploadedfile, ['name' => 'offers_web_images/' . $imageName]);
                unlink($localPath . $imageName);

                $url = $storage->getBucket()->object('offers_web_images/' . $imageName)->signedUrl(new \DateTime('tomorrow'));
                
            }
            
        }
        $request->request->remove('image');
            $request->request->add(['of_logo' => $url]);
            $this->connect()->getReference('offersdb/' . $id)->update($request->except(['_token', '_method']));
            return redirect()->route('offers.index');
    }

    public function destroy($id)
    {
        $this->connect()->getReference('offersdb/' . $id)->remove();
        return back();
    }
}
