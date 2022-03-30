<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadService
{
    private $driver;
    private $file;
    private $path;
    private $mime;
    private $filename;

    public function __construct($driver = 'public')
    {
        $this->driver = $driver;
    }

    public function driver($driver = null)
    {
        if (is_null($driver)) {
            return $this->driver;
        }

        $this->driver = $driver;
        return $this;
    }

    public function from($file)
    {
        $this->file = $file;
        return $this;
    }

    public function to(string $path)
    {
        $this->path = $path;
        return $this;
    }

    public function mimes(string $mime=null)
    {
        if (is_null($mime)) {
            return $this->mime;
        }

        $this->mime = $mime;
        return $this;
    }

    public function setName(string $filename)
    {
        $this->filename = $filename.'.'.$this->file->getClientOriginalExtension();
        return $this;
    }

    public function getName()
    {
        if ($this->filename) {
            return $this->filename;
        }

        $this->filename = $this->file->getClientOriginalName();
    }

    public function validate()
    {
        $request = ['file' => $this->file];

        Validator::make($request, [
            'file' => 'required|max:512000|mimes:'.$this->mime
        ], [
            "mimes" => 'Format file must be ('.str_replace(',', ', ', $this->mime).')'
        ])->validate();
    }

    public function save()
    {
        $this->validate();
        $this->getName();
        Storage::disk($this->driver)
            ->putFileAs($this->path, $this->file, $this->filename);

        return $this->filename;
    }
}