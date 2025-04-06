<?php

namespace App\Jobs;


use App\Models\Video;
// use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Exception;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $videoId;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
        $this->videoId = $videoId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        try {
            // Find the video by ID
            $video = Video::find($this->videoId);

            if (!$video) {
                throw new Exception('Video not found');
            }

            // Simulate processing (e.g., video transcoding or encoding)
            sleep(5);  // Simulate video processing delay

            // Update the video status to 'processed'
            $video->status = 'processed';
            $video->save();

            Log::info("Video (ID: {$this->videoId}) processed successfully.");
        } catch (Exception $e) {
            // Handle error (log it and optionally update the video status)
            Log::error("Error processing video (ID: {$this->videoId}): " . $e->getMessage());

            // Optionally, you could update the status to 'failed'
            $video = Video::find($this->videoId);
            if ($video) {
                $video->status = 'failed';
                $video->save();
            }
        }
    }
}
