<?php

namespace M1ge0\Bootsjet\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use M1ge0\Bootsjet\JetstrapFacade;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bootsjet:swap {--teams : Indicates if team support should be installed}';

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
        $this->info('Performing swap...');

        // Remove Tailwind Configuration...
        if ((new Filesystem)->exists(base_path('tailwind.config.js'))) {
            (new Filesystem)->delete(base_path('tailwind.config.js'));
        }
        $this->info('Removing tailwind.config.js ...');

        // Remove Postcss Configuration...
        if ((new Filesystem)->exists(base_path('postcss.config.js'))) {
            (new Filesystem)->delete(base_path('postcss.config.js'));
        }
        $this->info('Removing postcss.config.js ...');

        // Remove @tailwindcss folder...
        if ((new Filesystem)->exists(base_path('node_modules/@tailwindcss'))) {
            (new Filesystem)->delete(base_path('node_modules/@tailwindcss'));
        }
        $this->info('Removing node_modules/@tailwindcss ...');

        // Remove tailwindcss folder...
        if ((new Filesystem)->exists(base_path('node_modules/tailwindcss'))) {
            (new Filesystem)->delete(base_path('node_modules/tailwindcss'));
        }
        $this->info('Removing node_modules/tailwindcss ...');


        // Assets...

        // delte css-folder
        (new Filesystem)->deleteDirectory(resource_path('css'));
        $this->info('Removing css-directory ...');

        // check if sass-, js- and views-folder exist
        (new Filesystem)->ensureDirectoryExists(resource_path('sass'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));

        // copy sass- and js-folder from stubs
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/js', resource_path('js'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/sass', resource_path('sass'));

        // light-dark mode js script
        (new Filesystem)->makeDirectory(public_path('js'));
        (new Filesystem)->ensureDirectoryExists(public_path('js'));
        copy(__DIR__.'/../../../../stubs/resources/custom.js', public_path('js/custom.js'));


        $this->info('Copying sass-, js-directory and js-script...');


        //Views

        // check if views/api, views/auth, views/layouts and views/profile exist
        (new Filesystem)->ensureDirectoryExists(resource_path('views/api'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/profile'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/components'));

        // Layouts
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/views/api', resource_path('views/api'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/views/auth', resource_path('views/auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/views/components', resource_path('views/components'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/views/layouts', resource_path('views/layouts'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/views/profile', resource_path('views/profile'));

        // Single Blade Views...
        copy(__DIR__.'/../../../../stubs/resources/views/dashboard.blade.php', resource_path('views/dashboard.blade.php'));
        copy(__DIR__.'/../../../../stubs/resources/views/navigation-menu.blade.php', resource_path('views/navigation-menu.blade.php'));
        copy(__DIR__.'/../../../../stubs/resources/views/policy.blade.php', resource_path('views/policy.blade.php'));
        copy(__DIR__.'/../../../../stubs/resources/views/terms.blade.php', resource_path('views/terms.blade.php'));

        $this->line('');
        $this->info('Rounding up...');

        $this->line('');
        $this->info('Bootstrap scaffolding swapped for livewire successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');

    }

    /**
     * Swap the Livewire stack into the application.
     *
     * @return void
     */
    protected function swapJetstreamLivewireStack()
    {
        $this->line('');
        $this->info('Installing livewire stack...');

        // Directories...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/api'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/profile'));

        // Layouts
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/livewire/resources/views/layouts', resource_path('views/layouts'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/livewire/resources/views/api', resource_path('views/api'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/livewire/resources/views/profile', resource_path('views/profile'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/livewire/resources/views/auth', resource_path('views/auth'));

        // Single Blade Views...
        copy(__DIR__.'/../../../../stubs/livewire/resources/views/dashboard.blade.php', resource_path('views/dashboard.blade.php'));
        copy(__DIR__.'/../../../../stubs/livewire/resources/views/navigation-menu.blade.php', resource_path('views/navigation-menu.blade.php'));
        copy(__DIR__.'/../../../../stubs/livewire/resources/views/terms.blade.php', resource_path('views/terms.blade.php'));
        copy(__DIR__.'/../../../../stubs/livewire/resources/views/policy.blade.php', resource_path('views/policy.blade.php'));

        // Assets...
        (new Filesystem)->copy(__DIR__.'/../../../../stubs/resources/js/app.js', resource_path('js/app.js'));

        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'jetstrap-views', '--force' => true]);

        // Teams...
        if ($this->option('teams')) {
            $this->swapBootsjetLivewireTeamStack();
        }

        $this->line('');
        $this->info('Finishing...');
        $this->installPreset();

        $this->line('');
        $this->info('Bootstrap scaffolding swapped successfully.');
        $this->comment('Please execute the "npm install && npm run build" command to build your assets.');
    }

    /**
     * Swap the Livewire team stack into the application.
     *
     * @return void
     */
    protected function swapBootsjetLivewireTeamStack()
    {
        // Directories...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/teams'));

        (new Filesystem)->copyDirectory(__DIR__.'/../../../../stubs/resources/views/teams', resource_path('views/teams'));
    }



}
