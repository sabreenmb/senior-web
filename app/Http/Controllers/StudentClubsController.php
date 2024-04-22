<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator; //ه
use Carbon\Carbon;

class StudentClubsController extends Controller
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
        $studentClubsDB = $this->connect()->getReference('studentClubsDB')->getSnapshot()->getValue();

        return view('StudentClubs-list')
            ->with([
                'studentClubsDB' => $studentClubsDB

            ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'image.required' => 'حقل شعار النادي مطلوب.',
            'image.image' => 'شعار النادي يجب أن يكون صورة',
            'image.mimes' => 'شعار النادي يجب أن يكون من نوع jpg,jpeg,bmp,png,gif,svg.',
            'club_name.required' => ' اسم النادي مطلوب.',
            'club_details.required' => ' حقل النبذة عن النادي مطلوب.',
            'club_leader.required' => ' حقل قائد\ة النادي مطلوب.',
            'club_regTime.required' => ' حقل موعد التسجيل مطلوب',
            'club_contact.required' => ' حقل وسيلة التواصل مطلوب.',
            'clubMB_link.url' => 'يجب أن يكون رابط الأعضاء صالحًا.',
            'clubMG_link.url' => 'يجب أن يكون رابط الادارة صالحًا.',
        ];

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpg,jpeg,bmp,png,gif,svg|max:2048',
            'club_name' => 'required',
            'club_details' => 'required',
            'club_leader' => 'required',
            'club_regTime' => 'required',
            'club_contact' => 'required',
            'clubMB_link' => 'nullable|url',
            'clubMG_link' => 'nullable|url',

        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if ($request->input('clubMB_link') == null) {
            $clubMBlink = $request->input('clubMB_link');
            $clubMBlink = '';
            $request->merge(['clubMB_link' => $clubMBlink]);

        } 
        if ($request->input('clubMG_link') == null) {
            $clubMGlink = $request->input('clubMG_link');
            $clubMGlink = '';
            $request->merge(['clubMG_link' => $clubMGlink]);

        }
        $storage = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env("FIREBASE_DATABASE_URL"))
            ->createStorage();


        $image = $request->file('image');
        $imageName = 'club_logo' . time() . '.' . $image->getClientOriginalExtension();
        $localPath = public_path('image/');

        if ($image->move($localPath, $imageName)) {
            $uploadedfile = fopen($localPath . $imageName, 'r');
            $storage->getBucket()->upload($uploadedfile, ['name' => 'club_web_images/' . $imageName]);
            unlink($localPath . $imageName);
        }
        $url = $storage->getBucket()->object('club_web_images/' . $imageName)->signedUrl(new \DateTime('9999-12-31'));

        $request->request->remove('image');
        // $request->merge(['image' => $url]);
        $request->request->add(['club_logo' => $url]);
        $request->flash();

        $requestData = $request->except(['_token']);
        $requestData['timestamp'] = Carbon::now();

        $this->connect()->getReference('studentClubsDB')->push($requestData);
        return redirect()->route('clubs.index');

    }
    public function create()
    {
        return view('studentClubs-form')->with([
            'id' => null
        ]);
    }
    public function edit($id)
    {
        $club = $this->connect()->getReference('studentClubsDB')->getChild($id)->getValue();
        return view('studentClubs-form')->with([
            'club' => $club,
            'id' => $id
        ]);
    }

    public function update($id, Request $request)
    {
        $messages = [
            'image.required' => 'حقل شعار النادي مطلوب.',
            'image.image' => 'شعار النادي يجب أن يكون صورة',
            'image.mimes' => 'شعار النادي يجب أن يكون من نوع jpg,jpeg,bmp,png,gif,svg.',
            'club_name.required' => ' اسم النادي مطلوب.',
            'club_details.required' => ' حقل النبذة عن النادي مطلوب.',
            'club_leader.required' => ' حقل قائد\ة النادي مطلوب.',
            'club_regTime.required' => ' حقل موعد التسجيل مطلوب',
            'club_contact.required' => ' حقل وسيلة التواصل مطلوب.',
            'clubMB_link.url' => 'يجب أن يكون رابط الأعضاء صالحًا.',
            'clubMG_link.url' => 'يجب أن يكون رابط الادارة صالحًا.',
        ];

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpg,jpeg,bmp,png,gif,svg|max:2048',
            'club_name' => 'required',
            'club_details' => 'required',
            'club_leader' => 'required',
            'club_regTime' => 'required',
            'club_contact' => 'required',
            'clubMB_link' => 'nullable|url',
            'clubMG_link' => 'nullable|url',

        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Access the OEvent_time value from the request
    
        if ($request->input('clubMB_link') == null) {
            $clubMBlink = $request->input('clubMB_link');
            $clubMBlink = '';
            $request->merge(['clubMB_link' => $clubMBlink]);

        } 
        if ($request->input('clubMG_link') == null) {
            $clubMGlink = $request->input('clubMG_link');
            $clubMGlink = '';
            $request->merge(['clubMG_link' => $clubMGlink]);

        }
  

     
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'club_logo' . time() . '.' . $image->getClientOriginalExtension();
            $localPath =  public_path('image/');

            if ($image->move($localPath, $imageName)) {
                $storage = (new Factory)
                    ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                    ->withDatabaseUri(env("FIREBASE_DATABASE_URL"))
                    ->createStorage();

                $uploadedfile = fopen($localPath . $imageName, 'r');
                $storage->getBucket()->upload($uploadedfile, ['name' => 'club_web_images/' . $imageName]);
                unlink($localPath . $imageName);

                $url = $storage->getBucket()->object('club_web_images/' . $imageName)->signedUrl(new \DateTime('9999-12-31'));
                
            }
            
        }
        $request->request->remove('image');
            $request->request->add(['club_logo' => $url]);
       

            $requestData = $request->except(['_token', '_method']);
            $requestData['timestamp'] = Carbon::now();
    
        $this->connect()->getReference('studentClubsDB/' . $id)->update($requestData);
        return redirect()->route('clubs.index');
    }
    public function destroy($id)
    {
        $this->connect()->getReference('studentClubsDB/' . $id)->remove();
    
        // Check if there are no items left
        $studentClubsDB = $this->connect()->getReference('studentClubsDB')->getSnapshot()->getValue();
    
        if ($studentClubsDB === null) {
            // Set a placeholder value to keep the reference
            $this->connect()->getReference('studentClubsDB')->set('placeholder');
        }
    
        return back();
    }

}
