<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ServiceCommand extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Add New Service';

    public function handle()
    {
        $name = $this->argument('name');

        $filePath = $this->getFilePath($name);
        if (File::exists($filePath)) {
            $this->error("{$name}.php already exists.");
            return;
        }
        $namespace = rtrim($this->getNamespace($name), '\\');
        $content = "<?php\n\n";
        $content .= "namespace {$namespace};\n\n";
        $content .= "class {$this->getClassName($name)}\n";
        $content .= "{\n";
        $content .= "    // Your class implementation\n";
        $content .= "}\n";

        $directoryPath = $this->getDirectoryPath($name);
        File::ensureDirectoryExists($directoryPath);

        // Write the content to the new PHP file
        File::put($filePath, $content);

        $this->info("{$name}.php created successfully.");
    }

    private function getDirectoryPath($name)
    {
        $parts = $this->parseName($name);
        return app_path("Services/{$parts['directory']}");
    }

    private function getClassName($name)
    {
        $parts = $this->parseName($name);
        return $parts['filename'];
    }

    private function getNamespace($name)
    {
        $parts = $this->parseName($name);
        return "App\\Services\\{$parts['directory']}";
    }

    private function getFilePath($name)
    {
        $parts = $this->parseName($name);
        return app_path("Services/{$parts['directory']}/{$parts['filename']}.php");
    }

    private function parseName($name)
    {
        if (strpos($name, '/') !== false) {
            $parts = explode('/', $name);
            return [
                'directory' => $parts[0],
                'filename' => $parts[1]
            ];
        } else {
            return [
                'directory' => '',
                'filename' => $name
            ];
        }
    }
}
