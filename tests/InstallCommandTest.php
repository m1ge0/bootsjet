<?php

namespace M1Ge0\Bootsjet\Tests;

use Illuminate\Filesystem\Filesystem;

class InstallCommandTest extends TestCase
{
    public function test_swap_command_updates_assets_and_package_json(): void
    {
        $files = new Filesystem();

        $this->seedPackageJson($files);
        $files->put(base_path('tailwind.config.js'), 'export default {};');
        $files->put(base_path('postcss.config.js'), 'export default {};');

        $this->artisan('bootsjet:swap')
            ->assertExitCode(0);

        $this->assertFileDoesNotExist(base_path('tailwind.config.js'));
        $this->assertFileDoesNotExist(base_path('postcss.config.js'));

        $this->assertFileExists(base_path('vite.config.js'));
        $this->assertFileExists(resource_path('sass/app.scss'));
        $this->assertFileExists(resource_path('js/app.js'));
        $this->assertFileExists(resource_path('views/navigation-menu.blade.php'));
        $this->assertFileExists(public_path('js/custom.js'));

        $packageJson = json_decode($files->get(base_path('package.json')), true);

        $this->assertArrayHasKey('devDependencies', $packageJson);
        $this->assertArrayHasKey('bootstrap', $packageJson['devDependencies']);
        $this->assertArrayHasKey('sass', $packageJson['devDependencies']);
        $this->assertArrayNotHasKey('tailwindcss', $packageJson['devDependencies']);
        $this->assertArrayNotHasKey('postcss', $packageJson['devDependencies']);
        $this->assertArrayNotHasKey('autoprefixer', $packageJson['devDependencies']);
    }

    public function test_swap_command_with_teams_option_publishes_team_views(): void
    {
        $files = new Filesystem();

        $this->seedPackageJson($files);

        $this->artisan('bootsjet:swap', ['--teams' => true])
            ->assertExitCode(0);

        $this->assertFileExists(resource_path('views/teams/show.blade.php'));
    }

    public function test_swap_command_is_idempotent_on_second_run(): void
    {
        $files = new Filesystem();

        $this->seedPackageJson($files);

        $this->artisan('bootsjet:swap')->assertExitCode(0);
        $this->artisan('bootsjet:swap')->assertExitCode(0);

        $this->assertFileExists(base_path('vite.config.js'));
        $this->assertFileExists(resource_path('sass/app.scss'));
        $this->assertFileExists(resource_path('js/app.js'));
        $this->assertFileExists(resource_path('views/navigation-menu.blade.php'));
        $this->assertFileExists(public_path('js/custom.js'));

        $packageJson = json_decode($files->get(base_path('package.json')), true);

        $this->assertArrayHasKey('bootstrap', $packageJson['devDependencies']);
        $this->assertArrayHasKey('sass', $packageJson['devDependencies']);
        $this->assertArrayNotHasKey('tailwindcss', $packageJson['devDependencies']);
    }

    public function test_swap_command_handles_invalid_package_json_gracefully(): void
    {
        $files = new Filesystem();

        $files->put(base_path('package.json'), '{invalid json');

        $this->artisan('bootsjet:swap')
            ->expectsOutputToContain('Skipping package.json update: invalid JSON.')
            ->assertExitCode(0);

        $this->assertFileExists(base_path('vite.config.js'));
        $this->assertFileExists(resource_path('sass/app.scss'));
        $this->assertFileExists(resource_path('js/app.js'));
        $this->assertSame('{invalid json', $files->get(base_path('package.json')));
    }

    public function test_swap_command_without_package_json_still_succeeds(): void
    {
        $files = new Filesystem();

        if ($files->exists(base_path('package.json'))) {
            $files->delete(base_path('package.json'));
        }

        $this->artisan('bootsjet:swap')->assertExitCode(0);

        $this->assertFileDoesNotExist(base_path('package.json'));
        $this->assertFileExists(base_path('vite.config.js'));
        $this->assertFileExists(resource_path('sass/app.scss'));
        $this->assertFileExists(resource_path('js/app.js'));
        $this->assertFileExists(public_path('js/custom.js'));
    }

    protected function seedPackageJson(Filesystem $files): void
    {
        $json = [
            'private' => true,
            'devDependencies' => [
                '@tailwindcss/forms' => '^0.5.0',
                '@tailwindcss/vite' => '^0.1.0',
                'autoprefixer' => '^10.0.0',
                'postcss' => '^8.0.0',
                'tailwindcss' => '^3.0.0',
                'vite' => '^5.0.0',
            ],
        ];

        $files->put(
            base_path('package.json'),
            json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).PHP_EOL
        );
    }
}
