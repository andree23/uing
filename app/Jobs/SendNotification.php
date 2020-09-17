<?php

namespace App\Jobs;

use App\Livetv;
use App\Movie;
use App\anime;
use App\Setting;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    const FIREBASE_URL = "https://fcm.googleapis.com/fcm/send";
    const NOTIFS = "/topics/all";
    const NOTIFICATION = "notification";
    const TITLE = "title";
    const ADDED = "has been added";
    const IMAGE = "image";
    const CLICK_ACTION = "click_action";
    

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $settings = Setting::find(1);
        $client = new Client(['headers' => ['Authorization' => "key=$settings->authorization", 'Content-Type' => 'application/json']]);


        try {
            if ($this->data instanceof Movie) {
                $client->post(self::FIREBASE_URL, [
                    'json' => [
                        'to' => self::NOTIFS,
                        self::NOTIFICATION => [self::TITLE => $this->data->title . self::ADDED,
                        'body' => $this->data->overview, self::IMAGE => $this->data->backdrop_path, self::CLICK_ACTION => "MOVIE"],
                        'data' => ['instanceof' => 'movie', 'id' => $this->data->id]
                    ]
                ]);
            }
            if ($this->data instanceof Serie) {
                $client->post(self::FIREBASE_URL, [
                    'json' => [
                        'to' => self::NOTIFS,
                        self::NOTIFICATION => [self::TITLE => $this->data->name . self::ADDED, 'body' => $this->data->overview,
                        self::IMAGE => $this->data->backdrop_path, self::CLICK_ACTION => "serie"],
                        'data' => ['instanceof' => 'serie', 'id' => $this->data->id]
                    ]
                ]);
            }

            if ($this->data instanceof Livetv) {
                $client->post(self::FIREBASE_URL, [
                    'json' => [
                        'to' => self::NOTIFS,
                        self::NOTIFICATION => [self::TITLE => $this->data->name . self::ADDED, 'body' => $this->data->overview,
                        self::IMAGE => $this->data->backdrop_path, self::CLICK_ACTION => "LIVETV"],
                        'data' => ['instanceof' => 'livetv', 'id' => $this->data->id]
                    ]
                ]);
            }
            $status = 'success';
        } catch (ClientException $ce) {
            $status = 'error';
        } catch (RequestException $re) {
            $status = 'error';
        } catch (Exception $e) {
            $status = 'error';
        }

        return ['status' => $status];
    }
}
