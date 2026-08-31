<?php

namespace App\Filament\Resources\CourseRegistrations\Pages;

use App\Filament\Resources\CourseRegistrations\CourseRegistrationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseRegistration extends CreateRecord
{
    protected static string $resource = CourseRegistrationResource::class;
}
