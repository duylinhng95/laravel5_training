<?php

namespace App\Repository;

interface PostTagRepository
{
    public function deleteTags($array, $id);

    public function updateMany($id, $array);

    public function getPopularTags();
}
