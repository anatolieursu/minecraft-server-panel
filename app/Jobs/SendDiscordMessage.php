<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDiscordMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $title;
    protected $type;

    public function __construct($type, $title)
    {
        $this->type = $type;
        $this->title = $title;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == "event") {
            $webhookUrl = env("DISCORD_EVENT_WEBHOOK");
        } elseif ($this->type == "applications") {
            $webhookUrl = env("DISCORD_APPLICATIONS_WEBHOOK");
        } elseif ($this->type == "forums") {
            $webhookUrl = env("DISCORD_FORUMS_WEBHOOK");
        }
        if(!isset($webhookUrl)) {
            return;
        }
        $message = 'Was added a new ' . $this->type . '. ' . $this->title;
        $data = [
            'content' => $message,
        ];

        $options = [
            CURLOPT_URL => $webhookUrl,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);
    }
}
