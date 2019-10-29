<?php

namespace App\Transformers;

use Specialtactics\L5Api\APIBoilerplate;

class AnnouncementTransformer extends BaseTransformer
{
    public function transform($object)
    {
        $transformed = parent::transform($object);

        // Add some lyrics
        $transformed[APIBoilerplate::formatCaseAccordingToResponseFormat('some_new_attribute')] =
            [
                'hey' => 'now',
                'now' => 'were',
                'going' => 'down',
                'down' => true,
            ];

        return $transformed;
    }
}