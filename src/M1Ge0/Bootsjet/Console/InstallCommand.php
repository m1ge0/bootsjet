<?php

namespace M1Ge0\Bootsjet\Console;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use JsonException;
use M1Ge0\Bootsjet\BootsjetFacade;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bootsjet:swap 
        {--teams : Indicates if team support should be installed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Swap Tailwind for Bootstrap';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $files = new Filesystem();

        $this->info('Performing swap...');

        // Remove Tailwind Configuration...
        $this->safeDeleteFile($files, base_path('tailwind.config.js'));
        $this->info('Removing tailwind.config.js ...');

        // Remove Postcss Configuration...
        $this->safeDeleteFile($files, base_path('postcss.config.js'));
        $this->info('Removing postcss.config.js ...');

        // Remove @tailwindcss folder...
        $this->safeDeleteDirectory($files, base_path('node_modules/@tailwindcss'));
        $this->info('Removing node_modules/@tailwindcss ...');

        // Remove tailwindcss folder...
        $this->safeDeleteDirectory($files, base_path('node_modules/tailwindcss'));
        $this->info('Removing node_modules/tailwindcss ...');

        $this->updatePackageJsonForBootstrap($files);
        $this->info('Updating package.json dependencies ...');


        // Assets...

        // delte css-folder
        $this->safeDeleteDirectory($files, resource_path('css'));
        $this->info('Removing css-directory ...');

        // check if sass-, js- and views-folder exist
        $files->ensureDirectoryExists(resource_path('sass'));
        $files->ensureDirectoryExists(resource_path('js'));
        $files->ensureDirectoryExists(resource_path('views'));

        // copy sass- and js-folder from stubs
        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/js', resource_path('js'));
        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/sass', resource_path('sass'));
        $this->safeCopyFile($files, __DIR__.'/../../../../stubs/vite.config.js', base_path('vite.config.js'));

        // light-dark mode js script
        $files->ensureDirectoryExists(public_path('js'));
        $this->safeCopyFile($files, __DIR__.'/../../../../stubs/resources/custom.js', public_path('js/custom.js'));


        $this->info('Copying sass-, js-directory, vite config and js-script...');


        //Views

        // check if views/api, views/auth, views/layouts and views/profile exist
        $files->ensureDirectoryExists(resource_path('views/api'));
        $files->ensureDirectoryExists(resource_path('views/auth'));
        $files->ensureDirectoryExists(resource_path('views/layouts'));
        $files->ensureDirectoryExists(resource_path('views/profile'));
        $files->ensureDirectoryExists(resource_path('views/components'));

        // Layouts
        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/views/api', resource_path('views/api'));
        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/views/auth', resource_path('views/auth'));
        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/views/components', resource_path('views/components'));
        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/views/layouts', resource_path('views/layouts'));
        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/views/profile', resource_path('views/profile'));

        // Single Blade Views...
        $this->safeCopyFile($files, __DIR__.'/../../../../stubs/resources/views/dashboard.blade.php', resource_path('views/dashboard.blade.php'));
        $this->safeCopyFile($files, __DIR__.'/../../../../stubs/resources/views/navigation-menu.blade.php', resource_path('views/navigation-menu.blade.php'));
        $this->safeCopyFile($files, __DIR__.'/../../../../stubs/resources/views/policy.blade.php', resource_path('views/policy.blade.php'));
        $this->safeCopyFile($files, __DIR__.'/../../../../stubs/resources/views/terms.blade.php', resource_path('views/terms.blade.php'));
        $this->safeCopyFile($files, __DIR__.'/../../../../stubs/resources/views/welcome.blade.php', resource_path('views/welcome.blade.php'));

        // Teams...
        if ($this->option('teams')) {
            $this->swapBootsjetLivewireTeamStack();
        }

        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'bootsjet-views', '--force' => true]);

        $this->line('');
        $this->info('Rounding up...');

        $this->line('');
        $this->info('Bootstrap scaffolding swapped for livewire successfully.');
        $this->comment('Please execute "npm install && npm run build" (or "npm run dev" for local development).');

    }

    /**
     * Swap the Livewire team stack into the application.
     *
     * @return void
     */
    protected function swapBootsjetLivewireTeamStack()
    {
        $files = new Filesystem();

        // Directories...
        $files->ensureDirectoryExists(resource_path('views/teams'));

        $this->safeCopyDirectory($files, __DIR__.'/../../../../stubs/resources/views/teams', resource_path('views/teams'));

        $this->line('');
        $this->info('Swapping teams directory ...');
    }

    protected function safeDeleteFile(Filesystem $files, string $path): void
    {
        if ($files->exists($path)) {
            $files->delete($path);
        }
    }

    protected function safeDeleteDirectory(Filesystem $files, string $path): void
    {
        if ($files->isDirectory($path)) {
            $files->deleteDirectory($path);
        }
    }

    protected function safeCopyDirectory(Filesystem $files, string $from, string $to): void
    {
        if ($files->isDirectory($from)) {
            $files->copyDirectory($from, $to);
        }
    }

    protected function safeCopyFile(Filesystem $files, string $from, string $to): void
    {
        if ($files->exists($from)) {
            $files->copy($from, $to);
        }
    }

    protected function updatePackageJsonForBootstrap(Filesystem $files): void
    {
        $packageJsonPath = base_path('package.json');

        if (! $files->exists($packageJsonPath)) {
            return;
        }

        try {
            $packageJson = json_decode($files->get($packageJsonPath), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            $this->warn('Skipping package.json update: invalid JSON.');
            return;
        }

        $packageJson['devDependencies'] = $packageJson['devDependencies'] ?? [];

        $tailwindPackages = [
            'tailwindcss',
            '@tailwindcss/forms',
            '@tailwindcss/vite',
            'autoprefixer',
            'postcss',
        ];

        foreach ($tailwindPackages as $package) {
            unset($packageJson['devDependencies'][$package]);
        }

        $packageJson['devDependencies']['bootstrap'] = $packageJson['devDependencies']['bootstrap'] ?? '^5.3.3';
        $packageJson['devDependencies']['sass'] = $packageJson['devDependencies']['sass'] ?? '^1.77.8';

        ksort($packageJson['devDependencies']);

        $json = json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        if ($json === false) {
            $this->warn('Skipping package.json update: unable to encode JSON.');
            return;
        }

        $files->put($packageJsonPath, $json.PHP_EOL);
    }

}
