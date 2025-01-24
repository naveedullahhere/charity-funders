<?php

namespace App\Observers;

use App\Models\Funder;
use Illuminate\Support\Str;

class FunderObserver
{
    /**
     * Handle the Funder "creating" event.
     */
    public function creating(Funder $funder)
    {
        // Generate slug from name
        $funder->slug = Str::slug($funder->name);

         if (request()->hasFile('logo')) {
            $funder->logo = 'storage/' . $this->storeProfileImage(request()->file('logo'), $funder);
        }
    }

    /**
     * Handle the Funder "updating" event.
     */
    public function saving(Funder $funder)
    {
        // Regenerate slug if name is changed
        if ($funder->isDirty('name')) {
            $funder->slug = Str::slug($funder->name);
        }
         if (request()->hasFile('logo')) {
            $funder->logo = 'storage/' . $this->storeProfileImage(request()->file('logo'), $funder);
        }
    }


        protected function storeProfileImage($image, Funder $funder)
    {

            $logoOriginalName = pathinfo($funder->logo->getClientOriginalName(), PATHINFO_FILENAME);

         $sluggedName = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $logoOriginalName));
        $filename = Str::slug($logoOriginalName) . '-' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();

        return $image->storeAs('funders', $filename, 'public');
    }
}