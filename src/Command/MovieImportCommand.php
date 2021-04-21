<?php

namespace App\Command;

use App\Entity\Movie;
use App\ImdbClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MovieImportCommand extends Command
{
    protected static $defaultName = 'app:movie:import';
    protected static $defaultDescription = 'Import a movie from IMDB';

    public function __construct(
        private ImdbClient $imdbClient,
        private EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('title', InputArgument::OPTIONAL, 'The title of the movie')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (null === $input->getArgument('title')) {
            $input->setArgument('title', $io->ask('What\'s the title of the movie to import?'));
        }

        $title = $input->getArgument('title');
        if (null === $title) {
            $io->error('The title must be passed explicitly when in non-interactive mode.');

            return Command::FAILURE;
        }

        $imdbData = $this->imdbClient->findMovieDetails($title);
        if (null === $imdbData) {
            $io->error(sprintf('Movie "%s" not found', $title));

            return Command::FAILURE;
        }

        $m = new Movie();
        $m->setTitle($imdbData['title']);
        $m->setPoster($imdbData['image']);

        $this->entityManager->persist($m);
        $this->entityManager->flush();

        // BATCH IMPORTS

        /*$i = 0;
        foreach ($batch as $imdbData) {
            $m = new Movie();
            $m->setTitle($imdbData['title']);
            $m->setPoster($imdbData['image']);

            $this->entityManager->persist($m);

            if ($i % 50 === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
            $i++;
        }
        $this->entityManager->flush();*/


        $io->success(sprintf('Movie "%s" successfully imported.', $title));

        return Command::SUCCESS;
    }
}
