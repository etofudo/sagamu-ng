<?php

namespace App\Services;

use Cloudinary\Api\Upload\UploadApi;

class CloudinaryService
{
    public function upload(string $localPath, string $folder, array $transform = []): string
    {
        $options = ['folder' => 'sagamu/' . $folder];

        if (!empty($transform)) {
            $options['transformation'] = $transform;
        }

        $result = (new UploadApi())->upload($localPath, $options);

        return $result['secure_url'];
    }

    public function uploadListing(string $path): string
    {
        return $this->upload($path, 'listings', [
            'width' => 800, 'height' => 600, 'crop' => 'fill', 'quality' => 'auto',
        ]);
    }

    public function uploadArticle(string $path): string
    {
        return $this->upload($path, 'articles', [
            'width' => 1200, 'height' => 630, 'crop' => 'fill', 'quality' => 'auto',
        ]);
    }

    public function uploadNeighbourhood(string $path): string
    {
        return $this->upload($path, 'neighbourhoods', [
            'width' => 1280, 'height' => 720, 'crop' => 'fill', 'quality' => 'auto',
        ]);
    }
}
