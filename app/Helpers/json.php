<?php

if (!function_exists('countries')) {
    function countries(): array
    {
        try {
            $path = base_path('storage/josn/countries.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('states')) {
    function states(): array
    {
        try {
            $path = base_path('storage/josn/states.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}


if (!function_exists('cities')) {
    function cities(): array
    {
        try {
            $path = base_path('storage/josn/cities.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('units')) {
    function units(): array
    {
        try {
            $path = base_path('storage/josn/units.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('roles')) {
    function roles(): array
    {
        try {
            $path = base_path('storage/josn/roles.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('departments')) {
    function departments(): array
    {
        try {
            $path = base_path('storage/josn/departments.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('designations')) {
    function designations(): array
    {
        try {
            $path = base_path('storage/josn/designations.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('projectStatus')) {
    function projectStatus(): array
    {
        try {
            $path = base_path('storage/josn/projectStatus.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}





