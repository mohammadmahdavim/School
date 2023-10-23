<?php
$setting = App\Setting::all()->first();

return [
    'name' => $setting->name,
    'student' => $setting->student,
    'students' => $setting->students,
    'parent' => $setting->parent,
    'parents' => $setting->parents,
    'teacher' => $setting->teacher,
    'teachers' => $setting->teachers,
    'admin' => $setting->admin,
    'paye' => $setting->paye,
    'school' => $setting->school,
    'type_mark' => $setting->type_mark,
    'mark1' => $setting->mark1,
    'mark2' => $setting->mark2,
    'mark3' => $setting->mark3,
];

