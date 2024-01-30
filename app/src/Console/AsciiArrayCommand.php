<?php

namespace ExadsChallenge\Console;

use ExadsChallenge\Libraries\AsciiArray;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AsciiArrayCommand extends Command
{
    protected function configure(): void
    {
        parent::configure();
        $this
            ->setName('app:ascii-array')
            ->setHidden(false)
            ->setDescription('Execute Prime challenge')
            ->setHelp('This command show a list...')
            ->addArgument('startChar', InputArgument::OPTIONAL, 'First number.', ',')
            ->addArgument('lastChar', InputArgument::OPTIONAL, 'Last number.', '|');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //TODO: Take care about excepetions
        $startChar = $input->getArgument('startChar');
        $lastChar = $input->getArgument('lastChar');

        $asciiArray = new AsciiArray($startChar, $lastChar);

        $answer = $asciiArray->getAnswer();

        foreach ($answer as $line) {
            $output->writeln($line);
        }

        return Command::SUCCESS;
    }
}
