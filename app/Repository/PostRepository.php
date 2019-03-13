<?php

namespace App\Repository;

interface PostRepository
{
    public function create($input);

    public function generateTagFromString($input);

    public function delete($id);

    public function update($id, $input, $att);

    public function getPosts($params);

    public function destroy($id);

    public function paginateWithTrashed($params, $num);

    public function findWithTrashed($id);

    public function restore($id);

    public function getPopularPosts();

    public function getLatestPost();

    public function publish($id);
}
