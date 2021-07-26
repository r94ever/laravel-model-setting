<?php

namespace r94ever\LaravelModelSetting\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use r94ever\LaravelModelSetting\ModelSettingServiceProvider;
use r94ever\LaravelModelSetting\Tests\Model\User;

abstract class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupDatabase();
    }

    protected function getPackageProviders($app): array
    {
        return [
            ModelSettingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('database.default', 'testing');
    }

    protected function setupDatabase()
    {
        $this->createSettingsTable();
        $this->createUserTable();
        $this->seedUserModel();
    }

    protected function createSettingsTable()
    {
        include_once __DIR__ . '/../database/migrations/2021_07_25_161726_create_model_has_settings_table.php';

        (new \CreateModelHasSettingsTable())->down();
        (new \CreateModelHasSettingsTable())->up();
    }

    protected function createUserTable()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    protected function seedUserModel()
    {
        foreach (range(1, 10) as $id) {
            User::create(['name' => 'User - '.$id]);
        }
    }
}
