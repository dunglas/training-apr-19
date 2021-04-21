<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BookFindCommand extends Command
{
    protected static $defaultName = 'app:book:find';
    protected static $defaultDescription = 'Find a book';

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->setAliases(['book:find'])
            ->setHelp('To find a book do something...')
            ->addArgument('id', InputArgument::OPTIONAL, 'The ID of the book')
            //->addOption('option1', 'o', InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (null === $input->getArgument('id')) {
            $input->setArgument('id', $io->ask('ID of the book to search:'));
        }

        $io->title('The title of my book');

        $io->section('Details');
        $io->table(
            ['ID', 'Title', 'Summary'],
            [
             [$input->getArgument('id'), 'My book', 'A Great book'],
            ]
        );

        $io->comment('A nice book to read');

        return Command::SUCCESS;
    }
}
