<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivetvRequest;
use App\Http\Requests\StoreImageRequest;
use App\Jobs\SendNotification;
use App\Livetv;
use App\Setting;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class LivetvController extends Controller
{
    // returns all livetv for api
    public function index()
    {
        return response()->json(Livetv::orderByDesc('id')->paginate(12), 200);
    }


    public function latest($statusapi)
    {

        $statusapi = Setting::first()->purchase_key;
        $streaming = Livetv::where('created_at', '>', Carbon::now()->subMonth())
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return response()
            ->json(['livetv' => $streaming], 200);
    }


    // returns all livetv for admin panel
    public function data()
    {
        return response()->json(Livetv::orderByDesc('created_at')
        ->get(), 200);
    }

    // create a new livetv in the database
    public function store(LivetvRequest $request)
    {
        if (isset($request->livetv)) {

            $livetv = new Livetv();
            $livetv->fill($request->livetv);
            $livetv->save();
            $data = [
                'status' => 200,
                'message' => 'successfully created',
                'body' => $livetv
            ];
        } else {
            $data = [
                'status' => 400,
                'message' => 'could not be created',
            ];
        }

        if ($request->notification) {
            $this->dispatch(new SendNotification($livetv));
        }

        return response()->json($data, $data['status']);
    }

    // returns a specific livetv
    public function show(Livetv $livetv)
    {
        return response()->json($livetv, 200);
    }




    // update a livetv in the database
    public function update(LivetvRequest $request, Livetv $livetv)
    {
        if ($livetv != null) {

            $livetv->fill($request->livetv);
            $livetv->save();
            $data = [
                'status' => 200,
                'message' => 'successfully updated',
                'body' => $livetv
            ];
        } else {
            $data = [
                'status' => 400,
                'message' => 'could not be updated',
            ];
        }

        return response()->json($data, $data['status']);
    }

    // delete a livetv in the database
    public function destroy(Livetv $livetv)
    {
        if ($livetv != null) {
            $livetv->delete();
            $data = [
                'status' => 200,
                'message' => 'successfully deleted',
            ];
        } else {
            $data = [
                'status' => 400,
                'message' => 'could not be deleted',
            ];
        }

        return response()->json($data, $data['status']);
    }

    // save a new image in the livetv folder of the storage
    public function storeImg(StoreImageRequest $request)
    {
        if ($request->hasFile('image')) {
            $filename = Storage::disk('livetv')->put('', $request->image);
            $data = [
                'status' => 200,
                'image_path' => $request->root() . '/api/livetv/image/' . $filename,
                'message' => 'successfully uploaded'
            ];
        } else {
            $data = [
                'status' => 400,
            ];
        }

        return response()->json($data, $data['status']);
    }

    // return an image from the livetv folder of the storage
    public function getImg($filename)
    {

        $image = Storage::disk('livetv')->get($filename);

        $mime = Storage::disk('livetv')->mimeType($filename);

        return (new Response($image, 200))
            ->header('Content-Type', $mime);
    }
}
