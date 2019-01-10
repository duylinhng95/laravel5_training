<?php

namespace App\Traits;

Trait SummernoteTrait
{
    public function convertImg($detail)
    {
        $dom    = new \DOMDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName("img");
        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            list($type, $data) = array_pad(explode(';', $data), -2, null);
            list(, $data) = array_pad(explode(',', $data), -2, null);
            $data = base64_decode($data);
            $image_name = "/upload/" . time() . $k . '.png';
            $path = public_path() . $image_name;
            if (!file_exists(public_path()."/upload/")) {
                mkdir(public_path()."/upload/", 0777, true);
            }
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        return $detail = $dom->saveHTML();
    }
}
