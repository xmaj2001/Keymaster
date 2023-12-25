<?php

namespace App\Lib;

class FileUpdate
{
    private string $target_dir = uploads_dir;
    private string $target_file;
    private string $fileToUpload;
    private bool $ok = false;
    public function Isimagem(): bool
    {
        $check = getimagesize($_FILES[$this->fileToUpload]["tmp_name"]);
        if ($check !== false) {
            $this->ok = true;
            return true;
        } else {
            $this->ok = false;
            return false;
        }
    }
    // Check if file already exists
    public function FileExiste(): bool
    {
        if (file_exists($this->target_file)) {
            $this->ok = true;
            return true;
        }
        $this->ok = false;
        return false;
    }
    // Check file size
    public function size(): int
    {
        return isset($_FILES[$this->fileToUpload]["size"]) ? $_FILES[$this->fileToUpload]["size"] : 0;
    }
    public function EXTENSION(): string
    {
        return strtolower(pathinfo($this->target_file, PATHINFO_EXTENSION));
    }

    public function TipoPermitido(array $tipoFiles = []): bool
    {
        $tipoFile = strtolower(pathinfo($this->target_file, PATHINFO_EXTENSION));
        if (in_array($tipoFile, $tipoFiles)) {
            $this->ok = true;
            return true;
        } else {
            $this->ok = false;
            return false;
        }
    }

    public function Upload()
    {
        try {
            if ($this->ok) {
                if (move_uploaded_file($_FILES[$this->fileToUpload]["tmp_name"], $this->target_file)) {
                    return "/".$this->target_file;
                } else {
                    return null;
                }
            }
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function define(string $post, string $pasta = uploads_dir)
    {
        $this->target_dir = $pasta;
        $this->fileToUpload = $post;
        if (isset($_FILES[$this->fileToUpload])) {
            $file = md5(basename($_FILES[$this->fileToUpload]["name"]).date("d/m/y s:i:h"));
            $this->target_file = $this->target_dir . basename($_FILES[$this->fileToUpload]["name"]);
            $tipo = "." . $this->EXTENSION();
            while (file_exists(uploads_dir . $file . $tipo)) {
                $file = md5(basename($_FILES[$this->fileToUpload]["name"]).date("d/m/y s:i:h"));
            }
            $this->target_file = $this->target_dir . $file . $tipo;
            $this->ok = true;
        } else {
            $this->ok = false;
            die("Não foi encontrado este valor :" . $post . " no $_FILES");
        }
    }

    function __construct(string $post, string $pasta = uploads_dir)
    {
        $this->define($post,$pasta);
    }
}
