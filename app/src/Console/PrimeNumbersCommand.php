<?php

namespace ExadsChallenge\Console;

use ExadsChallenge\Libraries\PrimeNumbers;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PrimeNumbersCommand extends Command
{
    protected function configure(): void
    {
        parent::configure();
        $this
            ->setName('app:prime-challenge')
            ->setHidden(false)
            ->setDescription('Execute Prime challenge')
            ->setHelp('This command show a list...')
            ->addArgument('firstNumber', InputArgument::OPTIONAL, 'First number.', 1)
            ->addArgument('lastNumber', InputArgument::OPTIONAL, 'Last number.', 100);
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $firstNumber = $input->getArgument('firstNumber');
        $lastNumber = $input->getArgument('lastNumber');

        $primeNumbers = new PrimeNumbers();
        $answer = $primeNumbers->getAnswer();
        foreach ($answer as $line) {
            $output->writeln($line);
        }

        return Command::SUCCESS;
    }
}
