<?php namespace Arcanedev\LaravelTracker\Tests;

use Illuminate\Support\Facades\Schema;

/**
 * Class     MigrationsTest
 *
 * @package  Arcanedev\LaravelTracker\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MigrationsTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_publish_migrations()
    {
        /** @var \Illuminate\Filesystem\Filesystem $filesystem */
        $filesystem = $this->app['files'];
        $src        = $this->getMigrationsSrcPath();
        $dest       = $this->getMigrationsDestPath();

        static::assertCount(0, $filesystem->allFiles($dest));

        $this->publishMigrations();

        static::assertEquals(
            count($filesystem->allFiles($src)),
            count($filesystem->allFiles($dest))
        );

        $filesystem->cleanDirectory($dest);
    }

    /** @test */
    public function it_can_migrate()
    {
        $this->migrate();

        foreach ($this->getTablesNames() as $table) {
            static::assertTrue(Schema::hasTable($table), "The table [$table] not found in the database.");
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    private function getTablesNames($prefix = 'tracker_')
    {
        $tables = array_map(function ($table) use ($prefix) {
            return $prefix.$table;
        }, [
            'agents',
            'cookies',
            'devices',
            'errors',
            'domains',
            'geoip',
            'languages',
            'paths',
            'queries',
            'referers',
            'referer_search_terms',
            'routes',
            'route_paths',
            'route_path_parameters',
            'visitors',
            'visitor_activities',
        ]);

        return $tables + [
            // Fixture tables
            'users',
        ];
    }
}
