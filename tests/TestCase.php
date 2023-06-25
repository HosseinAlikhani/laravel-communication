<?php
namespace D3cr33\Communication\Test;

use D3cr33\Communication\CommunicationServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * store wallet faker
     */
    protected CommunicationFaker $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = app(CommunicationFaker::class);
        $this->artisan('migrate', ['--database' => 'sqlite'])->run();
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [CommunicationServiceProvider::class];
    }
}
