<?php

namespace App\Traits;

trait SummernoteTrait
{
    public function convertImg($detail)
    {
        $dom = new \DOMDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName("img");
        foreach ($images as $key => $image) {
            $data = $image->getAttribute('src');

            list($type, $data) = array_pad(explode(';', $data), -2, null);
            list(, $data) = array_pad(explode(',', $data), -2, null);

            $data = base64_decode($data);

            $imageName = "/storage/" . time() . $key . '.png';
            $path      = public_path() . $imageName;

            if (!file_exists(public_path() . "/storage/")) {
                mkdir(public_path() . "/storage/", 0777, true);
            }

            file_put_contents($path, $data);
            $image->removeAttribute('src');
            $image->setAttribute('src', $imageName);
        }
        return $detail = $dom->saveHTML();
    }
}
