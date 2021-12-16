<?php

namespace App\Jobs;

use App\Models\ClotheImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class ImageResize implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $DS = DIRECTORY_SEPARATOR;
        $img_directory = storage_path('app' . $DS . 'public'. $DS . 'clothes' . $DS . $this->id . $DS);
        $img_orig = $img_directory . $this->name;
        $img_dest = $img_directory . 'blur_' . $this->name;

        Image::make($img_orig)
            ->resize(300, 200)
            ->blur(30)
            ->save($img_dest);

        $clothe_image = ClotheImage::where('clothe_id', '=', $this->id)->first();
        if (!is_null($clothe_image)) {
            $clothe_image->image_blur = 'blur_' . $this->name;
            $clothe_image->save();
        }
    }
}
