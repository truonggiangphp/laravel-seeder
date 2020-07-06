<?php

namespace Webikevn\LaravelSeeder\Command;

use Webikevn\LaravelSeeder\Repository\SeederRepository;
use Webikevn\LaravelSeeder\Repository\SeederRepositoryInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class SeedInstall extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'seed:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the seeder repository';

    /**
     * The repository instance.
     *
     * @var SeederRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param SeederRepository $repository
     */
    public function __construct(SeederRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->repository->setSource($this->input->getOption('database'));

        $this->repository->createRepository();

        $this->info('Seeder table created successfully.');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],
        ];
    }
}
