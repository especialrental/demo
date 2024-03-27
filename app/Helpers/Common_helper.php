<?php
 namespace App\Helpers;

 use App\Models\User;
 use DB;

 class Common_helper{
 	
 	public function createSlug($title, $id = 0, $db)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id, $db);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0, $db)
    {
        return DB::table($db)->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
    public function generateStrongPassword($length = 8, $add_dashes = false, $available_sets = 'luds') {
    $sets = array();
    if (strpos($available_sets, 'l') !== false) {
      $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    }

    if (strpos($available_sets, 'u') !== false) {
      $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    }

    if (strpos($available_sets, 'd') !== false) {
      $sets[] = '23456789';
    }

    if (strpos($available_sets, 's') !== false) {
      $sets[] = '!@#$%&*?';
    }

    $all = '';
    $password = '';
    foreach ($sets as $set) {
      $password .= $set[array_rand(str_split($set))];
      $all .= $set;
    }

    $all = str_split($all);
    for ($i = 0; $i < $length - count($sets); $i++) {
      $password .= $all[array_rand($all)];
    }

    $password = str_shuffle($password);

    if (!$add_dashes) {
      return $password;
    }

    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while (strlen($password) > $dash_len) {
      $dash_str .= substr($password, 0, $dash_len) . '-';
      $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
  }
 }