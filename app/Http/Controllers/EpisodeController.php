<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use App\SerieVideo;
use App\Setting;
use App\SerieSubstitle;


class EpisodeController extends Controller
{

    // delete an episode from the database
    public function destroy(Episode $episode)
    {
        if ($episode != null) {
            $episode->delete();

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

    // return videos for an episode
    public function videos($episode)
    {
        

        $model = Episode::where('tmdb_id', $episode)->firstOrFail();

        return response()->json(['episode_stream' => $model->videos], 200);

    }



   // return substitles for an episode
   public function substitles($episode)
   {

       $model = Episode::where('tmdb_id', $episode)->first();

       return response()->json(['episode_stream' => $model->substitles], 200);

   }


    // remove a video from an episode
    public function destroyVideo($id)
    {
        if ($id != null) {
            $video = SerieVideo::find($id);
            $video->delete();

            $data = [
                'status' => 200,
                'message' => 'successfully deleted ',
            ];
        } else {
            $data = [
                'status' => 400,
                'message' => 'could not be deleted',
            ];
        }

        return response()->json($data, $data['status']);
    }



     // remove a substitle from an episode
     public function destroySubstitles($id)
     {
         if ($id != null) {
             $video = SerieSubstitle::find($id);
             $video->delete();
 
             $data = [
                 'status' => 200,
                 'message' => 'successfully deleted ',
             ];
         } else {
             $data = [
                 'status' => 400,
                 'message' => 'could not be deleted',
             ];
         }
 
         return response()->json($data, $data['status']);
     }
 

    // add a view to an episode
    public function view(Episode $episode)
    {
        if ($episode != null) {
            $episode->views++;
            $episode->save();
            $data = [
                'status' => 200
            ];
        } else {
            $data = [
                'status' => 400
            ];
        }

        return response()->json($data, $data['status']);
    }
}
